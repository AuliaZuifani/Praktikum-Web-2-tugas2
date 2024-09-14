# Tugas 2 OOP dan MYSQL
## File Koneksi
Pada File ini berisi kode yang digunakan untuk membuat koneksi ke database MySQL menggunakan konsep OOP (Object-Oriented Programming) dalam PHP. Kode ini memiliki beberapa kelas yang digunakan untuk mengelola data jurnal, rincian jurnal, dan jurnal detail, yang semuanya terhubung ke database MySQL.
Berikut penjelasan dari tiap bagian:
#### 1. Kelas database
- Class Databasse ini dibuat dengan tujuan untuk mengoneksikan ke database yang sebelumnya sudah dibuat pada MYSQL.
~~~ php
$host: Alamat server database, biasanya "localhost" kalau dijalankan di server lokal.
$username: Nama pengguna untuk login ke database (di sini menggunakan "root").
$password: Password untuk pengguna database (kosong dalam kasus ini).
$database: Nama database yang akan digunakan ("tugas2").
$link: Menyimpan hasil koneksi ke database.
$error: Menyimpan pesan error jika koneksi gagal.
~~~
- Setelah itu membuat metode construct, fungsi Ini otomatis dijalankan saat objek kelas ini dibuat, mencoba membuat koneksi ke database menggunakan mysqli_connect().
Kalau koneksi gagal, pesan error disimpan di $error dan koneksi dihentikan.
~~~ php
// Fungsi ini otomatis dijalankan saat objek dibuat
    public function __construct() {
        // Coba buat koneksi ke database
        $this->link = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (!$this->link) {
            // Kalau gagal, simpan pesan error
            $this->error = "Koneksi ke Database Gagal: " . mysqli_connect_error();
            return false; // Berhenti kalau koneksi gagal
        }
    }
~~~
- pembuatan metode tampilkanData() untuk menampilkan data yang dapat diubah di kelas turunanya.
~~~ php
  // Metode ini bisa diubah di kelas lain yang turunannya
    public function TampilkanData($id = null) {
        return []; // Kembalikan array kosong karena ini dasar
    }
}
~~~

#### 2. Kelas journals
kelas journal ini merupakan kelas turunan dari kelas database yang berarti kelas ini, mewarisi seluruh atribut dan metode yang ada di class database yang sudah terhubung dengan MYSQL.
~~~ php
/ Kelas turunan dari class database untuk data jurnal
class journals extends database { 
    // Ubah metode TampilkanData untuk jurnal
    public function TampilkanData($id = null) {
        // Query untuk ambil semua data dari tabel jurnal
        $query = "SELECT * FROM journals";
        if ($id) {
            // Kalau ada ID, filter data berdasarkan ID
            $query .= " WHERE id = $id";
        }

        // Jalankan query dan simpan hasilnya
        $result = mysqli_query($this->link, $query);
        if (!$result) {
            // Kalau ada masalah dengan query, tampilkan pesan error
            die("Query Error: " . mysqli_error($this->link));
        }

        $array = array(); // Array buat simpan data hasil query
        while ($row = mysqli_fetch_array($result)) {
            // Masukkan setiap baris data ke array
            $array[] = $row;
        }
        return $array; // Kembalikan array yang berisi data jurnal
    }
}
    
