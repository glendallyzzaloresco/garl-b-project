@extends('format.student-layout')

@section('title', 'Student Dashboard')

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

.dashboard-container {
  padding: 2rem;
  background: var(--bg);
  min-height: calc(100vh - 100px);
}

/* Hero Section */
.hero-panel {
  background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 100%);
  border-radius: 16px;
  padding: 3rem;
  margin-bottom: 2.5rem;
  color: white;
  position: relative;
  overflow: hidden;
  box-shadow: 0 10px 40px rgba(30, 58, 138, 0.2);
  animation: slideDown 0.6s ease-out;
}

.hero-panel::before {
  content: '';
  position: absolute;
  top: -50px;
  right: -50px;
  width: 300px;
  height: 300px;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
  border-radius: 50%;
}

.hero-panel::after {
  content: '';
  position: absolute;
  bottom: -100px;
  left: -100px;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%);
  border-radius: 50%;
}

.hero-content {
  position: relative;
  z-index: 1;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.hero-avatar {
  width: 88px;
  height: 88px;
  border-radius: 999px;
  border: 3px solid rgba(255, 255, 255, 0.45);
  background: rgba(255, 255, 255, 0.12);
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  flex: 0 0 auto;
}

.hero-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.hero-avatar-placeholder {
  font-size: 34px;
  line-height: 1;
}

.hero-text h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  line-height: 1.2;
  color: white;
}

.hero-subtitle {
  font-size: 16px;
  opacity: 0.95;
  margin-bottom: 1.5rem;
  font-weight: 400;
}

.hero-date {
  font-size: 14px;
  opacity: 0.85;
  display: flex;
  align-items: center;
  gap: 6px;
}

/* Grid Layout */
.dashboard-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-bottom: 3rem;
}

/* Card Styles */
.dashboard-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 2rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.dashboard-card:hover {
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  transform: translateY(-2px);
}

.card-header {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.card-icon {
  width: 50px;
  height: 50px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  margin-right: 1rem;
}

.card-icon.blue {
  background: rgba(59, 130, 246, 0.1);
  color: var(--blue);
}

.card-icon.green {
  background: rgba(16, 185, 129, 0.1);
  color: var(--green);
}

.card-icon.orange {
  background: rgba(249, 115, 22, 0.1);
  color: var(--orange);
}

.card-icon.purple {
  background: rgba(139, 92, 246, 0.1);
  color: var(--purple);
}

.card-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--text);
  margin: 0;
}

.card-value {
  font-size: 2rem;
  font-weight: 700;
  color: var(--navy);
  margin-top: 0.5rem;
  margin-bottom: 0.5rem;
}

.card-label {
  font-size: 0.9rem;
  color: var(--text-2);
  font-weight: 500;
}

/* Profile Section */
.profile-section {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 2rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  margin-bottom: 3rem;
}

.profile-section h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--text);
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid var(--border);
}

.avatar-row {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1.5rem;
}

.avatar-preview {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.avatar-preview img {
  width: 72px;
  height: 72px;
  border-radius: 999px;
  object-fit: cover;
  border: 1px solid var(--border);
  background: var(--bg);
}

.avatar-meta {
  display: flex;
  flex-direction: column;
  gap: 0.2rem;
}

.avatar-title {
  font-weight: 700;
  color: var(--text);
}

.avatar-subtitle {
  font-size: 0.9rem;
  color: var(--text-2);
}

.avatar-form {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
  align-items: center;
  justify-content: flex-end;
}

.avatar-form input[type="file"] {
  max-width: 280px;
}

.profile-row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}

.profile-field {
  display: flex;
  flex-direction: column;
}

.profile-field-label {
  font-size: 0.85rem;
  font-weight: 700;
  color: var(--text-2);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  margin-bottom: 0.5rem;
}

.profile-field-value {
  font-size: 1rem;
  font-weight: 500;
  color: var(--text);
  padding: 0.75rem 1rem;
  background: var(--bg);
  border-radius: 8px;
  border: 1px solid var(--border);
}

.course-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.course-chip {
  display: inline-flex;
  align-items: center;
  padding: 0.35rem 0.7rem;
  border-radius: 999px;
  border: 1px solid rgba(59, 130, 246, 0.25);
  background: rgba(59, 130, 246, 0.10);
  color: var(--navy);
  font-weight: 700;
  font-size: 0.9rem;
}

.course-empty {
  color: var(--text-2);
}

/* Button Styles */
.btn-group {
  display: flex;
  gap: 1rem;
  margin-top: 1.5rem;
}

.btn {
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  border: none;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}

.btn-primary {
  background: var(--blue);
  color: white;
}

.btn-primary:hover {
  background: var(--navy);
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
}

.btn-secondary {
  background: var(--border);
  color: var(--text);
}

.btn-secondary:hover {
  background: var(--blue);
  color: white;
}

/* Animation */
@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.dashboard-card {
  animation: slideDown 0.6s ease-out;
}

.dashboard-card:nth-child(2) {
  animation-delay: 0.1s;
}

.dashboard-card:nth-child(3) {
  animation-delay: 0.2s;
}

.dashboard-card:nth-child(4) {
  animation-delay: 0.3s;
}
</style>

