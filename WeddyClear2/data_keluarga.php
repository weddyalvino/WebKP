<?php
include 'header-2.php'; ?>
<section class="statistics">
    <form method="POST" enctype="multipart/form-data">
        <div class="container-fluid">
            <h1><br>DATA KELUARGA</h1><br>
            <div class="col-lg-12">
                <div class="form-group row ">
                    <label class="col-sm-2 form-control-label">Nomor KTP</label>
                    <div class="col-sm-10">
                        <input type="text" name="noktp" class="form-control" style='width:950px' disabled
                               value="<?php echo $keluarga[0]['noKTP']; ?>">
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-sm-2 form-control-label">Nomor Kartu Keluarga</label>
                    <div class="col-sm-10">
                        <input required type="text" name="nokk" id="kk" class="form-control" style='width:950px'
                               value="<?php echo $keluarga[0]['noKK']; ?>" minlength="13" maxlength="13"
                               onkeypress="return hanyaAngka(event)"/>
                        <span id="searchKK"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label">Hubungan Keluarga</label>
                    <div class="col-sm-10">
                        <input type="radio" required name="hubungan"
                               value="Kepala Keluarga" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Kepala Keluarga') ? 'checked' : '' ?>>
                        Kepala Keluarga &nbsp;
                        <input type="radio" required name="hubungan"
                               value="Suami" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Suami') ? 'checked' : '' ?>>
                        Suami &nbsp;
                        <input type="radio" required name="hubungan"
                               value="Isteri" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Isteri') ? 'checked' : '' ?>>
                        Isteri &nbsp;
                        <input type="radio" required name="hubungan"
                               value="Anak" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Anak') ? 'checked' : '' ?>>
                        Anak &nbsp;
                        <input type="radio" required name="hubungan"
                               value="Menantu" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Menantu') ? 'checked' : '' ?>>
                        Menantu &nbsp;
                        <input type="radio" required name="hubungan"
                               value="Cucu" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Cucu') ? 'checked' : '' ?>>
                        Cucu &nbsp;
                        <input type="radio" required name="hubungan"
                               value="Orang Tua" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Orang Tua') ? 'checked' : '' ?>>
                        Orang Tua &nbsp;
                        <input type="radio" required name="hubungan"
                               value="Mertua" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Mertua') ? 'checked' : '' ?>>
                        Mertua &nbsp;
                        <input type="radio" required name="hubungan"
                               value="Famili Lain" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Famili Lain') ? 'checked' : '' ?>>
                        Famili Lain &nbsp;
                        <input type="radio" required name="hubungan"
                               value="Lainnya" <?php echo ($keluarga[0]['Hubungankeluarga'] == 'Lainnya') ? 'checked' : '' ?>>
                        Lainnya &nbsp;
                    </div
                </div>
                <!--		        --><?php //print_r($keluarga[0]['id']) ; ?>
                <input type="hidden" name="id" value="<?php echo $keluarga[0]['id']; ?>">
            </div>
            <input type="submit" id="submitbutton" name="btnsimpan" class="btn btn-primary" value="Simpan" style="float: right">
        </div>

    </form>
</section>
<script type="text/javascript">
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
<script>
    $(document).ready(function (){
        $('#kk').change(function () {
            $.ajax({
                type: 'POST',
                url: `cekKK.php`,
                data: "nokk=" + $(this).val(),
                dataType:'text',
                success: function (response) {
                    // alert(response);
                    if(response==="gagal"){
                        alert("No KK Belum terdaftar di dalam sistem")
                        document.getElementById('submitbutton').disabled = true;
                    }
                    else{
                        document.getElementById('submitbutton').disabled = false;
                    }
                },
                timeout: 2000
            });
        });

    });
</script>
<?php include 'footer-2.php'; ?>