~~~
penjelasan :
~~~ php
Fungsi TampilkanData($id = null):
~~~
Digunakan untuk menjalankan query SQL untuk mengambil data dari tabel journals.
Kalau ada parameter $id, query akan difilter berdasarkan id. Hasil query dimasukkan ke dalam array, dan array ini dikembalikan untuk menampilkan data.
#### 3. Kelas journal_details
kelas journal_details ini merupakan kelas turunan dari kelas database yang berarti kelas ini, mewarisi seluruh atribut dan metode yang ada di class database yang sudah terhubung dengan MYSQL.
~~~ php
// Kelas ini khusus buat rincian jurnal
class journal_details extends database {
    // Ubah metode TampilkanData untuk rincian jurnal
    public function TampilkanData($id = null) {
        // Query untuk ambil semua data dari tabel rincian jurnal
        $query = "SELECT * FROM journal_details";
        if ($id) {
            // Kalau ada ID, filter data berdasarkan ID
            $query .= " WHERE id = $id";
        }

        // Jalankan query dan simpan hasilnya
        $result = mysqli_query($this->link, $query);
        if (!$result) {
            // Kalau ada masalah dengan query, tampilkan pesan error
            die("Query Error: " . mysqli_error($this->link));
        }

        $array = array(); // Array buat simpan data hasil query
        while ($row = mysqli_fetch_array($result)) {
            // Masukkan setiap baris data ke array
            $array[] = $row;
        }
        return $array; // Kembalikan array yang berisi rincian jurnal
    }
}
~~~
Mirip dengan fungsi di kelas journals, tetapi mengambil data dari tabel journal_details.
Hasilnya juga disimpan dalam array dan dikembalikan.
#### 4. Kelas perinci
Class Perinci ini adalah turunan dari kelas database, hanya saja class perinci ini lebih kompleks dari pada 2 class turunan sebelumnya.
~~~ php
class perinci extends database {
    // Ubah metode TampilkanData untuk jurnal detail
    public function TampilkanData($id = null) {
        // Query untuk ambil data jurnal beserta nama rincian jurnal terkait
        $query = "SELECT m.id, m.material, sp.journal_details_name 
                  FROM journal_details m
                  JOIN journal_details sp ON m.journal_details_id = sp.id";
        if ($id) {
            // Kalau ada ID, filter data berdasarkan ID
            $query .= " WHERE m.id = $id";
        }

        // Jalankan query dan simpan hasilnya
        $result = mysqli_query($this->link, $query);
        if (!$result) {
            // Kalau ada masalah dengan query, tampilkan pesan error
            die("Query Error: " . mysqli_error($this->link));
        }

        $array = array(); // Array buat simpan data hasil query
        while ($row = mysqli_fetch_array($result)) {
            // Masukkan setiap baris data ke array
            $array[] = $row;
        }
        return $array; // Kembalikan array yang berisi data jurnal detail
    }
}
~~~
Penjelasan :
~~~ php
Fungsi TampilkanData($id = null):
~~~
Query ini lebih kompleks karena melibatkan JOIN antara tabel journal_details dan dirinya sendiri untuk mengambil data jurnal dan rincian jurnal nya.
Jika ada parameter $id, query akan difilter berdasarkan id, dan hasilnya dikembalikan dalam bentuk array.

#### Kesimpulan:
Koneksi ini dibuat untuk memudahkan akses data dari beberapa tabel di database secara modular dan terstruktur menggunakan OOP. Dengan membagi fungsi ke dalam beberapa kelas, kode menjadi lebih mudah di-maintain, dan perubahan atau penambahan fungsi dapat dilakukan tanpa harus mengulang penulisan koneksi database.
Secara keseluruhan, setiap kelas yang dibuat (misalnya journals, journal_details, journal) menggunakan metode koneksi yang sama dari kelas induk database, sehingga ketika koneksi diinisiasi, setiap kelas bisa memanfaatkan koneksi tersebut tanpa harus membuatnya ulang.
#### Kode Program :




## File Journals
File merupakan file dari class turunan journals yang saya buat dengan tujuan untuk menampilkan data dari tabel journals yang ada di MYSQL yang sudah terkoneksi pada file koneksi sebelumnya.
#### 1. Pembuatan koneksi ke database
~~~ php
// Menghubungkan ke database dengan file koneksi.php yang sudah dibuat tadi
include('koneksi.php');
~~~
#### 2. Memanggil data dari database yang sudah terkoneksi dengan file koneksi 
proses ini untuk membuat objek dari kelas Journals dan menggunakan metode TampilkanData() untuk mendapatkan semua data jurnal dari database.
~~~ php
// Membuat objek dari kelas Journals untuk mendapatkan data jurnal
$spesifik_journals = new Journals();
$data_journals = $spesifik_journals->TampilkanData();
~~~
penjelasan :
Kelas Journals sudah ada di file koneksi.php, kelas ini terhubung ke database dan berisi metode TampilkanData() yang menjalankan query SQL untuk mengambil data dari tabel journals.
#### 3. Menampilkan data di tabel
~~~ php
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
~~~
penjelasan :
Proses ini untuk menampilkan data dalam bentuk tabel sesuai dengan isi database pada mysql.
#### 4. Button untuk kembali ke menu utama
~~~ php
<div class="button-container">
    <a href="menu_utama.php">Kembali ke Menu Utama</a>
