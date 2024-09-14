<?php 
// Menghubungkan ke database dengan file koneksi.php
include('koneksi.php');

// Membuat objek dari kelas journal_details untuk mendapatkan rincian jurnal
$isi_journals = new journal_details();
$rincian_journal = $isi_journals->TampilkanData(); // Mengambil data rincian jurnal

// Membuat objek dari kelas journal_details lagi untuk mendapatkan data jurnal mahasiswa
$db_journals = new journal_details();
$journals_mhs = $db_journals->TampilkanData(); // Mengambil data jurnal mahasiswa
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Journal Mahasiswa PNC</title>
    <style>
        /* Mengatur tampilan halaman */
        body {
            font-family: Arial, sans-serif; /* Mengatur jenis font untuk teks di halaman */
            margin: 20px; /* Menentukan jarak tepi halaman */
            background-color: #f8f9fa; /* Warna latar belakang halaman */
        }
        h1 {
            text-align: center; /* Mengatur posisi judul di tengah halaman */
            color: #343a40; /* Warna teks judul */
            margin-bottom: 20px; /* Jarak di bawah judul */
        }
        table {
            width: 100%; /* Lebar tabel penuh */
            border-collapse: collapse; /* Menghapus jarak antar border tabel */
            margin: 20px 0; /* Jarak tabel dari elemen lain */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Efek bayangan pada tabel */
        }
        table, th, td {
            border: 1px solid #dee2e6; /* Border tabel dan sel */
        }
        th, td {
            padding: 15px; /* Jarak antara teks dan border sel */
            text-align: center; /* Mengatur teks agar berada di tengah sel */
        }
        th {
            background-color: #ff69b4; /* Warna latar belakang header tabel */
            color: white; /* Warna teks header tabel */
            text-transform: uppercase; /* Membuat teks header tabel menjadi huruf kapital semua */
            font-size: 16px; /* Ukuran font header tabel */
        }
        /* Mengatur warna baris tabel */
        tr:nth-child(odd) {
            background-color: #ffffff; /* Warna baris ganjil tabel */
        }
        tr:nth-child(even) {
            background-color: #f1f8e9; /* Warna baris genap tabel */
        }
        /* Mengatur warna baris saat di-hover */
        tr:hover {
            background-color: #ffeb3b; /* Warna baris saat dihover */
        }
        /* Mengatur efek bayangan pada tabel */
        table {
            border-radius: 8px; /* Membuat sudut tabel melengkung */
            overflow: hidden; /* Menghindari overflow border-radius */
        }
        th, td {
            border-radius: 4px; /* Membuat sudut sel tabel melengkung */
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
    $no = 1; // Inisialisasi nomor urut
    // Mengulangi setiap baris data jurnal mahasiswa dan menampilkannya dalam tabel
    foreach($journals_mhs as $row) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut -->
            <td><?php echo htmlspecialchars($row['id']); ?></td> <!-- Menampilkan Id jurnal -->
            <td><?php echo htmlspecialchars($row['material']); ?></td> <!-- Menampilkan materi jurnal -->
            <td><?php echo htmlspecialchars($row['has_acc_student']); ?></td> <!-- Menampilkan status acc mahasiswa -->
            <td><?php echo htmlspecialchars($row['has_acc_lecturer']); ?></td> <!-- Menampilkan status acc pengajar -->
            <td><?php echo htmlspecialchars($row['attendence_list_detail_id']); ?></td> <!-- Menampilkan Id detail daftar hadir -->
            <td><?php echo htmlspecialchars($row['journal_id']); ?></td> <!-- Menampilkan Id jurnal -->
        </tr>
        <?php 
    }
    ?>
</table>

</body>
</html>
