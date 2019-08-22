<?php

namespace SALESmanago\Models;

use SALESmanago\Database\myDatabase;

class DbPushModel
{
    private $searchModel;
    private $jsonData;
    private $db;
    private $temp;

    function __construct()
    {
        $this->db = new myDatabase();
    }

    public function pushData()
    {
        $this->searchModel = new JiraSearchModel();
        $this->jsonData = $this->searchModel->getJiraIssues();
        $this->db->push("UPDATE tasks SET task_json = :jsonData WHERE id='1'", $this->jsonData);
        $this->temp = $this->db->fetch("SELECT * FROM tasks");

        if ($this->temp == false) {
            $this->db->push("INSERT INTO tasks(task_json) VALUES (:jsonData)", $this->jsonData);
        } else {
            $this->db->push("UPDATE tasks SET task_json = :jsonData WHERE id='1'", $this->jsonData);
        }
    }

    public function closeConn()
    {
        $this->db = null;
    }
}
