<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS for Animation and Web 3.0 Style -->
    <style>
        body {
            background: linear-gradient(135deg, #ffecd2, #fcb69f);
            font-family: 'Poppins', sans-serif;
            color: #333;
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Background animasi */
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,87,34,0.1), rgba(255,87,34,0));
            animation: animateBackground 6s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes animateBackground {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Particle animation */
        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: rgba(255, 87, 34, 0.6);
            border-radius: 50%;
            animation: particleMove 10s linear infinite;
            z-index: -1;
        }

        @keyframes particleMove {
            0% { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(-100vh); opacity: 0; }
        }

        /* Animasi untuk ikon */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .icon-animate {
            display: inline-block;
            animation: bounce 1.5s infinite;
        }

        .table {
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .menu-card {
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .btn {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary, .btn-success {
            background-color: #ff7f50;
            border-color: #ff7f50;
        }

        .btn-primary:hover, .btn-success:hover {
            background-color: #ff5722;
            border-color: #ff5722;
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(255, 87, 34, 0.6);
        }

        /* Hover pada input dan elemen lain */
        .form-control {
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 4px 10px rgba(255, 127, 80, 0.4);
            border-color: #ff7f50;
        }

        .container {
            margin-top: 5rem;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #138496;
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(19, 132, 150, 0.6);
        }

        .menu-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .menu-price {
            color: #ff5722;
            font-weight: bold;
        }

        .motivational-text {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
        }

        /* Ukuran medium untuk form */
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-icon {
            padding-left: 2rem;
            position: relative;
        }

        .btn-icon i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>

<!-- Background Animasi -->
<div class="background-animation"></div>

<!-- Partikel animasi -->
<div class="particle"></div>
<div class="particle"></div>
<div class="particle"></div>
<div class="particle"></div>
<div class="particle"></div>
<div class="particle"></div>

<div class="container">
    <h1 class="text-center mb-4">
        <span class="icon-animate">👋</span> Selamat Datang Di E-Kantin Putri, Admin!
    </h1>

    <!-- Tampilkan daftar produk -->
    <h2><span class="icon-animate">🍽️</span> Menu yang Tersedia</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
        <div class="col-md-4">
            <div class="card menu-card">
                <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="<?= $product['product_name'] ?>" class="card-img-top" style="border-radius: 10px 10px 0 0;">
                <div class="card-body">
                    <h5 class="menu-title"><?= $product['product_name'] ?></h5>
                    <p class="menu-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                    <p><strong>Hari, Tanggal:</strong> <?= strftime("%A, %d %B %Y", strtotime($product['created_at'])) ?></p>
                    <a href="/edit-product/<?= $product['id'] ?>" class="btn btn-warning btn-icon">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="/delete-product/<?= $product['id'] ?>" class="btn btn-danger btn-icon">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Form tambah produk -->
    <h2 class="mt-5 text-center"><span class="icon-animate">➕</span> Tambah Produk</h2>
    <div class="form-container">
        <form action="/save-product" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <label for="product_name" class="form-label">Nama Produk:</label>
                <input type="text" id="product_name" name="product_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga:</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar:</label>
                <input type="file" id="image" name="image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-save"></i> Simpan Produk
            </button>
        </form>
    </div>

    <!-- Form tambah user -->
    <h2 class="mt-5 text-center"><span class="icon-animate">👤</span> Tambah User</h2>
    <div class="form-container">
        <form action="/save-user" method="post" class="mb-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select id="role" name="role" class="form-select">
                    <option value="admin">Admin</option>
                    <option value="mahasiswa">Mahasiswa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-user-plus"></i> Simpan User
            </button>
        </form>
    </div>

    <div class="text-center">
    <a href="/logout" class="btn btn-secondary btn-icon mt-4">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
