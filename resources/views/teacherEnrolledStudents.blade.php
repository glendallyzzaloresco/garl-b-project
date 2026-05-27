@extends('format.teacher-layout')

@section('title', 'Enrolled Students')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap');

  :root {
    --navy: #1E3A8A;
    --blue: #3B82F6;
    --orange: #F97316;
    --green: #10B981;
    --purple: #8B5CF6;
    --red: #EF4444;
    --bg: #F8FAFC;
    --card: #FFFFFF;
    --text: #1f2937;
    --text-2: #6B7280;
    --border: #E5E7EB;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  .page-container {
    padding: 2rem;
    background: var(--bg);
    min-height: calc(100vh - 100px);
  }

  .header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
  }

  .header-section h1 {
    font-size: 2rem;
    color: var(--text);
    font-weight: 700;
    font-family: 'Playfair Display', serif;
  }

  .back-btn {
    background: var(--blue);
    color: white;
    padding: 0.6rem 1.2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
  }

  .back-btn:hover {
    background: var(--navy);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);
  }

  .course-info {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border-left: 4px solid var(--orange);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .course-info h3 {
    color: var(--text);
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
  }

  .course-code {
    color: var(--orange);
    font-weight: 600;
    font-size: 1rem;
  }

  .course-name {
    color: var(--text-2);
    font-size: 0.95rem;
    margin-bottom: 1rem;
  }

  .student-count {
    background: rgba(59, 130, 246, 0.1);
    color: var(--blue);
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    display: inline-block;
  }

  .table-section {
    background: var(--card);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .table-section h3 {
    color: var(--text);
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
  }

  .students-table {
    width: 100%;
    border-collapse: collapse;
  }

  .students-table thead {
    background: linear-gradient(135deg, var(--blue) 0%, var(--navy) 100%);
    color: white;
  }

  .students-table thead th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
  }

  .students-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background-color 0.2s ease;
  }

  .students-table tbody tr:hover {
    background-color: rgba(59, 130, 246, 0.05);
  }

  .students-table tbody td {
    padding: 1.2rem 1rem;
    color: var(--text);
    font-size: 0.95rem;
  }

  .student-name {
    font-weight: 500;
    color: var(--text);
  }

  .student-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--border);
  }

  .avatar-cell {
    display: flex;
    align-items: center;
    gap: 0.8rem;
  }

  .empty-state {
    text-align: center;
    padding: 3rem 1.5rem;
    color: var(--text-2);
  }

  .empty-state-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
  }

  .empty-state-text {
    font-size: 1.1rem;
    font-weight: 500;
  }

  .badge {
    display: inline-block;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
  }

  .badge-primary {
    background: rgba(59, 130, 246, 0.2);
    color: var(--blue);
  }

  .badge-success {
    background: rgba(16, 185, 129, 0.2);
    color: var(--green);
  }

  .action-button {
    background: var(--blue);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.3s ease;
  }

  .action-button:hover {
    background: var(--navy);
    transform: translateY(-2px);
  }

  @media (max-width: 768px) {
    .page-container {
      padding: 1rem;
    }

    .students-table {
      font-size: 0.85rem;
    }

    .students-table thead th,
    .students-table tbody td {
      padding: 0.8rem 0.5rem;
    }

    .header-section {
      flex-direction: column;
      gap: 1rem;
    }

    .header-section h1 {
      font-size: 1.5rem;
    }
  }
</style>

<div class="page-container">
  <div class="header-section">
    <h1>📚 Enrolled Students</h1>
    <a href="/teacher" class="back-btn">← Back to Dashboard</a>
  </div>

  @if(isset($courses) && $courses->count() > 0)
    @foreach($courses as $course)
      <div class="course-info">
        <h3>
          <span class="course-code">{{ $course->course_code }}</span> - {{ $course->course_name }}
        </h3>
        <div style="margin-top: 1rem;">
          <span class="student-count">👥 {{ $course->students->count() }} Student{{ $course->students->count() !== 1 ? 's' : '' }} Enrolled</span>
        </div>
      </div>

      <div class="table-section">
        <h3>📋 Student List</h3>
        @if($course->students->count() > 0)
          <table class="students-table">
            <thead>
              <tr>
                <th style="width: 5%">#</th>
                <th style="width: 20%">Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 15%">Contact</th>
                <th style="width: 15%">Degree</th>
                <th style="width: 15%">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($course->students as $index => $student)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>
                    <div class="avatar-cell">
                      @if(!empty($student->avatar))
                        <img src="{{ asset($student->avatar) }}" alt="Student avatar" class="student-avatar">
                      @else
                        <div class="student-avatar" style="background: linear-gradient(135deg, var(--blue), var(--purple)); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                          {{ strtoupper(substr($student->fname, 0, 1)) }}
                        </div>
                      @endif
                      <span class="student-name">{{ $student->fname }} {{ $student->mname ?? '' }} {{ $student->lname }}</span>
                    </div>
                  </td>
                  <td>
                    {{ $student->userAccount->email ?? 'N/A' }}
                  </td>
                  <td>
                    {{ $student->contactInfo ?? 'N/A' }}
                  </td>
                  <td>
                    <span class="badge badge-primary">{{ $student->degree->degree_name ?? 'N/A' }}</span>
                  </td>
                  <td>
                    <span class="badge badge-success">✓ Active</span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <div class="empty-state">
            <div class="empty-state-icon">📭</div>
            <div class="empty-state-text">No students enrolled in this course yet</div>
          </div>
        @endif
      </div>
    @endforeach
  @else
    <div class="table-section">
      <div class="empty-state">
        <div class="empty-state-icon">🎓</div>
        <div class="empty-state-text">No courses assigned to you yet</div>
        <a href="/teacher" class="back-btn" style="margin-top: 1.5rem; display: inline-block;">← Back to Dashboard</a>
      </div>
    </div>
  @endif
</div>

<script>
  // Scroll to top on page load
  window.scrollTo(0, 0);
</script>

@endsection
