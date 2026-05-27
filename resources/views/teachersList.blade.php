@extends('format.layout')

@section('title','Teachers Management')

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

  .teachers-page {
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
    margin-bottom: var(--spacing-lg);
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
    font-size: 0.85rem;
  }

  .modern-table thead {
    background-color: var(--table-head);
    border-bottom: 2px solid var(--border);
  }

  .modern-table th {
    padding: 0.5rem 0.75rem;
    text-align: left;
    font-weight: 600;
    color: var(--text-main);
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.03em;
  }

  .modern-table th:nth-child(1) { width: 5%; }
  .modern-table th:nth-child(2) { width: 15%; }
  .modern-table th:nth-child(3) { width: 15%; }
  .modern-table th:nth-child(4) { width: 12%; }
  .modern-table th:nth-child(5) { width: 18%; }
  .modern-table th:nth-child(6) { width: 10%; }
  .modern-table th:nth-child(7) { width: 25%; }

  .modern-table tbody tr {
    border-bottom: 1px solid var(--border-light);
    transition: background-color var(--transition-fast);
  }

  .modern-table tbody tr:hover {
    background-color: var(--table-hover);
  }

  .modern-table td {
    padding: 0.6rem 0.75rem;
    vertical-align: middle;
    color: var(--text-main);
  }

  .avatar {
    width: 32px;
    height: 32px;
    border-radius: var(--radius-md);
    background: linear-gradient(135deg, #3B82F6, #2563EB);
    color: white;
    font-size: 0.75rem;
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
    gap: 0.5rem;
  }

  .name-info p {
    margin: 0;
  }

  .name-info .full-name {
    font-weight: 600;
    color: var(--text-main);
    font-size: 0.9rem;
  }

  .name-info .middle-name {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-top: 2px;
  }

  .badge {
    display: inline-block;
    padding: 3px 6px;
    background-color: rgba(59, 130, 246, 0.1);
    color: #3B82F6;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
  }

  .badge-green {
    background-color: rgba(34, 197, 94, 0.1);
    color: #16a34a;
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    display: inline-block;
  }

  .action-cell {
    display: flex;
    gap: 4px;
    justify-content: flex-end;
    flex-wrap: nowrap;
  }

  .btn {
    padding: 5px 10px;
    font-size: 0.8rem;
    border-radius: var(--radius-md);
    transition: all var(--transition-normal);
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    white-space: nowrap;
  }

  .btn-label {
    display: inline;
  }

  .btn-sm {
    padding: 6px 12px;
    font-size: var(--font-size-sm);
  }

  .btn-primary {
    background-color: #3B82F6;
    color: white;
  }

  .btn-primary:hover {
    background-color: #2563EB;
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
    border-color: #F97316;
    box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
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

    .action-cell {
      flex-direction: row;
      gap: 3px;
    }

    .action-cell .btn {
      padding: 4px 6px;
      gap: 2px;
    }

    .btn-label {
      display: none;
    }

    .modern-table th:nth-child(5),
    .modern-table td:nth-child(5) {
      display: none;
    }
  }

  @media (max-width: 1024px) {
    .modern-table {
      font-size: 0.8rem;
    }

    .btn {
      padding: 4px 8px;
      font-size: 0.75rem;
    }

    .action-cell {
      gap: 3px;
    }
  }
</style>

<div class="teachers-page">
<div class="page-header">
  <div>
    Welcome, {{ $logged_role }}!<br>
    <h1>Teacher Management</h1>
    <p class="text-secondary">{{ $teachers->total() }} total teachers</p>
  </div>
  <a href="/teachers/create" class="btn btn-primary">➕ Add Teacher</a>
</div>

@if(session('success') || session('messages'))
  <div class="alert alert-success" id="success-alert">
    <i class="bi bi-check-circle"></i>
    <div class="alert-content">
      {{ session('success') ?? session('messages') }}
    </div>
  </div>
@endif

<div class="search-box">
  <svg class="search-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
    <circle cx="6.5" cy="6.5" r="4.5" stroke="currentColor" stroke-width="1.4"/>
    <path d="M10 10l3.5 3.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
  </svg>
  <input type="text" placeholder="Search by name or email…" id="search-input" class="form-control" />
</div>

<div class="table-wrapper">
  <table class="modern-table">
    <thead>
      <tr>
        <th width="50">#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Assigned Course</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="table-body">
      @forelse($teachers as $teacher)
        <tr>
          <td>{{ $teachers->firstItem() + $loop->index }}</td>
          <td>
            <div class="name-cell">
              <div class="avatar">{{ strtoupper(substr($teacher->fname, 0, 1)) }}</div>
              <div class="name-info">
                <p class="full-name">{{ trim($teacher->fname . ' ' . ($teacher->mname ?? '') . ' ' . $teacher->lname) }}</p>
                <p class="middle-name">ID: {{ $teacher->id }}</p>
              </div>
            </div>
          </td>
          <td>{{ $teacher->email }}</td>
          <td>{{ $teacher->phone ?: 'N/A' }}</td>
          <td>
            @php
              $assignedCourse = \App\Models\Course::where('teacher_id', $teacher->id)->first();
            @endphp
            @if($assignedCourse)
              <span style="color: #3B82F6; font-weight: 600;">{{ $assignedCourse->course_code }} - {{ $assignedCourse->course_name }}</span>
            @else
              <span style="color: #9CA3AF;">No course assigned</span>
            @endif
          </td>
          <td><span class="badge">👨‍🏫 Teacher</span></td>
          <td>
            <div class="action-cell">
              <a href="/teachers/{{ $teacher->id }}" class="btn btn-primary" title="View Teacher">
                <i class="bi bi-eye"></i> <span class="btn-label">View</span>
              </a>
              <a href="/teachers/{{ $teacher->id }}/edit" class="btn btn-warning" title="Edit Teacher">
                <i class="bi bi-pencil"></i> <span class="btn-label">Edit</span>
              </a>
              <button type="button" class="btn btn-danger js-delete-teacher" data-teacher-id="{{ $teacher->id }}" title="Delete Teacher">
                <i class="bi bi-trash"></i> <span class="btn-label">Delete</span>
              </button>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-secondary);">
            No teachers found.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

