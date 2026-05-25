@extends('format.layout')

@section('title','Add Student')

@section('content')

<style>
  .form-header {
    margin-bottom: var(--spacing-lg);
  }

  .form-header h1 {
    margin: 0;
  }

  .form-container {
    max-width: 900px;
    background-color: var(--bg-surface);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
  }

  .form-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--spacing-lg);
    margin-bottom: var(--spacing-lg);
  }

  .form-actions {
    display: flex;
    gap: var(--spacing-md);
    justify-content: flex-end;
    margin-top: var(--spacing-xl);
    padding-top: var(--spacing-lg);
    border-top: 1px solid var(--border-light);
  }

  .back-link {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    color: var(--primary);
    text-decoration: none;
    font-size: var(--font-size-base);
    margin-bottom: var(--spacing-lg);
    font-weight: 500;
    padding: var(--spacing-md);
    border-radius: var(--radius-md);
    transition: all var(--transition-fast);
  }

  .back-link:hover {
    color: var(--primary-hover);
    background: var(--primary-light);
  }

  @media (max-width: 768px) {
    .form-row {
      grid-template-columns: 1fr;
    }

    .form-actions {
      flex-direction: column-reverse;
    }

    .form-actions .btn {
      width: 100%;
    }
  }

  .checkbox-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--spacing-md);
    margin-top: var(--spacing-md);
  }

  .checkbox-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-md);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-md);
    background: var(--bg-secondary);
  }

  .checkbox-item input {
    width: 18px;
    height: 18px;
  }

  .checkbox-help {
    margin-top: 0.35rem;
    color: var(--text-secondary);
    font-size: var(--font-size-sm);
  }

  @media (max-width: 900px) {
    .checkbox-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 520px) {
    .checkbox-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<a href="/students" class="back-link">
  <i class="bi bi-chevron-left"></i> Back to Students
</a>

<div class="form-header">
  <h1>Add New Student</h1>
  <p class="text-secondary">Register a new student and assign them to a degree program</p>
</div>

<div class="form-container">
  <div id="error-container"></div>
  <div id="success-message" style="display: none;" class="alert alert-success">
    <i class="bi bi-check-circle"></i>
    <div class="alert-content">Student added successfully! Redirecting...</div>
  </div>

    {{-- Row 1: Names --}}
    <div class="form-row">
      <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" id="fname" class="form-control" name="fname" placeholder="Enter firstname" value="{{ old('fname') }}" required />
        <span class="form-error error-fname" style="display:none;"></span>
      </div>

      <div class="form-group">
        <label for="mname">Middle Name</label>
        <input type="text" id="mname" class="form-control" name="mname" placeholder="Enter middlename" value="{{ old('mname') }}" />
        <span class="form-error error-mname" style="display:none;"></span>
      </div>

      <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" id="lname" class="form-control" name="lname" placeholder="Enter Lastname" value="{{ old('lname') }}" required />
        <span class="form-error error-lname" style="display:none;"></span>
      </div>
    </div>

    {{-- Row 2: Contact & Degree --}}
    <div class="form-row">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" class="form-control" name="email" placeholder="john@example.com" value="{{ old('email') }}" required />
        <span class="form-error error-email" style="display:none;"></span>
      </div>

      <div class="form-group">
        <label for="contactInfo">Contact Number</label>
        <input type="text" id="contactInfo" class="form-control" name="contactInfo" placeholder="09XXXXXXXXX" inputmode="numeric" value="{{ old('contactInfo') }}" required />
        <span class="form-error error-contactInfo" style="display:none;"></span>
      </div>

      <div class="form-group">
        <label for="degree_id">Degree Program</label>
        <select id="degree_id" class="form-control" name="degree_id" required>
          <option value="">-- Select Degree --</option>
          @foreach($degrees as $degree)
            <option value="{{ $degree->id }}" {{ old('degree_id') == $degree->id ? 'selected' : '' }}>
              {{ $degree->degree_title }}
            </option>
          @endforeach
        </select>
        <span class="form-error error-degree_id" style="display:none;"></span>
      </div>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" class="form-control" name="username" placeholder="Enter username" value="" autocomplete="off" required />
        <span class="form-error error-username" style="display:none;"></span>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" class="form-control" name="password" placeholder="Enter password" autocomplete="new-password" required />
        <span class="form-error error-password" style="display:none;"></span>
      </div>

    {{-- Action Buttons --}}
    <div class="form-actions">
      <a href="/students" class="btn btn-secondary">Cancel</a>
      <button type="button" id="saveStudent" class="btn btn-primary">
        <i class="bi bi-check-circle"></i> Add Stundent
      </button>
    </div>
</div>












@endsection

@section('footer')
@parent
<p>Copyright 2024. All rights reserved.</p>
@endsection