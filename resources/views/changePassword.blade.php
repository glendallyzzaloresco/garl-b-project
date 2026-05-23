@extends('format.layout')

@section('title','Change Password')

@section('content')

<style>
  .password-change-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem;
  }

  .password-change-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    max-width: 500px;
    width: 100%;
    padding: 3rem;
    animation: slideUp 0.5s ease-out;
  }

  .password-change-icon {
    text-align: center;
    margin-bottom: 2rem;
  }

  .password-change-icon i {
    font-size: 3rem;
    color: #667eea;
  }

  .password-change-card h2 {
    text-align: center;
    margin: 0 0 0.5rem 0;
    font-size: 1.8rem;
    color: #1a202c;
    font-weight: 700;
  }

  .password-change-card .subtitle {
    text-align: center;
    color: #718096;
    margin-bottom: 2rem;
    font-size: 0.95rem;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  .form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #2d3748;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .form-group input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
  }

  .form-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  }



  .btn-change-password {
    width: 100%;
    padding: 0.9rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .btn-change-password:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
  }

  .alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
  }

  .alert-danger {
    background: #fed7d7;
    border: 1px solid #fc8181;
    color: #c53030;
  }

  .alert-success {
    background: #c6f6d5;
    border: 1px solid #9ae6b4;
    color: #22543d;
  }

  .error-message {
    color: #c53030;
    font-size: 0.85rem;
    margin-top: 0.3rem;
  }

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

  @media (max-width: 640px) {
    .password-change-card {
      padding: 2rem;
    }

    .password-change-card h2 {
      font-size: 1.5rem;
    }
  }
</style>

<div class="password-change-container" data-first-login="{{ session('first_login') ? '1' : '0' }}">
  <div class="password-change-card">
    <div class="password-change-icon">
      <i class="bi bi-lock"></i>
    </div>

    <h2>Change Your Password</h2>
    <p class="subtitle">This is your first login. Please set your password to continue.</p>

    @if($errors->any())
      <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong><br>
        @foreach($errors->all() as $error)
          • {{ $error }}<br>
        @endforeach
      </div>
    @endif

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="/update-password" method="POST">
      @csrf

      <div class="form-group" id="current_password_group">
        <label for="current_password">Current Password</label>
        <input 
          type="password" 
          id="current_password" 
          name="current_password" 
          placeholder="Enter your current password"
          class="@error('current_password') is-invalid @enderror"
        />
        @error('current_password')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="new_password">New Password</label>
        <input 
          type="password" 
          id="new_password" 
          name="new_password" 
          placeholder="Enter your new password"
          required
          class="@error('new_password') is-invalid @enderror"
        />
        @error('new_password')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="new_password_confirmation">Confirm New Password</label>
        <input 
          type="password" 
          id="new_password_confirmation" 
          name="new_password_confirmation" 
          placeholder="Confirm your new password"
          required
          class="@error('new_password_confirmation') is-invalid @enderror"
        />
        @error('new_password_confirmation')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn-change-password">
        <i class="bi bi-check-circle"></i> Update Password
      </button>
    </form>
  </div>
</div>

<script>
  // Check if this is a first-time login
  const container = document.querySelector('.password-change-container');
  const isFirstLogin = container?.getAttribute('data-first-login') === '1';
  const currentPasswordField = document.getElementById('current_password');
  const currentPasswordGroup = document.getElementById('current_password_group');
  
  if (isFirstLogin) {
    // For first-time login, make current password field not required
    currentPasswordField.required = false;
  } else {
    // For subsequent password changes, require current password field
    currentPasswordField.required = true;
  }
</script>

@endsection
