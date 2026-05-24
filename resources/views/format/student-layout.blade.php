<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Dashboard')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .student-topbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #1e3a8a;
            color: white;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .student-brand {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: white;
            white-space: nowrap;
        }

        .student-nav {
            list-style: none;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .student-nav li {
            margin: 0;
        }

        .student-nav a {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
            display: inline-block;
            white-space: nowrap;
            text-decoration: none;
        }

        .student-nav a:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.15);
            text-decoration: none;
        }

        .student-logout {
            background-color: #dc2626 !important;
            color: white !important;
            margin-left: auto;
        }

        .student-logout:hover {
            background-color: #b91c1c !important;
            color: white !important;
        }

        .student-logout i {
            margin-right: 0.4rem;
        }

        .student-content {
            flex: 1;
            padding: 2rem 1.5rem;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <main>
        <header class="student-topbar">
            <h1 class="student-brand">Student Dashboard</h1>
            <ul class="student-nav">
                <li><a href="{{ route('student.dashboard', ['student' => $student->id]) }}"><i class="bi bi-house"></i> Dashboard</a></li>
                <li><a href="{{ route('user.logout') }}" class="student-logout"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </header>

        <section class="student-content">
            @yield('content')
        </section>
    </main>

    <!-- Notification Toast -->
    <div id="notificationToast" class="notification-toast"></div>
    <div id="flashMessages" data-success="{{ session('success') }}" data-error="{{ session('error') }}" style="display:none;"></div>

    <style>
        .notification-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 32px rgba(16, 185, 129, 0.35);
            display: none;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            font-weight: 600;
            z-index: 9999;
            animation: slideInRight 0.4s ease-out forwards;
            opacity: 0;
        }

        .notification-toast.success {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        }

        .notification-toast.success::before {
            content: '\2713';
            font-size: 20px;
            font-weight: bold;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(400px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(400px);
            }
        }

        .notification-toast.hide {
            animation: slideOutRight 0.4s ease-out forwards;
        }

        @media (max-width: 768px) {
            .notification-toast {
                top: 10px;
                right: 10px;
                left: 10px;
                margin: 0 auto;
            }
        }
    </style>

    <script>
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });

        // Show notification toast if there are session messages
        function showNotification(type, message) {
            const toast = document.getElementById('notificationToast');
            if (!toast) return;
            
            toast.textContent = message;
            toast.className = `notification-toast ${type}`;
            toast.style.display = 'flex';
            
            // Auto-hide after 4 seconds
            setTimeout(() => {
                toast.classList.add('hide');
                setTimeout(() => {
                    toast.style.display = 'none';
                    toast.classList.remove('hide');
                }, 400);
            }, 4000);
        }

        // Check for Laravel session messages
        document.addEventListener('DOMContentLoaded', function() {
            const flashEl = document.getElementById('flashMessages');
            if (!flashEl) return;

            const successMessage = flashEl.dataset.success;
            if (successMessage) {
                showNotification('success', successMessage);
            }

            const errorMessage = flashEl.dataset.error;
            if (errorMessage) {
                showNotification('error', errorMessage);
            }
        });
        

    </script>
</body>
</html>
