<?php 
// Menghubungkan ke database dengan file koneksi.php
include('koneksi.php');

// Membuat objek dari kelas Journals untuk mendapatkan data jurnal
$spesifik_journals = new Journals();
$data_journals = $spesifik_journals->TampilkanData();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Journals</title>
    <style>
        /* Mengatur tampilan halaman */
        body {
            font-family: Arial, sans-serif; /* Mengatur jenis font */
            margin: 20px; /* Jarak tepi halaman */
            background-color: #f0f0f8; /* Warna latar belakang halaman */
        }
        h1 {
            text-align: center; /* Mengatur posisi judul ke tengah */
            color: #4A4A4A; /* Warna teks judul */
        }
        table {
            width: 100%; /* Lebar tabel penuh */
            border-collapse: collapse; /* Menghilangkan jarak antar border */
            margin: 20px 0; /* Jarak tabel dari elemen lain */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Bayangan tabel */
        }
        table, th, td {
            border: 1px solid #ddd; /* Border tabel */
        }
        th, td {
            padding: 12px; /* Jarak antara teks dan border sel */
            text-align: center; /* Mengatur teks agar berada di tengah */
        }
        th {
            background-color: #ff69b4; /* Warna background header tabel */
            color: white; /* Warna teks header tabel */
            text-transform: uppercase; /* Membuat teks header tabel menjadi huruf kapital semua */
        }
        /* Warna baris tabel yang berbeda */
        tr:nth-of-type(2) {
            background-color: #ffe4e1; /* Warna baris kedua tabel */
        }
        tr:nth-child(odd) {
            background-color: #f2f2f2; /* Warna baris ganjil tabel */
        }
        tr:nth-child(even) {
            background-color: #e0f7fa; /* Warna baris genap tabel */
        }
        /* Warna baris tabel saat di-hover */
        tr:hover {
            background-color: #ffe082; /* Warna baris saat dihover */
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
        <th>Attendance List Id</th>
        <th>Has Finished</th>
        <th>Has Acc Head Department</th>
        <th>Lecturer Id</th>
        <th>Course Id</th>
        <th>Student Class Id</th>
    </tr>
    <?php 
    $no = 1; // Inisialisasi nomor urut
    // Mengulangi setiap baris data jurnal dan menampilkannya dalam tabel
    foreach($data_journals as $row) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut -->
            <td><?php echo htmlspecialchars($row['Id']); ?></td> <!-- Menampilkan Id jurnal -->
            <td><?php echo htmlspecialchars($row['attendence_list_id']); ?></td> <!-- Menampilkan Attendance List Id -->
            <td><?php echo htmlspecialchars($row['has_finished']); ?></td> <!-- Menampilkan status apakah sudah selesai -->
            <td><?php echo htmlspecialchars($row['has_acc_head_departmenet']); ?></td> <!-- Menampilkan status acc kepala departemen -->
            <td><?php echo htmlspecialchars($row['lecturer_id']); ?></td> <!-- Menampilkan Id pengajar -->
            <td><?php echo htmlspecialchars($row['course_id']); ?></td> <!-- Menampilkan Id mata kuliah -->
            <td><?php echo htmlspecialchars($row['student_class_id']); ?></td> <!-- Menampilkan Id kelas mahasiswa -->
        </tr>
        <?php 
    }
    ?>
</table>
    <!-- Tombol untuk kembali ke menu utama -->
<div class="button-container">
    <a href="menu_utama.php">Kembali ke Menu Utama</a> <!-- Ganti "menu_utama.php" dengan file menu utama Anda -->
</div>
</body>
</html>
