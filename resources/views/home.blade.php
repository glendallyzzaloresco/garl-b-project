@extends('format.layout')

@section('title','Dashboard - Student Management')

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
  --text: #f5f6fa;
  --text-2: #6B7280;
  --border: #E5E7EB;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

.professional-page {
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
}

.hero-panel h2 {
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



/* Features Grid */
.features-section {
  margin-bottom: 3rem;
}

.section-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 1.5rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.section-title::before {
  content: '';
  width: 4px;
  height: 28px;
  background: linear-gradient(180deg, var(--blue), var(--orange));
  border-radius: 2px;
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

.feature-card {
  background: var(--card);
  border-radius: 12px;
  padding: 2rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid var(--border);
  transition: all 0.3s ease;
  animation: slideUp 0.6s ease-out backwards;
}

.feature-card:nth-child(1) { animation-delay: 0.5s; }
.feature-card:nth-child(2) { animation-delay: 0.6s; }
.feature-card:nth-child(3) { animation-delay: 0.7s; }

.feature-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
  border-color: var(--blue);
}

.feature-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, var(--blue), var(--orange));
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 28px;
  margin-bottom: 1rem;
}

.feature-title {
  font-size: 16px;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 0.5rem;
}

.feature-desc {
  font-size: 14px;
  color: var(--text-2);
  line-height: 1.6;
  margin-bottom: 1rem;
}

.feature-link {
  font-size: 13px;
  font-weight: 600;
  color: var(--blue);
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 4px;
  transition: all 0.3s ease;
}

.feature-link:hover {
  gap: 8px;
  color: var(--navy);
}

/* Quick Actions */
.quick-actions {
  background: var(--card);
  border-radius: 12px;
  padding: 2rem;
  margin-bottom: 2rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid var(--border);
  animation: slideUp 0.8s ease-out;
}

.quick-actions h3 {
  font-size: 16px;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 1.5rem;
}

.action-buttons {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 1rem;
}

.action-btn {
  padding: 1rem;
  border: 2px solid var(--border);
  border-radius: 8px;
  background: var(--bg);
  color: var(--navy);
  font-weight: 600;
  font-size: 13px;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

.action-btn:hover {
  border-color: var(--blue);
  background: var(--blue);
  color: white;
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
}

/* Activity Section */
.activity-section {
  background: var(--card);
  border-radius: 12px;
  padding: 2rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid var(--border);
  animation: slideUp 0.9s ease-out;
}

.activity-section h3 {
  font-size: 16px;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 1.5rem;
}

.activity-item {
  padding: 1rem;
  border-bottom: 1px solid var(--border);
  display: flex;
  gap: 1rem;
  transition: all 0.3s ease;
}

.activity-item:last-child {
  border-bottom: none;
}

.activity-item:hover {
  background: var(--bg);
  border-radius: 8px;
  transform: translateX(5px);
}

.activity-icon {
  width: 40px;
  height: 40px;
  background: var(--bg);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--blue);
  flex-shrink: 0;
}

.activity-content h4 {
  font-size: 14px;
  font-weight: 600;
  color: var(--navy);
  margin-bottom: 0.2rem;
}

.activity-time {
  font-size: 12px;
  color: var(--text-2);
}

/* Animations */
@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 768px) {
  .professional-page {
    padding: 1rem;
  }

  .hero-panel {
    padding: 2rem;
  }

  .hero-panel h2 {
    font-size: 1.8rem;
  }

  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
  }

  .action-buttons {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .stats-grid,
  .action-buttons {
    grid-template-columns: 1fr;
  }

  .hero-panel h2 {
    font-size: 1.5rem;
  }

  .section-title {
    font-size: 1.3rem;
  }
}
</style>

<div class="professional-page">
  <!-- Hero Section -->
  <section class="hero-panel">
    <div class="hero-content">
      <h2>Welcome to the Student Dashboard</h2>
      <p class="hero-subtitle">Manage your student data, track progress, and stay organized</p>
      <div class="hero-date">
        <i class="bi bi-calendar3"></i>
        <span>{{ date('F j, Y') }} • {{ date('l') }}</span>
      </div>
    </div>
  </section>


  <!-- Quick Actions -->
  <div class="quick-actions">
    <h3>Quick Actions</h3>
    <div class="action-buttons">
      <a href="{{ route('students.index') }}" class="action-btn">
        <i class="bi bi-plus-circle"></i> Add Student
      </a>
      <a href="{{ route('students.index') }}" class="action-btn">
        <i class="bi bi-list-ul"></i> View Students
      </a>
      <a href="{{ route('degrees.index') }}" class="action-btn">
        <i class="bi bi-mortarboard"></i> Manage Degrees
      </a>
      <a href="/user_posts" class="action-btn">
        <i class="bi bi-file-earmark-plus"></i> Create Post
      </a>
    </div>
  </div>

  <!-- Features Section -->
  <section class="features-section">
    <h2 class="section-title">Key Features</h2>
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">
          <i class="bi bi-person-vcard"></i>
        </div>
        <h3 class="feature-title">Student Management</h3>
        <p class="feature-desc">Create, view, and manage student profiles with comprehensive information and enrollment details.</p>
        <a href="{{ route('students.index') }}" class="feature-link">
          <span>View Students</span>
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

      <div class="feature-card">
        <div class="feature-icon">
          <i class="bi bi-book"></i>
        </div>
        <h3 class="feature-title">Degree Programs</h3>
        <p class="feature-desc">Organize and manage degree programs, track enrollments, and view program statistics.</p>
        <a href="{{ route('degrees.index') }}" class="feature-link">
          <span>View Degrees</span>
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- Activity Section -->
  <section class="activity-section" style="margin-top: 2rem;">
    <h3>Recent Activity</h3>
    <div class="activity-item">
      <div class="activity-icon">
        <i class="bi bi-plus-circle"></i>
      </div>
      <div class="activity-content">
        <h4>New student enrolled</h4>
        <div class="activity-time">2 hours ago • Sarah Johnson</div>
      </div>
    </div>

    <div class="activity-item">
      <div class="activity-icon">
        <i class="bi bi-pencil"></i>
      </div>
      <div class="activity-content">
        <h4>Course updated</h4>
        <div class="activity-time">5 hours ago • Computer Science 101</div>
      </div>
    </div>

    <div class="activity-item">
      <div class="activity-icon">
        <i class="bi bi-check-circle"></i>
      </div>
      <div class="activity-content">
        <h4>System maintenance completed</h4>
        <div class="activity-time">Yesterday at 2:30 AM</div>
      </div>
    </div>

    <div class="activity-item">
      <div class="activity-icon">
        <i class="bi bi-star"></i>
      </div>
      <div class="activity-content">
        <h4>New degree program added</h4>
        <div class="activity-time">3 days ago • Data Science Masters</div>
      </div>
    </div>
  </section>
</div>

@endsection