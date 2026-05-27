@extends('format.layout')

@section('title', 'Manage Course: ' . $course->course_code . ' - ' . $course->course_name)

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

.back-link {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  color: var(--blue);
  text-decoration: none;
  margin-bottom: 1.5rem;
  font-weight: 600;
  transition: gap 0.2s ease;
}

.back-link:hover {
  gap: 1rem;
}

.header-section {
  background: white;
  padding: 2rem;
  border-radius: 14px;
  margin-bottom: 2rem;
  border-left: 4px solid var(--blue);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.header-section h1 {
  font-family: 'Playfair Display', serif;
  font-size: 2rem;
  color: var(--navy);
  margin-bottom: 0.5rem;
}

.course-meta {
  display: flex;
  gap: 2rem;
  margin-top: 1rem;
  flex-wrap: wrap;
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: var(--text-2);
}

.meta-item strong {
  color: var(--text);
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

.alert-info {
  background: rgba(59, 130, 246, 0.1);
  border-left: 4px solid var(--blue);
  color: var(--text);
}

.alert i {
  font-size: 1.2rem;
}

.tabs {
  display: flex;
  gap: 0;
  border-bottom: 2px solid var(--border);
  margin-bottom: 2rem;
}

.tab-btn {
  padding: 1rem 1.5rem;
  background: none;
  border: none;
  font-size: 1rem;
  font-weight: 600;
  color: var(--text-2);
  cursor: pointer;
  position: relative;
  transition: color 0.2s ease;
}

.tab-btn:hover {
  color: var(--blue);
}

.tab-btn.active {
  color: var(--blue);
}

.tab-btn.active::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  right: 0;
  height: 2px;
  background: var(--blue);
}

.tab-content {
  display: none;
}

.tab-content.active {
  display: block;
}

.section-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--text);
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
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

.student-email {
  color: var(--text-2);
  font-size: 0.9rem;
}

.action-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  padding: 0.4rem 0.8rem;
  border: none;
  border-radius: 6px;
  font-size: 0.85rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
}

.btn-remove {
  background: rgba(239, 68, 68, 0.1);
  color: var(--red);
}

.btn-remove:hover {
  background: var(--red);
  color: white;
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

.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 600;
  color: var(--text);
}

.form-group input,
.form-group select {
  width: 100%;
  padding: 0.7rem 1rem;
  border: 1px solid var(--border);
  border-radius: 8px;
  font-size: 0.95rem;
  font-family: inherit;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-group input:focus,
.form-group select:focus {
  outline: none;
  border-color: var(--blue);
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.assign-form {
  background: var(--card);
  padding: 2rem;
  border-radius: 14px;
  border: 1px solid var(--border);
  margin-bottom: 2rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.form-row {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 1rem;
  align-items: flex-end;
}

.btn-submit {
  padding: 0.7rem 1.5rem;
  background: var(--blue);
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  white-space: nowrap;
}

.btn-submit:hover {
  background: var(--navy);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);
}

.student-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 8px;
  margin-bottom: 0.8rem;
}

.student-info {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex: 1;
}

.student-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: var(--blue);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 700;
  font-size: 0.9rem;
}

.student-details {
  flex: 1;
}

.student-details-name {
  font-weight: 600;
  color: var(--text);
  margin-bottom: 0.2rem;
}

.student-details-email {
  font-size: 0.85rem;
  color: var(--text-2);
}

