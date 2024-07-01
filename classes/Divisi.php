<?php

class Divisi
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function addDivisi($table, $data)
    {
        $db = DB::getInstance();
        $res = $db->add($table, $data);
        return $res;
    }

    public function updateDivisi($table, $data, $where)
    {
        $db = DB::getInstance();
        $res = $db->update($table, $data, $where);

        return $res;
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

    public function getAllDivisiAndCountLoker()
    {
        $query = "select
                        divi.nama_divisi,
                        divi.id_divisi,
                        count(lok.id_loker) as jumlah_loker 
                    from
                        divisi divi
                    left join loker lok on
                        divi.id_divisi = lok.divisi_id
                    where
                        divi.is_active = 1
                    group by
                        divi.id_divisi";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDivisiById($id)
    {
        $query = "SELECT * FROM divisi WHERE id_divisi = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';

    $divisi = new Divisi();
    if ($_POST['action'] == 'addDivisi') {
        $dataInsert = [
            'nama_divisi' => $_POST['nama_divisi'],
        ];
        $res = $divisi->addDivisi('divisi', $dataInsert);
        if ($res) {
            echo json_encode(['status' => 'success', 'message' => 'Data divisi berhasil ditambahkan', 'icon' => 'bx bx-check-circle']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data divisi gagal ditambahkan', 'icon' => 'bx bx-error-circle']);
        }
    }

    if ($_POST['action'] == 'showDivisi') {
        $data = $divisi->getDivisiById($_POST['id']);
        echo json_encode($data);
    }

    if ($_POST['action'] == 'updateDivisi') {
        $data = [
            'nama_divisi' => $_POST['nama_divisi']
        ];
        $where = [
            'id_divisi' => $_POST['id']
        ];
        $res = $divisi->updateDivisi('divisi', $data, $where);
        if ($res) {
            echo json_encode(['status' => 'success', 'message' => 'Data divisi berhasil diubah', 'icon' => 'bx bx-check-circle']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data divisi gagal diubah', 'icon' => 'bx bx-error-circle']);
        }
    }

    if ($_POST['action'] == 'deleteDivisi') {
        $where = [
            'id_divisi' => $_POST['id']
        ];
        $data = [
            'is_active' => 0
        ];
        $res = $divisi->updateDivisi('divisi', $data, $where);
        if ($res) {
            echo json_encode(['status' => 'success', 'message' => 'Data divisi berhasil dihapus', 'icon' => 'bx bx-check-circle']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data divisi gagal dihapus', 'icon' => 'bx bx-error-circle']);
        }
    }
}
