<?php
include 'config/app.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header class="header-style">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">UNIVERSITAS XXX</a>
                <a class="navbar-brand" href="pages/auth/login.php">LOGIN</a>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <section>
                <h2>SELAMAT DATANG DI REPOSITORY UNIVERSITAS XXX</h2>
            </section>
            <section>
                <h2>CARI BUKU</h2>
                <form action="search.php" method="GET">
                    <input type="text" name="search" placeholder="Masukkan judul buku">
                    <button type="submit">Cari</button>
                </form>
            </section>
            <section>
                <h2>DAFTAR FAKULTAS</h2>
                <ul>
                    <li><a href="fakultas.php?kd_fakultas=FIK">Fakultas Ilmu Komputer</a></li>
                    <li><a href="fakultas.php?kd_fakultas=FEB">Fakultas Ekonomi dan Bisnis</a></li>
                    <li><a href="fakultas.php?kd_fakultas=FIP">Fakultas Ilmu Pendidikan</a></li>
                </ul>
            </section>
            <section>
                <h2>DAFTAR BUKU TERKINI</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>Penulis</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $data_buku_terkini = select("SELECT * FROM tb_dokumen WHERE kd_jurusan='TI' and kd_fakultas='FIK'");?>
                        <?php if (empty($data_buku_terkini)): ?>
                            <tr>
                                <td colspan="4">Data tidak ditemukan</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data_buku_terkini as $data_buku_t): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $data_buku_t['judul_dokumen'] ?></td>
                                    <td><?= $data_buku_t['author_dokumen'] ?></td>
                                    <!-- <td><?= date('d/m/Y | H:i:s', strtotime($data_buku_t['tanggal'])) ?></td> -->
                                    <td><a target='_blank' href="assets/dokumen/<?= $data_buku_t['file_dokumen'] ?>"><?= $data_buku_t['file_dokumen'] ?></a></td>
                                    <td><a href="detail?id=<?= $data_buku_t['kd_dokumen'] ?>">Detail</a></td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 UNIVERSITAS XXX</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>