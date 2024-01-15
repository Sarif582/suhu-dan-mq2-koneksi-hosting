<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM data_sensor ORDER BY id DESC LIMIT 13");
$timestamp = [];
$suhuData = [];
$kelembabanData = [];
while ($data = mysqli_fetch_array($query)) {
    $timestamp[] = date('H:i:s', strtotime($data['created_at']));
    $suhuData[] = $data['temperature'];
    // $kelembabanData[] = $data['humidity'];
}
$timestamp = array_reverse($timestamp);
$kelembabanData = array_reverse($kelembabanData);
?>

<!-- Bagian untuk grafik -->
<div class="grafik-container">
    <canvas id="iotChartt"></canvas>
</div>

<script>
    // Ambil elemen canvas
    var ctx = document.getElementById('iotChartt').getContext('2d');

    // Buat grafik menggunakan Chart.js
    var iotChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($timestamp); ?>,
            datasets: [{
                label: 'Suhu (°C)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: <?php echo json_encode($suhuData); ?>,
            }
            
        ]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                     reverse: true,
                    ticks: {
                        fontSize: 8
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 10,
                        min: 0,
                        max: 100
                    }
                }
            },
            plugins: {
                zoom: {
                    pan: {
                        enabled: true,
                        mode: 'xy'
                    },
                    zoom: {
                        enabled: true,
                         mode: 'xy'
                    }
                }
            },
            animation: {
                duration: 0 // Menonaktifkan animasi
            }
        }
    });
</script>
