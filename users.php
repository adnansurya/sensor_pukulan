<!DOCTYPE html>
<html lang="en">

<head>

    <title>Admin - </title>
    <?php
    include_once 'template/head.php';
    require_once 'koneksi.php';
    session_start();

    if (!(isset($_SESSION['username']) && $_SESSION['id_role'] == 1)) {
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
                    <h1 class="h3 mb-4 text-gray-800">List User</h1>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-act="add" data-target="#exampleModal">
                                        Tambah User
                                    </button>
                                </div>
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


                                                $sql = "SELECT user.* , role.rolename FROM user INNER JOIN role ON user.id_role=role.id_role";
                                                $result = $koneksi->query($sql);

                                                if ($result->num_rows > 0) {
                                                    // output data of each row
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<tr>';
                                                        echo '<td>' . $row["id_user"] . '</td>';
                                                        echo '<td>' . $row["nama"] . '</td>';
                                                        echo '<td>' . $row["username"] . '</td>';
                                                        echo '<td>' . $row["rolename"] . '</td>';
                                                        echo '<td>
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-act="edit" data-id=' . $row['id_user'] . ' data-target="#exampleModal">
                                                                Edit
                                                            </button>  
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-act="delete" data-id=' . $row['id_user'] . ' data-target="#exampleModal">
                                                                Hapus
                                                            </button>
                                                        </td>';
                                                        echo '</tr>';
                                                    }
                                                }

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

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="user_form" method="post" action="forms/user_crud.php">
                        <!-- Isi Modal -->
                        <div class="modal-body">

                            <input type="hidden" name="act">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label for="id_role">Role:</label>
                                <select class="form-control" name="id_role" id="id_role">
                                    <?php
                                    $sql = "SELECT * FROM role";
                                    $result = $koneksi->query($sql);

                                    if ($result) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['id_role'] . '">' . $row['rolename'] . '</option>';
                                        }
                                    }
                                    $koneksi->close();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- Tombol Simpan dan Tutup Modal -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>

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
                $(' #tableId').DataTable({
                    responsive: true
                });


                $('#exampleModal').on('show.bs.modal', function(e) { //get data-id attribute of the clicked element 
                    let act = $(e.relatedTarget).data('act');
                    $(e.currentTarget).find('input[name="act"]').val(act);
                    if (act != 'add') {
                        let id = $(e.relatedTarget).data('id');
                        $(e.currentTarget).find('input[name="id"]').val(id);
                        $.get("api/get_single_data.php?table=user&col=id_user&id=" + id, function(data, status) {
                            // alert(" Data: " + data + " \nStatus: " + status);
                            let jsonObj = $.parseJSON(data);


                            $(e.currentTarget).find('input[name="nama"]').val(jsonObj.nama);
                            $(e.currentTarget).find('input[name="username"]').val(jsonObj.username);
                            $(e.currentTarget).find('input[name="password"]').val(jsonObj.password);
                            $(e.currentTarget).find('select[name="id_role"]').val(jsonObj.id_role);
                            if (act == 'delete') {
                                $(e.currentTarget).find('h5[id="exampleModalLabel"]').text('Hapus User');
                                $(e.currentTarget).find('input').prop("disabled", true);
                                $(e.currentTarget).find('select').prop("disabled", true);
                                $(e.currentTarget).find('input[name="act"]').prop("disabled", false);
                                $(e.currentTarget).find('input[name="id"]').prop("disabled", false);
                                $(e.currentTarget).find('button[type="submit"]').text('Hapus');
                            } else if (act == 'edit') {
                                $(e.currentTarget).find('h5[id="exampleModalLabel"]').text('Edit User');
                                $(e.currentTarget).find('input').prop("disabled", false);
                                $(e.currentTarget).find('select').prop("disabled", false);
                                $(e.currentTarget).find('button[type="submit"]').text('Simpan');
                            }
                        });

                    } else {
                        $(e.currentTarget).find('input').prop("disabled", false);
                        $(e.currentTarget).find('select').prop("disabled", false);
                        $(e.currentTarget).find('input').val('');
                        $(e.currentTarget).find('input[name="act"]').val(act);
                    }
                });
            </script>

</body>

</html>