</div>
~~~
#### kesimpulan :
File ini dibuat dengan fungsi untuk
- Mengambil data dari tabel journals dalam database MySQL.
- Menampilkan data tersebut dalam bentuk tabel HTML di browser.
- Menyediakan tombol yang mengarah kembali ke halaman menu utama.
### Kode Program :

## File Journals_detail
File merupakan file dari class turunan journals_detail yang saya buat dengan tujuan untuk menampilkan data dari tabel journals_detail yang ada di MYSQL yang sudah terkoneksi pada file koneksi sebelumnya.
#### 1. Pembuatan koneksi ke database
~~~ php
// Menghubungkan ke database dengan file koneksi.php yang sudah dibuat tadi
include('koneksi.php');
~~~
#### 2. Memanggil data dari database yang sudah terkoneksi dengan file koneksi 
proses ini untuk membuat objek dari kelas Journals_detail dan menggunakan metode TampilkanData() untuk mendapatkan semua data journals_detail dari database.
~~~ php
// Membuat objek dari kelas journal_details untuk mendapatkan rincian jurnal
$isi_journals = new journal_details();
$rincian_journal = $isi_journals->TampilkanData(); // Mengambil data rincian jurnal
// Membuat objek dari kelas journal_details lagi untuk mendapatkan data jurnal mahasiswa
$db_journals = new journal_details();
$journals_mhs = $db_journals->TampilkanData(); // Mengambil data jurnal mahasiswa
~~~
penjelasan :
Kelas Journals_detail sudah ada di file koneksi.php, kelas ini terhubung ke database dan berisi metode TampilkanData() yang menjalankan query SQL untuk mengambil data dari tabel journals_detail.
#### 3. Menampilkan data di tabel
~~~ php
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
~~~
penjelasan :
Proses ini untuk menampilkan data dalam bentuk tabel sesuai dengan isi database pada mysql.
#### 4. Button untuk kembali ke menu utama
~~~ php
<div class="button-container">
    <a href="menu_utama.php">Kembali ke Menu Utama</a>
</div>
~~~
#### kesimpulan :
File ini dibuat dengan fungsi untuk
- Mengambil data dari tabel journals_detail dalam database MySQL.
- Menampilkan data tersebut dalam bentuk tabel HTML di browser.
- Menyediakan tombol yang mengarah kembali ke halaman menu utama.
### Kode Program :


## File Tampil Journals (Polymorphism)
#### Proses Polymorphism Journals
#### 1. proses ini adalah proses polymorphism untuk menampilkan salah satu data dari tabel journals
~~~ php
<?php 
// Koneksi ke database lewat file koneksi.php
include('koneksi.php');

// Buat objek dari kelas journals untuk ambil data
$spesifik_journals = new journals();
// Ambil data jurnal dengan ID 3
$data_journals = $spesifik_journals->TampilkanData(3);  // Kita filter datanya pakai ID 3
?>
~~~
#### 2. jika sudah maka kita akan menampilkan data nya dengan menggunakan pemanggilan table journals di database
~~~ php
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
~~~
#### 3. pembuatan button ke menu utama
~~~ php
<div class="button-container">
    <a href="menu_utama.php">Kembali ke Menu Utama</a>
</div>
~~~
#### kesimpulan :
Proses polymorhphism ini digunakan untuk menampilkan salah satu data yang terdapat pada table journals yang ada pada databases.
#### Kode Program :





## File Tampil Journals_detail (polymorphism)
#### proses polymorphism journals_detail
#### 1. proses ini adalah proses polymorphism untuk menampilkan salah satu data dari tabel journals.
~~~ php
<?php 
// Koneksi ke database lewat file koneksi.php
include('koneksi.php');

// Buat objek dari kelas journal_details untuk ambil data jurnal
$isi_journals = new journal_details();
// Ambil data jurnal dengan ID 4
$rincian_journal = $isi_journals->TampilkanData(4);  // Kita filter datanya pakai ID 4
?>
~~~
#### 2. jika sudah maka kita akan menampilkan data nya dengan menggunakan pemanggilan table journals di database
~~~ php
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
~~~
#### 3. pembuatan button ke menu utama
~~~ php
<div class="button-container">
    <a href="menu_utama.php">Kembali ke Menu Utama</a>
</div>
~~~
#### kesimpulan :
Proses polymorhphism ini digunakan untuk menampilkan salah satu data yang terdapat pada table journals yang ada pada databases.
#### Kode Program :



