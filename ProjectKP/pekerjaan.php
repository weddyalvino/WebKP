<?php
include_once 'header-2.php';
//    var_dump($result);
//$tanggal = date("d M Y");
//echo "Hari ini  " .$tanggal."<br><br>";
//echo "Hari ini Tanggal " . date("Y/m/d") . "<br>";
$date = date('Y-m-d', time());
//print_r($result);
?>
    <script>

        function deleteValue(id) {
            let confimation = window.confirm("Apakah data pekerjaan akan dihapus ?");
            if (confimation) {
                window.location = "?menu=pekerjaan&cmd=del&kerja=" + id;
            }
        }

        $(document).ready(function () {
            $('#table_id').DataTable();

        });
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <body>
    <div class="container-fluid">
        <br>
        <h1>Pekerjaan
            <input type="submit" data-toggle="modal" data-target="#tambah" class="btn btn-primary" id="tambahkerja"
                   value="Tambah"
                   style="float: right">
        </h1>
        <br>
        <table id="table_id" class="display" style="flex-shrink: 0; width:100%">
            <thead>
            <tr>
                <th width="15%">Awal</th>
                <th width="15%">Akhir</th>
                <th width="22%">Nama Pekerjaan</th>
                <th width="35%">Keterangan</th>
                <th width="13%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $kerja = new kerjaDAO();
//            $result = $kerja->fetchPekerjaan($_SESSION['userid']);
            //        print_r($result);
            foreach ($kerjadata as $results) {
                $mulai = date("d M Y", strtotime($results['pekerjaanMulai']));
                if ($results['pekerjaanAkhir'] != null) {
                    $akhir = date("d M Y", strtotime($results['pekerjaanAkhir']));
                } else {
                    $akhir = "Sekarang";
                } ?>
                <tr>
                    <td><?php echo $mulai ?></td>
                    <td><?php echo $akhir ?></td>

                    <td><?php echo $results['pekerjaanNama'] ?> </td>
                    <td><?php echo $results['keterangan'] ?> </td>
                    <td><input value="Update" type="submit" data-toggle="modal" name="update" id="update"
                               class="btn btn-outline-info btn-sm" data-target="#tambah"
                               data-mulai="<?php echo $results['pekerjaanMulai'] ?>"
                               data-akhir="<?php echo $results['pekerjaanAkhir'] ?>"
                               data-id="<?php echo $results['id_pekerjaan'] ?>"
                               data-idkerja="<?php echo $results['pekerjaanID'] ?>"
                               data-valuekerja="<?php echo $results['pekerjaanNama'] ?>"
                               data-keterangan="<?php echo $results['keterangan'] ?>">
                        <button class="btn btn-outline-info btn-sm"
                                onclick="deleteValue(<?php echo $results['id_pekerjaan'] ?>)">Delete
                        </button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    </body>
<?php
echo("<script>console.log('PHP: " . $_SESSION['userid'] . "');</script>");
//print_r($result );
?>

    <!-- Modal -->
    <div class="modal fade" id="tambah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <!-- Modal content-->
            <form method="post" id="form">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div>Data Pekerjaan Jemaat</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times; </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>Tanggal Mulai Bekerja</td>
                                <td><b>:</b></td>
                                <td>
                                    <input type="date" name="tglMulai" id="tgl_mulai" value="<?php echo $date; ?>"
                                           required>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Akhir Bekerja</td>
                                <td><b>:</b></td>
                                <td>
                                    <input type="radio" name="akhir" id="sekarang" value="1" required>&nbsp;Sekarang&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="akhir" id="tglakhir" value="0" required>&nbsp;
                                    <input type="date" name="tglAkhir" id="tgl_akhir" value="<?php echo $date; ?>">
                                </td>
                            </tr>
                            <input type="hidden" id="id" name="id">
                            <tr>
                                <td>Nama Pekerjaan</td>
                                <td><b>:</b></td>
                                <td>
                                    <select id="kerja" name="pekerjaan" required>
                                        <?php
                                        $kerjaisi = $kerja->  fetchKerja();
//                                        /* @var $row Pekerjaan */
                                        foreach ($kerjaisi as $row) {
                                            if ($row->$row['pekerjaanID'] == 01) {
                                                echo "<option value='" . $row['pekerjaanID'] . "'>" .$row['pekerjaanNama']. "</option>";
                                            } else {
                                                echo "<option  value='" . $row['pekerjaanID'] . "'>" . $row['pekerjaanNama'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td><b>:</b></td>
                                <td rowspan="5">
                                <textarea id="ket" name="keterangan" cols="50" rows="5"
                                          placeholder="Keterangan tambahan terkait pekerjaan yang dilalui"></textarea>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" name="btnProses" value="Simpan">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(function(){
                $('#ket').change(function(){
                    this.value = $.trim(this.value);
                });
            });
            $('#table_id').DataTable();
            $(document).on('click', '#update', function () {
                var kerjamulai = $(this).data('mulai');
                var kerjaakhir = $(this).data('akhir');
                var id = $(this).data('id');
                var kerjaid = $(this).data('idkerja');
                var kerjanama = $(this).data('valuekerja');
                var kerjaketerangan = $(this).data('keterangan');

                $('#tgl_mulai').val(kerjamulai);
                if(kerjaakhir===''){
                    var newcol='sekarang';
                }
                else{
                    var newcol='tglakhir';
                    $('#tgl_akhir').val(kerjaakhir);
                }
                $('#' + newcol).prop('checked',true);
                $('#ket').val(kerjaketerangan);
                $('#id').val(id);
                document.getElementById('kerja').value=kerjaid;

                $('.modal').on('hidden.bs.modal', function(){
                    $(this).find('form')[0].reset();
                    $('#id').val(null);
                });
            })
        });


    </script>
<?php include 'footer-2.php'; ?>