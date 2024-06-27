<?php

class Divisi
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function getAllDivisi()
    {
        $query = "SELECT * FROM divisi WHERE is_active = 1 ORDER BY nama_divisi ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $divisi = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $divisi[] = $row;
        }

        return $divisi;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';

    $divisi = new Divisi();
}
