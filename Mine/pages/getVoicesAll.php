<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$database = "voicedatek";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination settings
$limit = 20; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query utama untuk mengambil data dengan pagination
$sql = "
    SELECT vm.id, vm.serial_number, vm.created_at, vd.voice, vd.pass_voice 
    FROM voice_main AS vm
    JOIN voice_detail AS vd ON vm.id = vd.voice_main_id
    LIMIT $limit OFFSET $offset
";

$result = $conn->query($sql);

if (!$result) {
    error_log("Query Error: " . $conn->error);
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    exit;
}

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Query untuk menghitung total data
$totalQuery = "SELECT COUNT(*) AS total FROM voice_main AS vm JOIN voice_detail AS vd ON vm.id = vd.voice_main_id";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalData = $totalRow['total'];
$totalPages = ceil($totalData / $limit);

// Mengembalikan data dalam format JSON
echo json_encode([
    "data" => $data,
    "totalPages" => $totalPages
]);

// Menutup koneksi
$conn->close();
?>
