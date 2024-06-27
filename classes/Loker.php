<?php

class Loker
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function addLoker($table, $data)
    {
        $db = DB::getInstance();
        $res = $db->add($table, $data);
        return $res;
    }

    public function getAllLoker()
    {
        $query = "select
                        lok.id_loker,
                        pos.nama_posisi,
                        divi.nama_divisi,
                        lok.jumlah_kebutuhan,
                        lok.is_active,
                        lok.deskripsi,
                        count(lam.id_lamaran) as jumlah_pelamar 
                    from
                        loker lok
                    left join lamaran lam on
                        lok.id_loker = lam.loker_id
                    join posisi pos on
                        lok.posisi_id = pos.id_posisi
                    join divisi divi on
                        lok.divisi_id = divi.id_divisi
                    group by 
	                    lok.id_loker";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';

    $loker = new Loker();
    if ($_POST['action'] == 'addLoker') {
        $data = [
            'posisi_id' => $_POST['posisi'],
            'divisi_id' => $_POST['divisi'],
            'jumlah_kebutuhan' => $_POST['jumlah_kebutuhan'],
            'deskripsi' => $_POST['deskripsi'],
        ];
        $save = $loker->addLoker('loker', $data);
        if ($save) {
            echo json_encode([
                'status' => 'success',
                'icon' => 'bx bx-check',
                'message' => 'Data berhasil disimpan!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'icon' => 'bx bx-error',
                'message' => 'Data gagal disimpan!'
            ]);
        }
    }
}