.checkbox-wrapper {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

input[type="checkbox"] {
  width: 1.2rem;
  height: 1.2rem;
  cursor: pointer;
}

.unassigned-list {
  max-height: 500px;
  overflow-y: auto;
}

@media (max-width: 768px) {
  .dashboard-container {
    padding: 1rem;
  }

  .header-section {
    padding: 1.5rem;
  }

  .header-section h1 {
    font-size: 1.5rem;
  }

  .course-meta {
    gap: 1rem;
    flex-direction: column;
  }

  .form-row {
    grid-template-columns: 1fr;
  }

  .tabs {
    gap: 0;
    overflow-x: auto;
  }

  .tab-btn {
    padding: 0.8rem 1rem;
    font-size: 0.9rem;
  }

  table {
    font-size: 0.9rem;
  }

  th, td {
    padding: 0.8rem;
  }
}
</style>

<div class="dashboard-container">
  <a href="{{ route('course-students.index') }}" class="back-link">
    <i class="bi bi-arrow-left"></i> Back to Courses
  </a>

  {{-- Header Section --}}
  <div class="header-section">
    <h1><i class="bi bi-book"></i> {{ $course->course_code }} - {{ $course->course_name }}</h1>
    <div class="course-meta">
      <div class="meta-item">
        <strong>Total Students Enrolled:</strong>
        <span class="student-count">{{ $enrolledStudents->count() }}</span>
      </div>
      @if($course->teacher)
        <div class="meta-item">
          <strong>Instructor:</strong>
          <span>{{ $course->teacher->fname }} {{ $course->teacher->lname }}</span>
        </div>
      @endif
    </div>
  </div>

  {{-- Success/Info Messages --}}
  @if(session('success'))
    <div class="alert alert-success">
      <i class="bi bi-check-circle-fill"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  @if(session('info'))
    <div class="alert alert-info">
      <i class="bi bi-info-circle"></i>
      <span>{{ session('info') }}</span>
    </div>
  @endif

  {{-- Tabs --}}
  <div class="tabs">
    <button class="tab-btn active" onclick="switchTab(event, 'enrolled')">
      <i class="bi bi-check-circle"></i> Enrolled Students ({{ $enrolledStudents->count() }})
    </button>
    <button class="tab-btn" onclick="switchTab(event, 'assign')">
      <i class="bi bi-plus-circle"></i> Assign Students
    </button>
  </div>

  {{-- Tab 1: Enrolled Students --}}
  <div id="enrolled" class="tab-content active">
    <div class="section-title">
      <i class="bi bi-people-fill"></i> Currently Enrolled Students
    </div>

    @if($enrolledStudents->count() > 0)
      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($enrolledStudents as $index => $student)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td class="student-name">{{ $student->fname }} {{ $student->mname }} {{ $student->lname }}</td>
                <td class="student-email">{{ $student->email }}</td>
                <td>{{ $student->contactInfo ?? 'N/A' }}</td>
                <td>
                  <form action="{{ route('course-students.unassign', ['course' => $course->id, 'student' => $student->id]) }}" 
                        method="POST" 
                        style="display: inline;"
                        onsubmit="return confirm('Remove this student from the course?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn btn-remove">
                      <i class="bi bi-trash"></i> Remove
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <p>No students enrolled in this course yet.</p>
      </div>
    @endif
  </div>

  {{-- Tab 2: Assign Students --}}
  <div id="assign" class="tab-content">
    <div class="section-title">
      <i class="bi bi-plus-circle"></i> Add Students to Course
    </div>

    {{-- Get unassigned students --}}
    @php
      $unassignedStudents = $allStudents->reject(function($student) use ($enrolledStudentIds) {
        return in_array($student->id, $enrolledStudentIds);
      });
    @endphp

    @if($unassignedStudents->count() > 0)
      <div class="assign-form">
        <h3 style="margin-bottom: 1.5rem; color: var(--text);">
          <i class="bi bi-hand-index"></i> Select Students to Enroll
        </h3>

        <form action="{{ route('course-students.bulkAssign', ['course' => $course->id]) }}" method="POST">
          @csrf

          <div class="unassigned-list">
            @foreach($unassignedStudents as $student)
              <div class="student-item">
                <div class="student-info">
                  <div class="student-avatar">
                    {{ strtoupper(substr($student->fname, 0, 1)) }}{{ strtoupper(substr($student->lname, 0, 1)) }}
                  </div>
                  <div class="student-details">
                    <div class="student-details-name">
                      {{ $student->fname }} {{ $student->mname }} {{ $student->lname }}
                    </div>
                    <div class="student-details-email">
                      {{ $student->email }}
                    </div>
                  </div>
                </div>
                <div class="checkbox-wrapper">
                  <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" id="student-{{ $student->id }}">
                </div>
              </div>
            @endforeach
          </div>

          <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
            <button type="submit" class="btn-submit">
              <i class="bi bi-check-circle"></i> Assign Selected Students
            </button>
            <button type="button" class="btn-submit" style="background: var(--text-2);" onclick="toggleAllCheckboxes()">
              <i class="bi bi-check2-all"></i> Select All
            </button>
          </div>
        </form>
      </div>
    @else
      <div class="empty-state">
        <i class="bi bi-check-circle"></i>
        <p>All students are already enrolled in this course!</p>
      </div>
    @endif
  </div>
</div>

<script>
function switchTab(e, tabName) {
  e.preventDefault();
  
  // Hide all tabs
  const tabs = document.querySelectorAll('.tab-content');
  tabs.forEach(tab => tab.classList.remove('active'));
  
  // Remove active class from all buttons
  const buttons = document.querySelectorAll('.tab-btn');
  buttons.forEach(btn => btn.classList.remove('active'));
  
  // Show selected tab
  document.getElementById(tabName).classList.add('active');
  e.target.closest('.tab-btn').classList.add('active');
}

function toggleAllCheckboxes() {
  const checkboxes = document.querySelectorAll('input[name="student_ids[]"]');
  const allChecked = Array.from(checkboxes).every(cb => cb.checked);
  checkboxes.forEach(cb => cb.checked = !allChecked);
}
</script>

@endsection
