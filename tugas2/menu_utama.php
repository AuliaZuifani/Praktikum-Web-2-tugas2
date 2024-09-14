<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Journals</title>

    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Styling untuk Navbar */
        .navbar {
            background-color: #ff69b4; /* Navbar jadi pink biar catchy */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Jarak antara logo dan menu biar enak dilihat */
            padding: 10px 20px;
        }

        .navbar ul {
            list-style-type: none; /* Nggak ada bullet point di menu */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* Menu di tengah secara horizontal */
            align-items: center;
        }

        .navbar ul li {
            margin: 0 15px; /* Jarak antar item menu */
        }

        .navbar ul li a {
            display: block;
            color: white; /* Warna teks link di navbar */
            text-align: center;
            padding: 14px 20px;
            text-decoration: none; /* Hilangkan garis bawah di link */
            font-size: 18px;
            border-radius: 5px; /* Sudut melengkung biar lebih keren */
            transition: background-color 0.3s; /* Efek transisi pas hover */
        }

        .navbar ul li a:hover {
            background-color: #ff85c2; /* Warna pink lebih gelap pas hover */
        }

        .navbar .logo-container {
            display: flex;
            align-items: center;
        }

        .navbar .logo-text {
            font-size: 24px;
            color: white; /* Warna teks logo biar kontras dengan background */
            margin-left: 10px;
        }

        .navbar img {
            height: 40px; /* Tinggi gambar logo */
            width: auto;
        }

        /* Styling untuk Navbar di layar kecil */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar ul {
                flex-direction: column;
                align-items: flex-start;
                background-color: #ff69b4; /* Background navbar di layar kecil */
                width: 100%;
                display: none;
            }

            .navbar ul.show {
                display: flex; /* Tampilkan menu kalau toggle diaktifkan */
            }

            .navbar .menu-toggle {
                display: block;
                cursor: pointer;
                color: white;
                padding: 14px 20px;
                font-size: 24px;
                margin-top: 10px;
            }
        }

        .menu-toggle {
            display: none; /* Sembunyikan toggle menu di layar besar */
        }

        /* Styling untuk konten utama */
        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 80vh; /* Biar konten tetap di tengah layar */
            text-align: center; /* Pusatkan teks */
        }

        /* Styling untuk heading dan paragraf di konten */
        .content h1 {
            font-family: 'Playfair Display', serif; /* Font elegan untuk heading */
            font-size: 48px;
            margin-bottom: 10px;
            color: #2c2c2c; /* Warna abu-abu gelap biar kontras dengan pink */
        }

        .content p {
            font-family: 'Poppins', sans-serif; /* Font modern untuk paragraf */
            font-size: 20px;
            max-width: 600px;
            line-height: 1.6;
            color: #333; /* Warna abu-abu gelap buat paragraf biar enak dibaca */
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <!-- Logo dan Teks -->
    <div class="logo-container">
        <div class="logo-text">Menu Journals</div>
    </div>

    <!-- Ikon Toggle Menu untuk Mobile -->
    <span class="menu-toggle">&#9776;</span>

    <!-- Link Menu Navbar -->
    <ul id="nav-links">
        <li><a href="journals.php">Acc Journals</a></li>
        <li><a href="journals_detail.php">Journal Detail</a></li>
        <li><a href="tampil_detail_journals.php">Tampil Detail Journals</a></li>
        <li><a href="tampil_journals.php">Tampil Acc Journals</a></li>
    </ul>
</div>

<!-- Konten Utama -->
<div class="content">
    <h1>Assalamualaikum Wr.Wb</h1>
    <p>Selamat datang di halaman utama!</p>
</div>

<script>
    // Toggle menu buat layar kecil
    document.querySelector('.menu-toggle').addEventListener('click', function() {
        document.getElementById('nav-links').classList.toggle('show');
    });
</script>

</body>
</html>
