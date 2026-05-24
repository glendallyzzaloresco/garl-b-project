@extends('format.layout')

@section('title', 'Students - Course Management')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap');

:root {
  --navy: #1E3A8A;
  --blue: #3B82F6;
  --orange: #F97316;
  --green: #10B981;
  --red: #EF4444;
  --bg: #F8FAFC;
  --card: #FFFFFF;
  --text: #1f2937;
  --text-2: #6B7280;
  --border: #E5E7EB;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

.dashboard-container {
  padding: 2rem;
  background: var(--bg);
  min-height: calc(100vh - 100px);
}

.header-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  gap: 1rem;
}

.header-title {
  font-family: 'Playfair Display', serif;
  font-size: 2rem;
  font-weight: 700;
  color: var(--navy);
  margin: 0;
}

.header-subtitle {
  color: var(--text-2);
  font-size: 0.95rem;
}

.view-toggle {
  display: flex;
  gap: 0.5rem;
}

.toggle-btn {
  padding: 0.6rem 1.2rem;
  border: 2px solid var(--blue);
  background: transparent;
  color: var(--blue);
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
}

.toggle-btn.active {
  background: var(--blue);
  color: white;
}

.alert {
  padding: 1rem 1.5rem;
  border-radius: 10px;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1rem;
}

.alert-success {
  background: rgba(16, 185, 129, 0.1);
  border-left: 4px solid var(--green);
  color: var(--text);
}

.alert i {
  font-size: 1.2rem;
}

.table-wrapper {
  background: var(--card);
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  border: 1px solid var(--border);
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background: var(--bg);
  border-bottom: 2px solid var(--border);
}

th {
  padding: 1rem 1.5rem;
  text-align: left;
  font-weight: 700;
  color: var(--text-2);
  font-size: 0.85rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

td {
  padding: 1rem 1.5rem;
  border-bottom: 1px solid var(--border);
  color: var(--text);
}

tbody tr:hover {
  background: rgba(59, 130, 246, 0.02);
}

tbody tr:last-child td {
  border-bottom: none;
}

.student-name {
  font-weight: 600;
  color: var(--navy);
}

.courses-list {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  align-items: center;
}

.course-badge {
  background: rgba(59, 130, 246, 0.1);
  color: var(--blue);
  padding: 0.3rem 0.7rem;
  border-radius: 6px;
  font-size: 0.85rem;
  font-weight: 600;
}

.course-badge.empty {
  color: var(--text-2);
  background: transparent;
  font-style: italic;
}

.degree-badge {
  background: rgba(16, 185, 129, 0.1);
  color: var(--green);
  padding: 0.4rem 0.8rem;
  border-radius: 6px;
  font-size: 0.9rem;
  font-weight: 600;
  display: inline-block;
  max-width: fit-content;
}

.action-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 6px;
  font-size: 0.85rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
}

.btn-assign {
  background: var(--blue);
  color: white;
}

.btn-assign:hover {
  background: var(--navy);
  transform: translateY(-2px);
}

.empty-state {
  text-align: center;
  padding: 3rem 2rem;
  color: var(--text-2);
}

.empty-state i {
  font-size: 2.5rem;
  opacity: 0.5;
  margin-bottom: 1rem;
}

@media (max-width: 768px) {
  .dashboard-container {
    padding: 1rem;
  }

  .header-section {
    flex-direction: column;
    align-items: flex-start;
  }

  .header-title {
    font-size: 1.5rem;
  }

  th, td {
    padding: 0.8rem;
    font-size: 0.9rem;
  }

  .courses-list {
    max-width: 200px;
  }
}
</style>

<div class="dashboard-container">
  <div class="header-section">
    <div>
      <h1 class="header-title"><i class="bi bi-diagram-3"></i> Student Course Management</h1>
      <p class="header-subtitle">View all students and assign courses to them</p>
    </div>
    <div class="view-toggle">
      <a href="{{ route('course-students.index') }}" class="toggle-btn">
        <i class="bi bi-book"></i> By Course
      </a>
      <button class="toggle-btn active">
        <i class="bi bi-people"></i> By Student
      </button>
    </div>
  </div>

  {{-- Success/Info Messages --}}
  @if(session('success'))
    <div class="alert alert-success">
      <i class="bi bi-check-circle-fill"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  {{-- Students Table --}}
  @if($students->count() > 0)
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Degree</th>
            <th>Enrolled Courses</th>
            <th style="text-align: center;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($students as $index => $student)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td class="student-name">{{ $student->fname }} {{ $student->mname }} {{ $student->lname }}</td>
              <td>
                @if($student->degree)
                  <span class="degree-badge">{{ $student->degree->degree_title }}</span>
                @else
                  <span style="color: var(--text-2); font-size: 0.9rem;">No degree</span>
                @endif
              </td>
              <td>
                <div class="courses-list">
                  @if($student->courses->count() > 0)
                    @foreach($student->courses as $course)
                      <span class="course-badge">
                        {{ $course->course_name }}
                      </span>
                    @endforeach
                  @else
                    <span class="course-badge empty">No courses enrolled</span>
                  @endif
                </div>
              </td>
              <td style="text-align: center;">
                <a href="{{ route('course-students.assignCourses', ['student' => $student->id]) }}" class="action-btn btn-assign">
                  <i class="bi bi-plus-circle"></i> Assign Course
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
    <div class="empty-state">
      <i class="bi bi-inbox"></i>
      <p>No students available.</p>
    </div>
  @endif
</div>

@endsection
