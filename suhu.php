<?php
include "koneksi.php";

// Ambil data suhu terakhir dari database
$query = mysqli_query($koneksi, "SELECT * FROM data_sensor ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_array($query);

// Menentukan pesan berdasarkan suhu
if ($data['temperature'] < 30) {
    $message = "Suhu Dingin";
    $image = "img/gambar/dingin.png"; // Ganti dengan nama file gambar yang sesuai
} elseif ($data['temperature'] >= 30 && $data['temperature'] <= 35) {
    $message = "Suhu Normal";
    $image = "img/gambar/normal.png"; // Ganti dengan nama file gambar yang sesuai
} else {
    $message = "Suhu Panas";
    $image = "img/gambar/panas.png"; // Ganti dengan nama file gambar yang sesuai
}
// Format data suhu dan pesan sebagai HTML yang akan dimuat ke dalam card
$html = '
<div class="col-xl-12 col-md-8 mb-6">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
             <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Suhu (Temperatur)</div>
                         <span style="font-size: 50px;">' . $message . '</span>
                            <img src="' . $image . '" alt="Gambar Suhu" style="width: 100px; height: 80px;">
                    <div class="mt-2">
                        <span style="font-size: 30px;">' . $data['temperature']  .  '</span><font size="2">  °C</font>
                    
                
                    </div>
                 </div>
            </div>
         </div>
        </div>
    </div>
    </div>
';

// Mengembalikan HTML sebagai respons untuk dimuat ke dalam card
echo $html;
?>
