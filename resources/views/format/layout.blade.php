<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Management Dashboard')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="/js/jQuery.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #F8FAFC;
            color: #1f2937;
        }

        .shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .brand {
            margin: 0;
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #1E3A8A;
            line-height: 1.1;
            white-space: nowrap;
        }

        .topbar-nav {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .topbar-nav a {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
            padding: 0.45rem 0.7rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #374151;
            transition: background-color 0.15s ease, color 0.15s ease, transform 0.15s ease;
        }

        .topbar-nav a:hover {
            background: rgba(59, 130, 246, 0.10);
            color: #1E3A8A;
            transform: translateY(-1px);
        }

        .topbar-nav a:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.18);
        }

        .logout-btn {
            background: #F97316;
            color: #ffffff !important;
        }

        .logout-btn:hover {
            background: #ea580c;
            color: #ffffff !important;
        }

        .footer {
            margin-top: auto;
            padding: 1rem 2rem;
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            color: #6B7280;
            font-size: 0.9rem;
        }

        @media (max-width: 900px) {
            .topbar {
                padding: 1rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .brand {
                white-space: normal;
            }

            .topbar-nav {
                width: 100%;
                justify-content: flex-start;
            }
        }

        .content {
            position: relative;
        }
        .content-locked {
            opacity: 0;
            pointer-events: none;
        }

        .content-lock-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #1a3a6b;
            display: flex !important;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn 0.4s ease-out forwards !important;
            padding: 2rem;
            pointer-events: auto;
        }

        .content-lock-card {
            background: white;
            border-radius: 20px;
            padding: 3.5rem 2.5rem;
            max-width: 750px;
            width: 100%;
            box-shadow: 0 25px 80px rgba(30, 58, 138, 0.4);
            text-align: center;
            animation: slideUp 0.6s 0.2s ease-out forwards !important;
            position: relative;
            overflow: hidden;
            border-top: 5px solid #F97316;
        }

        .content-lock-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 0px;
            background: transparent;
        }

        .content-lock-card::after {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .card-content {
            position: relative;
            z-index: 1;
        }

        .content-lock-icon {
            width: 120px;
            height: 120px;
            background: #e8e8e8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2.5rem;
            font-size: 60px;
            color: #F97316;
            animation: pulse 2s ease-in-out infinite;
        }

        .content-lock-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 700;
            color: #1E3A8A;
            margin-bottom: 0.8rem;
            line-height: 1.2;
            letter-spacing: -0.01em;
        }

        .content-lock-subtitle {
            font-size: 15px;
            color: #6B7280;
            margin-bottom: 2.5rem;
            line-height: 1.6;
            font-weight: 400;
        }

        .content-lock-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.7rem 1.3rem;
            background: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            color: #92400e;
            margin-bottom: 2rem;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            background: #f59e0b;
            border-radius: 50%;
            animation: blink 1.5s ease-in-out infinite;
        }

        .content-lock-message {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 1.8rem;
            margin-bottom: 2.5rem;
            color: #4B5563;
            font-size: 14px;
            line-height: 1.7;
        }

        .content-lock-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2.5rem;
            margin-bottom: 3rem;
        }

        .meta-item {
            flex: 1;
        }

        .meta-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6B7280;
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .meta-value {
            font-size: 14px;
            font-weight: 600;
            color: #1E3A8A;
        }

        .content-lock-button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.85rem 2rem;
            background: linear-gradient(135deg, #3B82F6, #2563EB);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            position: relative;
            z-index: 10001;
        }

        .content-lock-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        /* Notification Styles */
        .notification {
            min-width: 100%;
            max-width: 600px;
            padding: 16px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInRight 0.3s ease-out forwards;
            font-weight: 500;
            font-size: 14px;
        }

        #notification-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .notification.success {
            background: #dbeafe;
            color: #0c4a6e;
            border-left: 4px solid #3b82f6;
        }

        .notification.error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .notification.info {
            background: #dbeafe;
            color: #0c4a6e;
            border-left: 4px solid #3b82f6;
        }

        .notification-icon {
            font-size: 18px;
        }

        .notification-close {
            margin-left: auto;
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 18px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-close:hover {
            opacity: 0.7;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }

        .content-lock-footer {
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
            color: #9CA3AF;
            font-size: 13px;
            line-height: 1.6;
        }

        .content-lock-footer p {
            margin: 0.3rem 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        @keyframes blink {
            0%, 49%, 100% {
                opacity: 1;
            }
            50%, 99% {
                opacity: 0.3;
            }
        }

        @media (max-width: 600px) {
            .content-lock-card {
                padding: 2.5rem 1.5rem;
            }

            .content-lock-card h2 {
                font-size: 1.8rem;
            }

            .content-lock-icon {
                width: 100px;
                height: 100px;
                font-size: 48px;
            }

            .content-lock-meta {
                grid-template-columns: 1fr;
                padding: 0;
            }

            .content-lock-button {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
        }
    </style>
</head>
<body>
    <main class="shell">
        <header class="topbar" @if($maintenanceLock = request()->attributes->get('maintenance_lock')) style="display: none;" @endif>
            <h1 class="brand">
                @if(session('logged_role') === 'student')
                    👨‍🎓 Student Dashboard
                @elseif(session('logged_role') === 'teacher')
                    👨‍🏫 Teacher Dashboard
                @elseif(session('logged_role') === 'admin')
                    👨‍💼 Admin Dashboard
                @else
                    Student Management Dashboard
                @endif
            </h1>
            @section('header')
                <ul class="topbar-nav">
                    {{-- Student Role Navigation --}}
                    @if(session('logged_role') === 'student')
                        @if(session('student_id'))
                            <li><a href="{{ route('student.dashboard', ['student' => session('student_id')]) }}">Dashboard</a></li>
                        @endif
                    {{-- Teacher Role Navigation --}}
                    @elseif(session('logged_role') === 'teacher')
                        <li><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                    {{-- Admin Role Navigation --}}
                    @elseif(session('logged_role') === 'admin')
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('students.index') }}">Students</a></li>
                        <li><a href="{{ route('teachers.index') }}">Teachers</a></li>
                        <li><a href="{{ route('degrees.index') }}">Degrees</a></li>
                        <li><a href="/user_profile">Profile</a></li>
                        <li><a href="/user_posts">Posts</a></li>
                        <li><a href="{{ route('generatePdf') }}">PDF</a></li>
                        <li><a href="{{ route('upload.image') }}">Upload image</a></li>
                        <li><a href="/activity-log">Activity Log</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('demo') }}">Demo</a></li>
                    {{-- Default Navigation (if no role is set) --}}
                    @else
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('students.index') }}">Students</a></li>
                    @endif
                    
                    <li><a href="{{ route('user.logout') }}" class="logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                </ul>
            @show
        </header>

        @php
            $maintenanceLock = request()->attributes->get('maintenance_lock');
        @endphp

        <section class="content{{ $maintenanceLock ? ' content-locked' : '' }}">
            @yield('content')

            @if ($maintenanceLock)
                <div class="content-lock-overlay" role="alert" aria-live="assertive">
                    <div class="content-lock-card">
                        <div class="card-content">
                            <div class="content-lock-icon">
                                <i class="bi bi-tools"></i>
                            </div>
                            
                            <h2>Down for Maintenance</h2>
                            <p class="content-lock-subtitle">We're making improvements to serve you better</p>
                            
                            <div class="content-lock-status">
                                <span class="status-indicator"></span>
                                Scheduled Maintenance in Progress
                            </div>
                            
                            <div class="content-lock-message">
                                <p>{{ request()->attributes->get('maintenance_message') }}</p>
                            </div>
                            
                            <div class="content-lock-meta">
                                <div class="meta-item">
                                    <div class="meta-label">
                                        <i class="bi bi-clock"></i> Expected Back
                                    </div>
                                    <div class="meta-value">{{ date('h:i A') }}</div>
                                </div>
                                <div class="meta-item">
                                    <div class="meta-label">
                                        <i class="bi bi-info-circle"></i> Status
                                    </div>
                                    <div class="meta-value">In Progress</div>
                                </div>
                            </div>
                            
                            <a href="/" class="content-lock-button">
                                <i class="bi bi-arrow-left"></i> Back to Home
                            </a>
                            
                            <div class="content-lock-footer">
                                <p>Thank you for your patience.</p>
                                <p>For more information, please contact our support team.</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>

        <footer class="footer">
            @section('footer')
                <p>All rights reserved. Student Management Dashboard, {{ date('Y') }}.</p>
            @show
        </footer>
    </main>
    <!-- <p id="$(title).hide()">hello</p> -->
    <script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });

        // Notification system
        function showNotification(message, type = 'success', duration = 5000) {
            // Create notification container if it doesn't exist
            let container = document.getElementById('notification-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'notification-container';
                const contentSection = document.querySelector('.content');
                if (contentSection) {
                    contentSection.insertBefore(container, contentSection.firstChild);
                }
            }
            
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            const icons = {
                success: 'bi-check-circle',
                error: 'bi-exclamation-circle',
                info: 'bi-info-circle'
            };
            
            notification.innerHTML = `
                <i class="bi ${icons[type]} notification-icon"></i>
                <span>${message}</span>
                <button class="notification-close" aria-label="Close notification">
                    <i class="bi bi-x"></i>
                </button>
            `;
            
            container.appendChild(notification);
            
            const closeBtn = notification.querySelector('.notification-close');
            closeBtn.addEventListener('click', () => {
                notification.style.animation = 'slideOutRight 0.3s ease-out forwards';
                setTimeout(() => notification.remove(), 300);
            });
            
            if (duration > 0) {
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.style.animation = 'slideOutRight 0.3s ease-out forwards';
                        setTimeout(() => notification.remove(), 300);
                    }
                }, duration);
            }
        }

 
    </script>
</body>
</html>
