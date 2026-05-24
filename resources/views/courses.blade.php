@extends('format.layout')

@section('title','Courses')

@section('content')
<style>
  :root {
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --radius-sm: 0.5rem;
    --radius-md: 0.75rem;
    --radius-lg: 1rem;

    --font-size-sm: 0.85rem;
    --font-size-base: 0.95rem;

    --bg-surface: #ffffff;
    --text-main: #1f2937;
    --text-secondary: #6B7280;
    --border-light: #E5E7EB;
    --border: #D1D5DB;
    --table-head: #f3f4f6;
    --table-hover: #f9fafb;

    --warning: #F59E0B;
    --danger: #EF4444;
    --success: #16A34A;
    --success-light: rgba(22, 163, 74, 0.10);

    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
    --shadow-md: 0 10px 25px rgba(0, 0, 0, 0.10);
    --transition-normal: 0.2s ease;
  }

  .courses-page {
    padding: 2rem;
    max-width: 1100px;
    margin: 0 auto;
  }

  .courses-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-lg);
  }

  .courses-title {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--text-main);
  }

  .courses-subtitle {
    margin: 0.35rem 0 0;
    color: var(--text-secondary);
    font-size: 0.95rem;
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
    font-weight: 700;
    color: var(--text-main);
    text-transform: uppercase;
    font-size: var(--font-size-sm);
    letter-spacing: 0.05em;
  }

  .modern-table td {
    padding: var(--spacing-md) var(--spacing-lg);
    vertical-align: middle;
    color: var(--text-main);
  }

  .modern-table tbody tr:hover {
    background: var(--table-hover);
  }

  .btn {
    padding: 0.45rem 0.75rem;
    border-radius: 10px;
    border: none;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    transition: all var(--transition-normal);
    font-size: var(--font-size-sm);
    line-height: 1.1;
  }

  .btn-primary {
    background: #3B82F6;
    color: #ffffff;
  }

  .btn-warning {
    background: var(--warning);
    color: #ffffff;
  }

  .btn-danger {
    background: var(--danger);
    color: #ffffff;
  }

  .alert {
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--radius-lg);
    margin-bottom: var(--spacing-lg);
    display: flex;
    gap: var(--spacing-md);
    align-items: flex-start;
    background-color: var(--success-light);
    color: var(--success);
    border: 1px solid rgba(22, 163, 74, 0.35);
  }

  .actions {
    display: inline-flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    justify-content: flex-end;
  }

  .empty {
    padding: 2rem;
    text-align: center;
    color: var(--text-secondary);
  }

  @media (max-width: 768px) {
    .courses-header {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  .filter-section {
    display: flex;
    gap: var(--spacing-md);
    align-items: center;
    margin-bottom: var(--spacing-lg);
    padding: var(--spacing-md) var(--spacing-lg);
    background: var(--bg-surface);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
  }

  .filter-section label {
    font-weight: 600;
    color: var(--text-main);
  }

  .filter-section select {
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    background-color: var(--bg-surface);
    color: var(--text-main);
    font-size: var(--font-size-base);
    cursor: pointer;
    transition: border-color var(--transition-normal);
  }

  .filter-section select:hover {
    border-color: #3B82F6;
  }

  .filter-section select:focus {
    outline: none;
    border-color: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .reset-filter {
    padding: 0.5rem 1rem;
    background: var(--text-secondary);
    color: white;
    border: none;
    border-radius: var(--radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: background var(--transition-normal);
  }

  .reset-filter:hover {
    background: var(--text-main);
  }

  .degree-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: rgba(59, 130, 246, 0.1);
    color: #3B82F6;
    border-radius: var(--radius-sm);
    font-size: var(--font-size-sm);
    font-weight: 600;
  }
</style>

<div class="courses-page">
  @if(session('success'))
    <div class="alert">
      <div>✓</div>
      <div>{{ session('success') }}</div>
    </div>
  @endif

  <div class="courses-header">
    <div>
      <h1 class="courses-title">Courses</h1>
      <p class="courses-subtitle">Admin can add, edit, and delete courses</p>
    </div>

    <a href="{{ route('courses.create') }}" class="btn btn-primary">➕ Add Course</a>
  </div>

  {{-- Degree Filter Section --}}
  <div class="filter-section">
    <label for="degree-filter">Filter by Degree:</label>
    <select id="degree-filter" onchange="filterByCourse()">
      <option value="">All Degrees</option>
      @foreach($degrees as $degree)
        <option value="{{ $degree->id }}" {{ request('degree_id') == $degree->id ? 'selected' : '' }}>
          {{ $degree->degree_title }}
        </option>
      @endforeach
    </select>
    @if(request('degree_id'))
      <a href="{{ route('courses.index') }}" class="reset-filter">✕ Reset Filter</a>
    @endif
  </div>

  <div class="table-wrapper">
    @if($courses->count() === 0)
      <div class="empty">No courses found{{ request('degree_id') ? ' for the selected degree' : '' }}.</div>
    @else
      <table class="modern-table">
        <thead>
          <tr>
            <th>Course Name</th>
            <th>Degree</th>
            <th style="text-align:right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($courses as $course)
            <tr>
              <td style="font-weight: 700;">{{ $course->course_name }}</td>
              <td>
                @if($course->degree)
                  <span class="degree-badge">{{ $course->degree->degree_title }}</span>
                @else
                  <span style="color: var(--text-secondary); font-size: var(--font-size-sm);">No degree assigned</span>
                @endif
              </td>
              <td style="text-align:right;">
                <div class="actions">
                  <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">✏️ Edit</a>

                  <form method="POST" action="{{ route('courses.destroy', $course->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this course? Students enrolled will be removed from this course.');">🗑️ Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</div>

<script>
function filterByCourse() {
  const degreeSelect = document.getElementById('degree-filter');
  const degreeId = degreeSelect.value;
  
  if (degreeId) {
    window.location.href = `{{ route('courses.index') }}?degree_id=${degreeId}`;
  } else {
    window.location.href = `{{ route('courses.index') }}`;
  }
}
</script>

@endsection
