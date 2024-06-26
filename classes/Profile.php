<?php

class Profile
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function updateUser($table, $data, $where)
    {
        $db = DB::getInstance();
        $res = $db->update($table, $data, $where);

        return $res;
    }

    public function checkPasswordUser($where)
    {
        $password = md5($where['password']);
        $query = "SELECT * FROM user WHERE id_user = :id_user AND password = :password AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $where['id_user']);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkUsernameEmail($where)
    {
        $query = "SELECT * FROM user WHERE (username = :username OR email = :email) AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $where['username']);
        $stmt->bindParam(':email', $where['email']);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDetailUser($where = null)
    {
        $where = is_null($where) ? '' : $where;
        $query = "select
                    usr.username,
                    usr.email,
                    usr.id_user,
                    usr.photo,
                    case
                        when da.nama is not null then da.nama
                        when dh.nama is not null then dh.nama
                        when dk.nama is not null then dk.nama
                    end as nama_user,
                    case
                        when da.id_admin is not null then da.id_admin
                        when dh.id_hrd is not null then dh.id_hrd
                        when dk.id_karyawan is not null then dk.id_karyawan
                    end as the_id,
                    ro.id_role,
                    ro.nama_role,
                    usr.is_active,
                    dk.*
                from
                    user usr
                left join detail_admin da on
                    usr.id_user = da.user_id
                left join detail_hrd dh on
                    usr.id_user = dh.user_id
                left join detail_karyawan dk on
                    usr.id_user = dk.user_id
                join role ro on
                    usr.role_id = ro.id_role
                $where";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';

    $profile = new Profile();
    if ($_POST['action'] == 'checkPasswordUser') {
        $where = [
            'id_user' => $_POST['id_user'],
            'password' => $_POST['password']
        ];
        $res = $profile->checkPasswordUser($where);

        if ($res) {
            echo true;
        } else {
            echo false;
        }
    }

    if ($_POST['action'] == 'updateAccountUser') {
        session_start();
        // check photo
        if (isset($_FILES['photo'])) {
            $photo               = $_FILES['photo'];
            $photo_name          = $photo['name'];
            $photo_tmp           = $photo['tmp_name'];
            $photo_size          = $photo['size'];
            $photo_error         = $photo['error'];

            $photo_ext           = explode('.', $photo_name);
            $photo_actual_ext    = strtolower(end($photo_ext));

            $allowed             = ['jpg', 'jpeg', 'png'];

            if (in_array($photo_actual_ext, $allowed)) {
                if ($photo_error === 0) {
                    if ($photo_size < 1000000) {
                        $nama_user = strtolower(preg_replace('/\s+/', '', $_SESSION['user']['nama_user']));
                        $nama_user = preg_replace('/[^\w\s]|_/', '', $nama_user);
                        $photo_new_name = $nama_user . '_' . $_SESSION['user']['id_user'] . '.' . $photo_actual_ext;
                        $photo_destination = '../myfiles/photo/' . $photo_new_name;
                    } else {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Ukuran file terlalu besar',
                            'icon' => 'bx bx-error'
                        ]);
                        exit;
                    }
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan saat mengupload file',
                        'icon' => 'bx bx-error'
                    ]);
                    exit;
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Ekstensi file tidak diizinkan',
                    'icon' => 'bx bx-error'
                ]);
                exit;
            }
        }
        // end check photo

        // check username and email
        $checkUser = $profile->checkUsernameEmail([
            'username' => $_POST['username'],
            'email' => $_POST['email']
        ]);
        if ($checkUser) {
            if ($checkUser['id_user'] != $_SESSION['user']['id_user']) {
                echo json_encode([
                    'status' => 'info',
                    'message' => 'username / email sudah digunakan!',
                    'icon' => 'bx bx-info-circle'
                ]);
                exit;
            }
        }
        // end check username and email

        $insertUser = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
        ];
        //check change password
        if ($_POST['real_password'] != '') {
            $insertUser['password'] = md5($_POST['change_password']);
        }
        // end check change password
        // save photo
        if (isset($photo_new_name)) {
            move_uploaded_file($photo_tmp, $photo_destination);
            $insertUser['photo'] = $photo_new_name;
        }
        // end save photo
        $updateUser = $profile->updateUser('user', $insertUser, ['id_user' => $_SESSION['user']['id_user']]);


        // choice table
        if ($_POST['id_role'] == 1) {
            $table = 'detail_admin';
        } else if ($_POST['id_role'] == 2) {
            $table = 'detail_hrd';
        } else {
            $table = 'detail_karyawan';
        }
        // end choice table

        $insertRole = [
            'nama' => $_POST['nama'],
        ];
        $updateRole = $profile->updateUser($table, $insertRole, ['user_id' => $_SESSION['user']['id_user']]);

        echo json_encode([
            'status' => 'success',
            'message' => 'User berhasil diupdate!',
            'icon' => 'bx bx-check'
        ]);

        $detail = $profile->getDetailUser("where usr.id_user = " . $_SESSION['user']['id_user']);
        $_SESSION['user'] = $detail;
    }

    if ($_POST['action'] == 'updateBioKaryawan') {
        session_start();
        $updateKaryawan = [
            'nik' => $_POST['nik'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'no_hp' => $_POST['no_hp'],
            'alamat' => $_POST['alamat'],
        ];
        // check jenkel
        if (isset($_POST['jenkel'])) {
            $updateKaryawan['jenkel'] = $_POST['jenkel'];
        }
        // check tanggal lahir
        if ($_POST['tanggal_lahir'] != '') {
            $updateKaryawan['tanggal_lahir'] = $_POST['tanggal_lahir'];
        }

        $updateUser = $profile->updateUser('detail_karyawan', $updateKaryawan, ['user_id' => $_SESSION['user']['id_user']]);

        if ($updateUser) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Bio berhasil diupdate!',
                'icon' => 'bx bx-check'
            ]);
            $detail = $profile->getDetailUser('where usr.id_user = ' . $_SESSION['user']['id_user']);
            $_SESSION['user'] = $detail;
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Bio gagal diupdate!',
                'icon' => 'bx bx-error'
            ]);
        }
    }
}
