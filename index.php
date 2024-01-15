<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>admin suhu</title>

 

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <?php
    include "koneksi.php";
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <div class="row">

                        <div id="cardToUpdate" class="col-xl-4 col-md-8 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <!-- Konten card akan diperbarui melalui AJAX -->
                            </div>
                        </div>
                        <div id="cardhumadity" class="col-xl-4 col-md-8 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <!-- Konten card akan diperbarui melalui AJAX -->
                            </div>
                        </div>
                        <div id="cardgas" class="col-xl-4 col-md-8 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <!-- Konten card akan diperbarui melalui AJAX -->
                            </div>
                        </div>

                    </div>

                    <div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Sensor</h6>
                <div class="dropdown no-arrow">
                    <!-- Konten dropdown (jika diperlukan) -->
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- suhu -->
                    <div class="col-md-5">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="chart-area">
                                    <div class="panel-body">
                                        <div class="grafik-container">
                                            <div id="iotChartContainer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- kelembapan -->
                    <div class="col-md-5">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="chart-area">
                                    <div class="panel-body">
                                        <div class="grafik-container">
                                            <div id="iothumidity"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- gas -->
                    <div class="col-md-5">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="chart-area">
                                    <div class="panel-body">
                                        <div class="grafik-container">
                                            <div id="mq2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan kartu lainnya jika diperlukan -->
                </div>
            </div>
        </div>
    </div>
</div>


       

    <script>
        function refreshCard() {
            // Menggunakan AJAX untuk memuat data suhu terbaru
            $.ajax({
                url: 'suhu.php',
                type: 'GET',
                success: function(data) {
                    // Mengganti konten card dengan data suhu terbaru
                    $('#cardToUpdate').html(data);
                },
                error: function(error) {
                    console.error('Error refreshing card:', error);
                }
            });
            $.ajax({
                url: 'humadity.php',
                type: 'GET',
                success: function(data) {
                    // Mengganti konten card dengan data suhu terbaru
                    $('#cardhumadity').html(data);
                },
                error: function(error) {
                    console.error('Error refreshing card:', error);
                }
            });
            $.ajax({
                url: 'gas.php',
                type: 'GET',
                success: function(data) {
                    // Mengganti konten card dengan data suhu terbaru
                    $('#cardgas').html(data);
                },
                error: function(error) {
                    console.error('Error refreshing card:', error);
                }
            });
            $.ajax({
            url: 'grafik_suhu.php',
            type: 'GET',
            success: function (data) {
                // Mengganti konten grafik pada tampilan utama
                $('#iotChartContainer').html(data);
            },
            error: function (error) {
                console.error('Error loading graph:', error);
            }
             });

             $.ajax({
            url: 'grafik_humidity.php',
            type: 'GET',
            success: function (data) {
                // Mengganti konten grafik pada tampilan utama
                $('#iothumidity').html(data);
            },
            error: function (error) {
                console.error('Error loading graph:', error);
            }
             });
             $.ajax({
            url: 'grafik_mq.php',
            type: 'GET',
            success: function (data) {
                // Mengganti konten grafik pada tampilan utama
                $('#mq2').html(data);
            },
            error: function (error) {
                console.error('Error loading graph:', error);
            }
             });
        }

        // Merefresh card setiap 5 detik
        setInterval(refreshCard, 5000);

        // Merefresh grafik setiap 5 detik
        setInterval(loadGraph, 5000);

        // Memanggil fungsi refreshCard saat halaman pertama kali dimuat
        $(document).ready(refreshCard);

        // Memanggil fungsi loadGraph saat halaman pertama kali dimuat
        $(document).ready(loadGraph);
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>
