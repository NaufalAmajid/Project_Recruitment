<?php

class Posisi
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function addPosisi($table, $data)
    {
        $db = DB::getInstance();
        $res = $db->add($table, $data);
        return $res;
    }

    public function updatePosisi($table, $data, $where)
    {
        $db = DB::getInstance();
        $res = $db->update($table, $data, $where);

        return $res;
    }

    public function getAllPosisi()
    {
        $query = "SELECT * FROM posisi WHERE is_active = 1 ORDER BY nama_posisi ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $divisi = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $divisi[] = $row;
        }

        return $divisi;
    }

    public function getAllPosisiAndCountLoker()
    {
        $query = "select
                        pos.nama_posisi,
                        pos.id_posisi,
                        count(lok.id_loker) as jumlah_loker 
                    from
                        posisi pos
                    left join loker lok on
                        pos.id_posisi = lok.posisi_id
                    where
                        pos.is_active = 1
                    group by
                        pos.id_posisi";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPosisiById($id)
    {
        $query = "SELECT * FROM posisi WHERE id_posisi = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';

    $posisi = new Posisi();
    if ($_POST['action'] == 'addPosisi') {
        $dataInsert = [
            'nama_posisi' => $_POST['nama_posisi'],
        ];
        $res = $posisi->addPosisi('posisi', $dataInsert);
        if ($res) {
            echo json_encode(['status' => 'success', 'message' => 'Data posisi berhasil ditambahkan', 'icon' => 'bx bx-check-circle']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data posisi gagal ditambahkan', 'icon' => 'bx bx-error-circle']);
        }
    }

    if ($_POST['action'] == 'showPosisi') {
        $data = $posisi->getPosisiById($_POST['id']);
        echo json_encode($data);
    }

    if ($_POST['action'] == 'updatePosisi') {
        $data = [
            'nama_posisi' => $_POST['nama_posisi']
        ];
        $where = [
            'id_posisi' => $_POST['id']
        ];
        $res = $posisi->updatePosisi('posisi', $data, $where);
        if ($res) {
            echo json_encode(['status' => 'success', 'message' => 'Data posisi berhasil diubah', 'icon' => 'bx bx-check-circle']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data posisi gagal diubah', 'icon' => 'bx bx-error-circle']);
        }
    }

    if ($_POST['action'] == 'deletePosisi') {
        $where = [
            'id_posisi' => $_POST['id']
        ];
        $data = [
            'is_active' => 0
        ];
        $res = $posisi->updatePosisi('posisi', $data, $where);
        if ($res) {
            echo json_encode(['status' => 'success', 'message' => 'Data posisi berhasil dihapus', 'icon' => 'bx bx-check-circle']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data posisi gagal dihapus', 'icon' => 'bx bx-error-circle']);
        }
    }
}
