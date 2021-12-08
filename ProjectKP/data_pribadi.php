<?php
include 'header-2.php';
$date = date('Y-m-d', time());
//print_r($datapribadi);
//print_r($_POST);
?>
<section class="statistics">
    <div class="container-fluid">
        <h1><br>DATA PRIBADI</h1><br>
        <form method="post" id="form">
            <div class="row d-flex">
                <div class="col-lg-12">
                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtNama" id="txtNama" class="form-control is-valid"
                                   placeholder="Nama Lengkap Jemaat sesuai dengan KTP" required
                                   value="<?php echo $datapribadi[0]['jemaatNama_lengkap']; ?>"
                                   onkeypress="return hanyaHuruf(event)">
                        </div>
                    </div>

                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Nama Panggilan</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtNamaPanggil" id="txtNamaPanggil" class="form-control is-valid"
                                   value="<?php echo $datapribadi[0]['jemaatPanggilan']; ?>"
                                   placeholder="Nama Panggilan Jemaat" onkeypress="return hanyaHuruf(event)">
                        </div>
                    </div>

                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Nomor Anggota</label>
                        <div class="col-sm-10">
                            <input type="text" name="txtNoAnggota" id="txtNoAnggota" class="form-control is-valid"
                                   value="<?php if (is_null($datapribadi[0]['jemaatNoAnggota']) || $datapribadi[0]['jemaatNoAnggota'] == 0) {
                                       echo '';
                                   } else
                                       echo $datapribadi[0]['jemaatNoAnggota'] ?>"
                                   placeholder="Nomor Anggota Gereja Jemaat" onkeypress="return hanyaAngka(event)">
                        </div>
                    </div>


                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Jenis Anggota</label>
                        <div class="col-sm-10">
                            <input type="radio" name="txtJnsAnggota"
                                   value="Pasif" <?php echo ($datapribadi[0]['jemaatKeanggotaan'] == 'Pasif') ? 'checked' : '' ?>
                                   required>&nbsp Pasif &nbsp
                            <input type="radio" name="txtJnsAnggota"
                                   value="Aktifis" <?php echo ($datapribadi[0]['jemaatKeanggotaan'] == 'Aktifis') ? 'checked' : '' ?>>&nbsp
                            Aktifis &nbsp
                            <input type="radio" name="txtJnsAnggota" value="Dalam Pembinaan"
                                   value="Dalam Pembinaan" <?php echo ($datapribadi[0]['jemaatKeanggotaan'] == 'Dalam Pembinaan') ? 'checked' : '' ?>>
                            &nbsp Dalam Pembinaan &nbsp
                            <input type="radio" name="txtJnsAnggota" value="Keluar"
                                   value="Keluar" <?php echo ($datapribadi[0]['jemaatKeanggotaan'] == 'Keluar') ? 'checked' : '' ?>>
                            &nbsp Keluar &nbsp
                        </div>
                    </div>

                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Status Jemaat</label>
                        <div class="col-sm-10">
                            <input type="radio" name="txtStatus"
                                   value="Simpatisan"<?php echo ($datapribadi[0]['StatusJemaat'] == 'Simpatisan') ? 'checked' : '' ?>
                                   required>&nbsp Simpatisan &nbsp
                            <input type="radio" name="txtStatus"
                                   value="Calon"<?php echo ($datapribadi[0]['StatusJemaat'] == 'Calon') ? 'checked' : '' ?>>&nbsp
                            Calon &nbsp
                            <input type="radio" name="txtStatus"
                                   value="SIDI" <?php echo ($datapribadi[0]['StatusJemaat'] == 'SIDI') ? 'checked' : '' ?>>&nbsp
                            SIDI &nbsp
                            <input type="radio" name="txtStatus"
                                   value="Baptis" <?php echo ($datapribadi[0]['StatusJemaat'] == 'Baptis') ? 'checked' : '' ?>>&nbsp
                            Baptis &nbsp
                            <input type="radio" name="txtStatus"
                                   value="Tidak Diketahui" <?php echo ($datapribadi[0]['StatusJemaat'] == 'Tidak Diketahui') ? 'checked' : '' ?>>&nbsp
                            Tidak Diketahui &nbsp
                        </div>
                    </div>

                    <!--JENIS KELAMIN-->
                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="radio" name="gender"
                                   value="Laki-laki" <?php echo ($datapribadi[0]['jemaatGender'] == 'Laki-laki') ? 'checked' : '' ?>
                                   required>&nbsp Laki-laki &nbsp
                            <input type="radio" name="gender"
                                   value="Perempuan" <?php echo ($datapribadi[0]['jemaatGender'] == 'Perempuan') ? 'checked' : '' ?>>&nbsp
                            Perempuan &nbsp
                            <input type="radio" name="gender"
                                   value="Tidak Diketahui" <?php echo ($datapribadi[0]['jemaatGender'] == 'Tidak Diketahui') ? 'checked' : '' ?>>&nbsp
                            Tidak Diketahui &nbsp
                        </div>
                    </div>

                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Kelahiran</label>
                        <div class="col-sm-10">
                            <input width="500" type="text" name="txtkota" id="txtkota" placeholder="Kota Kelahiran"
                                   value="<?php echo $datapribadi[0]['jemaatKotaLahir']; ?>"
                                   onkeypress="return hanyaHuruf(event)">
                            <input type="date" name="lahir" id="tgl_mulai" value="<?php
                            if ($datapribadi[0]['jemaatTglLahir'] == '0000-00-00') {
                                echo $date;
                            } else echo $datapribadi[0]['jemaatTglLahir']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Status Nikah</label>
                        <div class="col-sm-10">
                            <input type="radio" name="txtStatusNikah" value="Tidak / Belum Menikah"
                                   required <?php echo ($datapribadi[0]['jemaatStatusNikah'] == 'Tidak / Belum Menikah') ? 'checked' : '' ?>>&nbsp
                            Tidak / Belum Menikah &nbsp
                            <input type="radio" name="txtStatusNikah"
                                   value="Menikah" <?php echo ($datapribadi[0]['jemaatStatusNikah'] == 'Menikah') ? 'checked' : '' ?>>&nbsp
                            Menikah &nbsp
                            <input type="radio" name="txtStatusNikah"
                                   value="Duda" <?php echo ($datapribadi[0]['jemaatStatusNikah'] == 'Duda') ? 'checked' : '' ?>>&nbsp
                            Duda &nbsp
                            <input type="radio" name="txtStatusNikah"
                                   value="Janda" <?php echo ($datapribadi[0]['jemaatStatusNikah'] == 'Janda') ? 'checked' : '' ?>>&nbsp
                            Janda &nbsp
                            <input type="radio" name="txtStatusNikah"
                                   value="Tidak Diketahui" <?php echo ($datapribadi[0]['jemaatStatusNikah'] == 'Tidak Diketahui') ? 'checked' : '' ?>>&nbsp
                            Tidak Diketahui &nbsp
                        </div>
                    </div>

                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Golongan Darah</label>
                        <div class="col-sm-10">
                            <input type="radio" name="txtgoldar" required value="O" <?php echo ($datapribadi[0]['jemaatGoldar'] == 'O') ? 'checked' : '' ?>>&nbsp O &nbsp
                            <input type="radio" name="txtgoldar" value="A" <?php echo ($datapribadi[0]['jemaatGoldar'] == 'A') ? 'checked' : '' ?>>&nbsp A &nbsp
                            <input type="radio" name="txtgoldar" value="B" <?php echo ($datapribadi[0]['jemaatGoldar'] == 'B') ? 'checked' : '' ?>>&nbsp B &nbsp
                            <input type="radio" name="txtgoldar" value="AB" <?php echo ($datapribadi[0]['jemaatGoldar'] == 'AB') ? 'checked' : '' ?>>&nbsp AB &nbsp
                            <input type="radio" name="txtgoldar" value="Tidak Diketahui" <?php echo ($datapribadi[0]['jemaatGoldar'] == 'Tidak Diketahui') ? 'checked' : '' ?>>&nbsp Tidak Diketahui &nbsp
                        </div>
                    </div>

                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Nama Ayah</label>
                        <div class="col-sm-10">
                            <input style="width: 18%" type="text" name="txtnoayah" id="txtnoayah" maxlength="16"
                                   value="<?php if (is_null($datapribadi[0]['jemaatAyahID']) || $datapribadi[0]['jemaatAyahID'] == 0) {
                                       echo '';
                                   } else
                                       echo $datapribadi[0]['jemaatNoAnggota'] ?>"
                                   placeholder="Nomor Anggota Ayah" onkeypress="return hanyaAngka(event)">
                            <input style="width: 65%" type="text" name="txtayah" id="txtayah"
                                   value="<?php echo $datapribadi[0]['jemaatAyahNama']; ?>"
                                   placeholder="Nama lengkap Ayah" onkeypress="return hanyaHuruf(event)">
                        </div>
                    </div>

                    <div class="form-group row has-success">
                        <label class="col-sm-2 form-control-label">Nama Ibu</label>
                        <div class="col-sm-10">
                            <input style="width: 18%" type="text" name="txtnoibu" id="txtnoibu" maxlength="16"
                                   placeholder="Nomor Anggota Ibu"
                                   value="<?php if (is_null($datapribadi[0]['jemaatIbuID']) || $datapribadi[0]['jemaatIbuID'] == 0) {
                                       echo '';
                                   } else
                                       echo $datapribadi[0]['jemaatNoAnggota'] ?>"
                                   onkeypress="return hanyaAngka(event)">
                            <input style="width: 65%" type="text" name="txtibu" id="txtibu"
                                   placeholder="Nama lengkap Ibu"
                                   value="<?php echo $datapribadi[0]['jemaatIbuNama']; ?>"
                                   onkeypress="return hanyaHuruf(event)">
                        </div>
                    </div>

                    <input type="submit" name="btnsimpan" class="btn btn-primary" value="Simpan" style="float: right">
