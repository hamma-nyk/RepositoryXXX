<?php
    $get_user = select("SELECT * FROM tb_user");
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User Management</h1>
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php if (empty($get_user)): ?>
                    <tr>
                        <td colspan="4">Data tidak ditemukan</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($get_user as $user): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <!-- <td><a target='_blank' href="assets/dokumen/<?= $data_buku_t['file_dokumen'] ?>"><?= $data_buku_t['file_dokumen'] ?></a></td> -->
                            <!-- <td><a href="detail?id=<?= $data_buku_t['kd_dokumen'] ?>">Detail</a></td> -->
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>