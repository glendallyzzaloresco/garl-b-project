@extends('format.layout')

@section('title', 'Assign Courses - ' . $student->fname . ' ' . $student->lname)

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
  margin-bottom: 1rem;
}

.student-meta {
  display: flex;
  gap: 2rem;
  flex-wrap: wrap;
  margin-top: 1rem;
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

.section-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--text);
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.form-section {
  background: var(--card);
  padding: 2rem;
  border-radius: 14px;
  border: 1px solid var(--border);
  margin-bottom: 2rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.course-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 8px;
  margin-bottom: 0.8rem;
}

.course-info {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex: 1;
}

.course-icon {
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

.course-details {
  flex: 1;
}

.course-details-name {
  font-weight: 600;
  color: var(--text);
  margin-bottom: 0.2rem;
}

.course-details-degree {
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

.courses-list {
  max-height: 500px;
  overflow-y: auto;
}

.form-actions {
  display: flex;
  gap: 1rem;
  margin-top: 1.5rem;
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
}

.btn-submit:hover {
  background: var(--navy);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);
}

.btn-submit.secondary {
  background: var(--text-2);
}

.btn-submit.secondary:hover {
  background: var(--text);
}

.empty-state {
  text-align: center;
  padding: 2rem;
  color: var(--text-2);
  border: 2px dashed var(--border);
  border-radius: 8px;
}

.empty-state i {
  font-size: 2rem;
  opacity: 0.5;
  margin-bottom: 0.5rem;
}

.alert {
  padding: 1rem 1.5rem;
  border-radius: 10px;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 1rem;
}

.alert-info {
  background: rgba(59, 130, 246, 0.1);
  border-left: 4px solid var(--blue);
  color: var(--text);
}

.alert i {
  font-size: 1.2rem;
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

  .student-meta {
    gap: 1rem;
    flex-direction: column;
  }

  .course-item {
    flex-direction: column;
    align-items: flex-start;
  }

  .checkbox-wrapper {
    align-self: flex-start;
  }
}
</style>

<div class="dashboard-container">
  <a href="{{ route('course-students.studentsList') }}" class="back-link">
    <i class="bi bi-arrow-left"></i> Back to Students
  </a>

  {{-- Header Section --}}
  <div class="header-section">
    <h1><i class="bi bi-person-check"></i> Assign Courses</h1>
    <p style="color: var(--text-2); margin: 0;">Assign courses to: <strong>{{ $student->fname }} {{ $student->mname }} {{ $student->lname }}</strong></p>
    <div class="student-meta">
      <div class="meta-item">
        <strong>Email:</strong>
        <span>{{ $student->email }}</span>
      </div>
      <div class="meta-item">
        <strong>Degree:</strong>
        <span>{{ $student->degree->degree_title ?? 'Not assigned' }}</span>
      </div>
      <div class="meta-item">
        <strong>Current Courses:</strong>
        <span>{{ $student->courses->count() }}</span>
      </div>
    </div>
  </div>

  {{-- Info Alert --}}
  <div class="alert alert-info">
    <i class="bi bi-info-circle"></i>
    <span>Select the courses you want to assign to this student. Already enrolled courses are pre-checked.</span>
  </div>

  {{-- Course Assignment Form --}}
  <div class="form-section">
    <div class="section-title">
      <i class="bi bi-list-check"></i> Available Courses
    </div>

    @if($allCourses->count() > 0)
      <form action="{{ route('course-students.bulkAssignCourses', ['student' => $student->id]) }}" method="POST">
        @csrf

        <div class="courses-list">
          @foreach($allCourses as $course)
            <div class="course-item">
              <div class="course-info">
                <div class="course-icon">
                  {{ strtoupper(substr($course->course_name, 0, 1)) }}
                </div>
                <div class="course-details">
                  <div class="course-details-name">{{ $course->course_name }}</div>
                  <div class="course-details-degree">
                    @if($course->degree)
                      <i class="bi bi-mortarboard"></i> {{ $course->degree->degree_title }}
                    @else
                      <span style="color: #999;">No degree assigned</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="checkbox-wrapper">
                <input 
                  type="checkbox" 
                  name="course_ids[]" 
                  value="{{ $course->id }}" 
                  id="course-{{ $course->id }}"
                  {{ in_array($course->id, $enrolledCourses) ? 'checked' : '' }}
                >
              </div>
            </div>
          @endforeach
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-submit">
            <i class="bi bi-check-circle"></i> Save Assignments
          </button>
          <button type="button" class="btn-submit secondary" onclick="toggleAllCourses()">
            <i class="bi bi-check2-all"></i> Select All
          </button>
          <a href="{{ route('course-students.studentsList') }}" class="btn-submit secondary" style="text-decoration: none;">
            <i class="bi bi-x-circle"></i> Cancel
          </a>
        </div>
      </form>
    @else
      <div class="empty-state">
        <i class="bi bi-inbox"></i>
        <p>No courses available. Create courses first.</p>
      </div>
    @endif
  </div>
</div>

<script>
function toggleAllCourses() {
  const checkboxes = document.querySelectorAll('input[name="course_ids[]"]');
  const allChecked = Array.from(checkboxes).every(cb => cb.checked);
  checkboxes.forEach(cb => cb.checked = !allChecked);
}
</script>

@endsection
