<?php

class pdo_db
{

    private $databaseName;
    private $host;
    private $user;
    private $password;
    private $db;

    /**
     * pdo_db constructor.
     */
    function __construct()
    {
        $this->databaseName = 'theberry_drops';
        $this->host = 'localhost';
        $this->user = 'theberry_drops';
        $this->password = 't&c*[CZet0g-';
        $dsn = "mysql:dbname=$this->databaseName;host=$this->host";
        try {
            $db = new PDO($dsn, $this->user, $this->password);
            $this->db = $db;
        } // end try
        catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * @param $query
     * @return int
     */
    public function numrows($query)
    {
        $result = $this->db->query($query);
        return $result->rowCount();
    }

    /**
     * @param $query
     * @return PDOStatement
     */
    public function query($query)
    {
        return $this->db->query($query);
    }

}