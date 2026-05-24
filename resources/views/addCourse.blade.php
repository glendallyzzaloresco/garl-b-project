@extends('format.layout')

@section('title','Add Course')

@section('content')
<style>
  :root {
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --radius-lg: 1rem;

    --bg-surface: #ffffff;
    --text-main: #1f2937;
    --text-secondary: #6B7280;
    --border-light: #E5E7EB;

    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
  }

  .page {
    padding: 2rem;
    max-width: 900px;
    margin: 0 auto;
  }

  .card {
    background: var(--bg-surface);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: 2rem;
    box-shadow: var(--shadow-sm);
  }

  .title {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--text-main);
  }

  .subtitle {
    margin: 0.5rem 0 0;
    color: var(--text-secondary);
  }

  label {
    display: block;
    margin-top: 1.25rem;
    font-weight: 700;
    color: var(--text-main);
  }

  input[type="text"] {
    width: 100%;
    margin-top: 0.5rem;
    padding: 0.75rem 0.9rem;
    border: 1px solid var(--border-light);
    border-radius: 12px;
    font-size: 1rem;
    outline: none;
  }

  .error {
    margin-top: 0.5rem;
    color: #EF4444;
    font-weight: 600;
  }

  .actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.75rem;
    flex-wrap: wrap;
  }

  .btn {
    padding: 0.6rem 1rem;
    border-radius: 12px;
    border: none;
    font-weight: 800;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
  }

  .btn-primary { background: #3B82F6; color: #ffffff; }
  .btn-secondary { background: #e5e7eb; color: #111827; }
</style>

<div class="page">
  <div class="card">
    <h1 class="title">Add Course</h1>
    <p class="subtitle">Create a new course for students to enroll in</p>

    <form method="POST" action="{{ route('courses.store') }}">
      @csrf

      <label for="course_name">Course name</label>
      <input id="course_name" type="text" name="course_name" value="{{ old('course_name') }}" placeholder="e.g. Programming 101" required>
      @error('course_name')
        <div class="error">{{ $message }}</div>
      @enderror

      <div class="actions">
        <button type="submit" class="btn btn-primary">💾 Save</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection
