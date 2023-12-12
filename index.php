<!DOCTYPE html>
<html lang="en">

<head>

    <title>Admin - </title>
    <?php

    include_once 'template/head.php';
    require_once 'koneksi.php';
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    ?>

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
                    <h1 class="h3 mb-4 text-gray-800">Home</h1>
                    <div class="row mt-4">
                        <div class="col-12">
                            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"> </i> Tambah Data
                            </button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pukulan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            $.post("forms/pukulan_data.php", {
                'act': 'new',
                'id_user': '<?php echo $_SESSION['id_user'] ?>'                 
            }, function(result) {
                // $("").html(result);
                alert(result);
            });
        })

        $("#exampleModal").on("hide.bs.modal", function() {
            $.post("forms/pukulan_data.php", {
                'act': 'cancel',
                'id_user': '<?php echo $_SESSION['id_user'] ?>'           
            }, function(result) {
                // $("").html(result);
                alert(result);
            });
        });
    </script>

</body>

</html>