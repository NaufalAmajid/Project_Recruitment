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

    public function getJawabanByKaryawanAndLoker($data)
    {
        $query = "select
                        count(jaw.id_jawaban) as jawab
                    from
                        soal so
                    join loker lok on
                        so.loker_id = lok.id_loker
                    join jawaban jaw on
                        so.id_soal = jaw.soal_id
                    where
                        jaw.karyawan_id = :karyawan_id
                        and lok.id_loker = :loker_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':karyawan_id', $data['karyawan_id']);
        $stmt->bindParam(':loker_id', $data['loker_id']);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';
    session_start();

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

    if ($_POST['action'] == 'saveJawaban') {
        $jawaban = $_POST['jawaban'];
        $success = 0;
        $failed = 0;
        foreach ($jawaban as $key => $value) {
            $dataInsert = [
                'soal_id' => substr($key, 5),
                'karyawan_id' => $_SESSION['user']['id_karyawan'],
                'jawaban' => $value
            ];
            $res = $testSkill->addTest('jawaban', $dataInsert);
            if ($res) {
                $success++;
            } else {
                $failed++;
            }
        }

        echo json_encode([
            'status' => 'success',
            'title' => 'Berhasil',
            'msg' => "Jawaban berhasil disimpan. <br>Berhasil: $success <br>Gagal: $failed"
        ]);
    }

    if ($_POST['action'] == 'uploadBerkas') {
        $loker_id = $_POST['loker_id'];
        $karyawan_id = $_SESSION['user']['id_karyawan'];

        if (isset($_FILES['file_berkas'])) {
            $file_berkas = $_FILES['file_berkas'];
            $tmp_file_berkas = $file_berkas['tmp_name'];
            $name_file_berkas = $file_berkas['name'];
            $size_file_berkas = $file_berkas['size'];
            $error_file_berkas = $file_berkas['error'];

            $file_berkas_ext           = explode('.', $name_file_berkas);
            $file_berkas_actual_ext    = strtolower(end($file_berkas_ext));

            if ($error_file_berkas == 0) {
                $new_nama_file_berkas = "berkas_" . "$karyawan_id" . "_" . "$loker_id" . "." . $file_berkas_actual_ext;
                $file_laporan_destination = '../myfiles/berkas/' . $new_nama_file_berkas;
                // check destination
                if (file_exists($file_laporan_destination)) {
                    move_uploaded_file($tmp_file_berkas, $file_laporan_destination);
                    $dataEdit = [
                        'file_lamaran' => $new_nama_file_berkas
                    ];
                    $where = [
                        'karyawan_id' => $karyawan_id,
                        'loker_id' => $loker_id
                    ];
                    $res = $testSkill->updateTest('lamaran', $dataEdit, $where);
                } else {
                    move_uploaded_file($tmp_file_berkas, $file_laporan_destination);
                    $dataInsert = [
                        'karyawan_id' => $karyawan_id,
                        'loker_id' => $loker_id,
                        'file_lamaran' => $new_nama_file_berkas
                    ];
                    $res = $testSkill->addTest('lamaran', $dataInsert);
                }
                echo json_encode([
                    'status' => 'success',
                    'title' => 'Berhasil',
                    'msg' => 'Berkas berhasil diunggah!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'title' => 'Gagal',
                    'msg' => 'Terjadi kesalahan saat mengunggah berkas!'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'title' => 'Gagal',
                'msg' => 'Berkas tidak boleh kosong!'
            ]);
        }
    }
}
