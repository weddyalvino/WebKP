<?php


class PendidikanController
{
    private $pendidikan;

    public function __construct()
    {
        $this->pendidikan = new PendidikanDAO();
    }

    public function index()
    {
        $res = $this->pendidikan->fetchpendidikan($_SESSION['userid']);

        $didik = $this->pendidikan->fetchjenis();

        //delete
        $command= filter_input(INPUT_GET,'cmd');
        if(isset($command) &&$command == 'del'){
            $cid= filter_input(INPUT_GET,'didik');
            if(isset($cid)){
                $delete = $this->pendidikan->deletedidik($cid);
                header("location:index.php?menu=pendidikan");
            }
        }

        //insert
        $btn = filter_input(INPUT_POST,"btnProses");
        $id = filter_input(INPUT_POST,"id");
        if($btn && $id==null){
            //get data dari form
            $jnspendidikan = filter_input(INPUT_POST,"jnspendidikan");
            $sekolah = filter_input(INPUT_POST,"sekolah");
            $jurusan = filter_input(INPUT_POST,"jurusan");
            $keterangan = filter_input(INPUT_POST,"keterangan");
            $userid = $_SESSION['userid'];

            //Connect db
            $result = $this->pendidikan->insertpendidikan($jnspendidikan,$sekolah,$jurusan,$keterangan,$userid);
            if ($result != 0) {
                header("location:index.php?menu=pendidikan");
            }
        }

        //Update
        else if(isset($btn) && $id){
            //get data dari form
            $jnspendidikan = filter_input(INPUT_POST,"jnspendidikan");
            $sekolah = filter_input(INPUT_POST,"sekolah");
            $jurusan = filter_input(INPUT_POST,"jurusan");
            $keterangan = filter_input(INPUT_POST,"keterangan");

            //Connect db
            $upd = $this->pendidikan->updatependidikan($jnspendidikan,$sekolah,$jurusan,$keterangan,$id);
            if ($upd != 0) {
                header("location:index.php?menu=pendidikan");
            }
        }

        include_once 'pendidikan.php';
    }
}