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

    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

    <link rel="stylesheet" href="vendor/select2/select2.min.css">
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
                        <div class="col-4">
                            <?php                            
                            if ($_SESSION['id_role'] == 1) {
                                $sql = "SELECT * FROM user";
                                $result = $koneksi->query($sql);

                                if ($result) {
                                    echo '<select class="form-control" name="user_selector" id="user_selector">';
                                    echo '<option value="" disabled selected hidden>Pilih User</option>';
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['id_role'] != 1) {
                                            echo '<option value="' . $row['id_user'] . '">' . $row['nama'] . '</option>';
                                        }
                                    }
                                    echo '</select>';
                                }
                                $koneksi->close();
                            } else {
                                echo '<button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"> </i> Tambah Data
                                    </button>';
                            }
                            ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <div id="chartContainer" style="height: 400px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <div id="chartContainer2" style="height: 400px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <div id="chartContainer3" style="height: 400px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <div id="chartContainer4" style="height: 400px; width: 100%;"></div>
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

        <!-- <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script> -->        
        <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

        <script src="vendor/canvasjs/canvasjs.min.js"></script>
        <script src="vendor/select2/select2.min.js"></script>

        <script>
            $('#user_selector').select2();
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
                        $('#beratVal').html(berat_pukulan + '<p><small> gram</small></p>');
                        $('#kecepatanVal').html(kecepatan_pukulan + '<p><small> km/h</small></p>');
                        $('#jarakVal').html(jarak + '<p><small> cm</small></p>');
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
                        // interval: 10,
                        // intervalType: "hour",
                        // valueFormatString: "DD-MM-YYYY HH:mm",
                        // labelAngle: -50
                    },

                    data: [{
                        type: "line",
                        color: "blue",
                        // xValueType: "dateTime",
                        dataPoints: arr1,
                        showInLegend: true,
                        markerType: "triangle",
                        legendText: "kecepatan",
                        toolTipContent: "Kecepatan: <b>{y} km/h </b>  <br>Waktu: {waktu}"
                    }, {
                        type: "line",
                        color: "red",
                        // xValueType: "dateTime",
                        dataPoints: arr2,
                        showInLegend: true,
                        markerType: "cross",
                        legendText: "jarak",
                        toolTipContent: "Jarak: <b>{y} cm </b>  <br>Waktu: {waktu}"
                    }, {
                        type: "line",
                        color: "green",
                        // xValueType: "dateTime",
                        dataPoints: arr3,
                        showInLegend: true,
                        markerType: "square",
                        legendText: "berat",
                        toolTipContent: "Berat: <b>{y} kg </b>  <br>Waktu: {waktu}"
                    }]
                });
                // console.log(dataArr);
                chart.render();
                var chart2 = new CanvasJS.Chart("chartContainer2", {
                    zoomEnabled: true,

                    title: {
                        text: "Grafik Kecepatan Pukulan"
                    },
                    axisX: {
                        title: "Data ke",
                        // gridThickness: 2,
                        // interval: 10,
                        // intervalType: "hour",
                        // valueFormatString: "DD-MM-YYYY HH:mm",
                        // labelAngle: -50
                    },

                    data: [{
                        type: "line",
                        color: "blue",
                        // xValueType: "dateTime",
                        dataPoints: arr1,
                        showInLegend: true,
                        markerType: "triangle",
                        legendText: "kecepatan" ,
                        toolTipContent: "Kecepatan: <b>{y} km/h </b>  <br>Waktu: {waktu}"                   
                    }]
                });
                // console.log(dataArr);
                chart2.render();

                var chart3 = new CanvasJS.Chart("chartContainer3", {
                    zoomEnabled: true,

                    title: {
                        text: "Grafik Jarak Pukulan"
                    },
                    axisX: {
                        title: "time",
                        // gridThickness: 2,
                        // interval: 10,
                        // intervalType: "hour",
                        // valueFormatString: "DD-MM-YYYY HH:mm",
                        // labelAngle: -50
                    },

                    data: [ {
                        type: "line",
                        color: "red",
                        // xValueType: "dateTime",
                        dataPoints: arr2,
                        showInLegend: true,
                        markerType: "cross",
                        legendText: "jarak",
                        toolTipContent: "Jarak: <b>{y} cm </b>  <br>Waktu: {waktu}"
                    }]
                });
                // console.log(dataArr);
                chart3.render();

                var chart4 = new CanvasJS.Chart("chartContainer4", {
                    zoomEnabled: true,

                    title: {
                        text: "Grafik Berat Pukulan"
                    },
                    axisX: {
                        title: "time",
                        // gridThickness: 2,
                        // interval: 10,
                        // intervalType: "hour",
                        // valueFormatString: "DD-MM-YYYY HH:mm",
                        // labelAngle: -50
                    },

                    data: [  {
                        type: "line",
                        color: "green",
                        // xValueType: "dateTime",
                        dataPoints: arr3,
                        showInLegend: true,
                        markerType: "square",
                        legendText: "berat",
                        toolTipContent: "Berat: <b>{y} kg </b>  <br>Waktu: {waktu}",
                    }]
                });
                // console.log(dataArr);
                chart4.render();
            }

            function loadChart(id_user) {
                $.get("api/get_grafik_data.php", {
                    'id_user': id_user
                }, function(result) {
                    // console.log(result);
                    let jsonArr = JSON.parse(result);
                    let kecepatanArr = [];
                    let beratArr = [];
                    let jarakArr = [];
                    for (let i = 0; i < jsonArr.length; i++) {
                        oneKecepatan = {};
                        // oneKecepatan['x'] = parseInt(jsonArr[i]['timestamp']) * 1000;                        
                        oneKecepatan['y'] = parseFloat(jsonArr[i]['kecepatan_pukulan']);
                        oneKecepatan['label'] = parseInt(jsonArr[i]['nomor']);
                        oneKecepatan['waktu'] = jsonArr[i]['waktu'];
                        kecepatanArr.push(oneKecepatan);

                        oneBerat = {};
                        // oneBerat['x'] = parseInt(jsonArr[i]['timestamp']) * 1000;
                        oneBerat['y'] = parseFloat(jsonArr[i]['berat_pukulan']);
                        oneBerat['label'] = parseInt(jsonArr[i]['nomor']);
                        oneBerat['waktu'] = jsonArr[i]['waktu'];
                        beratArr.push(oneBerat);

                        oneJarak = {};
                        // oneJarak['x'] = parseInt(jsonArr[i]['timestamp']) * 1000;
                        oneJarak['y'] = parseFloat(jsonArr[i]['jarak']);
                        oneJarak['label'] = parseInt(jsonArr[i]['nomor']);
                        oneJarak['waktu'] = jsonArr[i]['waktu'];
                        jarakArr.push(oneJarak);

                    }
                    // console.log(kecepatanArr);
                    // console.log(beratArr);
                    // console.log(jarakArr);

                    plotChartbyData(kecepatanArr, jarakArr, beratArr);
                });
            }

            window.onload = function() {

                loadChart(<?php echo $_SESSION['id_user']; ?>);

            }

            $('#user_selector').on('change', function() {
                // alert(this.value);
                let user_id = this.value;
                loadChart(user_id);
            });
        </script>

</body>

</html>