<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS for Animations -->
    <style>
        /* Animasi untuk form login */
        .login-box {
            animation: fadeIn 1.2s ease-in-out;
        }

        /* Fade In Keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom styling */
        body, html {
            height: 100%;
            margin: 0;
            background: linear-gradient(135deg, #ffecd2, #fcb69f); /* Background yang vibrant */
            font-family: 'Poppins', sans-serif;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            position: relative;
        }
        .login-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            z-index: 10; /* Pastikan form berada di atas */
        }
        .login-box::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 127, 80, 0.2);
            border-radius: 50%;
            top: -250px;
            left: -250px;
            z-index: -1;
            animation: scaleIn 6s ease-in-out infinite;
        }
        .login-box::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 87, 34, 0.2);
            border-radius: 50%;
            bottom: -200px;
            right: -200px;
            z-index: -1;
            animation: scaleIn 8s ease-in-out infinite;
        }

        /* Scale In Keyframes */
        @keyframes scaleIn {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.7;
            }
        }

        /* Animasi bounce untuk ikon */
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

        h2 {
            color: #333;
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

        /* Hover pada input untuk lebih interaktif */
        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            transition: box-shadow 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 4px 10px rgba(255, 127, 80, 0.4);
            border-color: #ff7f50;
        }

        /* Animasi Partikel */
        .particle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: rgba(255, 87, 34, 0.6);
            border-radius: 50%;
            animation: particleMove 10s linear infinite;
            z-index: -1; /* Pastikan partikel berada di belakang */
        }

        @keyframes particleMove {
            0% { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(-100vh); opacity: 0; }
        }

        /* Tambahkan lebih banyak partikel untuk kesan interaktif */
        .particle:nth-child(2) { width: 15px; height: 15px; animation-duration: 8s; left: 10%; }
        .particle:nth-child(3) { width: 5px; height: 5px; animation-duration: 12s; left: 30%; }
        .particle:nth-child(4) { width: 20px; height: 20px; animation-duration: 6s; left: 50%; }
        .particle:nth-child(5) { width: 8px; height: 8px; animation-duration: 14s; left: 70%; }
        .particle:nth-child(6) { width: 12px; height: 12px; animation-duration: 10s; left: 90%; }
    </style>
</head>
<body>
    <!-- Partikel animasi -->
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>

    <div class="login-container">
        <div class="login-box">
            <h2 class="text-center mb-4">
                <i class="fas fa-user-circle icon-animate"></i> Login E-Kantin Putri
            </h2>
            <form action="/login" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">
                        <i class="fas fa-user"></i> Username
                    </label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
