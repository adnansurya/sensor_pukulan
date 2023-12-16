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
                    <div class="row my-4">
                        <div class="col-12">
                            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"> </i> Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <div id="chartContainer" style="height: 500px; width: 100%;"></div>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pukulan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class=" row" id="resultText">
                            <div class="col-4 text-center">
                                <h5>Berat</h5>
                                <h2 id="beratVal">0.0</h2>
                                <!-- <p>kg</p> -->
                            </div>
                            <div class="col-4 text-center">
                                <h5>Kecepatan</h5>
                                <h2 id="kecepatanVal">0.0</h2>
                                <!-- <p>km/h</p> -->
                            </div>
                            <div class="col-4 text-center">
                                <h5>Jarak</h5>
                                <h2 id="jarakVal">0.0</h2>
                                <!-- <p>cm</p> -->
                            </div>
                        </div>

                        <div id="spinnerInput">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <p>Menunggu Input dari Sensor</p>
                        </div>




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

        <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        <script>
            $('#resultText').hide();
            let id_record = null;
            let intervalCek = null;
            let dataAvailable = false;

            function cekKategori() {
                $.get("api/get_single_data.php", {
                    'table': 'data_record',
                    'col': 'id_record',
                    'id': id_record
                }, function(result) {
                    // console.log(result);
                    let recordObj = JSON.parse(result);
                    let kategori = recordObj['kategori'];
                    let berat_pukulan = recordObj['berat_pukulan'];
                    let kecepatan_pukulan = recordObj['kecepatan_pukulan'];
                    let jarak = recordObj['jarak'];
                    console.log(kategori);
                    if (kategori != 'Waiting') {
                        $('#beratVal').html(berat_pukulan + '<small> kg</small>');
                        $('#kecepatanVal').html(kecepatan_pukulan + '<small> km/h</small>');
                        $('#jarakVal').html(jarak + '<small> cm</small>');
                        $('#spinnerInput').hide();
                        $('#resultText').show();
                        clearInterval(intervalCek);
                        dataAvailable = true;
                    }


                });
            }



            $('#exampleModal').on('show.bs.modal', function(event) {
                $.post("forms/pukulan_data.php", {
                    'act': 'new',
                    'id_user': '<?php echo $_SESSION['id_user'] ?>'
                }, function(result) {
                    // $("").html(result);
                    // alert(result);

                    id_record = parseInt(result);
                    console.log(id_record);
                    if (!isNaN(id_record)) {
                        intervalCek = setInterval(cekKategori, 1000);
                    }
                });

            })

            $("#exampleModal").on("hide.bs.modal", function() {
                clearInterval(intervalCek);
                if (dataAvailable == false) {
                    $.post("forms/pukulan_data.php", {
                        'act': 'cancel',
                        'id_user': '<?php echo $_SESSION['id_user'] ?>'
                    }, function(result) {
                        console.log(result);
                    });
                } else {
                    window.location.reload();
                }

            });

            function plotChartbyData(arr1, arr2, arr3) {
                var chart = new CanvasJS.Chart("chartContainer", {
                    zoomEnabled: true,

                    title: {
                        text: "Grafik Kekuatan Pukulan"
                    },
                    axisX: {
                        title: "time",
                        // gridThickness: 2,
                        // interval: 1,
                        // intervalType: "day",
                        valueFormatString: "DDDD MMM YYYY HH:mm:ss"
                        // labelAngle: -20
                    },

                    data: [{
                        type: "line",
                        xValueType: "dateTime",
                        dataPoints: arr1
                    }, {
                        type: "column",
                        xValueType: "dateTime",
                        dataPoints: arr2
                    }, {
                        type: "area",
                        xValueType: "dateTime",
                        dataPoints: arr3
                    }]
                });
                // console.log(dataArr);
                chart.render();
            }

            window.onload = function() {
                $.get("api/get_grafik_data.php", {
                    'id_user': 2
                }, function(result) {
                    // console.log(result);
                    let jsonArr = JSON.parse(result);
                    let kecepatanArr = [];
                    let beratArr = [];
                    let jarakArr = [];
                    for (let i = 0; i < jsonArr.length; i++) {
                        oneKecepatan = oneBerat = oneJarak = {};
                        oneKecepatan['x'] = oneBerat['x']  = oneJarak['x']= parseInt(jsonArr[i]['timestamp']) * 1000;
                        oneKecepatan['y'] = parseFloat(jsonArr[i]['kecepatan_pukulan']);
                        kecepatanArr.push(oneKecepatan);
                        oneBerat['y'] = parseFloat(jsonArr[i]['berat_pukulan']);
                        beratArr.push(oneBerat);
                        oneJarak['y'] = parseFloat(jsonArr[i]['jarak']);
                        jarakArr.push(oneJarak);

                    }
                    console.log(kecepatanArr);
                    console.log(beratArr);
                    console.log(jarakArr);
                    plotChartbyData(kecepatanArr, jarakArr, beratArr);
                });

            }
        </script>

</body>

</html>