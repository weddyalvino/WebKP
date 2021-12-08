<?php


class DataKeluargaController
{
    private $dk;
    public function __construct(){
        $this->dk = new DataKelDAO();
    }

    public function index()
    {
        $btn = filter_input(INPUT_POST,"btnsimpan");
        if($btn){
            //get data dari form
            $hubungan = filter_input(INPUT_POST,"hubungan");
            $kk = filter_input(INPUT_POST,"nokk");
            $id = filter_input(INPUT_POST,"id");

            $userid = $_SESSION['userid'];

            //Connect db
            $result = $this->dk->updatekeluarga($kk,$hubungan,$id);
            if ($result==1){
                header("location:index.php?menu=data_keluarga");
            }
        }

        $keluarga=$this->dk->fetchkeluarga($_SESSION['userid']);
        include_once 'data_keluarga.php';
    }
}