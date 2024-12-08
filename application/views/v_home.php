<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Poliklinik</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #025aa5;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .hero {
            background-color: #025aa5;
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
        }

        .login-section {
            padding: 50px 20px;
        }

        .login-section h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-option {
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
            padding: 30px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .login-option i {
            font-size: 4rem;
            color: #0275d8;
            margin-bottom: 15px;
        }

        .login-option h3 {
            margin-bottom: 10px;
        }

        .login-option a {
            display: inline-block;
            margin-top: 15px;
            font-size: 1rem;
            color: white;
            background-color: #0275d8;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .login-option a:hover {
            background-color: #025aa5;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Poliklinik</a>
        </div>
    </nav>

    <header class="hero">
        <h1 class="fw-bolder">Selamat Datang di Poliklinik Kami</h1>
        <p>Solusi kesehatan terbaik untuk Anda dan keluarga</p>
    </header>

    <section class="login-section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="login-option">
                        <i class="fas fa-user"></i>
                        <h3>Registrasi Pasien</h3>
                        <p>Apabila Anda adalah seorang Pasien, silahkan Registrasi terlebih dahulu untuk melakukan
                            pendaftaran sebagai Pasien!</p>
                        <a href="<?= base_url() ?>auth/register_pasien">Registrasi Sekarang</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-option">
                        <i class="fas fa-user-md"></i>
                        <h3>Login Dokter</h3>
                        <p>Apabila Anda adalah seorang Dokter, silahkan Login terlebih dahulu untuk memulai melayani
                            Pasien!</p>
                        <a href="<?= base_url() ?>auth/login_dokter">Masuk Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>