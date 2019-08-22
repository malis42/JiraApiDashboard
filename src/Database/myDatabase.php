<?php

namespace SALESmanago\Database;

use Dotenv\Dotenv;

class myDatabase
{
    private $db;
    private $stmt;
    private $result;

    public function __construct()
    {
        $dotenv = Dotenv::create(__DIR__);
        $dotenv->load();

        try {
            $database = getenv('DB_NAME');
            $host = getenv('DB_HOST');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');

            $this->db = new \PDO("mysql:host={$host}; dbname={$database}; port=3306; charset=utf8",
                $user,
                $pass,
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
    public function fetch($sql)
    {
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
    public function push($sql, $jsonData)
    {
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
    public function logIn($sql, $email)
    {
        $this->stmt = $this->db->prepare($sql);
        $this->stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $this->stmt->execute();
        $this->result = $this->stmt->fetchColumn();

        return $this->result;
    }
}
