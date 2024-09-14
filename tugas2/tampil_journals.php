<?php 
// Koneksi ke database lewat file koneksi.php
include('koneksi.php');

// Buat objek dari kelas journals untuk ambil data
$spesifik_journals = new journals();
// Ambil data jurnal dengan ID 3
$data_journals = $spesifik_journals->TampilkanData(3);  // Kita filter datanya pakai ID 3
?>

<!DOCTYPE html>
<html>
<head>
    <title>Journals</title>
    <style>
        /* Atur tampilan halaman */
        body {
            font-family: Arial, sans-serif; /* Pilih font untuk teks */
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Kasih bayangan di tabel */
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
            background-color: #afeeee; /* Warna biru muda untuk baris genap */
        }
        /* Warna baris saat di-hover */
        tr:hover {
            background-color: #ffeb3b; /* Warna kuning terang saat baris di-hover */
        }
    </style>
</head>
<body>

<h1>Acc Journals</h1> <!-- Judul halaman -->

<table>
    <tr>
        <!-- Header tabel -->
        <th>No</th>
        <th>Id</th>
        <th>Attendence List Id</th>
        <th>Has Finished</th>
        <th>Has Acc Head Department</th>
        <th>Lecturer Id</th>
        <th>Course Id</th>
        <th>Student Class Id</th>
    </tr>
    <?php 
    $no = 1; // Mulai dari nomor urut 1
    // Loop untuk tampilkan setiap baris data jurnal
    foreach($data_journals as $row) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td> <!-- Tampilkan nomor urut baris -->
            <td><?php echo htmlspecialchars($row['Id']); ?></td> <!-- Tampilkan ID jurnal -->
            <td><?php echo htmlspecialchars($row['attendence_list_id']); ?></td> <!-- Tampilkan ID daftar hadir -->
            <td><?php echo htmlspecialchars($row['has_finished']); ?></td> <!-- Status selesai -->
            <td><?php echo htmlspecialchars($row['has_acc_head_departmenet']); ?></td> <!-- Status acc kepala departemen -->
            <td><?php echo htmlspecialchars($row['lecturer_id']); ?></td> <!-- ID pengajar -->
            <td><?php echo htmlspecialchars($row['course_id']); ?></td> <!-- ID mata kuliah -->
            <td><?php echo htmlspecialchars($row['student_class_id']); ?></td> <!-- ID kelas mahasiswa -->
        </tr>
        <?php 
    }
    ?>
</table>

</body>
</html>
