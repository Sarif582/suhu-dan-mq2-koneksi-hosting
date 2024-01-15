<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM data_sensor ORDER BY id DESC LIMIT 13");
$timestamp = [];
$gas = [];
while ($data = mysqli_fetch_array($query)) {
    $timestamp[] = date('H:i:s', strtotime($data['created_at']));
    $gas[] = $data['gas_value'];
}

// Reverse array untuk mendapatkan urutan dari sebelah kanan
$timestamp = array_reverse($timestamp);
$gas = array_reverse($gas);
?>

<!-- Bagian untuk grafik -->
<div class="grafik-container">
    <canvas id="iotCharttt"></canvas>
</div>

<script>
    // Ambil elemen canvas
    var ctx = document.getElementById('iotCharttt').getContext('2d');

    // Buat grafik menggunakan Chart.js
    var iotChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($timestamp); ?>,
            datasets: [
            {
                label: 'Kelembaban (%)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data:<?php echo json_encode($gas); ?>,
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
                        max: 10000
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
