<?php
$get_nodok = select("SELECT kd_dokumen FROM tb_dokumen WHERE kd_fakultas='FIK'");
$date_dok = [];
$date = date('dmY');

foreach ($get_nodok as $nodok) {
    $ex = substr($nodok['kd_dokumen'], 4, 8);
    $push = array_push($date_dok, $ex);
}

if (in_array($date, $date_dok) == true) {
    $get_max = select("SELECT kd_dokumen FROM tb_dokumen WHERE kd_fakultas='FIK' AND kd_dokumen LIKE '%$date%' ORDER BY kd_dokumen DESC LIMIT 1");
    $max = substr($get_max[0]['kd_dokumen'], 12);
    $kode_dok = "FIK_" . $date . str_pad($max + 1, 3, '0', STR_PAD_LEFT);
} else {
    $kode_dok = "FIK_" . $date . "001";
}

?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dokumen Fakultas Ilmu Komputer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
            + Tambah
        </button>
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Dokumen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="lib/lib_create.php" method="post" enctype="multipart/form-data">
                            <input type="text" name="kd_fakultas" hidden readonly value="FIK">
                            <div class="mb-3">
                                <label class="form-label">Kode Dokumen</label>
                                <input type="text" class="form-control" id="kd_dokumen" name='kd_dokumen' placeholder=<?= $kode_dok ?> value=<?= $kode_dok ?> readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Judul Dokumen</label>
                                <input type="text" class="form-control" id="judul" name='judul'>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="penulis" name='penulis'>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jurusan</label>
                                <select name="kd_jurusan" class="form-select" aria-label="Default select example">
                                    <option value="IT">Pilih Jurusan</option>
                                    <?php
                                    $get_jurusan = select("SELECT * FROM tb_jurusan");
                                    foreach ($get_jurusan as $jur) {
                                        echo "<option value='" . $jur['kd_jurusan'] . "'>" . $jur['nama_jurusan'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">File</label>
                                <input type="file" class="form-control" id="file" name='file'>
                            </div>
                            <div class="float-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name='proses' value="Upload" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Buku</th>
                    <th>Penulis</th>
                    <th>Jurusan</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php $get_d_fik = select("SELECT * FROM tb_dokumen WHERE kd_fakultas='FIK'"); ?>
                <?php if (empty($get_d_fik)): ?>
                    <tr>
                        <td colspan="4">Data tidak ditemukan</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($get_d_fik as $dok): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $dok['judul_dokumen'] ?></td>
                            <td><?= $dok['author_dokumen'] ?></td>
                            <td><?= $dok['kd_jurusan'] ?></td>
                            <!-- <td><?= date('d/m/Y | H:i:s', strtotime($dok['tanggal'])) ?></td> -->
                            <td><a target='_blank' href="../../assets/dokumen/<?= $dok['file_dokumen'] ?>"><?= $dok['file_dokumen'] ?></a></td>
                            <td>
                                <a href="edit?id=<?= $dok['kd_dokumen'] ?>">Edit</a>
                                <a href="lib/lib_delete?dok=<?= $dok['kd_dokumen'] ?>&fk=<?= $dok['kd_fakultas'] ?>">Delete</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>