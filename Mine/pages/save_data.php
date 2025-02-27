
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
$telpArray = isset($_POST['telp']) ? $_POST['telp'] : [];
$passArray = isset($_POST['passtelp']) ? $_POST['passtelp'] : [];
$serial_number = isset($_POST['sn']) ? trim($_POST['sn']) : '';

// Cek apakah array telp dan password memiliki jumlah yang sama
if (count($telpArray) !== count($passArray)) {
    echo "error: Jumlah No Telephone dan Password tidak sesuai!";
    exit;
}

// Cek apakah serial_number sudah ada
$checkQuery = "SELECT * FROM voice_main WHERE serial_number = ?";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->bind_param("s", $serial_number);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    echo "error: Serial Number sudah terdaftar!";
    exit;
}

// Simpan ke tabel voice_main dulu
$mainStmt = $conn->prepare("INSERT INTO voice_main (serial_number) VALUES (?)");
$mainStmt->bind_param("s", $serial_number);
$mainStmt->execute();
$voice_main_id = $mainStmt->insert_id; // Ambil ID dari voice_main yang baru disimpan

// Simpan ke tabel voice_detail untuk setiap nomor dan password
$detailStmt = $conn->prepare("INSERT INTO voice_detail (voice_main_id, voice, pass_voice) VALUES (?, ?, ?)");
foreach ($telpArray as $index => $telp) {
    $telp = trim($telp);
    $pass = trim($passArray[$index]);

    // Cek apakah data kosong
    if (empty($telp) || empty($pass) || empty($serial_number)) {
        echo "error: Field tidak boleh kosong!";
        exit;
    }

    // Cek apakah No Telephone sudah ada di database
    $checkQuery = "SELECT * FROM voice_detail WHERE voice = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $telp);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "No Telephone $telp sudah terdaftar!";
        exit;
    }

    // Simpan ke tabel voice_detail
    $detailStmt->bind_param("iss", $voice_main_id, $telp, $pass);
    $detailStmt->execute();
}

$mainStmt->close();
$detailStmt->close();
$conn->close();
echo "success";
?>
