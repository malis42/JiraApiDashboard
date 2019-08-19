<?php
namespace models;

use database\myDatabase;
use models\jiraSearchModel;

class dbPushModel{
    private $searchModel;
    private $jsonData;
    private $db;

    function __construct()
    {
        $this->db = new myDatabase();
    }

    public function pushData(){
        $this->searchModel = new jiraSearchModel();
        $this->jsonData = $this->searchModel->getJiraIssues();
        $this->db->push("UPDATE tasks SET task_json = :jsonData WHERE id='1'", $this->jsonData);
    }

    public function closeConn(){
        $this->db = null;
    }
}