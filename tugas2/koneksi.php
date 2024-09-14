<?php 
// Kelas ini buat koneksi ke database
class database {
    private $host = "localhost"; // Alamat server database
    private $username = "root"; // Nama pengguna database
    private $password = ""; // Password untuk database
    private $database = "tugas2"; // Nama database
    public $link; // Simpan koneksi ke database
    public $error; // Simpan pesan error kalau koneksi gagal

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

    // Metode ini bisa diubah di kelas lain yang turunannya
    public function TampilkanData($id = null) {
        return []; // Kembalikan array kosong karena ini dasar
    }
}

// Kelas ini khusus untuk data jurnal
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

// Kelas ini untuk data jurnal yang lebih detail
class journal extends database {
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
?>
