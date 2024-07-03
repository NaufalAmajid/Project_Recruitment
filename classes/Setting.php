<?php

class Setting
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function updateSetting($table, $data, $where)
    {
        $db = DB::getInstance();
        $res = $db->update($table, $data, $where);

        return $res;
    }

    public function getSetting()
    {
        $query = "SELECT * FROM setting";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';

    $setting = new Setting();
    if ($_POST['action'] == 'changeSetting') {
        $data = [
            'nama_perusahaan' => $_POST['nama_perusahaan'],
            'alamat_perusahaan' => $_POST['alamat_perusahaan'],
            'email_perusahaan' => $_POST['email_perusahaan'],
            'pesan_email_lolos' => $_POST['pesan_email_lolos']
        ];
        $where = [
            'id' => 1
        ];
        $res = $setting->updateSetting('setting', $data, $where);

        if ($res) {
            echo json_encode([
                'status' => 'success',
                'title' => 'Berhasil',
                'msg' => 'Pesan email berhasil diubah'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'title' => 'Gagal',
                'msg' => 'Pesan email gagal diubah'
            ]);
        }
    }
}
