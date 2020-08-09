<?php

class Admin_model {
    private $dbh; // database handler
    private $stmt;

    public function __construct()
    {
        // data source name
        $dsn = 'mysql:host=localhost;dbname=sipdp_kelsaru';

        try {
            $this->dbh = new PDO($dsn, 'root', '');
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getAllAdmin()
    {
        $this->stmt = $this->dbh->prepare('SELECT * FROM m_admin');
        $this->stmt->execute(); // menjalankan query
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC); // ambil semua data
    }
}