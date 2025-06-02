<?php
session_start();
if (
    !isset($_SESSION['status']) || 
    ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'petugas')
) {
    header('Location: ../403.php');
    exit;
}
?>