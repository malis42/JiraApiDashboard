<?php
namespace SALESmanago\Models;

use JiraRestApi\Issue\IssueService;
use JiraRestApi\JiraException;

class JiraSearchModel
{
    private $jql;
    private $issueArr;
    private $startAt;	//the index of the first issue to return (0-based)
    private $maxResult;	// the maximum number of issues to return (defaults to 50).
    private $totalCount;	// the number of issues to return

    function __construct()
    {
        $this->jql = 'status NOT in (Canceled, Closed, Done, Resolved) AND labels = PACO order by created DESC';
        $this->issueArr = [];
        $this->startAt = 0;
        $this->maxResult = 100;
        $this->totalCount = -1;
    }

    public function getJiraIssues(){
        try {
            $issueService = new IssueService();
            //
            $jql = $this->jql;
            $startAt = $this->startAt;
            $maxResult = $this->maxResult;
            $issueArr = $this->issueArr;
            //
            // first fetch
            $ret = $issueService->search($jql, $startAt, $maxResult);
            $totalCount = $ret->total;

            // do something with fetched data
            foreach ($ret->issues as $issue) {
                $taskId = $issue->key;
                $taskStatus = $issue->fields->status->name;
                $reporterName = $issue->fields->reporter->displayName;
                $assigneeName = $issue->fields->assignee->displayName;
                $clientDueDate = $issue->fields->customFields['customfield_11414'];
                $taskArr = [
                    'task_id' => $taskId,
                    'task_status' => $taskStatus,
                    'reporter_name' => $reporterName,
                    'assignee_name' => $assigneeName,
                    'client_due_date' => $clientDueDate
                ];
                array_push($issueArr, $taskArr);
                //print (sprintf("%s %s %s %s %s <br/>", $issue->key, $issue->fields->status->name, $reporterName, $assigneeName, $issue->fields->customFields["customfield_11414"]));
            }

            if($totalCount > $maxResult){
                $issueResultCount = $totalCount/$maxResult;
                for($startAt = 1; $startAt < $issueResultCount; $startAt++){
                    $ret = $issueService->search($jql, $startAt*$maxResult, $maxResult);
                    foreach($ret->issues as $issue){
                        $taskId = $issue->key;
                        $taskStatus = $issue->fields->status->name;
                        $reporterName = $issue->fields->reporter->displayName;
                        $assigneeName = $issue->fields->assignee->displayName;
                        $clientDueDate = $issue->fields->customFields['customfield_11414'];
                        $taskArr = [
                            'task_id' => $taskId,
                            'task_status' => $taskStatus,
                            'reporter_name' => $reporterName,
                            'assignee_name' => $assigneeName,
                            'client_due_date' => $clientDueDate
                        ];
                        array_push($issueArr, $taskArr);
                        // print (sprintf("%s %s %s %s %s <br/>", $issue->key, $issue->fields->status->name, $reporterName, $assigneeName, $issue->fields->customFields["customfield_11414"]));
                    }
                }
            }
         //   return $issueArr;
            return json_encode($issueArr, JSON_UNESCAPED_UNICODE);
            //var_dump($issueArr);
        } catch (JiraException $e) {
            //$this->assertTrue(false, 'testSearch Failed : '.$e->getMessage());
        }
    }
}
