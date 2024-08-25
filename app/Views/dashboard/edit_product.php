<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS for Animations -->
    <style>
        body {
            background: linear-gradient(135deg, #ffecd2, #fcb69f);
            font-family: 'Poppins', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        h1 {
            font-weight: bold;
            color: #ff7f50;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
            padding-left: 50px; /* Tambahkan padding untuk geser tulisan */
        }

        h1 .fa-edit {
            position: absolute;
            left: 0; /* Geser ikon sedikit lebih kiri */
            color: #ff7f50;
            font-size: 2rem;
            animation: bounceIcon 2s infinite;
        }

        @keyframes bounceIcon {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .form-label {
            font-weight: bold;
            color: #555;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 10px;
            color: #ff7f50;
        }

        .btn-primary {
            background-color: #ff7f50;
            border-color: #ff7f50;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ff5722;
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(255, 87, 34, 0.6);
        }

        .form-control {
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .form-control:focus {
            box-shadow: 0 4px 10px rgba(255, 127, 80, 0.4);
            border-color: #ff7f50;
        }

        .btn-back {
            background-color: #6c757d;
            color: #fff;
            transition: transform 0.3s ease;
            margin-top: 50px; /* Pindahkan tombol kembali ke bawah */
        }

        .btn-back:hover {
            background-color: #5a6268;
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(90, 98, 104, 0.6);
        }

        .icon-animate {
            display: inline-block;
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

    </style>
</head>
<body>

<div class="container">
    <h1><i class="fas fa-edit"></i> Edit Produk</h1>
    <form action="/update-product/<?= $product['id'] ?>" method="post">
        <div class="mb-3">
            <label for="product_name" class="form-label">
                <i class="fas fa-tag"></i> Nama Produk:
            </label>
            <input type="text" id="product_name" name="product_name" value="<?= $product['product_name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">
                <i class="fas fa-money-bill-wave"></i> Harga:
            </label>
            <input type="number" id="price" name="price" value="<?= $product['price'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">
                <i class="fas fa-image"></i> URL Gambar:
            </label>
            <input type="text" id="image" name="image" value="<?= $product['image'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-save"></i> Update Produk
        </button>
    </form>
    
    <a href="/dashboard" class="btn btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
