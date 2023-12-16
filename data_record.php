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
                responsive: true

            });
        </script>

</body>

</html>