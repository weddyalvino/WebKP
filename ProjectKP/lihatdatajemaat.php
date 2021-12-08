<?php
include 'header-2.php';
?>


    <body>
    <div class="container-fluid">
        <br>
        <h1>List Data Jemaat
        </h1>
        <br>
        <table id="table_id" class="display" style="flex-shrink: 0; width:100%">
            <thead>

            <tr>
                <th width="15%">Username</th>
                <th width="15%">Nama Akun</th>
                <th width="22%">Nama Panjang</th>
                <th width="20%">Status</th>
            </tr>
            </thead>
            <tbody>
            <?php $dao = new DataPribadiDaoImpl();
            $res = $dao->fetchdatauser();
//                    print_r($res);

            foreach ($res as $results) {
                ?>
                <tr>
                    <td><?php echo $results['username'] ?></td>
                    <td><?php echo $results['nama'] ?></td>
                    <td><?php echo $results['jemaatNama_lengkap']; ?></td>
                    <td><?php if ($results['datalengkap'] == 1) {
                            echo "Data Sudah Dilengkapi";
                        } else {
                            echo "Data Belum Lengkap";
                        } ?>
<!--                        --><?php //if ($results['datalengkap'] == 0){ ?><!-- disabled --><?php //  } ?>
                        <button style="float: right" data-toggle="modal" data-target="#cek" id="cekdata" class="btn btn-default"
                                data-namalengkap="<?php echo $results['jemaatNama_lengkap'] ;?>"
                                data-panggilan="<?php echo $results['jemaatPanggilan']; ?>"
                                data-noanggota="<?php echo $results['jemaatNoAnggota'] ;?>"
                                data-anggota="<?php echo $results['jemaatKeanggotaan']; ?>"
                                data-status="<?php echo $results['StatusJemaat']; ?>"
                                data-kelamin="<?php echo $results['jemaatGender']; ?>"
                                data-tgllahir="<?php echo $results['jemaatTglLahir']; ?>"
                                data-Kotalahir="<?php echo $results['jemaatKotaLahir']; ?>"
                                data-nikah="<?php echo $results['jemaatStatusNikah']; ?>"
                                data-darah="<?php echo $results['jemaatGoldar']; ?>"
                                data-ayah="<?php echo $results['jemaatAyahNama']; ?>"
                                data-ayahnomor="<?php echo $results['jemaatAyahID']; ?>"
                                data-ibu="<?php echo $results['jemaatIbuNama']; ?>"
                                data-ibunomor="<?php echo $results['jemaatIbuID']; ?>"
                        >
                            Detail data
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    </body>

    <!-- Modal -->
    <div class="modal fade" id="cek" role="dialog">
        <div class="modal-dialog center-block mw-50 w-75">
            <!-- Modal content-->
            <form id="form">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div>Data Pribadi Jemaat</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times; </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table cellpadding="5" cellspacing="10">
                            <tr>
                                <td>Nama Lengkap</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtnamalengkap"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Panggilan</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtpanggil"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Anggota</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtnoanggota"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Anggota</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtjnsanggota"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Status Jemaat</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtstatusjmt"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtjnskelamin"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Kelahiran</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtlahir"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Status Nikah</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtstatusnikah"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Golongan Darah</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtgoldarah"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Ayah</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtayahnama"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Anggota Ayah</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtayahno"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama ibu</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtibunama"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Anggota ibu</td>
                                <td><b>:</b></td>
                                <td>
                                    <span id="txtibuno"></span>
                                </td>
                            </tr>


                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
            $(document).on('click', '#cekdata', function () {
                var namalengkap = $(this).data('namalengkap');
                var jemaatPanggilan = $(this).data('panggilan');
                var jemaatNoAnggota = $(this).data('noanggota');
                var jemaatKeanggotaan = $(this).data('anggota');
                var status = $(this).data('status');
                var kelamin = $(this).data('kelamin');
                var tgllahir = cek($(this).data('tgllahir'));
                var kotalahir= $(this).data('kotalahir');

                var lahir='';
                if(cek(kotalahir)==='-'){
                    // alert("if");
                    lahir+=tgllahir;
                }
                else {
                    // alert("else");
                    lahir+=kotalahir+', '+tgllahir;
                }

                var nikah= $(this).data('nikah');
                var darah= $(this).data('darah');
                var ayah= $(this).data('ayah');
                var ayahnomor= $(this).data('ayahnomor');
                var ibu= $(this).data('ibu');
                var ibunomor= $(this).data('ibunomor');
                // alert(jemaatNoAnggota);

                document.getElementById('txtnamalengkap').innerHTML = cek(namalengkap);
                document.getElementById('txtpanggil').innerHTML = cek(jemaatPanggilan);
                document.getElementById('txtnoanggota').innerHTML = cek(jemaatNoAnggota);
                document.getElementById('txtjnsanggota').innerHTML = cek(jemaatKeanggotaan);
                document.getElementById('txtstatusjmt').innerHTML = cek(status);
                document.getElementById('txtjnskelamin').innerHTML = cek(kelamin);
                document.getElementById('txtlahir').innerHTML = lahir;
                document.getElementById('txtstatusnikah').innerHTML = cek(nikah);
                document.getElementById('txtgoldarah').innerHTML = cek(darah);
                document.getElementById('txtayahnama').innerHTML = cek(ayah);
                document.getElementById('txtayahno').innerHTML = cek(ayahnomor);
                document.getElementById('txtibunama').innerHTML = cek(ibu);
                document.getElementById('txtibuno').innerHTML = cek(ibunomor);


            });
            $('.modal').on('hidden.bs.modal', function(){
                $(this).find('form')[0].reset();
            });
        });

        function cek(variabel){
            if(variabel==null || variabel==''|| variabel=='0' || variabel==='0000-00-00' ){
                return '-';
            }
            else {
                return variabel;
            }
        }
    </script>
<?php
include_once 'footer-2.php';
?>