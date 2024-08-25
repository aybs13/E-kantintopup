<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #ffecd2, #fcb69f); /* Latar belakang yang segar */
            font-family: 'Poppins', sans-serif;
            color: #333;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Background animasi */
        .background-animation {
            position: absolute;
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

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 700px;
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

        /* Feedback Loading dengan animasi */
        #loading {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        #loading.active {
            display: block;
            opacity: 1;
        }

        /* Icon animation */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .icon-animate {
            animation: bounce 1.5s infinite;
        }

        /* Particle animation */
        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: rgba(255, 87, 34, 0.6);
            border-radius: 50%;
            animation: particleMove 10s linear infinite;
        }

        @keyframes particleMove {
            0% { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(-100vh); opacity: 0; }
        }

        /* Partikel styling */
        .particle:nth-child(2) { width: 15px; height: 15px; animation-duration: 8s; left: 10%; }
        .particle:nth-child(3) { width: 5px; height: 5px; animation-duration: 12s; left: 30%; }
        .particle:nth-child(4) { width: 20px; height: 20px; animation-duration: 6s; left: 50%; }
        .particle:nth-child(5) { width: 8px; height: 8px; animation-duration: 14s; left: 70%; }
        .particle:nth-child(6) { width: 12px; height: 12px; animation-duration: 10s; left: 90%; }

        /* Illustration */
        .illustration {
            width: 120px;
            height: auto;
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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header">
                    <h1 class="icon-animate">💳 Konfirmasi Pembayaran</h1>
                </div>
                <div class="card-body">
                    <!-- Illustration -->
                    <img src="https://cdn-icons-png.flaticon.com/512/4298/4298254.png" alt="Payment Illustration" class="illustration mb-4">
                    <p>Anda akan diarahkan ke halaman pembayaran Midtrans.</p>
                    <button id="pay-button" class="btn btn-primary btn-lg">
                        <i class="fas fa-credit-card"></i> Bayar Sekarang
                    </button>

                    <!-- Feedback loading -->
                    <div id="loading" class="mt-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p>Memproses pembayaran...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Snap.js dan Handling Pembayaran -->
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    var loading = document.getElementById('loading');
    
    payButton.addEventListener('click', function () {
        // Tampilkan loading spinner dan sembunyikan tombol
        loading.classList.add('active');
        payButton.style.display = 'none';
        
        snap.pay('<?= $snapToken ?>', {
            onSuccess: function(result) {
                // Redirect ke halaman cek status setelah sukses
                window.location.href = "/topup/status/<?= $order_id ?>";
            },
            onPending: function(result) {
                window.location.href = "/topup/status/<?= $order_id ?>";
            },
            onError: function(result) {
                // Tampilkan pesan error dan kembalikan tombol bayar
                alert('Pembayaran gagal atau dibatalkan.');
                loading.classList.remove('active');
                payButton.style.display = 'block';
            }
        });
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
