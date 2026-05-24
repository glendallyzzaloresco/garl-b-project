@extends('format.layout')

@section('title','Change Password')

@section('content')

<style>
  .pw-shell {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--spacing-xl) var(--spacing-md);
    background:
      radial-gradient(900px circle at 15% 10%, var(--primary-light) 0%, transparent 55%),
      radial-gradient(900px circle at 85% 95%, var(--danger-light) 0%, transparent 50%),
      var(--bg-main);
  }

  .pw-card {
    width: 100%;
    max-width: 520px;
    background: var(--bg-surface);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    padding: var(--spacing-xl);
  }

  .pw-header {
    text-align: center;
    margin-bottom: var(--spacing-xl);
  }

  .pw-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto var(--spacing-md);
    border-radius: var(--radius-full);
    display: grid;
    place-items: center;
    background: var(--primary-light);
    border: 1px solid var(--border-light);
    color: var(--primary);
    font-size: 26px;
  }

  .pw-title {
    margin: 0;
    font-family: var(--font-serif);
    font-size: var(--font-size-2xl);
    letter-spacing: -0.02em;
  }

  .pw-subtitle {
    margin: var(--spacing-sm) 0 0 0;
    color: var(--text-secondary);
    font-size: var(--font-size-base);
  }

  .pw-actions {
    margin-top: var(--spacing-xl);
  }

  .pw-actions .btn {
    width: 100%;
  }

  .pw-card .is-invalid {
    border-color: var(--danger) !important;
    box-shadow: 0 0 0 3px var(--danger-light) !important;
  }

  .pw-error {
    margin-top: var(--spacing-sm);
    color: var(--danger);
    font-size: var(--font-size-sm);
  }

  .pw-error-list {
    margin-top: var(--spacing-sm);
    padding-left: 18px;
  }

  .pw-error-list li {
    margin: 4px 0;
  }

  @media (max-width: 640px) {
    .pw-card {
      padding: var(--spacing-lg);
    }
  }
</style>

<div class="pw-shell" data-first-login="{{ session('first_login') ? '1' : '0' }}">
  <div class="pw-card">
    <div class="pw-header">
      <div class="pw-icon" aria-hidden="true">
        <i class="bi bi-lock"></i>
      </div>

      <h2 class="pw-title">Change Your Password</h2>
      <p class="pw-subtitle">
        @if(session('first_login'))
          This is your first login. Please set your password to continue.
        @else
          Update your password to keep your account secure.
        @endif
      </p>
    </div>

    @if($errors->any())
      <div class="alert alert-danger">
        <div class="alert-icon" aria-hidden="true"><i class="bi bi-exclamation-triangle"></i></div>
        <div class="alert-content">
          <div><strong>Please fix the following:</strong></div>
          <ul class="pw-error-list">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    @if(session('success'))
      <div class="alert alert-success">
        <div class="alert-icon" aria-hidden="true"><i class="bi bi-check-circle"></i></div>
        <div class="alert-content">{{ session('success') }}</div>
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
          autocomplete="current-password"
          class="@error('current_password') is-invalid @enderror"
        />
        @error('current_password')
          <div class="pw-error">{{ $message }}</div>
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
          autocomplete="new-password"
          class="@error('new_password') is-invalid @enderror"
        />
        @error('new_password')
          <div class="pw-error">{{ $message }}</div>
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
          autocomplete="new-password"
          class="@error('new_password_confirmation') is-invalid @enderror"
        />
        @error('new_password_confirmation')
          <div class="pw-error">{{ $message }}</div>
        @enderror
      </div>

      <div class="pw-actions">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="bi bi-check-circle"></i> Update Password
        </button>
      </div>
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
