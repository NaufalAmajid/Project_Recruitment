<?php

class Test_Skill
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function addTest($table, $data)
    {
        $db = DB::getInstance();
        $res = $db->add($table, $data);
        return $res;
    }

    public function updateTest($table, $data, $where)
    {
        $db = DB::getInstance();
        $res = $db->update($table, $data, $where);

        return $res;
    }

    public function deleteTest($table, $where)
    {
        $db = DB::getInstance();
        $res = $db->delete($table, $where);

        return $res;
    }

    public function getAllTestByLoker($loker_id)
    {
        $query = "select
                    *
                from
                    soal so
                where
                    so.loker_id = :loker_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':loker_id', $loker_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';

    $testSkill = new Test_Skill();
    if ($_POST['action'] == 'addSoal') {
        $data = [
            'soal' => $_POST['soal'],
            'loker_id' => $_POST['loker_id']
        ];
        $res = $testSkill->addTest('soal', $data);

        if ($res) {
            echo json_encode([
                'status' => 'success',
                'icon' => 'bx bx-check',
                'msg' => 'Soal berhasil ditambahkan'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'icon' => 'bx bx-error',
                'msg' => 'Soal gagal ditambahkan'
            ]);
        }
    }

    if ($_POST['action'] == 'editSoal') {
        $data = [
            'soal' => $_POST['soal']
        ];
        $where = [
            'id_soal' => $_POST['id_soal']
        ];
        $res = $testSkill->updateTest('soal', $data, $where);

        if ($res) {
            echo json_encode([
                'status' => 'success',
                'icon' => 'bx bx-check',
                'msg' => 'Soal berhasil diubah'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'icon' => 'bx bx-error',
                'msg' => 'Soal gagal diubah'
            ]);
        }
    }

    if ($_POST['action'] == 'deleteSoal') {
        $where = [
            'id_soal' => $_POST['id_soal']
        ];
        $res = $testSkill->deleteTest('soal', $where);

        if ($res) {
            echo json_encode([
                'status' => 'success',
                'icon' => 'bx bx-check',
                'msg' => 'Soal berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'icon' => 'bx bx-error',
                'msg' => 'Soal gagal dihapus'
            ]);
        }
    }
}
