<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "voicedatek"; // Ganti dengan nama database kamu

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk menghitung total voice
$sql = "SELECT COUNT(*) as total_voice FROM voice_detail";
$result = $conn->query($sql);

$total_voice = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_voice = $row['total_voice'];
}

// Mengembalikan data dalam format JSON
echo json_encode(array("total_voice" => $total_voice));
?>
