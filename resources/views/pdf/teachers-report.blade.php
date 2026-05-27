<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9fafb;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #3b82f6;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #1f2937;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #6b7280;
            margin: 10px 0 0 0;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }
        table thead {
            background-color: #3b82f6;
            color: white;
        }
        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #e5e7eb;
        }
        table td {
            padding: 12px;
            border: 1px solid #e5e7eb;
            color: #374151;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        table tbody tr:hover {
            background-color: #f3f4f6;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }
        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Generated on {{ $date->format('F d, Y \a\t H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teachers as $index => $teacher)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $teacher->f_name }}</td>
                    <td>{{ $teacher->m_name ?? 'N/A' }}</td>
                    <td>{{ $teacher->l_name }}</td>
                    <td>{{ $teacher->userAccount->email ?? 'N/A' }}</td>
                    <td>{{ $teacher->phone ?? 'N/A' }}</td>
                    <td>
                        <span class="status-badge {{ $teacher->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $teacher->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #9ca3af;">No teachers found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>© 2026 Learning Management System. All rights reserved.</p>
    </div>
</body>
</html>
