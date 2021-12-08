<?php


class KontakDAO
{
    public function fetchkontak($id){
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM tbl_kontak WHERE kontakIdUser = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertkontak($jns,$alamat,$ket,$userid){
        $result= 0;
        $link =PDOUtil::openKoneksi();
        $query= "INSERT INTO tbl_kontak(kontakJenis,kontakNomor,kontakKeterangan,kontakIdUser) 
        values(?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt ->bindValue(1,$jns);
        $stmt ->bindValue(2,$alamat);
        $stmt ->bindValue(3,$ket);
        $stmt ->bindValue(4,$userid);
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

    public function deletekontak($id){
        $result = 0;
        $link =PDOUtil::openKoneksi();
        $query = "DELETE FROM tbl_kontak WHERE kontakID = ?";
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


    public function updatekontak($jns,$alamat,$ket,$id){
        $result = 0;
        $link =PDOUtil::openKoneksi();
        $query = "UPDATE tbl_kontak SET kontakJenis = ?, kontakNomor = ?,kontakKeterangan = ? WHERE kontakID = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $jns);
        $stmt->bindValue(2, $alamat);
        $stmt->bindValue(3, $ket);
        $stmt->bindValue(4, $id);
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