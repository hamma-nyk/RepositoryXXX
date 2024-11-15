<?php
include '../../../config/app.php';
if (isset($_POST['proses'])) {
    $kd_fakultas = $_POST['kd_fakultas'];
    $kd_jurusan = $_POST['kd_jurusan'];
    $kd_dokumen = $_POST['kd_dokumen'];
    $judul_dokumen = $_POST['judul'];
    $author_dokumen = $_POST['penulis'];

    // Dokumen
    $file_dokumen = $_FILES['file']['name'];
    $allowed = array('txt', 'pdf');
    $x = explode('.', $_FILES['file']['name']);
    $ekstensi = strtolower(end($x));
    move_uploaded_file($_FILES['file']['tmp_name'], '../../../assets/dokumen/' . $file_dokumen);
    rename('../../../assets/dokumen/' . $file_dokumen, '../../../assets/dokumen/' . $kd_jurusan . '_' . str_replace(' ', '_', $judul_dokumen) . '.' . $ekstensi);
    $nama_file = $kd_jurusan . '_' . str_replace(' ', '_', $judul_dokumen) . '.' . $ekstensi;
    if (in_array($ekstensi, $allowed) == true) {
        $create = create("INSERT INTO tb_dokumen (kd_fakultas, kd_jurusan, kd_dokumen, judul_dokumen, file_dokumen, author_dokumen) VALUES ('$kd_fakultas', '$kd_jurusan', '$kd_dokumen','$judul_dokumen', '$nama_file', '$author_dokumen')");
        if ($create === TRUE) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href='../dashboard?views=" . strtolower($kd_fakultas) . "';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }
    }
}
