@extends('format.layout')

@section('title', 'Add Admin')

@section('content')

<style>
  .form-container {
    max-width: 600px;
    margin: 2rem auto;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .form-header {
    margin-bottom: 2rem;
    text-align: center;
  }

  .form-header h1 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1e3a8a;
    margin-bottom: 0.5rem;
  }

  .form-header p {
    color: #6b7280;
    font-size: 0.95rem;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  .form-group label {
    display: block;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
  }

  .form-group input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1.5px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    font-family: inherit;
  }

  .form-group input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  }

  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
  }

  .form-row.full {
    grid-template-columns: 1fr;
  }

  .form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
  }

  .btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    flex: 1;
  }

  .btn-primary {
    background: #3b82f6;
    color: white;
  }

  .btn-primary:hover {
    background: #1e3a8a;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
  }

  .btn-secondary {
    background: #e5e7eb;
    color: #1f2937;
  }

  .btn-secondary:hover {
    background: #d1d5db;
  }

  .error-message {
    background: #fee2e2;
    border: 1px solid #fecaca;
    color: #991b1b;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
  }

  .error-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .error-list li {
    padding: 0.25rem 0;
  }

  .success-message {
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    color: #166534;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
  }

  .required {
    color: #ef4444;
  }

  .hero-section {
    background: linear-gradient(135deg, #f97316 0%, #ef4444 100%);
    color: white;
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    text-align: center;
  }

  .hero-section h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
  }

  .hero-section p {
    opacity: 0.95;
    font-size: 0.95rem;
  }
</style>

<div class="form-container">
  <!-- Success Message -->
  @if (session('success'))
    <div class="success-message">
      ✓ {{ session('success') }}
    </div>
  @endif

  <!-- Error Messages -->
  @if ($errors->any())
    <div class="error-message">
      <strong>Oops! Please fix the following errors:</strong>
      <ul class="error-list">
        @foreach ($errors->all() as $error)
          <li>• {{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="form-header">
    <h1>👨‍💼 Add New Admin</h1>
    <p>Create a new admin account for your system</p>
  </div>

  <form action="{{ route('admin.store') }}" method="POST">
    @csrf

    <div class="form-row">
      <div class="form-group">
        <label for="fname">First Name <span class="required">*</span></label>
        <input type="text" id="fname" name="fname" value="{{ old('fname') }}" required>
      </div>

      <div class="form-group">
        <label for="lname">Last Name <span class="required">*</span></label>
        <input type="text" id="lname" name="lname" value="{{ old('lname') }}" required>
      </div>
    </div>

    <div class="form-group">
      <label for="email">Email <span class="required">*</span></label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
      <label for="contact_no">Contact Number <span class="required">*</span></label>
      <input type="tel" id="contact_no" name="contact_no" placeholder="09123456789" value="{{ old('contact_no') }}" required pattern="\d{11}">
    </div>

    <div class="form-group">
      <label for="username">Username <span class="required">*</span></label>
      <input type="text" id="username" name="username" value="{{ old('username') }}" required minlength="3">
    </div>

    <div class="form-group">
      <label for="password">Password <span class="required">*</span></label>
      <input type="password" id="password" name="password" required minlength="6">
    </div>

    <div class="form-actions">
      <a href="/dashboard" class="btn btn-secondary">❌ Cancel</a>
      <button type="submit" class="btn btn-primary">✓ Add Admin</button>
    </div>
  </form>
</div>

@endsection
