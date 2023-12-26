<?php
session_start();
if (isset($_SESSION['data'])) {
    unset($_SESSION['data']);
    $pesan = $_SESSION['pesan'] = 'Logout Berhasil!!';
    return header('Location:login.php');
}
?>