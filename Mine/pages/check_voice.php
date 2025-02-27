<?php
// Konfigurasi koneksi database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'voicedatek';

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil dan sanitasi data dari form
$voice = isset($_POST['telp']) ? $_POST['telp'] : [];

// Cek apakah telp dikirim dalam bentuk array
if (is_array($voice) && count($voice) > 0) {
    // Buat tanda tanya sebanyak jumlah voice
    $placeholders = implode(',', array_fill(0, count($voice), '?'));
    
    // Buat query untuk cek apakah nomor sudah ada di database
    $checkQuery = "SELECT voice FROM voice WHERE voice IN ($placeholders)";
    $stmt = $conn->prepare($checkQuery);

    // Siapkan tipe data untuk bind_param
    $types = str_repeat('s', count($voice));
    $stmt->bind_param($types, ...$voice);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Array untuk menyimpan nomor yang sudah terdaftar
    $existingNumbers = [];
    while ($row = $result->fetch_assoc()) {
        $existingNumbers[] = $row['voice'];
    }

    if (count($existingNumbers) > 0) {
        // Mengirimkan nomor yang sudah terdaftar
        echo json_encode([
            "status" => "exists",
            "registered" => $existingNumbers
        ]);
    } else {
        echo json_encode([
            "status" => "available"
        ]);
    }

    $stmt->close();
}

$conn->close();
?>
    
