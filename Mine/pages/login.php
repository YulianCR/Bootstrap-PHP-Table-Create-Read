<?php
// Mulai session
session_start();

// Memanggil koneksi database
include 'config.php';

// Cek apakah form telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Cek email di database
    $query = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($koneksi, $query);

    

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    
        // Verifikasi password menggunakan password_verify()
        if (password_verify($password, $data['password'])) 
        // Set session
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $data['email']; // Pastikan disini
        $_SESSION['LAST_ACTIVITY'] = time(); 
    
        session_write_close();
        
        // Redirect ke dashboard
        header('Location: dashboard.php');
        exit();
    }
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Verifikasi password
        if ($password === $row['password']) {
            // Jika cocok, set session dan redirect ke dashboard
            $_SESSION['logged_in'] = true;
            header("Location: ../pages/dashboard.php");
        exit;

        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }
}
?>
