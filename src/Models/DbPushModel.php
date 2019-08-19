<?php
namespace SALESmanago\Models;
use SALESmanago\Database\myDatabase;
use SALESmanago\Models\JiraSearchModel;

class DbPushModel{
    private $searchModel;
    private $jsonData;
    private $db;

    function __construct()
    {
        $this->db = new myDatabase();
    }

    public function pushData(){
        $this->searchModel = new JiraSearchModel();
        $this->jsonData = $this->searchModel->getJiraIssues();
        $this->db->push("UPDATE tasks SET task_json = :jsonData WHERE id='1'", $this->jsonData);
    }

    public function closeConn(){
        $this->db = null;
    }
}