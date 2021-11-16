<?php


class kerjaDAO
{
    public function fetchKerja(){
        $link = PDOUtil::openKoneksi();
        try {
            $query = "SELECT * FROM tbl_pekerjaanmaster";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function fetchPekerjaan($id){
        $link = PDOUtil::openKoneksi();
        $query = "SELECT k.*,m.pekerjaanNama FROM tbl_pekerjaan k 
        join tbl_pekerjaanmaster m on k.pekerjaanID=m.pekerjaanID
         WHERE id_user = ? ORDER by id_pekerjaan ";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertkerja($mulai,$akhir,$keterangan,$kerjaid,$userid){
        $result= 0;
        $link =PDOUtil::openKoneksi();
        $query= "INSERT INTO tbl_pekerjaan(pekerjaanMulai,pekerjaanAkhir,keterangan,pekerjaanID,id_user) 
        values(?,?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt ->bindValue(1,$mulai);
        $stmt ->bindValue(2,$akhir);
        $stmt ->bindValue(3,$keterangan);
        $stmt ->bindValue(4,$kerjaid);
        $stmt ->bindValue(5,$userid);
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

    public function deletekerja($id){
        $result = 0;
        $link =PDOUtil::openKoneksi();
        $query = "DELETE FROM tbl_pekerjaan WHERE id_pekerjaan = ?";
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
    public function kerjaterpilih($id){
        $link =PDOUtil::openKoneksi();
        $query = "SELECT * FROM tbl_pekerjaan WHERE id_pekerjaan =?";
        $result = $link->prepare($query);
        $result->bindParam(1,$id);
        $result->setFetchMode(PDO::FETCH_OBJ);
        $result->execute();
        PDOUtil::closeKoneksi($link);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatekerja($id,$mulai, $akhir, $keterangan, $kerjaid){
        $result = 0;
        $link =PDOUtil::openKoneksi();
        $query = "UPDATE tbl_pekerjaan SET pekerjaanMulai = ?, pekerjaanAkhir = ?,keterangan = ?,pekerjaanID=? WHERE id_pekerjaan = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $mulai);
        $stmt->bindValue(2, $akhir);
        $stmt->bindValue(3, $keterangan);
        $stmt->bindValue(4, $kerjaid);
        $stmt->bindValue(5, $id);
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
}