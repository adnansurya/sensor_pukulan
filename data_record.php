<!DOCTYPE html>
<html lang="en">

<head>

    <title>Admin - </title>
    <?php include_once 'template/head.php';
    require_once 'koneksi.php';
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    } ?>

    <link href="vendor/DataTables-1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="vendor/Buttons-2.4.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="vendor/Responsive-2.5.0/css/responsive.bootstrap4.min.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once 'template/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include_once 'template/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">List Data</h1>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <div class="table-responsive">
                                        <table class="table user-table" id="tableId">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Timestamp</th>
                                                    <?php
                                                    if ($_SESSION['id_role'] == 1) {
                                                        echo '<th scope="col">Nama</th>';
                                                    }
                                                    ?>
                                                    <th scope="col">Berat Pukulan</th>
                                                    <th scope="col">Kecepatan Pukulan</th>
                                                    <th scope="col">Jarak </th>
                                                    <th scope="col">Kategori</th>
                                                    <?php
                                                    if ($_SESSION['id_role'] == 1) {
                                                        echo '<th scope="col">Action</th>';
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody id="tableData">
                                                <?php
                                                require_once 'koneksi.php';

                                                $sql_filter = "";

                                                if (!($_SESSION['id_role'] == 1)) {
                                                    $sql_filter = " AND user.id_user=" . $_SESSION['id_user'];
                                                }


                                                $sql = "SELECT data_record.*, user.nama FROM data_record INNER JOIN user ON data_record.id_user=user.id_user WHERE data_record.kategori != 'Waiting'" . $sql_filter;
                                                $result = mysqli_query($koneksi, $sql);
                                                $nomor = 0;

                                                // echo $sql;

                                                if ($result->num_rows > 0) {

                                                    while ($row = $result->fetch_assoc()) {
                                                        $nomor++;
                                                        echo '<tr>';
                                                        echo '<td>' . $nomor . '</td>';
                                                        echo '<td>' . $row['waktu'] . '</td>';

                                                        if ($_SESSION['id_role'] == 1) {
                                                            echo '<td>' . $row["nama"] . '</td>';
                                                        }
                                                        echo '<td>' . $row["berat_pukulan"] . ' <small>kg</small></td>';
                                                        echo '<td>' . $row["kecepatan_pukulan"] . ' <small>km/h</small></td>';
                                                        echo '<td>' . $row["jarak"] . ' <small>cm</small></td>';
                                                        echo '<td>' . $row["kategori"] . '</td>';

                                                        if ($_SESSION['id_role'] == 1) {
                                                            echo '<td> <button class="btn btn-danger btn-sm" data-toggle="modal" data-id=' . $row['id_record'] . ' data-nama="' . $row['nama'] . '" data-target="#hapusModal">
                                                                    <i class="fa fa-trash"> </i> 
                                                                </button></td>';
                                                        }

                                                        echo '</tr>';
                                                    }
                                                }
                                                $koneksi->close();

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; SB Admin 2</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="pukulan_form" method="post" action="forms/pukulan_data.php">
                        <!-- Isi Modal -->
                        <div class="modal-body">
                            <input type="hidden" name="act">
                            <input type="hidden" name="id_record">
                            <div class="form-group">
                                <label for="waktu">Waktu :</label>
                                <input type="text" class="form-control" name="waktu" id="waktu" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama :</label>
                                <input type="text" class="form-control" name="nama" id="nama" disabled>
                            </div>
                            <div class="form-group">
                                <label for="berat">Berat <small> kg</small> :</label>
                                <input type="text" class="form-control" name="berat" id="berat" disabled>
                            </div>
                            <div class="form-group">
                                <label for="kecepatan">Kecepatan <small> (km/h)</small> :</label>
                                <input type="text" class="form-control" name="kecepatan" id="kecepatan" disabled>
                            </div>
                            <div class="form-group">
                                <label for="jarak">Jarak <small>(cm)</small> :</label>
                                <input type="text" class="form-control" name="jarak" id="jarak" disabled>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori :</label>
                                <input type="text" class="form-control" name="kategori" id="kategori" disabled>
                            </div>
                        </div>
                        <!-- Tombol Simpan dan Tutup Modal -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <script src="vendor/JSZip-3.10.1/jszip.min.js"></script>
        <script src="vendor/pdfmake-0.2.7/pdfmake.min.js"></script>
        <script src="vendor/pdfmake-0.2.7/vfs_fonts.js"></script>
        <script src="vendor/DataTables-1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="vendor/DataTables-1.13.6/js/dataTables.bootstrap4.min.js"></script>
        <script src="vendor/Buttons-2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="vendor/Buttons-2.4.2/js/buttons.bootstrap4.min.js"></script>
        <script src="vendor/Buttons-2.4.2/js/buttons.html5.min.js"></script>
        <script src="vendor/Responsive-2.5.0/js/dataTables.responsive.min.js"></script>
        <script src="vendor/Responsive-2.5.0/js/responsive.bootstrap4.min.js"></script>

        <script>
            $('#tableId').DataTable({
                responsive: true,
                order: [[0, 'desc']],
                dom: 'Bfrtip'

            });


            $('#hapusModal').on('show.bs.modal', function(e) { //get data-id attribute of the clicked element 

                let act = 'delete';
                $(e.currentTarget).find('input[name="act"]').val(act);

                let id = $(e.relatedTarget).data('id');
                let nama = $(e.relatedTarget).data('nama');
                $(e.currentTarget).find('input[name="id_record"]').val(id);
                $(e.currentTarget).find('input[name="nama"]').val(nama);
                $.get("api/get_single_data.php?table=data_record&col=id_record&id=" + id, function(data, status) {
                    // alert(" Data: " + data + " \nStatus: " + status);
                    let jsonObj = $.parseJSON(data);

                    $(e.currentTarget).find('input[name="waktu"]').val(jsonObj.waktu);
                    $(e.currentTarget).find('input[name="berat"]').val(jsonObj.berat_pukulan);
                    $(e.currentTarget).find('input[name="kecepatan"]').val(jsonObj.kecepatan_pukulan);
                    $(e.currentTarget).find('input[name="jarak"]').val(jsonObj.jarak);
                    $(e.currentTarget).find('input[name="kategori"]').val(jsonObj.kategori);

                });


            });
        </script>

</body>

</html>