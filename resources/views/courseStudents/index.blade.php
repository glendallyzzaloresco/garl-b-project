@extends('format.layout')

@section('title', 'Course-Student Management')

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

.hero-panel {
  background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 100%);
  border-radius: 16px;
  padding: 3rem;
  margin-bottom: 2.5rem;
  color: white;
  position: relative;
  overflow: hidden;
  box-shadow: 0 10px 40px rgba(30, 58, 138, 0.2);
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 2rem;
}

.hero-panel > div:first-child {
  flex: 1;
}

.hero-panel h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.hero-panel p {
  font-size: 0.95rem;
  opacity: 0.95;
}

.search-box {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: white;
  padding: 0.6rem 1rem;
  border-radius: 10px;
  border: 1px solid var(--border);
  flex: 1;
  max-width: 500px;
}

.search-box input {
  border: none;
  outline: none;
  width: 100%;
  font-size: 0.9rem;
}

.courses-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2rem;
}

.course-card {
  background: var(--card);
  border-radius: 14px;
  padding: 1.5rem;
  border: 1px solid var(--border);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  cursor: pointer;
  text-decoration: none;
  color: inherit;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.course-card:hover {
  box-shadow: 0 12px 24px rgba(30, 58, 138, 0.15);
  transform: translateY(-4px);
  border-color: var(--blue);
}

.course-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, var(--blue) 0%, var(--navy) 100%);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.8rem;
  margin-bottom: 1rem;
}

.course-name {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--text);
  margin-bottom: 0.5rem;
}

.course-info {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: var(--text-2);
  font-size: 0.9rem;
  margin-top: auto;
  padding-top: 1rem;
  border-top: 1px solid var(--border);
}

.student-count {
  background: var(--blue);
  color: white;
  padding: 0.3rem 0.7rem;
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.85rem;
}

.empty-state {
  text-align: center;
  padding: 3rem 2rem;
  background: var(--card);
  border-radius: 14px;
  border: 2px dashed var(--border);
}

.empty-state i {
  font-size: 3rem;
  color: var(--text-2);
  opacity: 0.5;
  margin-bottom: 1rem;
}

.empty-state p {
  color: var(--text-2);
  font-size: 1rem;
}

@media (max-width: 768px) {
  .dashboard-container {
    padding: 1rem;
  }

  .hero-panel {
    padding: 2rem 1.5rem;
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .view-toggle {
    width: 100%;
    flex-wrap: wrap;
  }

  .courses-grid {
    grid-template-columns: 1fr;
  }
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

.view-toggle {
  display: flex;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
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
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
}

.toggle-btn.active {
  background: var(--blue);
  color: white;
}

.toggle-btn:hover {
  transform: translateY(-2px);
}

.hero-panel .toggle-btn {
  border-color: white;
  color: white;
  background: rgba(255, 255, 255, 0.1);
}

.hero-panel .toggle-btn.active {
  background: white;
  color: var(--blue);
  border-color: white;
}

.hero-panel .toggle-btn:hover {
  background: rgba(255, 255, 255, 0.2);
}

</style>

<div class="dashboard-container">
  {{-- Hero Panel --}}
  <div class="hero-panel">
    <div>
      <h2><i class="bi bi-diagram-3"></i> Course-Student Management</h2>
      <p>Assign students to courses and manage enrollments</p>
    </div>
    <div class="view-toggle">
      <button class="toggle-btn active">
        <i class="bi bi-book"></i> By Course
      </button>
      <a href="{{ route('course-students.studentsList') }}" class="toggle-btn">
        <i class="bi bi-people"></i> By Student
      </a>
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

  {{-- Courses Grid --}}
  @if($courses->count() > 0)
    <div class="courses-grid">
      @foreach($courses as $course)
        <a href="{{ route('course-students.show', ['course' => $course->id]) }}" class="course-card">
          <div class="course-icon">
            <i class="bi bi-book"></i>
          </div>
          <div class="course-name">{{ $course->course_name }}</div>
          <div class="course-info">
            <i class="bi bi-people-fill"></i>
            <span class="student-count">{{ $course->students_count }} Student{{ $course->students_count !== 1 ? 's' : '' }}</span>
          </div>
          @if($course->teacher)
            <div class="course-info" style="margin-top: 0.5rem;">
              <i class="bi bi-person-circle"></i>
              <span>{{ $course->teacher->fname }} {{ $course->teacher->lname }}</span>
            </div>
          @endif
        </a>
      @endforeach
    </div>
  @else
    <div class="empty-state">
      <i class="bi bi-inbox"></i>
      <p>No courses available. Create courses first to assign students.</p>
    </div>
  @endif
</div>

@endsection
