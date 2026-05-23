@extends('format.layout')

@section('title', 'Add Teacher')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap');

:root {
  --navy: #1E3A8A;
  --blue: #3B82F6;
  --orange: #F97316;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
  border-radius: 50%;
}

.hero-content {
  position: relative;
  z-index: 1;
}

.hero-section h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  line-height: 1.2;
}

.hero-section p {
  opacity: 0.95;
  font-size: 1rem;
  font-weight: 400;
}

/* Form Container */
.form-container {
  max-width: 700px;
  margin: 0 auto 3rem;
  background: var(--card);
  padding: 2.5rem;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  border: 1px solid var(--border);
  animation: slideUp 0.6s ease-out 0.2s both;
}

.form-header {
  margin-bottom: 2rem;
  text-align: center;
  padding-bottom: 1.5rem;
  border-bottom: 2px solid var(--border);
}

.form-header h1 {
  font-family: 'Playfair Display', serif;
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 0.5rem;
}

.form-header p {
  color: var(--text-2);
  font-size: 0.95rem;
  font-weight: 500;
}

/* Form Group Styling */
.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  display: block;
  font-weight: 600;
  color: var(--text);
  margin-bottom: 0.6rem;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.form-group input {
  width: 100%;
  padding: 0.85rem 1rem;
  border: 1.5px solid var(--border);
  border-radius: 8px;
  font-size: 0.95rem;
  transition: all 0.3s ease;
  font-family: inherit;
  background: #fafbfc;
}

.form-group input:hover {
  border-color: var(--orange);
  background: #FFFFFF;
}

.form-group input:focus {
  outline: none;
  border-color: var(--orange);
  background: #FFFFFF;
  box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
}

.form-group input::placeholder {
  color: var(--text-2);
}

.form-group textarea {
  width: 100%;
  padding: 0.85rem 1rem;
  border: 1.5px solid var(--border);
  border-radius: 8px;
  font-size: 0.95rem;
  transition: all 0.3s ease;
  font-family: inherit;
  background: #fafbfc;
  resize: vertical;
  min-height: 100px;
}

.form-group textarea:hover {
  border-color: var(--orange);
  background: #FFFFFF;
}

.form-group textarea:focus {
  outline: none;
  border-color: var(--orange);
  background: #FFFFFF;
  box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
}

.form-group textarea::placeholder {
  color: var(--text-2);
}

/* Form Row for Multi-Column Layout */
.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
}

.form-row.full {
  grid-template-columns: 1fr;
}

@media (max-width: 768px) {
  .form-row {
    grid-template-columns: 1fr;
  }
}

/* Error Messages */
.error-message {
  background: linear-gradient(135deg, #fef2f2 0%, #ffe4e4 100%);
  border: 1.5px solid #fecaca;
  color: #991b1b;
  padding: 1.25rem;
  border-radius: 12px;
  margin-bottom: 1.5rem;
  animation: shake 0.5s ease-out;
}

.error-message strong {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 700;
}

.error-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.error-list li {
  padding: 0.35rem 0;
  font-size: 0.9rem;
}

.error-list li::before {
  content: '⚠ ';
  margin-right: 0.5rem;
}

/* Success Message */
.success-message {
  background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
  border: 1.5px solid #6ee7b7;
  color: #166534;
  padding: 1.25rem;
  border-radius: 12px;
  margin-bottom: 1.5rem;
  animation: slideDown 0.5s ease-out;
  font-weight: 600;
}

.success-message::before {
  content: '✓ ';
  margin-right: 0.5rem;
  font-weight: 700;
}

/* Required Indicator */
.required {
  color: var(--red);
  font-weight: 700;
}

/* Form Actions */
.form-actions {
  display: flex;
  gap: 1rem;
  margin-top: 2.5rem;
  padding-top: 2rem;
  border-top: 2px solid var(--border);
}

.btn {
  padding: 0.85rem 1.5rem;
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
  font-size: 0.95rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.btn-primary {
  background: linear-gradient(135deg, var(--orange) 0%, #EA580C 100%);
  color: white;
  box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(249, 115, 22, 0.4);
}

.btn-primary:active {
  transform: translateY(0);
}

.btn-secondary {
  background: var(--border);
  color: var(--text);
  border: 1.5px solid var(--border);
}

.btn-secondary:hover {
  background: var(--text-2);
  color: white;
  border-color: var(--text-2);
}

/* Animations */
@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-5px); }
  75% { transform: translateX(5px); }
}
</style>

