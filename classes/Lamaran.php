<?php
class Lamaran
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function updateLamaran($table, $data, $where)
    {
        $db = DB::getInstance();
        $res = $db->update($table, $data, $where);

        return $res;
    }

    public function getAllLamaran($where = null)
    {
        $where = $where ? $where : '';
        $query = "select
                        id_lamaran,
                        usr.email,
                        usr.username,
                        dk.nama,
                        pos.nama_posisi,
                        divi.nama_divisi,
                        lok.id_loker,
                        lam.file_lamaran,
                        lam.status_lamaran,
                        date_format(lam.created_at, '%Y-%m-%d') as hari,
                        date_format(lam.tgl_interview, '%Y-%m-%d') as tgl_interview,
                        date_format(lam.tgl_interview, '%H:%i') as jam
                    from
                        lamaran lam
                    join loker lok on
                        lam.loker_id = lok.id_loker
                    join posisi pos on
                        lok.posisi_id = pos.id_posisi
                    join divisi divi on
                        lok.divisi_id = divi.id_divisi
                    join detail_karyawan dk on
                        lam.karyawan_id = dk.id_karyawan
                    join user usr on
                        dk.user_id = usr.id_user
                        $where";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLamaranById($id)
    {
        $query = "select
                    usr.username,
                    usr.email,
                    usr.photo,
                    lam.*,
                    dk.*,
                    lok.*,
                    pos.nama_posisi,
                    divi.nama_divisi,
                    date_format(lam.created_at, '%Y-%m-%d') as hari
                from
                    lamaran lam
                join loker lok on
                    lam.loker_id = lok.id_loker
                join detail_karyawan dk on
                    lam.karyawan_id = dk.id_karyawan
                join user usr on
                    dk.user_id = usr.id_user
                join posisi pos on
                    lok.posisi_id = pos.id_posisi
                join divisi divi on
                    lok.divisi_id = divi.id_divisi
                where 
                    lam.id_lamaran = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllSoalByLokerAndPelamar($where)
    {
        $query = "select
                    *
                from
                    soal so
                    join jawaban jaw on so.id_soal = jaw.soal_id
                where
                    so.loker_id = :loker_id
                    and karyawan_id = :karyawan_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':loker_id', $where['loker_id']);
        $stmt->bindParam(':karyawan_id', $where['karyawan_id']);
        $stmt->execute($where);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSetting()
    {
        $query = "SELECT * FROM setting";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';
    require_once '../vendor_email/autoload.php';
    session_start();

    $lamaran = new Lamaran();
    if ($_POST['action'] == 'sendMail') {
        if ($_POST['status'] == 1) {
            $mail = new PHPMailer(true);
            $detailLamaran = $lamaran->getLamaranById($_POST['id_lamaran']);
            $setting = $lamaran->getSetting();
            $nama_pelamar = ucwords($detailLamaran['nama']);
            $nama_posisi = ucwords($detailLamaran['nama_posisi']);
            $nama_perusahaan = $setting['nama_perusahaan'];
            $tanggal = date('Y-m-d', strtotime('+7 days'));
            $waktu = '09:00';
            $alamat_perusahaan = $setting['alamat_perusahaan'];
            $email_perusahaan = $setting['email_perusahaan'];
            $nama_admin = ucwords($_SESSION['user']['nama_user']);

            $pesan_email_lolos = str_replace(
                ['{nama_pelamar}', '{nama_posisi}', '{nama_perusahaan}', '{tanggal}', '{waktu}', '{alamat_perusahaan}', '{email_perusahaan}', '{nama_admin}'],
                [$nama_pelamar, $nama_posisi, $nama_perusahaan, $tanggal, $waktu, $alamat_perusahaan, $email_perusahaan, $nama_admin],
                $setting['pesan_email_lolos']
            );

            try {
                // Config SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Host SMTP Gmail
                $mail->SMTPAuth   = true;
                $mail->Username   = $setting['email_perusahaan'];
                $mail->Password   = $setting['password_smtp'];
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // To
                $mail->setFrom($setting['email_perusahaan'], $setting['nama_perusahaan']);
                $mail->addAddress($detailLamaran['email'], $detailLamaran['nama']);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Lamaran Diterima';
                $mail->Body    =  nl2br(str_replace(' ', '  ', htmlspecialchars($pesan_email_lolos)));
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                $msg = 'Berhasil mengirim email';
            } catch (Exception $e) {
                $msg = 'Gagal mengirim email : ' . $mail->ErrorInfo;
            }

            $dataEdit = [
                'status_lamaran' => 1,
                'tgl_interview' => $tanggal . ' ' . $waktu
            ];
        } else {

            $dataEdit = [
                'status_lamaran' => 2,
            ];
        }
        $where = [
            'id_lamaran' => $_POST['id_lamaran']
        ];
        $save = $lamaran->updateLamaran('lamaran', $dataEdit, $where);
        if ($save) {
            if ($_POST['status'] == 1) {
                $msg = $msg;
            } else {
                $msg = 'Lamaran berhasil diUpdate';
            }
            echo json_encode([
                'status' => 'success',
                'title' => 'Berhasil',
                'msg' => $msg
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'title' => 'Gagal',
                'msg' => 'Gagal'
            ]);
        }
    }
}
