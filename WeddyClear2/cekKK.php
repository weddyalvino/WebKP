<?php
include_once 'dao/DataKelDAO.php';
include_once 'util/PDOUtil.php';
$kk='';$cek='';
$kk = $_POST['nokk'];
$datakeluarga = new DataKelDAO();

if ($kk!=null && $kk!=''){
    $cek=$datakeluarga->cekKK($kk);
    if($cek==null){
        echo "gagal";
    }
    else{
        echo "berhasil";
    }
}
else{
    echo "gagal";
}

?>