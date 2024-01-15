<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iot";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connection is OK<br>";

if (isset($_POST["temperature"]) && isset($_POST["humidity"]) && isset($_POST["gasValue"])) {

    $t = $_POST["temperature"];
    $h = $_POST["humidity"];
    $gas = $_POST["gasValue"];

    $sql = "INSERT INTO data_sensor (temperature, humidity, gas_value) VALUES (" . $t . ", " . $h . ", " . $gas . ")";

    if (mysqli_query($conn, $sql)) {
        echo "\nNew record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
