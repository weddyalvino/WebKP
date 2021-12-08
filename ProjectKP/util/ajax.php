<?php
	include "PDOUtil.php";
	include "../entity/Aktivitas.php";
	include "../entity/AtestasiMasuk.php";
	include "../entity/AtestasiKeluar.php";
	include "../entity/User.php";
	include "../entity/Gereja.php";
	include "../entity/MasterJemaat.php";
	
	$actid = 0;
	if(isset($_POST['actid'])){
		$actid = $_POST['actid'];
		$results = new Aktivitas();
		$results = fetchDataAktivitas($actid);
		$response = "<table border='0' width='100%'>";
		$response .= "<tr>";
		$response .= "<td>ID Kegiatan : </td><td>".$actid."</td>";
		$response .= "</tr>";
		
		$response .= "<tr>";
		$response .= "<td>Deskripsi Kegiatan : </td><td>".$results->getDeskripsi()."</td>";
		$response .= "</tr>";
		
		$response .= "</table>";
		echo $response;
		exit;
	}
	
	
	$atestasi = 0;
	if(isset($_POST['atestasi'])){
		$atestasi = $_POST['atestasi'];
		$results = new AtestasiMasuk();
		$results = fetchDataAtestasi($atestasi);
		$response = '<div class="table-responsive"><table class="table table-bordered">
		<style>
			#myImg {
			  border-radius: 5px;
			  cursor: pointer;
			  transition: 0.3s;
			}
			#myImg:hover {opacity: 0.7;}
			/* The Modal (background) */
			.modal1 {
			  display: none;
			  position: fixed; 
			  z-index: 1; 
			  padding-top: 100px;
			  left: 0;
			  top: 0;
			  width: 100%; 
			  height: 100%;
			  overflow: auto;
			  background-color: rgb(0,0,0); 
			  background-color: rgba(0,0,0,0.9);
			}
			.modal-content1 {
			  margin: auto;
			  display: block;
			  width: 100%;
			  max-width: 700px;
			}
			/* Caption of Modal Image */
			#caption {
			  margin: auto;
			  display: block;
			  width: 80%;
			  max-width: 700px;
			  text-align: center;
			  color: #ccc;
			  padding: 10px 0;
			  height: 150px;
			}
			.modal-content1, #caption {  
			  -webkit-animation-name: zoom;
			  -webkit-animation-duration: 0.6s;
			  animation-name: zoom;
			  animation-duration: 0.6s;
			}
			@-webkit-keyframes zoom {
			  from {-webkit-transform:scale(0)} 
			  to {-webkit-transform:scale(1)}
			}
			@keyframes zoom {
			  from {transform:scale(0)} 
			  to {transform:scale(1)}
			}
			.close {
			  position: absolute;
			  top: 15px;
			  right: 35px;
			  color: #ffffff;
			  font-size: 40px;
			  font-weight: bold;
			  transition: 0.3s;
			}
			.close:hover,.close:focus {
			  color: #bbb;
			  text-decoration: none;
			  cursor: pointer;
			}
			@media only screen and (max-width: 700px){
			  .modal-content1 {
				width: 100%;
			  }
			}
			</style>
		';
		$response .= '  
			<h1>Detail Atestasi</h1>
			</div>
                <tr>  
					<td width="40%"><b>Tanggal Pengajuan</b></td>
					<td width="70%">'.date_format(date_create($results->getTglPengajuan()), 'd-M-Y').'</td>
                </tr>
				<tr>
					<td width="30%"><b>Nama Lengkap</b></td>
					<td width="70%">'.$results->getNamaLengkap().'</td>
				</tr>
				<tr>
					<td width="30%"><b>Alamat</b></td>
					<td width="70%">'.$results->getAlamat().'</td>
				</tr>
				<tr>
					<td width="30%"><b>Email</b></td>
					<td width="70%">'.$results->getEmail().'</td>
				</tr>
				<tr>
					<td width="30%"><b>No Telp</b> </td>
					<td width="70%">'.$results->getNoTelp().'</td>
				</tr>
				<tr>
					<td width="30%"><b>No Whatsapp</b></td>
					<td width="70%">'.$results->getNoWA().'</td>
				</tr>
				<tr>
					<td width="30%"><b>Agama</b></td>
					<td width="70%">'.$results->getAgama().'</td>
				</tr>
				<tr>
					<td width="30%"><b>Gereja Asal</b></td>
					<td width="70%">'.$results->getGerejaAsal().'</td>
				</tr>
				<tr>
					<td width="30%"><b>Status</b></td>
					<td width="70%">'.$results->getStatus().'</td>
				</tr>
				<tr>
					<td width="30%"><b>Pas Foto</b></td>
					<td width="70%"><img id="myImg" src = '.$results->getPasFoto().' height=20% width=20%></td>
				</tr>
				<tr>
					<td width="30%"><b>Scan Akte Baptis/Sidi</b></td>
					<td width="70%"><img id="myImg2" src = '.$results->getScanAkteBaptisSidi().' height=20% width=20%></td>
				</tr>
				<tr>
					<td width="30%"><b>Surat Keterangan</b> </td>
					<td width="70%"> <img id="myImg3" src = '.$results->getSuratKeterangan().' height=20% width=20%></td>
				</tr>
				<tr>
					<td width="30%"><b>Bukti Atestasi</b> </td>
					<td width="70%"> <a href="'.$results->getBuktiAM().'">Download</td>
				</tr>
		'; 
		$response .= '</table></div>
		<div id="myModal1" class="modal1">
		  <span class="close">&times;</span>
		  <img class="modal-content1" id="img01">
		  <div id="caption"></div>
		</div>
		<script>
			var modal = document.getElementById("myModal1");
			var img = document.getElementById("myImg");
			var modalImg = document.getElementById("img01");
			var captionText = document.getElementById("caption");
			img.onclick = function(){
			  modal.style.display = "block";
			  modalImg.src = this.src;
			  captionText.innerHTML = this.alt;
			}
			
			var modal = document.getElementById("myModal1");
			var img = document.getElementById("myImg2");
			var modalImg = document.getElementById("img01");
			var captionText = document.getElementById("caption");
			img.onclick = function(){
			  modal.style.display = "block";
			  modalImg.src = this.src;
			  captionText.innerHTML = this.alt;
			}
			
			var modal = document.getElementById("myModal1");
			var img = document.getElementById("myImg3");
			var modalImg = document.getElementById("img01");
			var captionText = document.getElementById("caption");
			img.onclick = function(){
			  modal.style.display = "block";
			  modalImg.src = this.src;
			  captionText.innerHTML = this.alt;
			}
			
			var span = document.getElementsByClassName("close")[0];
			span.onclick = function() { 
			  modal.style.display = "none";}
		</script>';  
		echo $response;
		exit;
	}
	
	$atestasiK = 0;
	if(isset($_POST['atestasiK'])){
		$atestasiK = $_POST['atestasiK'];
		$results = new AtestasiKeluar();
		$results = fetchDataAtestasiK($atestasiK);
		$response = '<div class="table-responsive"><table class="table table-bordered">';
		$response .= '  
			<h1>Detail Atestasi</h1>
			</div>
                <tr>  
					<td width="40%"><b>Tanggal Pengajuan</b></td>
					<td width="70%">'.date_format(date_create($results->getTglPengajuan()), 'd-M-Y').'</td>
                </tr>
				<tr>
					<td width="30%"><b>Gereja Tujuan</b></td>
					<td width="70%">'.$results->getGereja()->getNama().'</td>
				</tr>
				<tr>
					<td width="30%"><b>Alasan</b> </td>
					<td width="70%">'.$results->getAlasan().'</td>
				</tr>
				<tr>
					<td width="30%"><b>Status</b></td>
					<td width="70%">'.$results->getStatus().'</td>
				</tr>
		'; 
		$response .= '</table></div>';  
		echo $response;
		exit;
	}
	
	$user = 0;
	if(isset($_POST['user'])){
		$user = $_POST['user'];
		$results = fetchDataUser($user);
		$response = '<div class="table-responsive"><table class="table table-bordered">';
		$response .= '  
			<h1>Detail Akun</h1>
			</div>
                <tr>  
					<td width="40%"><b>Nama</b></td>
					<td width="70%">'.$results->getNama().'</td>
                </tr>
				<tr>
					<td width="30%"><b>Username</b></td>
					<td width="70%">'.$results->getUsername().'</td>
				</tr>
				<tr>
					<td width="30%"><b>Default Password</b></td>
					<td width="70%"> 12345* </td>
				</tr>
		'; 
		$response .= '</table></div>';  
		echo $response;
		exit;
	}
	
	function fetchDataAktivitas($actid){
		$link = PDOUtil::openKoneksi();
		$query = "SELECT * FROM tbl_aktivitas WHERE id_kegiatan = ? order by tanggal_mulai desc";
		$stmt = $link->prepare($query);
		$stmt->bindParam(1,$actid);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		PDOUtil::closeKoneksi($link);
		return $stmt->fetchObject('Aktivitas');
	}
	
	function fetchDataAtestasi($atestasi){
		$link = PDOUtil::openKoneksi();
		$query = "SELECT * FROM tbl_atestasimasuk WHERE idAtestasiM = ? order by tglPengajuan DESC";
		$stmt = $link->prepare($query);
		$stmt->bindParam(1,$atestasi);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		PDOUtil::closeKoneksi($link);
		return $stmt->fetchObject('AtestasiMasuk');
	}
	
	function fetchDataAtestasiK($atestasiK){
		$link = PDOUtil::openKoneksi();
		$query = "SELECT tbl_atestasikeluar.*, tbl_gereja.id_gereja, tbl_gereja.nama AS nama_gereja FROM tbl_atestasikeluar JOIN tbl_gereja ON tbl_atestasikeluar.id_gereja = tbl_gereja.id_gereja WHERE idAtestasiK = ? order by tbl_atestasikeluar .tglPengajuan DESC";
		$stmt = $link->prepare($query);
		$stmt->bindParam(1,$atestasiK);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		PDOUtil::closeKoneksi($link);
		return $stmt->fetchObject('AtestasiKeluar');
	}
	
	function fetchDataUser($user){
		$link = PDOUtil::openKoneksi();
		$query = "SELECT * FROM user WHERE id_user=?";
		$stmt = $link->prepare($query);
		$stmt->bindParam(1,$user);
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$stmt->execute();
		PDOUtil::closeKoneksi($link);
		return $stmt->fetchObject('User');
	}