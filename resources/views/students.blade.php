@extends('format.layout')

@section('title','Students Management')

@section('content')

<style>
  :root {
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --radius-sm: 0.5rem;
    --radius-md: 0.75rem;
    --radius-lg: 1rem;

    --font-serif: 'Playfair Display', serif;
    --font-sans: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;

    --font-size-sm: 0.85rem;
    --font-size-base: 0.95rem;
    --font-size-2xl: 1.5rem;
    --font-size-3xl: 2rem;

    --bg-surface: #ffffff;
    --text-main: #1f2937;
    --text-secondary: #6B7280;
    --border-light: #E5E7EB;
    --border: #D1D5DB;
    --table-head: #f3f4f6;
    --table-hover: #f9fafb;

    --primary: #3B82F6;
    --primary-hover: #2563EB;
    --primary-light: rgba(59, 130, 246, 0.18);
    --info: #2563EB;
    --info-light: rgba(37, 99, 235, 0.12);
    --warning: #F59E0B;
    --danger: #EF4444;
    --danger-light: rgba(239, 68, 68, 0.10);
    --success: #16A34A;
    --success-light: rgba(22, 163, 74, 0.10);

    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
    --shadow-md: 0 10px 25px rgba(0, 0, 0, 0.10);
    --transition-fast: 0.15s ease;
    --transition-normal: 0.2s ease;
  }

  .students-page {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
  }

  .page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--spacing-lg);
    flex-wrap: wrap;
    gap: var(--spacing-md);
    padding: var(--spacing-lg);
    border-radius: var(--radius-lg);
    background: linear-gradient(135deg, #3B82F6, #2563EB);
    border: 1px solid var(--border-light);
    box-shadow: var(--shadow-md);
  }

  .page-header h1 {
    margin: 0;
    font-family: var(--font-serif);
    font-size: var(--font-size-3xl);
    font-weight: 700;
    color: white;
    letter-spacing: -0.02em;
  }

  .page-header > div:first-child {
    flex: 1;
    color: white;
  }
  
  .page-header .text-secondary {
    font-size: var(--font-size-base);
    color: rgba(255, 255, 255, 0.9);
    margin-top: 0.5rem;
    font-weight: 500;
  }

  .page-header .btn-primary {
    background-color: white;
    color: #3B82F6;
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--radius-md);
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    transition: all var(--transition-normal);
    border: none;
    cursor: pointer;
  }

  .page-header .btn-primary:hover {
    background-color: rgba(255, 255, 255, 0.9);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }

  .search-box {
    position: relative;
    max-width: 400px;
    width: 100%;
  }

  .toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-lg);
    flex-wrap: wrap;
  }

  .toolbar .search-box {
    margin-bottom: 0;
    flex: 1;
    min-width: 260px;
  }

  .toolbar-actions {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
  }

  .search-box input {
    width: 100%;
    padding: var(--spacing-md) var(--spacing-md) var(--spacing-md) var(--spacing-lg);
    padding-left: 2.5rem;
    border-radius: var(--radius-md);
    border: 1.5px solid var(--border-light);
    transition: all var(--transition-normal);
    font-size: var(--font-size-base);
    background-color: var(--bg-surface);
  }
  
  .search-box input:focus {
    outline: none;
    border-color: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .search-icon {
    position: absolute;
    left: var(--spacing-md);
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
    pointer-events: none;
  }

  .table-wrapper {
    background: var(--bg-surface);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
  }

  .modern-table {
    width: 100%;
    border-collapse: collapse;
    font-size: var(--font-size-base);
  }

  .modern-table thead {
    background-color: var(--table-head);
    border-bottom: 2px solid var(--border);
  }

  .modern-table th {
    padding: var(--spacing-md) var(--spacing-lg);
    text-align: left;
    font-weight: 600;
    color: var(--text-main);
    text-transform: uppercase;
    font-size: var(--font-size-sm);
    letter-spacing: 0.03em;
  }

  .modern-table tbody tr {
    border-bottom: 1px solid var(--border-light);
    transition: background-color var(--transition-fast);
  }

  .modern-table tbody tr:hover {
    background-color: var(--table-hover);
  }

  .modern-table td {
    padding: 1rem 1.5rem;
    vertical-align: middle;
    color: var(--text-main);
  }

  .avatar {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-md);
    background: linear-gradient(135deg, #3B82F6, #2563EB);
    color: white;
    font-size: var(--font-size-sm);
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: var(--shadow-sm);
  }

  .name-cell {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
  }

  .name-info p {
    margin: 0;
  }

  .name-info .full-name {
    font-weight: 600;
    color: var(--text-main);
    font-size: var(--font-size-base);
  }

  .name-info .middle-name {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
    margin-top: 4px;
  }

  .badge {
    display: inline-block;
    padding: 4px 8px;
    background-color: var(--info-light);
    color: var(--info);
    border-radius: var(--radius-sm);
    font-size: var(--font-size-sm);
    font-weight: 600;
  }

  .action-cell {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    flex-wrap: nowrap;
    align-items: center;
  }

  .btn {
    padding: 8px 14px;
    font-size: var(--font-size-sm);
    border-radius: var(--radius-md);
    transition: all var(--transition-normal);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    white-space: nowrap;
  }

  .btn-sm {
    padding: 6px 12px;
    font-size: var(--font-size-sm);
  }

  .btn-primary {
    background-color: var(--primary);
    color: white;
  }

  .btn-primary:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }

  .btn-warning {
    background-color: var(--warning);
    color: white;
  }

  .btn-warning:hover {
    background-color: #d4a83f;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }

  .btn-danger {
    background-color: var(--danger);
    color: white;
  }

  .btn-danger:hover {
    background-color: #c56868;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }

  .btn-secondary {
    background-color: var(--text-secondary);
    color: white;
  }

  .btn-secondary:hover {
    background-color: var(--text-main);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }

  .btn-success {
    background-color: var(--success);
    color: white;
  }

  .btn-success:hover {
    background-color: #15803d;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
  }

  .pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--spacing-lg);
    padding-top: var(--spacing-lg);
    border-top: 1px solid var(--border-light);
    flex-wrap: wrap;
    gap: var(--spacing-md);
  }

  .pagination-info {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
    font-weight: 500;
  }

  .alert {
    padding: var(--spacing-lg);
    border-radius: var(--radius-lg);
    margin-bottom: var(--spacing-lg);
    display: flex;
    gap: var(--spacing-md);
    align-items: flex-start;
  }

  .alert-success {
    background-color: var(--success-light);
    color: var(--success);
    border: 1px solid var(--success);
  }

  .alert-danger {
    background-color: var(--danger-light);
    color: var(--danger);
    border: 1px solid var(--danger);
  }

  .form-control {
    width: 100%;
    padding: var(--spacing-md);
    border: 1.5px solid var(--border-light);
    border-radius: var(--radius-md);
    font-size: var(--font-size-base);
    font-family: var(--font-sans);
    transition: all var(--transition-normal);
    background-color: var(--bg-surface);
    color: var(--text-main);
  }

  .form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px var(--primary-light);
  }

  @media (max-width: 768px) {
    .page-header {
      flex-direction: column;
    }
    
    .page-header h1 {
      font-size: var(--font-size-2xl);
    }

    .page-header .btn-primary {
      width: 100%;
      justify-content: center;
    }

    .toolbar-actions {
      width: 100%;
    }

    .toolbar-actions .btn {
      width: 100%;
      justify-content: center;
    }

    .action-cell {
      flex-direction: column;
    }

    .action-cell .btn {
      width: 100%;
    }
  }
