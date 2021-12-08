<?php


class KontakController
{
    private $Kontak;

    public function __construct()
    {
        $this->Kontak = new KontakDAO();
    }

    public function index()
    {

        $res = $this->Kontak->fetchkontak($_SESSION['userid']);
        //delete
        $command = filter_input(INPUT_GET, 'cmd');
        if (isset($command) && $command == 'del') {
            $cid = filter_input(INPUT_GET, 'kntk');
            if (isset($cid)) {
                $delete = $this->Kontak->deletekontak($cid);
                header("location:index.php?menu=kontak");
            }
        }

        //get data dari form
        $jenis = filter_input(INPUT_POST, "Komunikasi");
        $alamat = filter_input(INPUT_POST, "alamat");
        $keterangan = filter_input(INPUT_POST, "keterangan");
        $userid = $_SESSION['userid'];


        //insert
        $btn = filter_input(INPUT_POST, "btnProses");
        $id = filter_input(INPUT_POST, "id");
        if ($btn && $id == null) {
            //Connect db
            $result = $this->Kontak->insertKontak($jenis, $alamat, $keterangan, $userid);
            if ($result != 0) {
                header("location:index.php?menu=kontak");
            }
        }

        //Update
        if (isset($btn) && $id) {
            //Connect db
            $upd = $this->Kontak->updatekontak($jenis, $alamat, $keterangan, $id);
            if ($upd != 0) {
                header("location:index.php?menu=kontak");
            }
        }

        include_once 'kontak.php';
    }
}