<?php

class Auth
{
    private $conn;

    public function __construct()
    {
        $this->conn = DB::getInstance()->connection();
    }

    public function addUser($table, $data)
    {
        $db = DB::getInstance();
        $res = $db->add($table, $data);
        if ($table == 'user') {
            $ret = $this->conn->lastInsertId();
        } else {
            $ret = $res;
        }

        return $ret;
    }

    public function getDetailUser($data)
    {
        $username_email = $data['username_email'];
        $password = md5($data['password']);
        $query = "select
                    usr.username,
                    usr.email,
                    usr.id_user,
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
                where
                    (usr.username like '%$username_email%'
                        or usr.email like '%$username_email%')
                    and usr.password = '$password'
                    and usr.is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function checkUserDuplicateEmailOrUsername($email, $username)
    {
        $query = "SELECT * FROM user WHERE email = :email OR username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';

    $auth = new Auth();
    if ($_POST['action'] == 'logout') {
        session_start();
        session_destroy();
    }

    if ($_POST['action'] == 'login') {
        $checkUser = $auth->getDetailUser($_POST);
        if ($checkUser) {
            session_start();
            $_SESSION['user'] = $checkUser;
            $_SESSION['is_login'] = true;
            echo json_encode(['status' => 'success', 'message' => 'Login berhasil', 'icon' => 'bx bx-check']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Username atau password salah', 'icon' => 'bx bx-error']);
        }
    }

    if ($_POST['action'] == 'signup') {
        $checkUser = $auth->checkUserDuplicateEmailOrUsername($_POST['email'], $_POST['username']);
        if ($checkUser) {
            if ($checkUser['email'] == $_POST['email']) {
                echo json_encode(['status' => 'error', 'message' => 'Email sudah terdaftar, silahkan gunakan email lain', 'icon' => 'bx bx-error']);
                exit;
            } else if ($checkUser['username'] == $_POST['username']) {
                echo json_encode(['status' => 'error', 'message' => 'Username sudah terdaftar, silahkan gunakan username lain', 'icon' => 'bx bx-error']);
                exit;
            }
        } else {
            $insertUser = [
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'role_id' => 3,
            ];
            $addUser = $auth->addUser('user', $insertUser);

            $insertKaryawan = [
                'user_id' => $addUser,
                'nama' => $_POST['nama'],
            ];
            $addKaryawan = $auth->addUser('detail_karyawan', $insertKaryawan);

            if ($addKaryawan) {
                echo json_encode(['status' => 'success', 'message' => 'Registrasi berhasil, silahkan login', 'icon' => 'bx bx-check']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Registrasi gagal, silahkan coba lagi', 'icon' => 'bx bx-error']);
            }
        }
    }
}
