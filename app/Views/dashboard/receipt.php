<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #ffecd2, #fcb69f); /* Latar belakang segar */
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background-color: #ff7f50;
            border-color: #ff7f50;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ff5722;
            border-color: #ff5722;
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(255, 87, 34, 0.6);
        }

        .card-header h1 {
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }

        .card-footer p {
            font-weight: bold;
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

    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h1><i class="fas fa-receipt icon-animate"></i> Struk Pembelian</h1>
                </div>
                <div class="card-body">
                    <p><strong><i class="fas fa-utensils"></i> Nama Menu:</strong> <?= $product['product_name'] ?></p>
                    <p><strong><i class="fas fa-dollar-sign"></i> Harga Satuan:</strong> Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
                    <p><strong><i class="fas fa-sort-numeric-up"></i> Kuantitas:</strong> <?= $transaction['quantity'] ?></p>
                    <p><strong><i class="fas fa-money-check-alt"></i> Total Harga:</strong> Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?></p>
                    <p><strong><i class="fas fa-calendar-alt"></i> Tanggal Pembelian:</strong> <?= date('d-m-Y H:i:s', strtotime($transaction['created_at'])) ?></p>
                </div>
                <div class="card-footer text-center">
                    <hr>
                    <p><i class="fas fa-thumbs-up icon-animate"></i> Terima kasih atas pembelian Anda!</p>
                    <a href="/dashboard-mahasiswa" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
