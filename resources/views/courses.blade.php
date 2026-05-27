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
    flex-wrap: nowrap;
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

  .degree-section {
    margin-bottom: 3rem;
  }

  .degree-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border);
  }

  .degree-header h2 {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-main);
  }

  .degree-course-count {
    display: inline-block;
    background: #3B82F6;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius-sm);
    font-size: var(--font-size-sm);
    font-weight: 600;
  }

  .courses-grid {
    display: grid;
    gap: 1rem;
    margin-bottom: 2rem;
  }

  .course-row {
    display: grid;
    grid-template-columns: 1fr 2fr 1fr;
    gap: 1rem;
    align-items: center;
    padding: 1rem var(--spacing-lg);
    background: var(--bg-surface);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-md);
    transition: box-shadow var(--transition-normal);
  }

  .course-row:hover {
    box-shadow: var(--shadow-md);
  }

  .course-code-name {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
  }

  .course-code-name .code {
    font-weight: 700;
    color: #3B82F6;
    font-size: var(--font-size-sm);
  }

  .course-code-name .name {
    font-weight: 600;
    color: var(--text-main);
  }

  .course-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
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

  {{-- Degree-Grouped Courses Section --}}
  @if($courses->count() === 0)
    <div class="table-wrapper">
      <div class="empty">No courses found.</div>
    </div>
  @else
    @foreach($courses as $degreeName => $courseList)
      <div class="degree-section">
        <div class="degree-header">
          <h2>📚 {{ $degreeName }}</h2>
          <span class="degree-course-count">{{ count($courseList) }} {{ count($courseList) == 1 ? 'Course' : 'Courses' }}</span>
        </div>

        <div class="courses-grid">
          @foreach($courseList as $course)
            <div class="course-row">
              <div class="course-code-name">
                <div class="code">{{ $course->course_code }}</div>
                <div class="name">{{ $course->course_name }}</div>
              </div>

              <div style="text-align: center; color: var(--text-secondary);">
                {{ count($course->students) }} {{ count($course->students) == 1 ? 'Student' : 'Students' }}
              </div>

              <div class="course-actions">
                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">✏️ Edit</a>
                <form method="POST" action="{{ route('courses.destroy', $course->id) }}" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this course? Students enrolled will be removed from this course.');">🗑️ Delete</button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  @endif

</div>

@endsection
