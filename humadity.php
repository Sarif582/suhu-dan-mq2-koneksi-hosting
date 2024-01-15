<?php
include "koneksi.php";

// Ambil data suhu terakhir dari database
$query = mysqli_query($koneksi, "SELECT * FROM data_sensor ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_array($query);


// Menentukan pesan berdasarkan suhu
if ($data['humidity']< 40) {
    $message = "Rendah";
} elseif ($data['humidity'] >40) {
    $message = "Tinggi";
} 
// Format data suhu sebagai HTML yang akan dimuat ke dalam card
$html = '
<div class="col-xl-11 col-md-8 mb-6">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
             <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Kelembapan</div>
                         <span style="font-size: 50px;">' . $message  . '</span>
                   
                    <div class="mt-1">
                    <span style="font-size: 30px;">' . $data['humidity']  .  '</span>
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
