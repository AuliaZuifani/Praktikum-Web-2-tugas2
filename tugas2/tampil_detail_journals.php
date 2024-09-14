<?php 
// Koneksi ke database lewat file koneksi.php
include('koneksi.php');

// Buat objek dari kelas journal_details untuk ambil data jurnal
$isi_journals = new journal_details();
// Ambil data jurnal dengan ID 4
$rincian_journal = $isi_journals->TampilkanData(4);  // Kita filter datanya pakai ID 4
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Journal</title>
    <style>
        /* Atur tampilan halaman */
        body {
            font-family: Arial, sans-serif; /* Pilih font untuk teks di halaman */
            margin: 20px; /* Jarak dari tepi halaman */
            background-color: #f5f5f5; /* Warna latar belakang halaman */
        }
        h1 {
            text-align: center; /* Judul di tengah-tengah halaman */
            color: #333; /* Warna teks judul */
            margin-bottom: 20px; /* Jarak bawah judul */
        }
        table {
            width: 100%; /* Tabel melebar penuh */
            border-collapse: collapse; /* Hapus jarak antar border tabel */
            margin: 20px 0; /* Jarak tabel dari elemen lain */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Kasih efek bayangan pada tabel */
            border-radius: 8px; /* Sudut tabel melengkung */
            overflow: hidden; /* Jangan sampai border-radius kebuang */
        }
        table, th, td {
            border: 1px solid #ddd; /* Border tabel dan sel */
        }
        th, td {
            padding: 12px; /* Jarak antara teks dan border sel */
            text-align: center; /* Teks di tengah-tengah sel */
        }
        th {
            background-color: #ff69b4; /* Warna header tabel pink */
            color: white; /* Warna teks header tabel */
            text-transform: uppercase; /* Ubah teks header jadi kapital semua */
            font-size: 14px; /* Ukuran font header tabel */
        }
        /* Warna baris tabel yang bergantian */
        tr:nth-child(odd) {
            background-color: #ffffff; /* Warna putih untuk baris ganjil */
        }
        tr:nth-child(even) {
            background-color: #c2c3c2; /* Warna abu-abu muda untuk baris genap */
        }
        /* Warna baris saat di-hover */
        tr:hover {
            background-color: #ffeb3b; /* Warna kuning terang saat baris di-hover */
        }
    </style>
</head>
<body>

<h1>Detail Journal Mahasiswa PNC</h1> <!-- Judul halaman -->

<table>
    <tr>
        <!-- Header tabel -->
        <th>No</th>
        <th>Id</th>
        <th>Material</th>
        <th>Has Acc Student</th>
        <th>Has Acc Lecturer</th>
        <th>Attendance List Detail Id</th>
        <th>Journal Id</th>
    </tr>
    <?php 
    $no = 1; // Mulai dari nomor urut 1
    // Loop untuk tampilkan setiap baris data jurnal
    foreach($rincian_journal as $row) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td> <!-- Tampilkan nomor urut baris -->
            <td><?php echo htmlspecialchars($row['id']); ?></td> <!-- Tampilkan ID jurnal -->
            <td><?php echo htmlspecialchars($row['material']); ?></td> <!-- Tampilkan materi jurnal -->
            <td><?php echo htmlspecialchars($row['has_acc_student']); ?></td> <!-- Status acc mahasiswa -->
            <td><?php echo htmlspecialchars($row['has_acc_lecturer']); ?></td> <!-- Status acc pengajar -->
            <td><?php echo htmlspecialchars($row['attendence_list_detail_id']); ?></td> <!-- ID detail daftar hadir -->
            <td><?php echo htmlspecialchars($row['journal_id']); ?></td> <!-- ID jurnal -->
        </tr>
        <?php 
    }
    ?>
</table>

</body>
</html>
