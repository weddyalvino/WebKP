<?php
include_once 'dao/AlamatDAO.php';
include_once 'util/PDOUtil.php';

$prov='';$kota='';$kec='';

$prov = $_POST['provinsi'];
if(isset($_POST['kota'])){
    $kota = $_POST['kota'];
}
if(isset($_POST['kecamatan'])){
    $kec = $_POST['kecamatan'];
}

$alamat = new AlamatDAO();
echo '<option value="" disabled selected hidden>-- Pilih Nama Wilayah --</option>';


if($prov!=null && $kota==''  && $kec=='' ){
//    echo '<script>alert("Kota")</script>';
    $hasil = $alamat->fetchkota($prov);
    foreach ($hasil as $kotaarray) {
        echo "<option  value='" . $kotaarray['wilayahKab'] . "'>" . $kotaarray['wilayahNama'] . "</option>";
    }
}

else if ($prov!=null && $kota!=null && $kec==''){
//    echo '<script>alert("Kecamatan")</script>';
    $hasil = $alamat->fetchkecamatan($prov,$kota);
    foreach ($hasil as $keamatanarray) {
        echo "<option  value='" . $keamatanarray['wilayahKec'] . "'>" . $keamatanarray['wilayahNama'] . "</option>";
    }
}
else if ($prov!=null && $kota!=null && $kec!=null){
//    echo '<script>alert("Desa")</script>';
    $hasil = $alamat->fetchkedesa($prov,$kota,$kec);
    foreach ($hasil as $desaarray) {
        echo "<option  value='" . $desaarray['wilayahKel'] . "'>" . $desaarray['wilayahNama'] . "</option>";
    }
}

//$call = array('data' => $value);
//echo json_encode($call);
?>