<?php

namespace SALESmanago\Controllers;

use SALESmanago\Models\DbFetchModel;

class FrontInit
{
    private $fetchModel;
    private $jsonFetchedData;
    private $fetchedTimestamp;

    public function __construct()
    {
        $this->fetchModel = new DbFetchModel();
        $this->jsonFetchedData = json_decode($this->fetchModel->fetchData(), true);
        $this->fetchedTimestamp = $this->fetchModel->fetchTimestamp();
    }

    public function loadData()
    {
        $foreachIter = 0;
        if (!is_array($this->jsonFetchedData)) {
            return true;
        }
        foreach ($this->jsonFetchedData as $issue) {
            empty($issue['assignee_name']) ? $issue['assignee_name'] = 'Not assigned' : $issue['assignee_name'];
            empty($issue['client_due_date']) ? $issue['client_due_date'] = 'Not set' : $issue['client_due_date'];
            echo "<tr><th scope='row'>{$foreachIter}</th>
          <td>{$issue['task_id']}</td>
          <td>{$issue['task_status']}</td>
          <td>{$issue['reporter_name']}</td>
          <td>{$issue['assignee_name']}</td>
          <td>{$issue['client_due_date']}</td></tr>";
            $foreachIter++;
        }
    }

    public function loadTimestamp()
    {
        $date = new \DateTime($this->fetchedTimestamp);
        echo $date->format('F jS, Y');
    }

    public function __destruct()
    {
        $this->fetchModel->closeConn();
    }
}
