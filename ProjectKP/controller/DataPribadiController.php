<?php

class DataPribadiController
{
    private $pribadi;

    function __construct()
    {
        $this->pribadi = new DataPribadiDaoImpl();
    }

    public function dataPribadiPage()
    {
        $datapribadi = $this->pribadi->fetchData($_SESSION['userid']);

        $btn = filter_input(INPUT_POST, "btnsimpan");
        if (isset($btn)) {
            //get data dari form
            $nama = filter_input(INPUT_POST, "txtNama");
            $panggilan = filter_input(INPUT_POST, "txtNamaPanggil");
            $noanggota = filter_input(INPUT_POST, "txtNoAnggota");
            $jnsanggota = filter_input(INPUT_POST, "txtJnsAnggota");
            $statusjemaat = filter_input(INPUT_POST, "txtStatus");
            $jnskelamin = filter_input(INPUT_POST, "gender");
            $kotalahir = filter_input(INPUT_POST, "txtkota");
            $tgllahir = filter_input(INPUT_POST, "lahir");
            $statusnikah = filter_input(INPUT_POST, "txtStatusNikah");
            $goldar = filter_input(INPUT_POST, "txtgoldar");
            $idayah = filter_input(INPUT_POST, "txtnoayah");

            $namaayah = filter_input(INPUT_POST, "txtayah");
            $idibu = filter_input(INPUT_POST, "txtnoibu");

            $namaibu = filter_input(INPUT_POST, "txtibu");
            $id = $_SESSION['userid'];

            //Connect db
            $result = $this->pribadi->updateData($nama, $panggilan, $noanggota, $jnsanggota, $statusjemaat,
                $jnskelamin, $kotalahir, $tgllahir, $statusnikah, $goldar, $idayah, $namaayah, $idibu, $namaibu, $id);
            if ($result==1){
                header("location:index.php?menu=data_pribadi");
            }

        }

        require_once 'data_pribadi.php';
    }
    public function cekdata()
    {
        $res = $this->pribadi->fetchdatauser();
        require_once 'lihatdatajemaat.php';
    }
}