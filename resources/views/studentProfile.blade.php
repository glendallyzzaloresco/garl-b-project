@extends('format.student-layout')

@section('title','My Profile')

@section('content')

<style>
  .profile-container {
    max-width: 900px;
    margin: 0 auto;
  }

  .profile-header {
    margin-bottom: 2rem;
  }

  .profile-header h1 {
    font-size: 2rem;
    font-weight: 700;
    color: #1e3a8a;
    margin: 0 0 0.5rem 0;
  }

  .profile-header p {
    color: #6b7280;
    font-size: 0.95rem;
    margin: 0;
  }

  .profile-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
  }

  .profile-card h2 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1e3a8a;
    margin: 0 0 1.5rem 0;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e5e7eb;
  }

  .profile-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 1.5rem;
  }

  .profile-row.full {
    grid-template-columns: 1fr;
  }

  .profile-field {
    display: flex;
    flex-direction: column;
  }

  .profile-field label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
  }

  .profile-field value {
    font-size: 1.1rem;
    font-weight: 500;
    color: #1f2937;
    padding: 0.75rem 1rem;
    background: #f9fafb;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
  }
  h3 {
    color: white;
  }

  .profile-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
  }

  .profile-summary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    padding: 2rem;
    color: white;
    margin-bottom: 2rem;
  }

  .profile-summary h3 {
    margin: 0 0 1rem 0;
    font-size: 1.2rem;
    font-weight: 600;
  }

  .summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
  }

  .summary-item {
    background: rgba(255, 255, 255, 0.15);
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .summary-item-value {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
  }

  .summary-item-label {
    font-size: 0.85rem;
    opacity: 0.9;
  }

  .action-buttons {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
  }

  .btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .btn-primary {
    background: #667eea;
    color: white;
  }

  .btn-primary:hover {
    background: #5568d3;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
  }

  .btn-secondary {
    background: #e5e7eb;
    color: #1f2937;
  }

  .btn-secondary:hover {
    background: #d1d5db;
    transform: translateY(-2px);
  }

  /* Form Control Styles */
  .form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1.5px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
  }

  .form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  }

  .form-control.is-invalid {
    border-color: #dc2626;
  }

  .invalid-feedback {
    color: #dc2626;
    font-size: 0.85rem;
    margin-top: 0.25rem;
    display: block;
  }

  /* Alert Styles */
  .alert {
    padding: 1rem 1.25rem;
    border-radius: 8px;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    font-size: 0.95rem;
    border: 1px solid;
  }

  .alert-success {
    background: #ecfdf5;
    border-color: #a7f3d0;
    color: #065f46;
  }

  .alert-danger {
    background: #fef2f2;
    border-color: #fecaca;
    color: #7f1d1d;
  }

  .alert i {
    flex-shrink: 0;
    margin-top: 0.125rem;
  }

  .alert ul {
    margin: 0;
    padding-left: 1.5rem;
  }

  @media (max-width: 768px) {
    .profile-row {
      grid-template-columns: 1fr;
      gap: 1.5rem;
    }

    .profile-card {
      padding: 1.5rem;
    }

    .summary-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .action-buttons {
      flex-direction: column;
    }

    .btn {
      width: 100%;
      justify-content: center;
    }
  }
</style>

<div class="profile-container">
  <div class="profile-header">
    <h1>Welcome, {{ $student->fname }}!</h1>
    <p>Here's your student profile information</p>
  </div>

  <div class="profile-summary">
    <h3><i class="bi bi-person-circle"></i> Profile Summary</h3>
    <div class="summary-grid">
      <div class="summary-item">
        <div class="summary-item-value">{{ $student->fname }}</div>
        <div class="summary-item-label">First Name</div>
      </div>
      <div class="summary-item">
        <div class="summary-item-value">{{ $student->lname }}</div>
        <div class="summary-item-label">Last Name</div>
      </div>
      <div class="summary-item">
        <div class="summary-item-value">{{ $student->degree ? substr($student->degree->degree_title, 0, 3) . '.' : 'N/A' }}</div>
        <div class="summary-item-label">Degree</div>
      </div>
    </div>
  </div>

  <div class="profile-card">
    <h2><i class="bi bi-person"></i> Personal Information</h2>
    
    <div class="profile-row">
      <div class="profile-field">
        <label>First Name</label>
        <value>{{ $student->fname }}</value>
      </div>
      <div class="profile-field">
        <label>Middle Name</label>
        <value>{{ $student->mname ?? 'N/A' }}</value>
      </div>
    </div>

    <div class="profile-row full">
      <div class="profile-field">
        <label>Last Name</label>
        <value>{{ $student->lname }}</value>
      </div>
    </div>

    <div class="profile-row full">
      <div class="profile-field">
        <label>Full Name</label>
        <value>{{ $student->fname }} {{ $student->mname ? $student->mname . ' ' : '' }}{{ $student->lname }}</value>
      </div>
    </div>
  </div>

  <div class="profile-card">
    <h2><i class="bi bi-envelope"></i> Contact Information</h2>
    
    <div class="profile-row full">
      <div class="profile-field">
        <label>Email Address</label>
        <value>{{ $student->email }}</value>
      </div>
    </div>

    <div class="profile-row full">
      <div class="profile-field">
        <label>Contact Number</label>
        <value>{{ $student->contactInfo }}</value>
      </div>
    </div>
  </div>

  <div class="profile-card">
    <h2><i class="bi bi-mortarboard"></i> Academic Information</h2>
    
    <div class="profile-row full">
      <div class="profile-field">
        <label>Degree Program</label>
        <value>{{ $student->degree ? $student->degree->degree_title : 'Not Assigned' }}</value>
      </div>
    </div>
  </div>

  <!-- Change Password Section -->
  <div class="profile-card">
    <h2><i class="bi bi-lock"></i> Change Password</h2>
    
    @if($errors->any())
      <div class="alert alert-danger" style="margin-bottom: 1.5rem;">
        <i class="bi bi-exclamation-circle"></i>
        <ul style="margin: 0; padding-left: 1.5rem;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if(session('success'))
      <div class="alert alert-success" style="margin-bottom: 1.5rem;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
      </div>
    @endif

    <form action="/update-password" method="POST">
      @csrf
      
      <div class="profile-row full">
        <div class="profile-field">
          <label for="current_password">Current Password</label>
          <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter your current password" required>
          @error('current_password')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="profile-row full">
        <div class="profile-field">
          <label for="new_password">New Password</label>
          <input type="password" id="new_password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Enter your new password" required>
          <small style="color: #6b7280; margin-top: 0.25rem;">Password must be at least 8 characters long</small>
          @error('new_password')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="profile-row full">
        <div class="profile-field">
          <label for="new_password_confirmation">Confirm New Password</label>
          <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" placeholder="Confirm your new password" required>
          @error('new_password_confirmation')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
        <button type="submit" class="btn btn-primary" style="flex: 1; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600;">
          <i class="bi bi-check-lg"></i> Update Password
        </button>
        <button type="reset" class="btn btn-secondary" style="flex: 1; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; background: #e5e7eb; color: #374151; border: none; cursor: pointer;">
          <i class="bi bi-arrow-clockwise"></i> Reset
        </button>
      </div>
    </form>
  </div>

  <!-- Action Buttons -->


  <div class="action-buttons">
    <a href="{{ route('user.logout') }}" class="btn btn-secondary">
      <i class="bi bi-box-arrow-right"></i> Logout
    </a>
  </div>
</div>

@endsection
