<?php
namespace SALESmanago\Models;
use SALESmanago\Database\myDatabase;

class DbFetchModel
{
    private $db;
    private $string;
    private $timestamp;

    public function __construct()
    {
        $this->db = new myDatabase();
    }

    public function fetchData()
    {
        $this->string = $this->db->fetch("SELECT task_json FROM tasks WHERE id='1'");
        return $this->string;
    }

    public function fetchTimestamp() {
        $this->timestamp = $this->db->fetch("SELECT timestamp FROM tasks WHERE id='1'");
        return $this->timestamp;
    }

    public function closeConn() {
        $this->db = null;
    }
}