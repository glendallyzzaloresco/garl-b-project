@extends('format.layout')

@section('title','Student Details')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@300;400;500&display=swap');

:root {
  --navy: #1E3A8A;
  --blue: #3B82F6;
  --blue-light: rgba(59,130,246,0.08);
  --blue-border: rgba(59,130,246,0.2);
  --bg: #F8FAFC;
  --card: #FFFFFF;
  --text: #111827;
  --text-2: #6B7280;
  --border: #E5E7EB;
}

.page-shell { max-width: 860px; margin: 0 auto; padding: 2rem 1.5rem 4rem; }

.back-link {
  display: inline-flex; align-items: center; gap: 6px;
  font-size: 13px; font-weight: 500; color: var(--blue);
  text-decoration: none;
  padding: 6px 12px 6px 8px;
  border-radius: 30px;
  border: 1px solid var(--blue-border);
  background: var(--blue-light);
  transition: all 0.2s ease;
  margin-bottom: 2rem;
  opacity: 0; animation: slideDown 0.4s 0.05s ease forwards;
}
.back-link:hover { background: var(--blue); color: #fff; border-color: var(--blue); }

.profile-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 1px 8px rgba(30,58,138,0.06);
  opacity: 0; animation: slideUp 0.5s 0.15s ease forwards;
}

.card-header {
  background: var(--navy);
  padding: 1.75rem 2rem;
  display: flex; align-items: center; gap: 1.25rem;
  position: relative; overflow: hidden;
}
.card-header::before {
  content: ''; position: absolute;
  right: -40px; top: -40px;
  width: 160px; height: 160px; border-radius: 50%;
  background: rgba(255,255,255,0.04);
}
.card-header::after {
  content: ''; position: absolute;
  right: 60px; bottom: -60px;
  width: 120px; height: 120px; border-radius: 50%;
  background: rgba(59,130,246,0.12);
}

.avatar {
  width: 64px; height: 64px; border-radius: 50%;
  background: var(--blue);
  border: 2.5px solid rgba(255,255,255,0.3);
  display: flex; align-items: center; justify-content: center;
  font-family: 'Playfair Display', serif;
  font-size: 22px; font-weight: 600; color: #fff;
  flex-shrink: 0; position: relative; z-index: 1;
}
.profile-badge {
  font-size: 10px; font-weight: 600;
  letter-spacing: 0.1em; text-transform: uppercase;
  color: rgba(255,255,255,0.55); margin-bottom: 0.3rem;
}
.student-name {
  font-family: 'Playfair Display', serif;
  font-size: 1.6rem; font-weight: 600; color: #fff;
  line-height: 1.15; letter-spacing: -0.01em; margin-bottom: 0.25rem;
}
.degree-tag {
  font-size: 12px; color: rgba(255,255,255,0.65);
  display: flex; align-items: center; gap: 5px;
  position: relative; z-index: 1;
}
.header-text { position: relative; z-index: 1; }

.card-body { padding: 2rem; }

.section-block { margin-bottom: 2rem; }
.section-block:last-child { margin-bottom: 0; }

.section-title {
  font-size: 10.5px; font-weight: 600;
  letter-spacing: 0.1em; text-transform: uppercase;
  color: var(--navy);
  display: flex; align-items: center; gap: 8px;
  margin-bottom: 1rem;
  padding-bottom: 0.6rem;
  border-bottom: 1.5px solid var(--border);
}

.fields-row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}

.field-item {
  background: var(--bg);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 1rem 1.1rem;
  transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
  opacity: 0; transform: translateY(10px);
}
.field-item:hover {
  border-color: var(--blue-border);
  box-shadow: 0 4px 16px rgba(59,130,246,0.1);
  transform: translateY(-2px);
}

.field-label {
  font-size: 10px; font-weight: 600;
  letter-spacing: 0.08em; text-transform: uppercase;
  color: var(--text-2); margin-bottom: 0.35rem;
}
.field-value { font-size: 14px; font-weight: 500; color: var(--text); word-break: break-word; }
.field-value.na     { color: #9CA3AF; font-style: italic; font-weight: 400; }
.field-value.accent { color: var(--blue); font-size: 13px; }
.field-value.degree-val {
  display: inline-block; font-size: 12.5px;
  color: var(--navy);
  background: rgba(30,58,138,0.07);
  border: 1px solid rgba(30,58,138,0.14);
  padding: 3px 9px; border-radius: 20px; font-weight: 500;
}

.f1{animation:slideUp 0.4s 0.30s ease forwards}
.f2{animation:slideUp 0.4s 0.38s ease forwards}
.f3{animation:slideUp 0.4s 0.46s ease forwards}
.f4{animation:slideUp 0.4s 0.54s ease forwards}
.f5{animation:slideUp 0.4s 0.62s ease forwards}
.f6{animation:slideUp 0.4s 0.70s ease forwards}

@keyframes slideDown { to { opacity:1; transform:translateY(0); } }
@keyframes slideUp   { to { opacity:1; transform:translateY(0); } }

@media (max-width: 620px) {
  .fields-row { grid-template-columns: 1fr 1fr; }
  .student-name { font-size: 1.25rem; }
  .card-body { padding: 1.25rem; }
}
@media (max-width: 380px) { .fields-row { grid-template-columns: 1fr; } }
</style>

<div class="page-shell">

  <a href="/dashboard" class="back-link">
    <i class="bi bi-chevron-left"></i> Back to Dashboard
  </a>

  <div class="profile-card">

    <div class="card-header">
      <div class="avatar">
        {{ strtoupper(substr($student->fname, 0, 1)) }}{{ strtoupper(substr($student->lname, 0, 1)) }}
      </div>
      <div class="header-text">
        <div class="profile-badge">Student Profile</div>
        <h1 class="student-name">{{ $student->fname }} {{ $student->lname }}</h1>
        <div class="degree-tag">
          <i class="bi bi-mortarboard"></i>
          {{ optional($student->degree)->degree_title ?? 'Unassigned' }}
        </div>
      </div>
    </div>

    <div class="card-body">

      <div class="section-block">
        <div class="section-title">
          <i class="bi bi-person" style="color:var(--blue)"></i>
          Personal Information
        </div>
        <div class="fields-row">
          <div class="field-item f1">
            <div class="field-label">First Name</div>
            <div class="field-value">{{ $student->fname }}</div>
          </div>
          <div class="field-item f2">
            <div class="field-label">Middle Name</div>
            <div class="field-value {{ $student->mname ? '' : 'na' }}">{{ $student->mname ?: 'N/A' }}</div>
          </div>
          <div class="field-item f3">
            <div class="field-label">Last Name</div>
            <div class="field-value">{{ $student->lname }}</div>
          </div>
        </div>
      </div>

      <div class="section-block">
        <div class="section-title">
          <i class="bi bi-envelope" style="color:var(--blue)"></i>
          Contact & Academic
        </div>
        <div class="fields-row">
          <div class="field-item f4">
            <div class="field-label">Email Address</div>
            <div class="field-value accent">{{ $student->email }}</div>
          </div>
          <div class="field-item f5">
            <div class="field-label">Contact Number</div>
            <div class="field-value">{{ $student->contactInfo }}</div>
          </div>
          <div class="field-item f6">
            <div class="field-label">Degree Program</div>
            <div class="field-value degree-val">
              {{ optional($student->degree)->degree_title ?? 'Unassigned' }}
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection