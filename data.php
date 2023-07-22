<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'mahasiswa');

$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Data Mahasiswa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Data</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <!-- Tambahkan link-menu admin lainnya di sini -->
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <!-- Link Logout -->
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <div class="container">
        <h1 class="mt-3" style="text-align: center;">Daftar Mahasiswa</h1>
        <?php 
        if (isset($_SESSION['message']) && $_SESSION['waktu'] < time()) {
            unset($_SESSION['message']);
            unset($_SESSION['waktu']);
        }
        
        
        if (isset($_SESSION['message'])) { ?>
            <div class="alert alert-success" role="alert"><?= $_SESSION['message']; ?></div>
        <?php } ?>
        <div class="text-end">
            <a href="insert.php" class="btn btn-primary">Tambah Data</a>
        </div>
        <table class="table table-bordered table-striped" style="margin-top: 12px;">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Periode</th>
                    <th>Kelas</th>
                    <th>Program Studi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                    if ($result->num_rows > 0) {
                        $i = 1; 
                        while ($fetch_assoc = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td>
                                    <?php if($fetch_assoc['foto'] == null) { ?>
                                        <img src="foto/avatar.png" alt="" class="img-thumbnail" width="50">
                                    <?php } else { ?>
                                        <img src="foto/<?= $fetch_assoc['foto']; ?>" alt="" class="img-thumbnail" width="50">
                                    <?php } ?>
                                </td>
                                <td><?= $fetch_assoc['nim']; ?></td>
                                <td><?= $fetch_assoc['nama']; ?></td>
                                <td><?= $fetch_assoc['periode']; ?></td>
                                <td><?= $fetch_assoc['kelas']; ?></td>
                                <td><?= $fetch_assoc['prodi']; ?></td>
                                <td>
                                    <a href="edit.php?nim=<?= $fetch_assoc['nim']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="delete.php?nim=<?= $fetch_assoc['nim']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                <?php   } 
                    } else { ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">Tidak ada data</td>
                        </tr>
                <?php 
                    } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php

session_destroy();

?>