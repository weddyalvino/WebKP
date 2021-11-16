<?php
include_once 'header-2.php';
//print_r($_POST)
?>
    <head>
        <!--        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>-->
        <!--        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
        <!--        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>-->
        <script>
            function deleteValue(id) {
                let confimation = window.confirm("Apakah data alamat akan dihapus ?");
                if (confimation) {
                    window.location = "?menu=alamat&cmd=del&alamat=" + id;
                }
            }
        </script>
        <!--        <script src=    "assets/vendor/jquery/jquery.min.js"></script>-->
        <script>
            function carikota(provinsi) {
                $.ajax({
                    type: 'POST',
                    url: `provinsi.php`,
                    data: "provinsi=" + $('#provinsi').val(),
                    // dataType:'text',
                    success: function (response) {
                        // alert(response);
                        $('#kota').html(response).val($('#txtkota').val());
                    },
                    timeout: 2000
                });
            }

            function carikecamatan(provinsi, kota) {
                $.ajax({
                    type: 'POST',
                    url: `provinsi.php`,
                    data: {"provinsi": provinsi, "kota": kota},
                    // dataType:'text',
                    success: function (response) {
                        // alert(kota);
                        $('#kecamatan').html(response)
                            .val($('#txtkecamatan').val());

                        console.log(kota);
                    },
                    timeout: 2000
                });
            }

            function caridesa(provinsi, kota, kecamatan) {
                $.ajax({
                    type: 'POST',
                    url: `provinsi.php`,
                    data: {"provinsi": provinsi, "kota": kota, "kecamatan": kecamatan},
                    // dataType:'text',
                    success: function (response) {
                        $('#desa').html(response).val($('#txtdesa').val());
                    },
                    timeout: 2000
                });
            }


            $(document).ready(function () {
                $('.modal').on('hidden.bs.modal', function () {
                    $(this).find('form')[0].reset();
                    $('#id').val(null);
                    $('#txtkota').val(null);
                    $('#txtkecamatan').val(null);
                    $('#txtdesa').val(null);
                    $('#kota')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="" disabled selected hidden>-- Pilih Nama Wilayah --</option>')
                    ;
                    $('#kecamatan')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="" disabled selected hidden>-- Pilih Nama Wilayah --</option>')
                    ;
                    $('#desa')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="" disabled selected hidden>-- Pilih Nama Wilayah --</option>')
                    ;
                });
                $('#provinsi').change(function () {
                    $('#txtkota').val(null);
                    carikota($(this).val());
                    $('#kecamatan')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="" disabled selected hidden>-- Pilih Nama Wilayah --</option>')
                    ;
                    $('#desa')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="" disabled selected hidden>-- Pilih Nama Wilayah --</option>')
                    ;
                });
                $('#kota').change(function () {
                    $('#txtkecamatan').val(null);
                    carikecamatan($('#provinsi').val(), $(this).val());
                    $('#desa')
                        .find('option')
                        .remove()
                        .end()
                        .append('<option value="" disabled selected hidden>-- Pilih Nama Wilayah --</option>')
                    ;
                });

                $('#kecamatan').change(function () {
                    $('#txtdesa').val(null);
                    caridesa($('#provinsi').val(), $('#kota').val(), $(this).val())
                });
            });
        </script>

    </head>
    <body>
    <div class="container-fluid">
        <br>
        <h1>Data Alamat
            <input type="submit" data-toggle="modal" data-target="#tambah" class="btn btn-primary" value="Tambah"
                   style="float: right">
        </h1>
        <br>

        <table id="table_id" class="display" style="flex-shrink: 0; width:100%">
            <thead>
            <tr>
                <th width="23%">Jenis</th>
                <th>Alamat</th>
                <th width="13%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $dao = new AlamatDAO();
            //            $result = $dao->fetchalamat($_SESSION['userid']);
            //            print_r($result);
            $kel = null;
            $kec = null;
            if ($cek == 1) {
                foreach ($alamatdata as $results) {
                    $alamat = $results['alamatlengkap'];
                    if ($results['rt'] != null) {
                        $alamat = $alamat . ' Rt ' . $results['rt'];
                    }
                    if ($results['rw'] != null) {
                        $alamat = $alamat . ' Rw ' . $results['rw'];
                    }
                    if ($results['kelurahan'] != null && $results['kecamatan'] != null && $results['kabupaten'] != null && $results['provinsi'] != null) {
                        $kel = $dao->fetchselectkedesa($results['provinsi'], $results['kabupaten'], $results['kecamatan'], $results['kelurahan']);
                        $alamat = $alamat . ', Kelurahan ' . $kel[0]['wilayahNama'];
                    }
                    if ($results['kecamatan'] != null && $results['kabupaten'] != null && $results['provinsi'] != null) {
                        $kec = $dao->fetchselectkecamatan($results['provinsi'], $results['kabupaten'], $results['kecamatan']);
                        $alamat = $alamat . ', Kecamatan ' . $kec[0]['wilayahNama'];
                    }
                    if ($results['kabupaten'] != null && $results['provinsi'] != null) {
                        $kab = $dao->fetchselectkota($results['provinsi'], $results['kabupaten']);
                        $alamat = $alamat . ', Kabupaten ' . $kab[0]['wilayahNama'];
                    }
                    if ($results['namaprovinsi'] != null) {
                        $alamat = $alamat . ', ' . $results['namaprovinsi'];
                    }
                    if ($results['kodepos'] != null) {
                        $alamat = $alamat . ', ' . $results['kodepos'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $results['jnsalamat'] ?> </td>
                        <td><?php echo $alamat ?> </td>
                        <td><input value="Update" type="submit" data-toggle="modal" name="update" id="update"
                                   class="btn btn-outline-info btn-sm" data-target="#tambah"
                                   data-id="<?php echo $results['alamatId'] ?>"
                                   data-jnsalamat="<?php echo $results['jnsalamat'] ?>"
                                   data-provinsi="<?php echo $results['provinsi'] ?>"
                                   data-kabupaten="<?php echo $results['kabupaten'] ?>"
                                   data-namakabupaten="<?php echo $kab[0]['wilayahNama'] ?>"

                                   data-kecamatan="<?php echo $results['kecamatan'] ?>"
                                   data-namakecamatan="<?php if ($kec != null)
                                       echo $kec[0]['wilayahNama'] ?>"

                                   data-kelurahan="<?php echo $results['kelurahan'] ?>"
                                   data-namakelurahan="<?php if ($kel != null)
                                       echo $kel[0]['wilayahNama'] ?>"

                                   data-alamatlengkap="<?php echo $results['alamatlengkap'] ?>"
                                   data-rt="<?php echo $results['rt'] ?>"
                                   data-rw="<?php echo $results['rw'] ?>"
                                   data-kodepos="<?php echo $results['kodepos'] ?>"
                                   data-koordinatgps="<?php echo $results['koordinatgps'] ?>"
                            >
                            <button class="btn btn-outline-info btn-sm"
                                    onclick="deleteValue(<?php echo $results['alamatId'] ?>)">Delete
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            }
            else {
                echo "<script type='text/javascript'>alert('Data alamat masih kosong mohon menambahkan data alamat');</script>";
            }
            ?>
            </tbody>
        </table>
    </div>
    </body>

    <!-- Modal -->
    <div class="modal fade" id="tambah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <!-- Modal content-->
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div>Data Alamat Jemaat</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times; </span>
                        </button>
                    </div>
                    <div class="modal-body flex-row">
                        <table style="width: 500px">
                            <tr>
                                <td>Jenis Alamat</td>
                                <td><b>:</b></td>
                                <td>
                                    <select name="jnsalamat" id="jnsalamat" style="width: 200px">
                                        <option value="Alamat Sekarang" selected="selected">Alamat Sekarang</option>
                                        <option value="Alamat Asal">Alamat Asal</option>
                                        <option value="Alamat Kantor">Alamat Kantor</option>
                                        <option value="Alamat Lainnya">Alamat Lainnya</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Provinsi</td>
                                <td><b>:</b></td>
                                <td>
                                    <select name="provinsi" id="provinsi" style="width: 200px" required>
                                        <option value="" disabled selected hidden>-- Pilih Nama Wilayah --
                                        </option>
                                        <?php
                                        $provinsi = new AlamatDAO();
                                        $result = $provinsi->fetchprovinsi();
                                        foreach ($result as $results) {
                                            echo "<option  value='" . $results['wilayahProp'] . "'>" . $results['wilayahNama'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Kota/Kabupaten</td>
                                <td><b>:</b></td>
                                <td>
                                    <select name="kota" id="kota" style="width: 200px" required>
                                        <option value="" disabled selected hidden>-- Pilih Nama Wilayah --
                                        </option>
                                    </select>
                                    <input type="hidden" id="txtkota">
                                </td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td><b>:</b></td>
                                <td>
                                    <select name="kecamatan" id="kecamatan" style="width: 200px">
                                        <option value="" disabled selected hidden>-- Pilih Nama Wilayah
                                            --
                                        </option>
                                    </select>
                                    <input type="hidden" id="txtkecamatan">
                                </td>
                            </tr>
                            <tr>
                                <td>Desa / Kelurahan</td>
                                <td><b>:</b></td>
                                <td>
                                    <select name="desa" id="desa" style="width: 200px">
                                        <option value="" disabled selected hidden>-- Pilih Nama Wilayah
                                            --
                                        </option>
                                    </select>
                                    <input type="hidden" id="txtdesa">
                                </td>
                            </tr>

                            <tr>
                                <td>Alamat</td>
                                <td><b>:</b></td>
                                <td>
                                    <input style="width: 100%" type="text" name="alamat" id="alamat"
                                           placeholder="Alamat Lengkap Jemaat" required>
                                </td>
                            </tr>

                            <tr>
                                <td>RT / RW</td>
                                <td><b>:</b></td>
                                <td>
                                    <input style="width: 50px" type="text" maxlength="3" name="RT" id="RT"
                                           placeholder="RT"
                                           onkeypress="return hanyaAngka(event)"/>
                                    <input style="width: 50px" type="text" maxlength="3" name="RW" id="RW"
                                           placeholder="RW"
                                           onkeypress="return hanyaAngka(event)"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Kode Pos</td>
                                <td><b>:</b></td>
                                <td>
                                    <input style="width: 105px" maxlength="5" type="text" name="KodePos" id="KodePos"
                                           placeholder="Kode Pos" onkeypress="return hanyaAngka(event)"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Koordinat GPS</td>
                                <td><b>:</b></td>
                                <td>
                                    <input style="width: 100%" type="text" name="koordinat" id="koordinat" maxlength="5"
                                           placeholder="Alamat koordinat lokasi dalam bentuk desimal"
                                           onkeypress="return hanyaAngka(event)"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <input type="hidden" id="id" name="id">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" name="btnProses" value="Simpan">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        $(document).ready(function () {
            $('#table_id').DataTable();
            $(document).on('click', '#update', function () {
                var id = $(this).data('id');
                var jnsalamat = $(this).data('jnsalamat');
                var provinsi = $(this).data('provinsi');
                var kabupaten = $(this).data('kabupaten');
                var kecamatan = $(this).data('kecamatan');
                var kelurahan = $(this).data('kelurahan');
                // var namakabupaten = $(this).data('namakabupaten');
                // var namakecamatan = $(this).data('namakecamatan');
                // var namakelurahan = $(this).data('namakelurahan');
                var alamatlengkap = $(this).data('alamatlengkap');
                var rt = $(this).data('rt');
                var rw = $(this).data('rw');
                var kodepos = $(this).data('kodepos');
                var koordinatgps = $(this).data('koordinatgps');

                $('#id').val(id);
                $('#alamat').val(alamatlengkap);
                $('#RT').val(rt);
                $('#RW').val(rw);
                $('#KodePos').val(kodepos);
                $('#koordinat').val(koordinatgps);
                $('#jnsalamat').val(jnsalamat);

                $('#provinsi').val(provinsi);
                $('#txtkota').val(kabupaten);
                $('#txtkecamatan').val(kecamatan);
                $('#txtdesa').val(kelurahan);

                carikota(provinsi);
                carikecamatan(provinsi, kabupaten);
                caridesa(provinsi, kabupaten, kecamatan);
            })
        });
    </script>
<?php include 'footer-2.php'; ?>