@if($teachers->hasPages())
  <div class="pagination-wrapper">
    <span class="pagination-info">
      Showing {{ $teachers->firstItem() }}–{{ $teachers->lastItem() }} of {{ $teachers->total() }} teachers
    </span>
    <div>
      {{ $teachers->links() }}
    </div>
  </div>
@endif

<script>
// Variable to store the current data hash for comparison
let teacherDataHash = null;

// Function to reload teacher list (called only after update/add/delete)
function reloadTeacherList() {
    $.ajax({
        url: '/teachers/list-data',
        type: 'GET',
        success: function(response) {
            $('#table-body').html(response);
            teacherDataHash = hashCode(response);
        },
        error: function(xhr, status, error) {
            console.log('Error fetching teacher data:', error);
        }
    });
}

// Cross-tab sync: refresh immediately when another tab broadcasts a teacher change.
$(function () {
  $(window).on('storage', function (e) {
    const evt = e.originalEvent;
    if (!evt || evt.key !== 'sync:teachers') return;
    reloadTeacherList();
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
        url: '/teachers/list-data',
        type: 'GET',
        success: function(response) {
            const newHash = hashCode(response);
            if (teacherDataHash === null || teacherDataHash !== newHash) {
                $('#table-body').html(response);
                teacherDataHash = newHash;
            }
        },
        error: function(xhr, status, error) {
            console.log('Error checking for teacher updates:', error);
        }
    });
}, 3000);

// Delegated handler so it works after AJAX refreshes
document.addEventListener('click', function (event) {
  const button = event.target.closest('.js-delete-teacher');
  if (!button) return;
  if (typeof deleteTeacher !== 'function') return;

  const teacherId = button.getAttribute('data-teacher-id');
  if (!teacherId) return;
  deleteTeacher(teacherId);
});
</script>

</div>

@endsection
