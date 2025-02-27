<?php
session_start();
$timeout_duration = 1800; // 30 menit dalam detik

// Cek status login
if (!isset($_SESSION['username'])) {
    header('Location: sign-in.html');
    exit();
}

// Cek timeout session
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header('Location: sign-in.html');
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
