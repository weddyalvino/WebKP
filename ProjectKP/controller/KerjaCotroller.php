<?php


class KerjaCotroller
{
    private $kerja;

    public function __construct()
    {
        $this->kerja = new kerjaDAO();
    }

    public function index()
    {
        $kerjadata = $this->kerja->fetchPekerjaan($_SESSION['userid']);

        $command = filter_input(INPUT_GET, 'cmd');
        if (isset($command) && $command == 'del') {
            $cid = filter_input(INPUT_GET, 'kerja');
            if (isset($cid)) {
                $delete = $this->kerja->deletekerja($cid);
                header("location:index.php?menu=pekerjaan");
            }
        }


        $btn = filter_input(INPUT_POST, "btnProses");
        $id = filter_input(INPUT_POST, "id");

        //get data dari form
        $mulai = filter_input(INPUT_POST, "tglMulai");
        $akhir = filter_input(INPUT_POST, "akhir");
        if ($akhir != 1) {
            $akhir = filter_input(INPUT_POST, "tglAkhir");
        } else {
            $akhir = null;
        }
        $keterangan = filter_input(INPUT_POST, "keterangan");
        $kerjaid = filter_input(INPUT_POST, "pekerjaan");
        $userid = $_SESSION['userid'];

        //Update
        if (isset($btn) && $id) {
            $result = $this->kerja->updatekerja($id, $mulai, $akhir, $keterangan, $kerjaid);
            if ($result != 0) {
                header("location:index.php?menu=pekerjaan");
            }
        }
        else if ($btn && $id == null) {
            $result = $this->kerja->insertkerja($mulai, $akhir, $keterangan, $kerjaid, $userid);
            if ($result != 0) {
                header("location:index.php?menu=pekerjaan");
            }
        }

        include_once 'pekerjaan.php';
    }
}