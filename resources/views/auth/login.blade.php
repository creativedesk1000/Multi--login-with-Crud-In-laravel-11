<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System</title>
    <!-- Include necessary CDNs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f0f4f8;
            --text-color: #2c3e50;
            --shadow-color: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 900px;
            display: flex;
            background: white;
            border-radius: 20px;
            box-shadow: 
                20px 20px 60px rgba(0, 0, 0, 0.1),
                -20px -20px 60px rgba(255, 255, 255, 0.5);
            overflow: hidden;
            position: relative;
        }

        .auth-image {
            flex: 1;
            background: url('https://picsum.photos/2000/3000?random=1') center/cover;
            min-height: 600px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(74, 144, 226, 0.3);
            backdrop-filter: blur(5px);
        }

        .auth-forms {
            flex: 1;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .form-section {
            opacity: 0;
            transform: translateX(100px);
            position: absolute;
            width: 100%;
            transition: all 0.5s ease;
        }

        .form-section.active {
            opacity: 1;
            transform: translateX(0);
            position: relative;
        }

        .form-title {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            background: var(--secondary-color);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: inset 4px 4px 8px rgba(0, 0, 0, 0.1),
                        inset -4px -4px 8px rgba(255, 255, 255, 0.9);
            outline: none;
        }

        .btn-auth {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: var(--primary-color);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.4);
        }

        .toggle-form {
            text-align: center;
            margin-top: 20px;
            color: var(--text-color);
        }

        .toggle-form a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }

        .social-login {
            margin-top: 30px;
            text-align: center;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            background: white;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1),
                        -4px -4px 8px rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }

            .auth-image {
                min-height: 200px;
            }

            .auth-forms {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-image"></div>
        <div class="auth-forms">
            <!-- Login Form -->
            <div class="form-section active" id="loginForm">
                <h2 class="form-title">Welcome Back</h2>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn-auth">Login</button>
                </form>

                <div class="social-login">
                    <a href="#" class="social-btn"><i class="fab fa-google"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                </div>

                <div class="toggle-form">
                    Don't have an account? <a href="/register">Register</a>
                </div>
            </div>

            <!-- Register Form -->
            <div class="form-section" id="registerForm">
                <h2 class="form-title">Create Account</h2>

                <form method="POST" action="{{ route('register') }}" id="register-form">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn-auth">Register</button>
                </form>

                <div class="toggle-form">
                    Already have an account? <a onclick="toggleForm('login')">Login</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleForm(type) {
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');

            if (type === 'register') {
                loginForm.classList.remove('active');
                registerForm.classList.add('active');
            } else {
                registerForm.classList.remove('active');
                loginForm.classList.add('active');
            }
        }

        // Form validation
        document.getElementById('login-form').addEventListener('submit', function(e) {
            const email = this.querySelector('input[name="email"]').value;
            const password = this.querySelector('input[name="password"]').value;

            if (!email || !password) {
                e.preventDefault();
                showAlert('Please fill in all fields', 'danger');
            }
        });

        document.getElementById('register-form').addEventListener('submit', function(e) {
            const name = this.querySelector('input[name="name"]').value;
            const email = this.querySelector('input[name="email"]').value;
            const password = this.querySelector('input[name="password"]').value;
            const confirmPassword = this.querySelector('input[name="password_confirmation"]').value;

            if (!name || !email || !password || !confirmPassword) {
                e.preventDefault();
                showAlert('Please fill in all fields', 'danger');
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                showAlert('Passwords do not match', 'danger');
            }
        });

        function showAlert(message, type) {
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.textContent = message;

            const forms = document.querySelector('.auth-forms');
            forms.insertBefore(alert, forms.firstChild);

            setTimeout(() => {
                alert.remove();
            }, 3000);
        }
    </script>
</body>
</html>