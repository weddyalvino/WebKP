<?php

class PendidikanDAO
{
    public function fetchjenis()
    {
        $link = PDOUtil::openKoneksi();
        try {
            $query = "SELECT * FROM tbl_jnspendidikan";
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

    public function fetchpendidikan($id)
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT p.*,j.pendidikanjenis FROM tbl_pendidikan p 
        join tbl_jnspendidikan j on j.pendidikanID=p.pendidikan_tingat
         WHERE id_user = ? ORDER by id_pendidikan ASC";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertpendidikan($pendidikan_tingat, $nama_sekolah, $jurusan, $keterangan, $id_user)
    {
        $result = 0;
        $link = PDOUtil::openKoneksi();
        $query = "INSERT INTO tbl_pendidikan(pendidikan_tingat,nama_sekolah,jurusan,keterangan,id_user) 
        values(?,?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $pendidikan_tingat);
        $stmt->bindValue(2, $nama_sekolah);
        $stmt->bindValue(3, $jurusan);
        $stmt->bindValue(4, $keterangan);
        $stmt->bindValue(5, $id_user);
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

    public function updatependidikan($pendidikan_tingat, $nama_sekolah, $jurusan, $keterangan, $id)
    {
        $result = 0;
        $link = PDOUtil::openKoneksi();
        $query = "UPDATE tbl_pendidikan SET pendidikan_tingat=?,nama_sekolah=?,jurusan=?,keterangan=?
        WHERE id_pendidikan=?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $pendidikan_tingat);
        $stmt->bindValue(2, $nama_sekolah);
        $stmt->bindValue(3, $jurusan);
        $stmt->bindValue(4, $keterangan);
        $stmt->bindValue(5, $id);
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

    public function deletedidik($id)
    {
        $result = 0;
        $link = PDOUtil::openKoneksi();
        $query = "DELETE FROM tbl_pendidikan WHERE id_pendidikan = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
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

}