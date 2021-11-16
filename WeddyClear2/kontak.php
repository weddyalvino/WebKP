<?php
include_once 'header-2.php';

?>
    <head>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#table_id').DataTable();
            });
        </script>
    </head>
    <script>
        function deletekontak(id) {
            let confimation = window.confirm("Apakah data Kontak akan dihapus ?");
            if (confimation) {
                window.location = "?menu=kontak&cmd=del&kntk=" + id;
            }
        }
    </script>
    <body>
    <div class="container-fluid">
        <br>
        <h1>Data Kontak Jemaat
            <input type="submit" data-toggle="modal" data-target="#tambah" class="btn btn-primary" value="Tambah"
                   style="float: right">
        </h1>
        <br>
        <table id="table_id" class="display" style="flex-shrink: 0; width:100%">
            <thead>
            <tr>
                <th>Jenis</th>
                <th>Alamat / Nomor Kontak</th>
                <th width="50%">Keterangan</th>
                <th width="13%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
//            $kontak = new KontakDAO();
//            $res = $kontak->fetchkontak($_SESSION['userid']);
            if ($cek==1){
                foreach ($res as $results) {
                    ?>
                    <tr>
                        <td><?php echo $results['kontakJenis'] ?></td>
                        <td><?php echo $results['kontakNomor'] ?></td>
                        <td><?php echo $results['kontakKeterangan'] ?></td>
                        <td><input value="Update" type="submit" data-toggle="modal" name="update" id="update"
                                   class="btn btn-outline-info btn-sm" data-target="#tambah"
                                   data-jenis="<?php echo $results['kontakJenis'] ?>"
                                   data-id="<?php echo $results['kontakID'] ?>"
                                   data-nomor="<?php echo $results['kontakNomor'] ?>"
                                   data-keterangan="<?php echo $results['kontakKeterangan'] ?>">
                            <button class="btn btn-outline-info btn-sm"
                                    onclick="deletekontak(<?php echo $results['kontakID'] ?>)">Delete
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            }
            else{
                echo "<script type='text/javascript'>alert('Data kontak masih kosong mohon menambahkan data kontak');</script>";
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
            <form method="post">
                <div class="modal-content">
                    <div class="modal-header ">
                        <div>Data Alamat Jemaat</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times; </span>
                        </button>
                    </div>
                    <div class="modal-body -columns">
                        <table>
                            <tr>
                                <td>Media Komunikasi</td>
                                <td><b>:</b></td>
                                <td>
                                    <select name="Komunikasi" id="jenis" required>
                                        <option selected="selected" value="Telepon">Telepon</option>
                                        <option value="Email">Email</option>
                                        <option value="Whatsapp">Whatsapp</option>
                                        <option value="Line">Line</option>
                                        <option value="Telegram">Telegram</option>
                                    </select>
                                </td>
                            </tr>
                            <input type="hidden" id="id" name="id">
                            <tr>
                                <td>Alamat / No. Kontak</td>
                                <td><b>:</b></td>
                                <td>
                                    <input size="47" type="text" name="alamat" id="nokontak" required
                                           placeholder="Alamat Atau nomor kontak aktif jemaat">
                                </td>
                            </tr>

                            <tr>
                                <td>Keterangan</td>
                                <td><b>:</b></td>
                                <td rowspan="5">
                                <textarea id="ket" name="keterangan" cols="50" rows="5"
                                          placeholder="Keterangan tambahan terkait alamat/nomor kontak yang diberikan"></textarea>
                                </td>
                            </tr>
                        </table>

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
            $('#table_id').DataTable();
            $(document).on('click', '#update', function () {
                var jenis = $(this).data('jenis');
                var kontak = $(this).data('nomor');
                var ket = $(this).data('keterangan');
                var id = $(this).data('id');

                $('#jenis').val(jenis);
                $('#nokontak').val(kontak);
                $('#ket').val(ket);
                $('#id').val(id);


                $('.modal').on('hidden.bs.modal', function () {
                    $(this).find('form')[0].reset();
                    $('#id').val(null);
                });
            })
        });
    </script>
<?php include 'footer-2.php'; ?>