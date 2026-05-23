@extends('format.layout')

@section('title','Degree Details')

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
  font-size: 24px; font-weight: 600; color: #fff;
  flex-shrink: 0; position: relative; z-index: 1;
}
.profile-badge {
  font-size: 10px; font-weight: 600;
  letter-spacing: 0.1em; text-transform: uppercase;
  color: rgba(255,255,255,0.55); margin-bottom: 0.3rem;
}
.title {
  font-family: 'Playfair Display', serif;
  font-size: 1.6rem; font-weight: 600; color: #fff;
  line-height: 1.15; letter-spacing: -0.01em; margin: 0;
}

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
  grid-template-columns: repeat(2, 1fr);
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
.field-value.accent { color: var(--blue); font-size: 13px; }

.action-buttons {
  display: flex;
  gap: 0.75rem;
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
  text-decoration: none;
}

.btn-primary {
  background: var(--blue);
  color: white;
}
.btn-primary:hover {
  background: #2563eb;
  box-shadow: 0 4px 12px rgba(59,130,246,0.3);
}

.btn-warning {
  background: #f59e0b;
  color: white;
}
.btn-warning:hover {
  background: #d97706;
  box-shadow: 0 4px 12px rgba(245,158,11,0.3);
}

.btn-danger {
  background: #ef4444;
  color: white;
}
.btn-danger:hover {
  background: #dc2626;
  box-shadow: 0 4px 12px rgba(239,68,68,0.3);
}

.f1{animation:slideUp 0.4s 0.30s ease forwards}
.f2{animation:slideUp 0.4s 0.38s ease forwards}
.f3{animation:slideUp 0.4s 0.46s ease forwards}
.f4{animation:slideUp 0.4s 0.54s ease forwards}

@keyframes slideDown { to { opacity:1; transform:translateY(0); } }
@keyframes slideUp   { to { opacity:1; transform:translateY(0); } }

@media (max-width: 620px) {
  .fields-row { grid-template-columns: 1fr; }
  .title { font-size: 1.25rem; }
  .card-body { padding: 1.25rem; }
}
</style>

<div class="page-shell">

  <a href="/degrees" class="back-link">
    <i class="bi bi-chevron-left"></i> Back to Degrees
  </a>

  <div class="profile-card">

    <div class="card-header">
      <div class="avatar">
        <i class="bi bi-mortarboard"></i>
      </div>
      <div>
        <div class="profile-badge">Degree Details</div>
        <h1 class="title">{{ $degree->degree_title }}</h1>
      </div>
    </div>

    <div class="card-body">

      <div class="section-block">
        <div class="section-title">
          <i class="bi bi-info-circle" style="color:var(--blue)"></i>
          Information
        </div>
        <div class="fields-row">
          <div class="field-item f1">
            <div class="field-label">Degree Title</div>
            <div class="field-value">{{ $degree->degree_title }}</div>
          </div>
          <div class="field-item f2">
            <div class="field-label">Degree ID</div>
            <div class="field-value accent">{{ $degree->id }}</div>
          </div>
          <div class="field-item f3">
            <div class="field-label">Created</div>
            <div class="field-value">{{ $degree->created_at->format('M d, Y') }}</div>
          </div>
          <div class="field-item f4">
            <div class="field-label">Last Updated</div>
            <div class="field-value">{{ $degree->updated_at->format('M d, Y') }}</div>
          </div>
        </div>
      </div>

      <div class="action-buttons">
        <a href="/degrees/{{ $degree->id }}/edit" class="btn btn-warning">
          <i class="bi bi-pencil"></i> Edit
        </a>
        <form action="/degrees/{{ $degree->id }}" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
            <i class="bi bi-trash"></i> Delete
          </button>
        </form>
      </div>

    </div>

  </div>

</div>

@endsection
