<?php
require_once '../vendor/autoload.php'; // Pastikan path sesuai dengan lokasi vendor

use phpseclib3\Net\SSH2;

header('Content-Type: application/json');

// Ambil data dari request
$data = json_decode(file_get_contents('php://input'), true);
$serialNumber = $data['serialNumber'] ?? null;
$deviceType = $data['deviceType'] ?? null;

if (!$serialNumber || !$deviceType) {
    echo json_encode(['status' => 'error', 'message' => 'Serial Number atau Device Type tidak boleh kosong.']);
    exit;
}

// Konfigurasi perangkat ZTE dan Huawei
$config = [
    'zte' => [
        'host' => '192.168.1.1', // IP perangkat ZTE
        'username' => 'admin',   // Username SSH ZTE
        'password' => 'admin123' // Password SSH ZTE
    ],
    'huawei' => [
        'host' => '192.168.1.2', // IP perangkat Huawei
        'username' => 'admin',   // Username SSH Huawei
        'password' => 'admin123' // Password SSH Huawei
    ]
];

// Pilih perangkat berdasarkan tipe
if (!isset($config[$deviceType])) {
    echo json_encode(['status' => 'error', 'message' => 'Tipe perangkat tidak valid.']);
    exit;
}

$deviceConfig = $config[$deviceType];

// Eksekusi command menggunakan SSH
$ssh = new SSH2($deviceConfig['host']);
if (!$ssh->login($deviceConfig['username'], $deviceConfig['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Login SSH ke perangkat gagal.']);
    exit;
}

// Command berdasarkan perangkat
$command = '';
if ($deviceType === 'zte') {
    $command = "show gpon onu by sn $serialNumber";
} elseif ($deviceType === 'huawei') {
    $command = "display ont info by-sn $serialNumber";
}

$output = $ssh->exec($command);

// Kembalikan hasil
if ($output) {
    echo json_encode(['status' => 'success', 'output' => $output]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Tidak ada output dari perangkat.']);
}