<div class="page-wrapper">
  <!-- Back Button -->
  <div style="margin-bottom: 1.5rem;">
    <a href="/dashboard" style="display: inline-flex; align-items: center; gap: 6px; padding: 0.6rem 1.2rem; border-radius: 8px; background: rgba(249, 115, 22, 0.1); border: 1px solid rgba(249, 115, 22, 0.3); color: var(--orange); text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease;">
      <span>←</span> Back to Dashboard
    </a>
  </div>

  <!-- Hero Section -->
  <div class="hero-section">
    <div class="hero-content">
      <h2>👨‍🏫 Add New Teacher</h2>
      <p>Create a new teacher account for your system</p>
    </div>
  </div>

  <!-- Form Container -->
  <div class="form-container">
    <!-- Success Message -->
    @if (session('success'))
      <div class="success-message">
        {{ session('success') }}
      </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
      <div class="error-message">
        <strong>Please fix the following errors:</strong>
        <ul class="error-list">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div id="teacher-form">
      <div class="form-row">
        <div class="form-group">
          <label for="fname">First Name <span class="required">*</span></label>
          <input type="text" id="fname" name="fname" placeholder="Enter first name" required>
        </div>

        <div class="form-group">
          <label for="mname">Middle Name</label>
          <input type="text" id="mname" name="mname" placeholder="Enter middle name (optional)">
        </div>

        <div class="form-group">
          <label for="lname">Last Name <span class="required">*</span></label>
          <input type="text" id="lname" name="lname" placeholder="Enter last name" required>
        </div>
      </div>

      <div class="form-group form-row full">
        <label for="email">Email Address <span class="required">*</span></label>
        <input type="email" id="email" name="email" placeholder="example@email.com" required>
      </div>

      <div class="form-group form-row full">
        <label for="contact_no">Contact Number <span class="required">*</span></label>
        <input type="tel" id="contact_no" name="contact_no" placeholder="09123456789" required pattern="\d{11}">
      </div>

      <div class="form-group form-row full">
        <label for="username">Username <span class="required">*</span></label>
        <input type="text" id="username" name="username" placeholder="Choose a username" required minlength="3">
      </div>

      <div class="form-group form-row full">
        <label for="password">Password <span class="required">*</span></label>
        <input type="password" id="password" name="password" placeholder="Enter a strong password" required minlength="6">
      </div>

      <div class="form-actions">
        <a href="/dashboard" class="btn btn-secondary"> Cancel</a>
        <button type="button" id="saveTeacher" class="btn btn-primary"> Add Teacher</button>
      </div>
    </div>
  </div>
</div>












<script>
$(document).ready(function() {
  $('#addTeacherBtn').on('click', function(e) {
    e.preventDefault();

    // Get CSRF token from meta tag
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Get form data
    let formData = {
      fname: $('#fname').val(),
      mname: $('#mname').val(),
      lname: $('#lname').val(),
      email: $('#email').val(),
      contact_no: $('#contact_no').val(),
      username: $('#username').val(),
      password: $('#password').val(),
      _token: csrfToken
    };

    // Validate required fields
    if (!formData.fname || !formData.lname || !formData.email || !formData.contact_no || !formData.username || !formData.password) {
      alert('Please fill in all required fields.');
      return;
    }

    // Send AJAX request
    $.ajax({
      url: "{{ route('teachers.store') }}",
      type: 'POST',
      data: formData,
      success: function(response) {
        // Clear form
        $('#teacher-form')[0].reset();
        // Redirect or show success message
        alert('Teacher added successfully!');
        window.location.href = '/dashboard';
      },
      error: function(xhr) {
        // Handle validation errors
        if (xhr.status === 422) {
          let errors = xhr.responseJSON.errors;
          let errorMessage = 'Please fix the following errors:\n\n';
          $.each(errors, function(key, value) {
            errorMessage += '- ' + value[0] + '\n';
          });
          alert(errorMessage);
        } else {
          alert('An error occurred. Please try again.');
        }
      }
    });
  });
});
</script>

@endsection
