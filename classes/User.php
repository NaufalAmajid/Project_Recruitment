<?php

class User
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

    public function updateUser($table, $data, $where)
    {
        $db = DB::getInstance();
        $res = $db->update($table, $data, $where);

        return $res;
    }

    public function checkUser($where)
    {
        $query = "SELECT * FROM user WHERE (username = :username OR email = :email) AND is_active = 1 AND role_id = :role_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $where['username']);
        $stmt->bindParam(':role_id', $where['role_id']);
        $stmt->bindParam(':email', $where['email']);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUserAccount($where = null)
    {
        $where = is_null($where) ? '' : $where;
        $query = "select
                        usr.username,
                        usr.email,
                        usr.id_user,
                        case
                            when da.nama is not null then da.nama
                            when dh.nama is not null then dh.nama
                            when dk.nama is not null then dk.nama
                        end as nama_user,
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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config/connection.php';
    require_once '../classes/DB.php';

    $user = new User();
    if ($_POST['action'] == 'addUser') {

        $checkUser = $user->checkUser(['username' => $_POST['username'], 'role_id' => $_POST['role_user'], 'email' => $_POST['email']]);
        if ($checkUser) {
            echo json_encode(['status' => 'info', 'message' => 'username / email sudah digunakan!', 'icon' => 'bx bx-info-circle']);
            return;
        }

        $insertUser = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => md5('123'),
            'role_id' => $_POST['role_user'],
        ];
        $saveUser = $user->addUser('user', $insertUser);

        $insertRole = [
            'user_id' => $saveUser,
            'nama' => $_POST['nama'],
        ];

        if ($_POST['role_user'] == 1) {
            $table = 'detail_admin';
        } else {
            $table = 'detail_hrd';
        }

        $saveRole = $user->addUser($table, $insertRole);

        if ($saveRole) {
            echo json_encode(['status' => 'success', 'message' => 'User berhasil ditambahkan!', 'icon' => 'bx bx-check']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User gagal ditambahkan!', 'icon' => 'bx bx-error']);
        }
    }

    if ($_POST['action'] = 'changeStatusUser') {
        $success = 0;
        $failed = 0;
        foreach ($_POST['group_action'] as $id) {
            $data = [
                'is_active' => $_POST['status']
            ];
            $where = [
                'id_user' => $id
            ];
            $update = $user->updateUser('user', $data, $where);
            if ($update) {
                $success++;
            } else {
                $failed++;
            }
        }

        $msg = $success . ' user berhasil di' . ($_POST['status'] == 1 ? 'aktifkan' : 'non-aktifkan');

        if ($failed > 0) {
            $msg .= ', ' . $failed . ' gagal di' . ($_POST['status'] == 1 ? 'aktifkan' : 'non-aktifkan');
        } else {
            $msg .= '!';
        }

        echo json_encode(['status' => 'success', 'message' => $msg, 'icon' => 'bx bx-check']);
    }
}
