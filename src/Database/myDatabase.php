<?php
namespace SALESmanago\Database;

class myDatabase
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = 'root';
    private $database = 'api_jira';
    private $db;
    private $stmt;
    private $result;

    public function __construct()
    {
        try {
            $this->db = new \PDO("mysql:host={$this->host}; dbname={$this->database}; port=3306; charset=utf8",
                $this->user,
                $this->pass,
                [\PDO::ATTR_EMULATE_PREPARES => false, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
            return $this->db;
        } catch (\PDOException $e) {
            exit('Database error' . $e->getMessage());
        }
    }

    /**
     * Fetches json file with issues from database
     * @param string sql
     * @return object pdo::fetchColumn
     */
    public function fetch($sql){
        $this->stmt = $this->db->prepare($sql);
        $this->stmt->execute();
        $this->result = $this->stmt->fetchColumn();
        return $this->result;
    }

    /**
     * Pushes json file with issues to database
     * @param string $sql
     * @param object $jsonData
     */
    public function push($sql, $jsonData){
        $this->stmt = $this->db->prepare($sql);
        $this->stmt->bindParam(':jsonData', $jsonData, \PDO::PARAM_STR);
        $this->stmt->execute();
    }

    /**
     * Fetches token connected with $email in database
     * @param string $sql
     * @param string $email
     * @return mixed pdo::fetchColumn (token)
     */
    public function logIn($sql, $email){
        $this->stmt = $this->db->prepare($sql);
        $this->stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $this->stmt->execute();
        $this->result = $this->stmt->fetchColumn();
        return $this->result;
    }
}