</style>

<div class="students-page">
<div class="page-header">
  <div>
    Welcome, {{ $logged_role }}!<br>
    <h1>Student Management</h1>
    <p class="text-secondary">{{ method_exists($students, 'total') ? $students->total() : $students->count() }} total students</p>
  </div>

  <div>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Add Student
    </a>
  </div>
 
</div>

@if(session('success') || session('messages'))
  <div class="alert alert-success" id="success-alert">
    <i class="bi bi-check-circle"></i>
    <div class="alert-content">
      {{ session('success') ?? session('messages') }}
    </div>
  </div>
@endif

<div class="toolbar">
  <div class="search-box">
    <svg class="search-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
      <circle cx="6.5" cy="6.5" r="4.5" stroke="currentColor" stroke-width="1.4"/>
      <path d="M10 10l3.5 3.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
    </svg>
    <input type="text" placeholder="Search by name, email, or degree…" id="search-input" class="form-control" />
  </div>

  <div class="toolbar-actions">
    <a href="/export-students" class="btn btn-success btn-sm">
      <i class="bi bi-file-earmark-excel"></i> Export Excel
    </a>
    <a href="{{ route('exportStudentsPDF') }}" class="btn btn-secondary btn-sm">
      <i class="bi bi-file-earmark-pdf"></i> Export PDF
    </a>
  </div>
</div>

<div class="table-wrapper">
  <table class="modern-table">
    <thead>
      <tr>
        <th width="50">#</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Degree Program</th>
        <th width="200">Actions</th>
      </tr>
    </thead>
    <tbody id="table-body">
      @include('studentList')
    </tbody>
  </table>
</div>

@if(method_exists($students, 'hasPages') && $students->hasPages())
  <div class="pagination-wrapper">
    <span class="pagination-info">
      Showing {{ $students->firstItem() }}–{{ $students->lastItem() }} of {{ $students->total() }} students
    </span>
    <div>
      {{ $students->links() }}
    </div>
  </div>
@endif

<script>
// Variable to store the current data hash for comparison
let studentDataHash = null;

// Function to reload student list (called only after update/add/delete)
function reloadStudentList() {
    $.ajax({
        url: '/students/list-data',
        type: 'GET',
        success: function(response) {
            $('#table-body').html(response);
            studentDataHash = hashCode(response);
        },
        error: function(xhr, status, error) {
            console.log('Error fetching student data:', error);
        }
    });
}

// Cross-tab sync: refresh immediately when another tab broadcasts a student change.
$(function () {
  $(window).on('storage', function (e) {
    const evt = e.originalEvent;
    if (!evt || evt.key !== 'sync:students') return;
    reloadStudentList();
  });
});

// Simple hash function to detect data changes
function hashCode(str) {
    let hash = 0;
    for (let i = 0; i < str.length; i++) {
        const char = str.charCodeAt(i);
        hash = ((hash << 5) - hash) + char;
        hash = hash & hash;
    }
    return hash.toString();
}

// Auto-reload when data changes (from other browser/user actions)
setInterval(function() {
    $.ajax({
        url: '/students/list-data',
        type: 'GET',
        success: function(response) {
            const newHash = hashCode(response);
            if (studentDataHash === null || studentDataHash !== newHash) {
                $('#table-body').html(response);
                studentDataHash = newHash;
            }
        },
        error: function(xhr, status, error) {
            console.log('Error checking for student updates:', error);
        }
    });
}, 3000);

// Delegated handler so it works after AJAX refreshes
document.addEventListener('click', function (event) {
  const button = event.target.closest('.js-delete-student');
  if (!button) return;
  if (typeof deleteStudent !== 'function') return;

  const studentId = button.getAttribute('data-student-id');
  if (!studentId) return;
  deleteStudent(studentId);
});
</script>

</div>

@endsection





