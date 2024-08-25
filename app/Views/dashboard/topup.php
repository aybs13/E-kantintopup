<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top-Up Saldo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #ffecd2, #fcb69f); /* Latar belakang segar dan modern */
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
            background: linear-gradient(45deg, #ff7f50, #ff5722);
            border-color: transparent;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 28px rgba(255, 87, 34, 0.6);
        }

        /* Hover pada input */
        .form-control {
            border-radius: 10px;
            transition: box-shadow 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 4px 10px rgba(255, 127, 80, 0.4);
            border-color: #ff7f50;
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

        /* Section for illustrations */
        .illustration {
            width: 120px;
            height: auto;
        }

        .motivational-text {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
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
        .particle:nth-child(7) { width: 10px; height: 10px; animation-duration: 11s; left: 20%; }
        .particle:nth-child(8) { width: 7px; height: 7px; animation-duration: 9s; left: 40%; }
        .particle:nth-child(9) { width: 18px; height: 18px; animation-duration: 13s; left: 60%; }
        .particle:nth-child(10) { width: 10px; height: 10px; animation-duration: 7s; left: 80%; }

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
<div class="particle"></div>
<div class="particle"></div>
<div class="particle"></div>
<div class="particle"></div>

<div class="container d-flex justify-content-center align-items-center">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card text-center p-4">
                <div class="card-header">
                    <h1 class="icon-animate">💸 Top-Up Saldo</h1>
                </div>
                <div class="card-body">
                    <!-- Illustration -->
                    <img src="https://cdn-icons-png.flaticon.com/512/2910/2910766.png" alt="Payment Illustration" class="illustration mb-4">

                    <form action="/topup" method="post">
                        <div class="mb-3">
                            <label for="amount" class="form-label"><i class="fas fa-money-bill-wave"></i> Jumlah Top-Up:</label>
                            <input type="number" id="amount" name="amount" class="form-control" required min="1" placeholder="Masukkan jumlah top-up">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane"></i> Proses Top-Up
                        </button>
                    </form>

                    <!-- Motivational text -->
                    <div class="motivational-text">
                        <p>Segera top-up untuk melanjutkan aktivitas di e-kantin! 🎉</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
