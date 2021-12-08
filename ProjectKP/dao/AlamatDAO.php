<?php


class AlamatDAO
{
    public function fetchalamat($id)
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT a.*,b.wilayahNama AS namaprovinsi FROM `tbl_alamat` a 
        JOIN tbwilayah b ON a.provinsi=b.wilayahProp WHERE a.id_user=? AND a.provinsi=b.wilayahProp AND b.wilayahKab=''";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchprovinsi()
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM `tbwilayah` WHERE wilayahProp>0 AND wilayahKab='' ORDER BY wilayahProp asc";
        $stmt = $link->prepare($query);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchkota($id)
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM `tbwilayah` WHERE wilayahProp=? AND wilayahKab>0 AND wilayahKec='' 
        ORDER BY wilayahNama asc";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchselectkota($prov, $kab)
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM `tbwilayah` WHERE wilayahProp=? AND wilayahKab=? AND wilayahKec=''";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $prov);
        $stmt->bindValue(2, $kab);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchkecamatan($prov, $kab)
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM `tbwilayah` WHERE wilayahProp=? AND wilayahKab=? AND wilayahKec>0 AND wilayahKel=''
        ORDER BY wilayahNama asc";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $prov);
        $stmt->bindValue(2, $kab);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchselectkecamatan($prov, $kab,$kec)
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM `tbwilayah` WHERE wilayahProp=? AND wilayahKab=? AND wilayahKec=? AND wilayahKel=''
        ORDER BY wilayahNama asc";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $prov);
        $stmt->bindValue(2, $kab);
        $stmt->bindValue(3, $kec);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchkedesa($prov, $kab, $kec)
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM `tbwilayah` WHERE wilayahProp=? AND wilayahKab=? AND wilayahKec=? AND wilayahKel>0
        ORDER BY wilayahNama asc";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $prov);
        $stmt->bindValue(2, $kab);
        $stmt->bindValue(3, $kec);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchselectkedesa($prov, $kab, $kec,$kel)
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM `tbwilayah` WHERE wilayahProp=? AND wilayahKab=? AND wilayahKec=? AND wilayahKel=?
        ORDER BY wilayahNama asc";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $prov);
        $stmt->bindValue(2, $kab);
        $stmt->bindValue(3, $kec);
        $stmt->bindValue(4, $kel);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertalamat($id_user, $jnsalamat, $provinsi, $kabupaten, $kecamatan, $kelurahan, $alamatlengkap, $rt, $rw, $kodepos, $koordinatgps)
    {
        $result = 0;
        $link = PDOUtil::openKoneksi();
        $query = "INSERT INTO tbl_alamat(id_user,jnsalamat,provinsi,kabupaten,kecamatan,kelurahan,alamatlengkap,
        rt,rw,kodepos,koordinatgps) 
        values(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $id_user);
        $stmt->bindValue(2, $jnsalamat);
        $stmt->bindValue(3, $provinsi);
        $stmt->bindValue(4, $kabupaten);
        $stmt->bindValue(5, $kecamatan);
        $stmt->bindValue(6, $kelurahan);
        $stmt->bindValue(7, $alamatlengkap);
        $stmt->bindValue(8, $rt);
        $stmt->bindValue(9, $rw);
        $stmt->bindValue(10, $kodepos);
        $stmt->bindValue(11, $koordinatgps);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
            $result = 1;
        } else {
            $link->rollBack();
        }
        PDOUtil::closeKoneksi($link);
        return $result;
    }

    public function updatealamat($jnsalamat, $provinsi, $kabupaten, $kecamatan, $kelurahan, $alamatlengkap, $rt, $rw, $kodepos, $koordinatgps,$id){
        $result = 0;
        $link =PDOUtil::openKoneksi();
        $query = "UPDATE tbl_alamat SET jnsalamat=?,provinsi=?,kabupaten=?,kecamatan=?,kelurahan=?,alamatlengkap=?,
        rt=?,rw=?,kodepos=?,koordinatgps=? WHERE alamatId = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $jnsalamat);
        $stmt->bindValue(2, $provinsi);
        $stmt->bindValue(3, $kabupaten);
        $stmt->bindValue(4, $kecamatan);
        $stmt->bindValue(5, $kelurahan);
        $stmt->bindValue(6, $alamatlengkap);
        $stmt->bindValue(7, $rt);
        $stmt->bindValue(8, $rw);
        $stmt->bindValue(9, $kodepos);
        $stmt->bindValue(10, $koordinatgps);
        $stmt->bindValue(11,$id);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
            $result = 1;
        } else{
            $link->rollBack();
        }
        PDOUtil::closeKoneksi($link);
        return $result;
    }
    public function deletealamat($id){
        $result = 0;
        $link =PDOUtil::openKoneksi();
        $query = "DELETE FROM tbl_alamat WHERE alamatId = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$id);
        $link->beginTransaction();
        if($stmt->execute()){
            $link->commit();
            $result= 1;
        }
        else{
            $link->rollBack();
        }
        PDOUtil::closeKoneksi($link);
        return $result;
    }
}