<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'mahasiswa');

$nim = $_REQUEST['nim'];
$nama = $_REQUEST['nama'];
$periode = $_REQUEST['periode'];
$kelas = $_REQUEST['kelas'];
$prodi = $_REQUEST['prodi'];

$update = mysqli_query($conn, "UPDATE 
                                    mahasiswa 
                                SET
                                    nama='$nama',
                                    periode='$periode',
                                    kelas='$kelas',
                                    prodi='$prodi'
                                WHERE 
                                    nim='$nim'");

if ($update) {
    $_SESSION['flash_message'] = 'Data mahasiswa berhasil diubah.'; 
    header("Location: data.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
unset($_SESSION['flash_message']);