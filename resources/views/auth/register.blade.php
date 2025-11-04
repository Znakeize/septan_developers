<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Septan Developers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1), rgba(0, 0, 0, 0.95)), url('{{ asset('assets/img/amila_ruwan-liyanapathirana-wood-locally-bricks-hotel-moksha-nature-sri-lanka-designboom-03-1-b5a51208.jpg') }}');
            background-size: cover;
            background-position: center;
            padding: 100px 20px;
        }
        .auth-box {
            background: rgba(26, 26, 26, 0.95);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            color: #fff;
        }
        .auth-header p {
            color: #999;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #fff;
            font-weight: 500;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 6px;
            color: #fff;
            font-size: 14px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #dc2626;
        }
        .form-group input::placeholder {
            color: #666;
        }
        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #dc2626;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background: #b91c1c;
        }
        .auth-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #333;
        }
        .auth-footer a {
            color: #dc2626;
            text-decoration: none;
            font-weight: 500;
        }
        .auth-footer a:hover {
            text-decoration: underline;
        }
        .logo-link {
            display: block;
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-link .logo {
            font-size: 28px;
            font-weight: 900;
            color: #dc2626;
            letter-spacing: 3px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <a href="{{ route('home') }}" class="logo-link">
                <img src="{{ asset('assets/img/logo-sample.svg') }}" alt="Septan" style="height:36px;display:inline-block;"/>
            </a>
            <div class="auth-header">
                <h1>Sign Up</h1>
                <p>Create your admin account</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter your name">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>

            <div class="auth-footer">
                <p style="color: #999;">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
        </div>
    </div>
</body>
</html>

