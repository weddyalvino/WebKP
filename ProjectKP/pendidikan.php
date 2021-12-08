<?php
include_once 'header-2.php';
//print_r($_POST);
//echo '<br>';
//print_r($_GET);
?>
    <script>
        function deletedidik(id) {
            let confimation = window.confirm("Apakah data Pendidikan akan dihapus ?");
            if (confimation) {
                window.location = "?menu=pendidikan&cmd=del&didik=" + id;
            }
        };
    </script>
    <head>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    </head>
    <body>
    <div class="container-fluid">
        <br>
        <h1>Data Pendidikan
            <input type="submit" data-toggle="modal" data-target="#tambah" class="btn btn-primary" value="Tambah"
                   style="float: right">
        </h1>
        <br>
        <table id="table_id" class="display" style="flex-shrink: 0; width:100%">
            <thead>
            <tr>
                <th>Tingkat</th>
                <th>Nama Sekolah</th>
                <th>Jurusan</th>
                <th>Keterangan</th>
                <th width="13%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $pendidikan = new PendidikanDAO();
//            $result = $pendidikan->fetchpendidikan($_SESSION['userid']);
            foreach ($res as $results) { ?>
                <tr>
                    <td><?php echo $results['pendidikanjenis'] ?> </td>
                    <td><?php echo $results['nama_sekolah'] ?> </td>
                    <td><?php echo $results['jurusan'] ?> </td>
                    <td><?php echo $results['keterangan'] ?> </td>
                    <td><input value="Update" type="submit" data-toggle="modal" name="update" id="update"
                               class="btn btn-outline-info btn-sm" data-target="#tambah"
                               data-jenis="<?php echo $results['pendidikan_tingat'] ?>"
                               data-sekolah="<?php echo $results['nama_sekolah'] ?>"
                               data-ket="<?php echo $results['keterangan'] ?>"
                               data-jurusan="<?php echo $results['jurusan'] ?>"
                               data-user="<?php echo $results['id_user'] ?>"
                               data-id="<?php echo $results['id_pendidikan'] ?>">
                        <button class="btn btn-outline-info btn-sm"
                                onclick="deletedidik(<?php echo $results['id_pendidikan'] ?>)">Delete
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

    <!-- Modal -->
    <div class="modal fade" id="tambah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <!-- Modal content-->
            <form method="post" action="">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div>Data Pendidikan Jemaat</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times; </span>
                        </button>
                    </div>
                    <div class="modal-body -columns">
                        <table>
                            <tr>
                                <td>Tingkat Pendidikan</td>
                                <td><b>:</b></td>
                                <td>
                                    <select name="jnspendidikan" id="didik">
                                        <?php
                                        $dao = new PendidikanDAO();
                                        $didik = $dao->fetchjenis();
                                        foreach ($didik as $jns) {
                                            echo "<option  value='" . $jns['pendidikanID'] . "'>" . $jns['pendidikanjenis'] . "</option>";
                                        }
                                        print_r($didik);
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <input type="hidden" id="id" name="id">
                            <tr>
                                <td>Nama Sekolah</td>
                                <td><b>:</b></td>
                                <td>
                                    <input size="47" type="text" name="sekolah" id="sklh"
                                           placeholder="Nama Lengkap Sekolah">
                                </td>
                            </tr>

                            <tr>
                                <td>Jurusan Pendidikan</td>
                                <td><b>:</b></td>
                                <td>
                                    <input size="47" type="text" name="jurusan" id="jurusanpendidikan"
                                           placeholder="Jurusan yang diambil di sekolah">
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td><b>:</b></td>
                                <td>
                                <textarea id="ket" name="keterangan" cols="50" rows="5"
                                          placeholder="Keterangan tambahan terkait pekerjaan yang dilalui"></textarea>
                                </td>
                            </tr>
                        </table>

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="btnProses" value="Simpan"
                                   onclick="return confirm('Apakah Anda yakin untuk menyimpan data pendidikan?')">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
            $(document).on('click', '#update', function () {
                var jenis = $(this).data('jenis');
                var sekolah = $(this).data('sekolah');
                var keterangan = $(this).data('ket');
                var jurusan = $(this).data('jurusan');
                var id = $(this).data('id');

                document.getElementById('didik').value = jenis;
                $('#ket').val(keterangan);
                $('#id').val(id);
                $('#sklh').val(sekolah);
                $('#jurusanpendidikan').val(jurusan);

                $('.modal').on('hidden.bs.modal', function () {
                    $(this).find('form')[0].reset();
                    $('#id').val(null);
                });
            })
        });
    </script>

<?php include 'footer-2.php'; ?>