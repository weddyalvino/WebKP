<?php
class GerejaDaoImpl {
	public function fetchGereja(){
		$link = PDOUtil::openKoneksi();
		try {
			$query = "SELECT * FROM tbl_gereja";
			$stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Gereja');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
		}
		PDOUtil::closeKoneksi($link);
		return $stmt;
	}
}