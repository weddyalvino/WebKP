<?php


class DataKelDAO
{
    public function fetchkeluarga($id){
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM tbl_keluarga
         WHERE id_user = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatekeluarga($kk,$hub,$id){
        $result = 0;
        $link =PDOUtil::openKoneksi();
        $query = "UPDATE tbl_keluarga SET noKK=?,Hubungankeluarga=? WHERE id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1,$kk);
        $stmt->bindValue(2,$hub);
        $stmt->bindValue(3,$id);
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

    public function cekKK($kk){
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM tbl_keluarga Where noKK=?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $kk);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}