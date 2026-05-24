<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css'])
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-sans);
            background:
                radial-gradient(900px circle at 15% 10%, var(--primary-light) 0%, transparent 55%),
                radial-gradient(900px circle at 85% 95%, var(--danger-light) 0%, transparent 55%),
                var(--bg-main);
            min-height: 100vh;
            margin: 0;
        }

        .auth-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .auth-top {
            padding: var(--spacing-lg) var(--spacing-xl);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: var(--spacing-md);
        }

        .auth-brand {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-sm);
            text-decoration: none;
            color: var(--text-main);
        }

        .auth-badge {
            width: 38px;
            height: 38px;
            border-radius: var(--radius-md);
            background: var(--primary);
            color: white;
            display: grid;
            place-items: center;
            box-shadow: var(--shadow-sm);
            flex-shrink: 0;
        }

        .auth-brand-title {
            font-family: var(--font-serif);
            font-size: var(--font-size-xl);
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .auth-brand-subtitle {
            font-size: var(--font-size-sm);
            color: var(--text-secondary);
            margin-top: 2px;
        }

        .auth-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-xl) var(--spacing-md) var(--spacing-xl);
        }

        .login-container {
            width: 100%;
            max-width: 520px;
        }

        .login-card {
            background: var(--bg-surface);
            border-radius: var(--radius-lg);
            padding: var(--spacing-xl);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-light);
        }

        .login-header {
            text-align: center;
            margin-bottom: var(--spacing-xl);
        }

        .logo-circle {
            width: 72px;
            height: 72px;
            background: var(--primary-light);
            border: 1px solid var(--border-light);
            border-radius: var(--radius-lg);
            display: grid;
            place-items: center;
            margin: 0 auto var(--spacing-lg);
            color: var(--primary);
            box-shadow: var(--shadow-sm);
        }

        .login-title {
            font-family: var(--font-serif);
            font-size: var(--font-size-2xl);
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: var(--spacing-xs);
            letter-spacing: -0.02em;
        }

        .login-subtitle {
            font-size: var(--font-size-base);
            color: var(--text-secondary);
            font-weight: 500;
            margin: 0;
        }

        .error-banner {
            background: var(--danger-light);
            border: 1px solid var(--danger);
            border-radius: var(--radius-md);
            padding: var(--spacing-md) var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .error-banner.lockout-warning {
            background: var(--warning-light);
            border-color: var(--warning);
        }

        .error-banner.lockout-warning .error-banner-text {
            color: var(--text-main);
        }

        .error-banner svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            color: var(--danger);
        }

        .error-banner-text {
            font-size: 14px;
            color: var(--danger);
            font-weight: 600;
        }

        .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: var(--font-size-sm);
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: var(--spacing-sm);
        }

        .form-label svg {
            width: 16px;
            height: 16px;
            color: var(--primary);
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-input {
            width: 100%;
            padding: var(--spacing-md) var(--spacing-md) var(--spacing-md) 44px;
            font-size: var(--font-size-base);
            font-family: inherit;
            color: var(--text-main);
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            outline: none;
            transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
        }

        .login-input::placeholder {
            color: var(--text-muted);
        }

        .login-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--primary);
        }

        .login-input.error {
            border-color: var(--danger);
            box-shadow: 0 0 0 3px var(--danger-light);
        }

        .forgot-link-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: var(--spacing-sm);
        }

        .forgot-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .forgot-link:hover {
            color: var(--primary-hover);
        }

        .login-btn {
            width: 100%;
            margin-top: var(--spacing-lg);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: var(--spacing-xl) 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider-text {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .login-footer {
            text-align: center;
            font-size: 14px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .login-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .login-footer a:hover {
            color: var(--primary-hover);
        }

        @media (max-width: 480px) {
            .auth-top { padding: var(--spacing-lg) var(--spacing-md); }
            .login-card { padding: var(--spacing-lg); }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <div class="auth-top">
            <a class="auth-brand" href="/" aria-label="Student Management Dashboard">
                <span class="auth-badge" aria-hidden="true"><i class="bi bi-mortarboard"></i></span>
                <span>
                    <div class="auth-brand-title">Student Management</div>
                    <div class="auth-brand-subtitle">Secure portal login</div>
                </span>
            </a>
        </div>

        <div class="auth-main">
            <div class="login-container">
                <div class="login-card">
                    <div class="login-header">
                        <div class="logo-circle" aria-hidden="true">
                            <i class="bi bi-person-fill"></i>
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

                <button type="submit" class="btn btn-primary btn-lg login-btn" id="loginBtn">Sign In</button>
            </form>

            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">or</span>
                <div class="divider-line"></div>
            </div>

            <p class="login-footer">Don't have an account? <a href="#">Create one</a></p>
                </div>
            </div>
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
                window.location.href = redirectUrl || '/';
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
            background: var(--success);
            color: white;
            padding: var(--spacing-md) var(--spacing-lg);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 600;
            box-shadow: var(--shadow-md);
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