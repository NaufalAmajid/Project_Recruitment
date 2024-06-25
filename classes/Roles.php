<?php

class Roles
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function getAllRole()
    {
        $query = "SELECT * FROM role";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $roles;
    }

    public function getRoleBySimple($simple)
    {
        $query = "SELECT * FROM role WHERE simple_nama_role = :simple";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':simple', $simple);
        $stmt->execute();

        $role = $stmt->fetch(PDO::FETCH_ASSOC);

        return $role;
    }
}
