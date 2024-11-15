<?php
include '../../../config/app.php';
if (isset($_GET['dok'])) {
    $dok = $_GET['dok'];
    $fk = $_GET['fk'];
    // $sql = "DELETE FROM tb_dokumen WHERE kd_dokumen='$dok'";
    // $delete = mysqli_query($db, $sql);
    $delete = delete("DELETE FROM tb_dokumen WHERE kd_dokumen='$dok'");
    if ($delete) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='../dashboard?views=" . strtolower($fk) . "';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus'); window.location.href='../dashboard?views=" . strtolower($fk) . "';</script>";
    }
}
