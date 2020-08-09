<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh; // database handler
    private $stmt;

    public function __construct()
    {
        // data source name
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->db_name.'';

        $option = [
            PDO::ATTR_PERSISTENT => true, // untuk membuat koneksinya terjaga selalu
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // untuk mode errornya
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    // untuk query
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // untuk sambungan query atau parameter
    public function bind($param, $value, $type = null)
    {
        if(is_null($type)) {
            switch(true) {
                // jika value integer
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                // jika value boolean
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                // jika value null
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                // jika value null
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // eksekusi query
    public function execute()
    {
        $this->stmt->execute();
    }

    // ambil semua data
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ambil satu data
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}