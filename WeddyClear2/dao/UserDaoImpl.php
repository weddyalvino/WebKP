<?php

class UserDaoImpl {
    public function getAllUser() {
        $link = PDOUtil::openKoneksi();
        try {
            $query = "SELECT * FROM user ORDER BY nama";
            $stmt = $link->prepare($query);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
            $stmt->execute();
        } catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closeKoneksi($link);
        return $stmt;
    }

    public function getOneUser(User $user) {
        $link = PDOUtil::openKoneksi();
        try {
            $query = 'SELECT * FROM user WHERE id_user=?';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $user->getIdUser(), PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
            $stmt->execute();
		} catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closeKoneksi($link);
        return $stmt;
    }
	
	public function getNama($iduser) {
        $link = PDOUtil::openKoneksi();
		$query = "SELECT nama from user WHERE id_user = ?";
		$stmt = $link->prepare($query);
		$stmt->bindValue(1, $iduser);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		$nr = $stmt->fetchColumn();
		PDOUtil::closeKoneksi($link);
		return $nr;
    }

    public function updateUser(User $user) {
        $link = PDOUtil::openKoneksi();
        try {
            $link->beginTransaction();
            $query = 'UPDATE user SET username = ?, password = MD5(?), name = ? WHERE id=?';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $user->getUsername(), PDO::PARAM_STR);
            $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(3, $user->getNama(), PDO::PARAM_STR);
            $stmt->bindValue(4, $user->getIdUser(), PDO::PARAM_INT);
            $stmt->execute();
            $link->commit();
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closeKoneksi($link);
    }

    public function insertUser(User $user) {
        $link = PDOUtil::openKoneksi();
        try {
            $link->beginTransaction();
            $query = 'INSERT INTO user (username, password, name) VALUES (?,?,?)';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $user->getUsername(), PDO::PARAM_STR);
            $stmt->bindValue(2, $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(3, $user->getNama(), PDO::PARAM_STR);
            $stmt->execute();
            $msg = 'sukses';
            $link->commit();
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closeKoneksi($link);
        return $stmt;
    }

    public function login(User $user) {
        $link = PDOUtil::openKoneksi();
        $query = 'SELECT * FROM user JOIN role ON user.id_role = role.id_role WHERE username=? AND password=MD5(?)';
        $stmt = $link->prepare($query);
		$stmt->bindValue(1, $user->getUsername());
		$stmt->bindValue(2, $user->getPassword());
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		PDOUtil::closeKoneksi($link);
		return $stmt->fetchObject('User');
    }
	
	public function namaRole($idRole){
		$link = PDOUtil::openKoneksi();
		$query = "SELECT nama_role from role WHERE id_role = ?";
		$stmt = $link->prepare($query);
		$stmt->bindValue(1, $idRole);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		$nr = $stmt->fetchColumn();
		PDOUtil::closeKoneksi($link);
		return $nr;
	}
	public function getIdRole($idUser){
		$link = PDOUtil::openKoneksi();
		$query = "SELECT id_role from user WHERE id_user = ?";
		$stmt = $link->prepare($query);
		$stmt->bindValue(1, $idUser);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		$nr = $stmt->fetchColumn();
		PDOUtil::closeKoneksi($link);
		return $nr;
	}
	
	public function insertJemaat($nama, $username){
		$link = PDOUtil::openKoneksi();
		try {
			$link->beginTransaction();
			$query = "INSERT INTO user (id_user,nama,username,password,status,id_role) VALUES (?,?,?,?,?,?)";
			$stmt = $link->prepare($query);
			$stmt->bindValue(1, PDO::PARAM_STR);
			$stmt->bindValue(2,$nama, PDO::PARAM_STR);
			$stmt->bindValue(3,$username, PDO::PARAM_STR);
			$stmt->bindValue(4,md5("12345*"), PDO::PARAM_STR);
			$stmt->bindValue(5,"Aktif", PDO::PARAM_STR);
			$stmt->bindValue(6,"jem", PDO::PARAM_STR);
			$stmt->execute();
			$msg = 'sukses';
			$link->commit();
        } catch (PDOException $er) {
            $link->rollBack();
            echo $er->getMessage();
            die();
        }
        PDOUtil::closeKoneksi($link);
        return $msg;
	}
	
	public function getJemaatByUsername($username){
        $link = PDOUtil::openKoneksi();
        try {
            $query = 'SELECT * FROM user WHERE username=?';
            $stmt = $link->prepare($query);
            $stmt->bindValue(1, $username, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
            $stmt->execute();
		} catch (PDOException $er) {
            echo $er->getMessage();
            die();
        }
        PDOUtil::closeKoneksi($link);
        return $stmt;
	}
}