<?php
class Lamaran
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function getAllLamaran()
    {
        $query = "select
                        id_lamaran,
                        usr.email,
                        dk.nama,
                        pos.nama_posisi,
                        divi.nama_divisi,
                        lok.id_loker,
                        lam.file_lamaran,
                        lam.status_lamaran,
                        date_format(lam.created_at, '%Y-%m-%d') as hari
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
                        dk.user_id = usr.id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLamaranById($id)
    {
        $query = "select
                        id_lamaran,
                        usr.email,
                        dk.nama,
                        pos.nama_posisi,
                        divi.nama_divisi,
                        lok.id_loker,
                        lam.file_lamaran,
                        lam.status_lamaran,
                        date_format(lam.created_at, '%Y-%m-%d') as hari
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
                    where
                        id_lamaran = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
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
    
    $lamaran = new Lamaran();
    if ($_POST['action'] == 'sendMail') {
        if ($_POST['status'] == 1) {
            $mail = new PHPMailer(true);
            $detailLamaran = $lamaran->getLamaranById($_POST['id_lamaran']);
            $setting = $lamaran->getSetting();
            try {
                // Config SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Host SMTP Gmail
                $mail->SMTPAuth   = true;
                $mail->Username   = 'naoefal.arters0@gmail.com';
                $mail->Password   = 'tovujptgqfcrrymf';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // To
                $mail->setFrom('naoefal.arters0@gmail.com', 'Nanzy');
                $mail->addAddress($detailLamaran['email'], $detailLamaran['nama']);

                // Content
                $otp = rand(100000, 999999); // Generate 6-digit OTP
                $mail->isHTML(true);
                $mail->Subject = 'Lamaran Diterima';
                $mail->Body    = $setting['pesan_email_lolos'];
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo 'Message has not been sent';
        }
    }
}
