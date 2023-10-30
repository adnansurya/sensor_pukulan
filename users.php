<!DOCTYPE html>
<html lang="en">

<head>

    <title>Admin - </title>
    <?php include_once 'template/head.php'; ?>

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
                <nav class="navbar navbar-expand navbar-light bg-danger topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars" style="color: #e7e3e3;"></i>
                    </button>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">List User</h1>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <div class="table-responsive">
                                        <table class="table user-table" id="tableId">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Role</th>                                                  
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableData">
                                                <?php
                                                require_once 'koneksi.php';
                                                

                                                $sql = "SELECT * FROM user";
                                                $result = $koneksi->query($sql);

                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                                    while ($row = $result->fetch_assoc()) {                                                       
                                                        echo '<tr>';
                                                        echo '<td>' . $row["id_user"] . '</td>';                                                      
                                                        echo '<td>' . $row["nama"] . '</td>';
                                                        echo '<td>' . $row["username"] . '</td>';
                                                        echo '<td>' . $row["role"] . '</td>';
                                                        echo '<td>' . $row["role"] . '</td>';
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

        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.5/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/r-2.5.0/datatables.min.js"></script>

        <script>
            $('#tableId').DataTable({
                responsive: true

            });
        </script>

</body>

</html>