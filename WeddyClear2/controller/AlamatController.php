<?php


class AlamatController
{
    private $alamat;

    public function __construct()
    {
        $this->alamat = new AlamatDAO();
    }

    public function index()
    {
        $alamatdata = $this->alamat->fetchalamat($_SESSION['userid']);
        if (empty($alamatdata)){
            $cek=0;
        }
        else{
            $cek=1;
        }

        $command = filter_input(INPUT_GET, 'cmd');
        if (isset($command) && $command == 'del') {
            $cid = filter_input(INPUT_GET, 'alamat');
            if (isset($cid)) {
                $delete = $this->alamat->deletealamat($cid);
                header("location:index.php?menu=alamat");
            }
        }

        $btn = filter_input(INPUT_POST, "btnProses");
        $id = filter_input(INPUT_POST, "id");
        if ($btn && $id == null) {
            //get data dari form
            $id_user = $_SESSION['userid'];
            $jnsalamat = filter_input(INPUT_POST, "jnsalamat");
            $provinsi = filter_input(INPUT_POST, "provinsi");
            $kabupaten = filter_input(INPUT_POST, "kota");
            $kecamatan = filter_input(INPUT_POST, "kecamatan");

            $kelurahan = filter_input(INPUT_POST, "desa");

            $alamatlengkap = filter_input(INPUT_POST, "alamat");
            $rt = filter_input(INPUT_POST, "RT");
            $rw = filter_input(INPUT_POST, "RW");
            $kodepos = filter_input(INPUT_POST, "KodePos");
            $koordinatgps = filter_input(INPUT_POST, "koordinat");

            //Connect db
            $result = $this->alamat->insertalamat($id_user, $jnsalamat, $provinsi, $kabupaten, $kecamatan, $kelurahan, $alamatlengkap, $rt, $rw, $kodepos, $koordinatgps);
            if ($result != 0) {
                header("location:index.php?menu=alamat");
            }
        } else if ($btn && $id != null) {
            $id = filter_input(INPUT_POST, "id");
            $jnsalamat = filter_input(INPUT_POST, "jnsalamat");
            $provinsi = filter_input(INPUT_POST, "provinsi");
            $kabupaten = filter_input(INPUT_POST, "kota");
            $kecamatan = filter_input(INPUT_POST, "kecamatan");

            $kelurahan = filter_input(INPUT_POST, "desa");

            $alamatlengkap = filter_input(INPUT_POST, "alamat");
            $rt = filter_input(INPUT_POST, "RT");
            $rw = filter_input(INPUT_POST, "RW");
            $kodepos = filter_input(INPUT_POST, "KodePos");
            $koordinatgps = filter_input(INPUT_POST, "koordinat");

            //Connect db
            $result = $this->alamat->updatealamat($jnsalamat, $provinsi, $kabupaten, $kecamatan, $kelurahan, $alamatlengkap, $rt, $rw, $kodepos, $koordinatgps, $id);
            if ($result != 0) {
                header("location:index.php?menu=alamat");
            }
        }

        include_once 'alamat.php';
    }
}