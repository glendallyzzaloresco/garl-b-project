@extends('format.layout')

@section('title','Edit Teacher')

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

.form-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 1px 8px rgba(30,58,138,0.06);
  opacity: 0; animation: slideUp 0.5s 0.15s ease forwards;
}

.form-header {
  background: var(--navy);
  padding: 1.75rem 2rem;
  color: white;
}

.form-header h1 {
  margin: 0; font-family: 'Playfair Display', serif;
  font-size: 1.6rem; font-weight: 600;
  line-height: 1.15; letter-spacing: -0.01em;
}

.form-header p {
  margin: 0.5rem 0 0 0; font-size: 13px;
  color: rgba(255,255,255,0.7);
}

.form-container {
  padding: 2rem;
}

.form-row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.form-row.two-col {
  grid-template-columns: repeat(2, 1fr);
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-size: 10px; font-weight: 600;
  letter-spacing: 0.08em; text-transform: uppercase;
  color: var(--text-2); margin-bottom: 0.5rem;
}

.form-control {
  padding: 0.75rem;
  border: 1px solid var(--border);
  border-radius: 8px;
  font-size: 14px;
  background: var(--bg);
  transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control:focus {
  outline: none;
  border-color: var(--blue);
  box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
}

.form-control.is-invalid {
  border-color: #ef4444;
}

.form-error {
  color: #ef4444;
  font-size: 11px;
  margin-top: 0.3rem;
  display: block;
}

.form-actions {
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
  margin-top: 2rem;
  padding-top: 1.5rem;
  border-top: 1px solid var(--border);
}

.btn {
  padding: 0.75rem 1.25rem;
  border-radius: 8px;
  border: none;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.btn-primary {
  background: var(--blue);
  color: white;
}

.btn-primary:hover {
  background: #2563eb;
  box-shadow: 0 4px 12px rgba(59,130,246,0.3);
}

.btn-secondary {
  background: var(--border);
  color: var(--text);
}

.btn-secondary:hover {
  background: #d1d5db;
}

.alert {
  padding: 1rem;
  border-radius: 8px;
  margin-bottom: 1.5rem;
  display: flex;
  gap: 0.75rem;
  align-items: flex-start;
}

.alert-danger {
  background: #fee;
  border: 1px solid #fcc;
  color: #991b1b;
}

.alert-danger .alert-content strong {
  display: block;
  margin-bottom: 0.25rem;
}

@keyframes slideDown { to { opacity:1; transform:translateY(0); } }
@keyframes slideUp   { to { opacity:1; transform:translateY(0); } }

@media (max-width: 620px) {
  .form-row { grid-template-columns: 1fr 1fr; }
  .form-header h1 { font-size: 1.25rem; }
  .form-container { padding: 1.25rem; }
}
@media (max-width: 380px) { .form-row { grid-template-columns: 1fr; } }
</style>

<div class="page-shell">

  <a href="/dashboard" class="back-link">
    <i class="bi bi-chevron-left"></i> Back to Dashboard
  </a>

  <div class="form-card">

    <div class="form-header">
      <h1>Edit Teacher</h1>
      <p>Update teacher information and qualifications</p>
    </div>

    <div class="form-container">
      <div id="error-container"></div>
      <div id="success-message" style="display: none;" class="alert alert-success">
        <i class="bi bi-check-circle"></i>
        <div class="alert-content">Teacher updated successfully.</div>
      </div>

        {{-- Row 1: Names --}}
        <div class="form-row">
          <div class="form-group">
            <label for="f_name">First Name</label>
            <input type="text" id="f_name" class="form-control" name="f_name" value="{{ old('f_name', $teacher->fname) }}" required />
            <span class="form-error error-f_name" style="display:none;"></span>
          </div>

          <div class="form-group">
            <label for="m_name">Middle Name</label>
            <input type="text" id="m_name" class="form-control" name="m_name"  value="{{ old('m_name', $teacher->mname) }}" />
            <span class="form-error error-m_name" style="display:none;"></span>
          </div>

          <div class="form-group">
            <label for="l_name">Last Name</label>
            <input type="text" id="l_name" class="form-control" name="l_name" value="{{ old('l_name', $teacher->lname) }}" required />
            <span class="form-error error-l_name" style="display:none;"></span>
          </div>
        </div>

        {{-- Row 2: Contact & Course --}}
        <div class="form-row">
          <div class="form-group">
            <label for="e_mail">Email</label>
            <input type="email" id="e_mail" class="form-control" name="e_mail" value="{{ old('e_mail', $teacher->email) }}" required />
            <span class="form-error error-e_mail" style="display:none;"></span>
          </div>

          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" class="form-control" name="phone" value="{{ old('phone', $teacher->phone) }}" />
            <span class="form-error error-phone" style="display:none;"></span>
          </div>

          <div class="form-group">
            <label for="course_id">Assign Teacher to Course</label>
            <select id="course_id" name="course_id" class="form-control">
              <option value="">-- Select a Course --</option>
              @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ ($assignedCourse && $assignedCourse->id == $course->id) ? 'selected' : '' }}>
                  {{ $course->course_code }} - {{ $course->course_name }}
                </option>
              @endforeach
            </select>
            <span class="form-error error-course_id" style="display:none;"></span>
          </div>
        </div>

        {{-- Action Buttons --}}
        <div class="form-actions">
          <a href="/dashboard" class="btn btn-secondary">Cancel</a>
          <button id="updateTeacher" class="btn btn-primary" data-teacher-id="{{ $teacher->id }}">
            <i class="bi bi-check-circle"></i> Update Teacher
          </button>
        </div>
    </div>

  </div>
</div>

@endsection