<!--                           onclick="return confirm('Apakah Anda yakin untuk menyimpan data pribadi?')">-->
                </div>
            </div>
    </div>
    </form>

</section>

<script type="text/javascript">

    function hanyaHuruf(evt) {
        // range huruf =97-122 65-90
        var charCode = (evt.which) ? evt.which : event.keyCode
        // alert(charCode)
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123)
            || charCode === 32 || charCode === 46 || charCode === 39)
            return true;
        else return false;
    }

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        else return true;
    }


    document.getElementById("txtayah").addEventListener('keydown', function (e) {
        if (this.value.length === 0 && e.which === 32) e.preventDefault();
    });
    document.getElementById("txtibu").addEventListener('keydown', function (e) {
        if (this.value.length === 0 && e.which === 32) e.preventDefault();
    });
    document.getElementById("txtNama").addEventListener('keydown', function (e) {
        if (this.value.length === 0 && (e.which === 32 || e.which === 46 || e.which === 39)) e.preventDefault();
    });
    document.getElementById("txtNamaPanggil").addEventListener('keydown', function (e) {
        if (this.value.length === 0 && e.which === 32) e.preventDefault();
    });
    document.getElementById("txtkota").addEventListener('keydown', function (e) {
        if (this.value.length === 0 && e.which === 32) e.preventDefault();
    });
</script>
<script>
    $(document).ready(function () {
        $(function () {
            $('input[type="text"]').change(function () {
                this.value = $.trim(this.value);
                // alert(this.value)
            });
        });
    });
</script>
<?php
include_once 'footer-2.php';
?>


