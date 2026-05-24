<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary-blue: #2F4FA2;
            --primary-blue-light: #4F8EF7;
            --accent-orange: #FF7A18;
            --navy-dark: #1F2A44;
            --bg-light: #F5F7FA;
            --white: #FFFFFF;
            --border-color: #E0E6ED;
            --text-dark: #1A1A1A;
            --text-muted: #6B7280;
            --error-red: #EF4444;
            --success-green: #22C55E;
            --soft-blue: #E8F0FE;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background orbs */
        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            left: -100px;
            animation: float 8s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -80px;
            right: -80px;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 60px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.7);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 10px 30px rgba(47, 79, 162, 0.3);
            animation: popIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s backwards;
        }

        @keyframes popIn {
            from {
                opacity: 0;
                transform: scale(0.5);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .logo-circle svg {
            width: 36px;
            height: 36px;
            fill: white;
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .login-subtitle {
            font-size: 15px;
            color: var(--text-muted);
            font-weight: 400;
        }

        .error-banner {
            background: #FEE2E2;
            border: 1px solid #FECACA;
            border-left: 4px solid var(--error-red);
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.4s ease-out;
        }

        .error-banner.lockout-warning {
            background: #FEF3C7;
            border-color: #FCD34D;
            border-left-color: #F59E0B;
        }

        .error-banner.lockout-warning .error-banner-text {
            color: #7C2D12;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-banner svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            color: var(--error-red);
        }

        .error-banner-text {
            font-size: 14px;
            color: #7F1D1D;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 10px;
        }

        .form-label svg {
            width: 16px;
            height: 16px;
            color: var(--primary-blue);
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s ease;
        }

        .login-input {
            width: 100%;
            padding: 13px 44px 13px 44px;
            font-size: 15px;
            font-family: inherit;
            color: var(--text-dark);
            background: var(--bg-light);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            outline: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-input::placeholder {
            color: #B0B8C4;
        }

        .login-input:hover {
            border-color: var(--primary-blue-light);
            background: #FAFBFC;
        }

        .login-input:focus {
            border-color: var(--primary-blue);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(79, 142, 247, 0.1);
            transform: translateY(-2px);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--primary-blue);
        }

        .login-input.error {
            border-color: var(--error-red);
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .forgot-link-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .forgot-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--primary-blue);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .forgot-link:hover {
            color: var(--accent-orange);
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            margin-top: 28px;
            font-size: 16px;
            font-weight: 700;
            font-family: inherit;
            color: white;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
            border: none;
            border-radius: 12px;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(47, 79, 162, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(47, 79, 162, 0.4);
        }

        .login-btn:active {
            transform: translateY(-1px);
        }

        .login-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 32px 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }

        .divider-text {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .login-footer {
            text-align: center;
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .login-footer a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .login-footer a:hover {
            color: var(--accent-orange);
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 40px 24px;
            }

            .login-title {
                font-size: 24px;
            }

            .logo-circle {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-circle">
                    <svg viewBox="0 0 24 24"><path d="M12 2a5 5 0 1 0 0 10A5 5 0 0 0 12 2zm0 12c-5.33 0-8 2.67-8 4v2h16v-2c0-1.33-2.67-4-8-4z"/></svg>
                </div>
                <h1 class="login-title">Welcome back</h1>
                <p class="login-subtitle">Sign in to your account to continue</p>
            </div>

            @if(session('error'))
            <div class="error-banner">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span class="error-banner-text">{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="error-banner">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span class="error-banner-text">{{ $errors->first() }}</span>
            </div>
            @endif

            @if(isset($msg) && $msg)
            <div class="error-banner @if(isset($is_locked_out) && $is_locked_out)lockout-warning @endif">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span class="error-banner-text">{{ $msg }}</span>
            </div>
            @endif

            <form action="/" method="POST" id="loginForm">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="username">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/></svg>
                        Username
                    </label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/></svg>
                        <input class="login-input" type="text" id="username" name="username" placeholder="Enter your username" autocomplete="off" value="" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Password
                    </label>
                    <div class="input-wrapper">
                        <svg class="input-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input class="login-input" type="password" id="password" name="password" placeholder="Enter your password" autocomplete="off" value="" required>
                    </div>
                    <div class="forgot-link-wrapper">
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">Sign In</button>
            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">or</span>
                <div class="divider-line"></div>
            </div>

            <p class="login-footer">Don't have an account? <a href="#">Create one</a></p>
        </div>
    </div>

    <!-- Success Toast Notification -->
    <div class="toast-notification" id="successToast">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        <span id="toastMessage">Login successful! Redirecting...</span>
    </div>

    <script>
        // Function to show success notification
        function showSuccessNotification(redirectUrl) {
            const toast = document.getElementById('successToast');
            @if(isset($success_message))
                document.getElementById('toastMessage').textContent = "{{ $success_message }}";
            @endif
            toast.classList.add('show');
            
            // Hide toast after 2.5 seconds then redirect
            setTimeout(function() {
                toast.classList.remove('show');
            }, 2500);

            // Redirect after 3 seconds total
            setTimeout(function() {
                window.location.href = redirectUrl || '/students';
            }, 3000);
        }

        // Handle login lockout with countdown timer
        document.addEventListener('DOMContentLoaded', function() {
            // Clear form fields on page load to prevent autofill
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
            
            @if(isset($login_success) && $login_success)
                var redirectUrl = "{{ $redirect_url ?? '/students' }}";
                showSuccessNotification(redirectUrl);
            @endif

            // Check if locked out
            @if(isset($is_locked_out) && $is_locked_out)
                disableLoginForm();
                startCountdownTimer();
            @endif
        });
        
        // Aggressive clearing to prevent browser autofill
        setTimeout(function() {
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
        }, 100);
        
        setTimeout(function() {
            document.getElementById('username').value = '';
            document.getElementById('password').value = '';
        }, 500);

        function disableLoginForm() {
            const loginBtn = document.getElementById('loginBtn');
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            
            loginBtn.disabled = true;
            username.disabled = true;
            password.disabled = true;
        }

        function enableLoginForm() {
            const loginBtn = document.getElementById('loginBtn');
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            
            loginBtn.disabled = false;
            username.disabled = false;
            password.disabled = false;
            loginBtn.textContent = 'Sign In';
        }

        function startCountdownTimer() {
            let timeRemaining = 15;
            const loginBtn = document.getElementById('loginBtn');
            const errorBanner = document.querySelector('.error-banner-text');

            const timer = setInterval(function() {
                timeRemaining--;
                loginBtn.textContent = 'Wait ' + timeRemaining + ' seconds...';

                if (errorBanner) {
                    errorBanner.textContent = 'Too many failed attempts. Please wait ' + timeRemaining + ' second(s) before trying again.';
                }

                if (timeRemaining <= 0) {
                    clearInterval(timer);
                    enableLoginForm();
                    
                    // Remove error banner
                    const banner = document.querySelector('.error-banner');
                    if (banner) {
                        banner.style.display = 'none';
                    }
                }
            }, 1000);
        }
    </script>

    <style>
        .toast-notification {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(120px);
            background: linear-gradient(135deg, #22C55E 0%, #16A34A 100%);
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 10px 32px rgba(34, 197, 94, 0.35);
            transition: all 0.4s cubic-bezier(0.22, 1, 0.36, 1);
            z-index: 999;
            opacity: 0;
        }

        .toast-notification.show {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        .toast-notification svg {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
        }
    </style>
</body>
</html>