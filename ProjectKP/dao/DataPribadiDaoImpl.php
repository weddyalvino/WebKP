<?php

class DataPribadiDaoImpl
{
    public function fetchData($id)
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT * FROM tbl_jemaatmaster
         WHERE jemaatId = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateData($nama, $panggilan, $noanggota, $jnsanggota, $statusjemaat, $jnskelamin, $kotalahir,
                               $tgllahir, $statusnikah, $goldar, $idayah, $namaayah, $idibu, $namaibu, $id)
    {
        $result = 0;
        $link = PDOUtil::openKoneksi();
        $query = "UPDATE tbl_jemaatmaster SET jemaatNama_lengkap=?,jemaatPanggilan=?,jemaatNoAnggota=?,jemaatKeanggotaan=?,
        StatusJemaat=?,jemaatGender=?, jemaatKotaLahir=?,jemaatTglLahir=?,jemaatStatusNikah=?,
        jemaatGoldar=?,jemaatAyahID=?,jemaatAyahNama=?, jemaatIbuID=?,jemaatIbuNama=?,datalengkap=1
        WHERE jemaatId = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $nama);
        $stmt->bindValue(2, $panggilan);
        $stmt->bindValue(3, $noanggota);
        $stmt->bindValue(4, $jnsanggota);
        $stmt->bindValue(5, $statusjemaat);
        $stmt->bindValue(6, $jnskelamin);
        $stmt->bindValue(7, $kotalahir);
        $stmt->bindValue(8, $tgllahir);
        $stmt->bindValue(9, $statusnikah);
        $stmt->bindValue(10, $goldar);
        $stmt->bindValue(11, $idayah);
        $stmt->bindValue(12, $namaayah);
        $stmt->bindValue(13, $idibu);
        $stmt->bindValue(14, $namaibu);
        $stmt->bindValue(15, $id);
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

    public function fetchdatauser()
    {
        $link = PDOUtil::openKoneksi();
        $query = "SELECT u.*,t.* FROM user u LEFT JOIN tbl_jemaatmaster t ON u.id_user=t.jemaatId Where u.id_role='jem' or t.datalengkap=1";
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeKoneksi($link);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}