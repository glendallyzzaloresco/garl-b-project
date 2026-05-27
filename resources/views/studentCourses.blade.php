@extends('format.student-layout')

@section('title', 'Courses')

@section('content')
<style>
:root {
  --navy: #1E3A8A;
  --blue: #3B82F6;
  --green: #10B981;
  --red: #EF4444;
  --bg: #F8FAFC;
  --card: #FFFFFF;
  --text: #1f2937;
  --text-2: #6B7280;
  --border: #E5E7EB;
}

.courses-container {
  padding: 2rem;
  background: var(--bg);
  min-height: calc(100vh - 100px);
}

.hero-panel {
  background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 100%);
  border-radius: 16px;
  padding: 2rem;
  margin-bottom: 1.5rem;
  color: white;
}

.hero-title {
  font-family: 'Playfair Display', serif;
  font-size: 2rem;
  font-weight: 700;
  margin: 0;
}

.hero-subtitle {
  margin-top: 0.5rem;
  opacity: 0.9;
}

.courses-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 1.5rem;
}

.modern-table {
  width: 100%;
  border-collapse: collapse;
}

.modern-table th,
.modern-table td {
  padding: 1rem;
  border-bottom: 1px solid var(--border);
  text-align: left;
}

.modern-table th {
  font-size: 0.85rem;
  color: var(--text-2);
  text-transform: uppercase;
  letter-spacing: 0.04em;
}

.badge {
  display: inline-flex;
  align-items: center;
  padding: 0.35rem 0.75rem;
  border-radius: 999px;
  font-weight: 700;
  font-size: 0.85rem;
}

.badge-enrolled {
  background: rgba(16, 185, 129, 0.12);
  color: var(--green);
}

.badge-not {
  background: rgba(239, 68, 68, 0.10);
  color: var(--red);
}

.btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.6rem 1rem;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  font-weight: 700;
}

.btn-enroll {
  background: var(--blue);
  color: white;
}

.btn-unenroll {
  background: var(--red);
  color: white;
}

.empty-state {
  padding: 2rem;
  text-align: center;
  color: var(--text-2);
}

@media (max-width: 768px) {
  .courses-container { padding: 1rem; }
  .hero-panel { padding: 1.5rem; }
  .modern-table th:nth-child(2),
  .modern-table td:nth-child(2) { display: none; }
}
</style>

<div class="courses-container">
  <div class="hero-panel">
    <h2 class="hero-title">📚 Courses</h2>
    <div class="hero-subtitle">Enroll in multiple courses available to you</div>
  </div>

  <div class="courses-card">
    @if($courses->count() === 0)
      <div class="empty-state">
        No courses found yet.
      </div>
    @else
      <table class="modern-table">
        <thead>
          <tr>
            <th>Course</th>
            <th>Status</th>
            <th style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($courses as $course)
            @php
              $isEnrolled = in_array($course->id, $enrolledCourseIds, true);
            @endphp
            <tr>
              <td style="font-weight: 700; color: var(--text);">{{ $course->course_code }} - {{ $course->course_name }}</td>
              <td>
                @if($isEnrolled)
                  <span class="badge badge-enrolled">Enrolled</span>
                @else
                  <span class="badge badge-not">Not enrolled</span>
                @endif
              </td>
              <td style="text-align: right;">
                @if($isEnrolled)
                  <form method="POST" action="{{ route('student.courses.unenroll', ['student' => $student->id, 'course' => $course->id]) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-unenroll"><i class="bi bi-x-circle"></i> Unenroll</button>
                  </form>
                @else
                  <form method="POST" action="{{ route('student.courses.enroll', ['student' => $student->id, 'course' => $course->id]) }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-enroll"><i class="bi bi-check2-circle"></i> Enroll</button>
                  </form>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</div>
@endsection
