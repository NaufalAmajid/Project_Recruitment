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
}
