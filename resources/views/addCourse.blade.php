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

  textarea {
    width: 100%;
    margin-top: 0.5rem;
    padding: 0.75rem 0.9rem;
    border: 1px solid var(--border-light);
    border-radius: 12px;
    font-size: 1rem;
    outline: none;
    font-family: inherit;
    resize: vertical;
    min-height: 120px;
  }

  textarea:focus {
    border-color: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  select {
    width: 100%;
    margin-top: 0.5rem;
    padding: 0.75rem 0.9rem;
    border: 1px solid var(--border-light);
    border-radius: 12px;
    font-size: 1rem;
    outline: none;
    background-color: var(--bg-surface);
    color: var(--text-main);
    cursor: pointer;
  }

  select:focus {
    border-color: #3B82F6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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

      <label for="course_code">Course Code</label>
      <input id="course_code" type="text" name="course_code" value="{{ old('course_code') }}" placeholder="e.g. CS101, MTH201" required>
      @error('course_code')
        <div class="error">{{ $message }}</div>
      @enderror

      <label for="course_name">Course Name</label>
      <textarea id="course_name" name="course_name" placeholder="e.g. Introduction to Computer Science" required>{{ old('course_name') }}</textarea>
      @error('course_name')
        <div class="error">{{ $message }}</div>
      @enderror

      <label for="degree_id">Degree</label>
      <select id="degree_id" name="degree_id">
        <option value="">-- Select a Degree --</option>
        @foreach($degrees as $degree)
          <option value="{{ $degree->id }}" {{ old('degree_id') == $degree->id ? 'selected' : '' }}>
            {{ $degree->degree_title }}
          </option>
        @endforeach
      </select>
      @error('degree_id')
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