<div class="dashboard-container">
  <!-- Hero Section -->
  <div class="hero-panel">
    <div class="hero-content">
      <div class="hero-text">
        <h2>Welcome, {{ $student->fname }}! 👋</h2>
        <p class="hero-subtitle">Here's an overview of your academic progress and information</p>
        <div class="hero-date">
          <span>📅</span>
          <span id="currentDate"></span>
        </div>
      </div>

      <div class="hero-avatar" aria-label="Profile image">
        @if(!empty($student->avatar))
          <img src="{{ asset($student->avatar) }}" alt="Profile image" />
        @else
          <span class="hero-avatar-placeholder">👤</span>
        @endif
      </div>
    </div>
  </div>

  <!-- Stats Grid -->
  <div class="dashboard-grid">
    <!-- Degree Card -->
    <div class="dashboard-card">
      <div class="card-header">
        <div class="card-icon blue">🎓</div>
        <div>
          <h3 class="card-title">Degree Program</h3>
        </div>
      </div>
      <p class="card-value" style="font-size: 1.3rem; color: var(--text);">
        {{ $student->degree ? $student->degree->degree_title : 'Not Assigned' }}
      </p>
      <p class="card-label">Your current program</p>
    </div>

    <!-- Email Card -->
    <div class="dashboard-card">
      <div class="card-header">
        <div class="card-icon orange">✉️</div>
        <div>
          <h3 class="card-title">Email</h3>
        </div>
      </div>
      <p class="card-value" style="font-size: 1rem; color: var(--text); word-break: break-all;">
        {{ $student->email }}
      </p>
      <p class="card-label">Your contact email</p>
    </div>

    <!-- Contact Info Card -->
    <div class="dashboard-card">
      <div class="card-header">
        <div class="card-icon green">📞</div>
        <div>
          <h3 class="card-title">Contact Number</h3>
        </div>
      </div>
      <p class="card-value" style="font-size: 1.3rem; color: var(--text);">
        {{ $student->contactInfo ?: 'Not Provided' }}
      </p>
      <p class="card-label">Your phone number</p>
    </div>
  </div>

  <!-- Profile Details Section -->
  <div class="profile-section">
    <h3>📋 Personal Information</h3>

    <div class="avatar-row">
      <div class="avatar-preview">
        @if(!empty($student->avatar))
          <img src="{{ asset($student->avatar) }}" alt="Profile image" />
        @else
          <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='72' height='72'%3E%3Crect width='100%25' height='100%25' fill='%23F8FAFC'/%3E%3Ctext x='50%25' y='54%25' dominant-baseline='middle' text-anchor='middle' font-size='28'%3E%F0%9F%91%A4%3C/text%3E%3C/svg%3E" alt="No profile image" />
        @endif
        <div class="avatar-meta">
          <div class="avatar-title">Profile Image</div>
          <div class="avatar-subtitle">Upload a photo to show on your dashboard</div>
        </div>
      </div>

      <form class="avatar-form" action="{{ route('student.avatar.upload', ['student' => $student->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="avatar" accept="image/*" class="form-control" required />
        <button type="submit" class="btn btn-primary">⬆️ Upload</button>
      </form>
    </div>
    
    <div class="profile-row">
      <div class="profile-field">
        <label class="profile-field-label">First Name</label>
        <div class="profile-field-value">{{ $student->fname }}</div>
      </div>
      <div class="profile-field">
        <label class="profile-field-label">Middle Name</label>
        <div class="profile-field-value">{{ $student->mname ?: 'N/A' }}</div>
      </div>
      <div class="profile-field">
        <label class="profile-field-label">Last Name</label>
        <div class="profile-field-value">{{ $student->lname }}</div>
      </div>
    </div>

    <div class="profile-row">
      <div class="profile-field">
        <label class="profile-field-label">Degree Program</label>
        <div class="profile-field-value">{{ $student->degree ? $student->degree->degree_title : 'Not Assigned' }}</div>
      </div>
      <div class="profile-field">
        <label class="profile-field-label">Email</label>
        <div class="profile-field-value">{{ $student->email }}</div>
      </div>
    </div>

    <div class="profile-row">
      <div class="profile-field">
        <label class="profile-field-label">Contact Number</label>
        <div class="profile-field-value">{{ $student->contactInfo ?: 'Not Provided' }}</div>
      </div>
      <div class="profile-field">
        <label class="profile-field-label">Member Since</label>
        <div class="profile-field-value">{{ $student->created_at->format('M d, Y') }}</div>
      </div>
    </div>

    <div class="profile-row">
      <div class="profile-field" style="grid-column: 1 / -1;">
        <label class="profile-field-label">Enrolled Courses</label>
        <div class="profile-field-value">
          @if($student->courses && $student->courses->count() > 0)
            <div class="course-chips">
              @foreach($student->courses as $course)
                <span class="course-chip">{{ $course->course_name }}</span>
              @endforeach
            </div>
          @else
            <span class="course-empty">None</span>
          @endif
        </div>
      </div>
    </div>

    <div class="btn-group">
      <a href="/change-password" class="btn btn-primary">🔐 Change Password</a>
      <a href="/logout" class="btn btn-secondary">🚪 Logout</a>
    </div>
  </div>
</div>

<script>
  // Update current date
  const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  const today = new Date().toLocaleDateString('en-US', options);
  document.getElementById('currentDate').textContent = today;
</script>

@endsection
