<?php
$id = $_GET['id'];

require_once('koneksi.php');

$sql = "SELECT * FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #1f3864; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        label.pilihan { display: inline; font-weight: normal; margin-right: 16px; }
        input[type="text"], select, textarea { width: 320px; padding: 6px; }
        button { margin-top: 16px; padding: 8px 20px; }
    </style>
</head>
<body>
    <h1>Edit Data Dirimu</h1>

    <form action="proses_edit.php" method="post">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <label for="na">Nomor Aggota:</label>
        <input type="number" id="na" name="na" onclick="this.select()" value="<?= htmlspecialchars($data['no_anggota']); ?>"><br>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" onclick="this.select()" value="<?= htmlspecialchars($data['nama_lengkap']); ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Masukkan Email '@'" value="<?= htmlspecialchars($data['email']); ?>"><br>

        <label for="noHP">Nomor Hp:</label>
        <input type="number" id="noHP" name="noHP" placeholder="Masukkan Nomor HP" value="<?= htmlspecialchars($data['no_hp']); ?>"><br>

        <label for="ja">Jenis Anggota</label>
        <select id="ja" name="ja">
            <option value="">==Pilih Jenis Anggota==</option>
            <option value="Mahasiswa" <?= $data['jenis_anggota'] == 'Mahasiswa' ? 'selected' : ''; ?>>Mahasiswa</option>
            <option value="Dosen" <?= $data['jenis_anggota'] == 'Dosen' ? 'selected' : ''; ?>>Dosen</option>
            <option value="Tenaga Kependidikan" <?= $data['jenis_anggota'] == 'Tenaga Kependidikan' ? 'selected' : ''; ?>>Tenaga Kependidikan</option>
        </select><br>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat"><?= htmlspecialchars($data['alamat']); ?> </textarea><br>

        <button type="submit">Kirim</button>
    </form><br>

    <a href="data.php">Lihat Data Anggota</a>
</body>
</html>