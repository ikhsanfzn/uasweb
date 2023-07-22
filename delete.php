<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'mahasiswa');

$nim = $_REQUEST['nim'];

$delete = mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim='$nim'");

if ($delete) {
    $_SESSION['message'] = 'Data mahasiswa berhasil dihapus.'; 
    header("Location: data.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
