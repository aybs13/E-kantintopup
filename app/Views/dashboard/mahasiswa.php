<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
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

        .container {
            margin-top: 5rem;
        }

        /* Kartu Saldo */
        .saldo-card {
            background: #fff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 25px;
            padding: 10px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .saldo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .saldo-amount {
            font-size: 2.5rem;
            color: #ff5722;
            font-weight: bold;
        }

        .saldo-title {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            font-weight: bold;
            color: #333;
        }

        .wallet-icon {
            font-size: 3.5rem;
            color: #ff5722;
            margin-bottom: 1rem;
        }

        /* Tombol Top-Up */
        .topup-btn {
            background-color: #ff7f50;
            border-color: #ff7f50;
            color: white;
            padding: 15px 40px;
            font-size: 1.2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .topup-btn:hover {
            background-color: #ff5722;
            border-color: #ff5722;
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(255, 87, 34, 0.6);
        }

        .icon-wallet {
            animation: bounce 1.5s infinite;
        }

        /* Menu Card */
        .menu-card {
            background: #fff;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin-bottom: 20px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 50px rgba(0, 0, 0, 0.15);
        }

        .menu-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .menu-price {
            font-size: 1.4rem;
            color: #ff5722;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .menu-img {
            max-width: 300px;
            border-radius: 20px;
        }

        .form-control {
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 4px 10px rgba(255, 127, 80, 0.4);
            border-color: #ff7f50;
        }

        .btn {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(255, 87, 34, 0.6);
        }

        /* Style untuk table transaksi */
        .table {
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .table-hover tbody tr:hover {
            background-color: #ffefe0;
        }

        .table thead th {
            background-color: #ff7f50;
            color: white;
            font-size: 1.1rem;
        }

        .table tbody td {
            padding: 15px;
        }

        .btn-info {
            background-color: #ff7f50;
            border-color: #ff7f50;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-info:hover {
            background-color: #ff5722;
            border-color: #ff5722;
            transform: translateY(-3px);
        }

        .logout-btn {
            margin-top: 30px;
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
            transition: transform 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #5a6268;
            transform: translateY(-3px);
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
        <span class="icon-animate">👋</span> Selamat Datang Di E-Kantin Putri, Mahasiswa!
    </h1>

    <!-- Kartu Saldo -->
    <div class="col-md-6 offset-md-3 saldo-card mb-4">
        <div class="wallet-icon">
            <i class="fas fa-wallet icon-wallet"></i>
        </div>
        <div class="saldo-title">Saldo Anda:</div>
        <div class="saldo-amount">Rp <?= number_format($saldo, 0, ',', '.') ?></div>
    </div>

    <!-- Tombol Top-Up -->
    <div class="text-center mb-4">
        <a href="/topup" class="btn topup-btn">
            <i class="fas fa-wallet"></i> Top-Up Saldo
        </a>
    </div>

    <!-- Daftar Menu yang Tersedia -->
    <h2><span class="icon-animate">🍽️</span> Menu yang Tersedia</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
        <div class="col-md-4">
            <div class="card menu-card">
                <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="<?= $product['product_name'] ?>" class="menu-img mb-3">
                <h5 class="menu-title"><?= $product['product_name'] ?></h5>
                <p class="menu-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                <p><strong>Hari, Tanggal:</strong> <?= strftime("%A, %d %B %Y", strtotime($product['created_at'])) ?></p>
                <form action="/buy-product/<?= $product['id'] ?>" method="post">
                    <div class="input-group">
                        <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-cart-plus"></i> Beli
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Riwayat Transaksi -->
    <h2><span class="icon-animate">🧾</span> Riwayat Transaksi</h2>
    <?php if (!empty($transactions)): ?>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Tanggal Pembelian</th>
                <th>Struk</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?= $transaction['product_name'] ?></td>
                <td>Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?></td>
                <td><?= $transaction['created_at'] ?></td>
                <td><a href="/receipt/<?= $transaction['id'] ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-receipt"></i> Lihat Struk
                </a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p class="text-muted">Belum ada transaksi.</p>
    <?php endif; ?>

    <a href="/logout" class="btn logout-btn">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
