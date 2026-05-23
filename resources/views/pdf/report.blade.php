<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 3px solid #3498db;
            padding-bottom: 10px;
        }
        .info {
            margin-top: 20px;
            background: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #7f8c8d;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    
    <div class="info">
        <p><strong>Generated on:</strong> {{ $date->format('Y-m-d H:i:s') }}</p>
        <p>This is your student management report.</p>
    </div>
    
    <div class="footer">
        <p>&copy; 2024 Student Management System. All rights reserved.</p>
    </div>
</body>
</html>
