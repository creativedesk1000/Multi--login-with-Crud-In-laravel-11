<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

        .form-container {
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

        .form-section {
            flex: 1;
            padding: 40px;
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
        }

        .form-control {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            background: var(--secondary-color);
            transition: all 0.3s ease;
            width: 100%;
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

        .error-messages p {
            color: red;
            font-size: 0.9rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .form-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- <a href="/login">Login</a>    -->

    <div class="form-container">
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

                <div class="form-group">
                    <select name="role" id="role" class="form-control" required>
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <button type="submit" class="btn-auth">Register</button>
            </form>

            <div class="toggle-form">
                Already have an account? <a onclick="toggleForm('login')">Login</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="error-messages">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</body>
</html>
