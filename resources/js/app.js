import './bootstrap';

// ============================================
// INTERACTIVE ENHANCEMENTS & ANIMATIONS
// ============================================

document.addEventListener('DOMContentLoaded', function() {
  // Smooth scroll to page sections
  enableSmoothScroll();
  
  // Add hover animations to buttons
  enhanceButtonAnimations();
  
  // Add form interactions
  enhanceFormInteractions();
  
  // Add table row hover effects
  enhanceTableRows();
  
  // Auto-hide alerts after 10 seconds
  autoHideAlerts();
  
  // Add tooltip functionality
  enableTooltips();
  
  // Initialize update student handler - MOVED TO public/js/app.js (jQuery version)
  // initializeUpdateStudent();
});


// ============================================
// SMOOTH SCROLL NAVIGATION
// ============================================
function enableSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      if (href === '#') return;
      
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
}

// ============================================
// ENHANCED BUTTON ANIMATIONS
// ============================================
function enhanceButtonAnimations() {
  const buttons = document.querySelectorAll('.btn');
  
  buttons.forEach(button => {
    button.addEventListener('mouseenter', function() {
      this.style.transition = 'all 0.2s ease-out';
      this.style.transform = 'translateY(-2px)';
    });
    
    button.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });
}

// ============================================
// FORM FIELD ENHANCEMENTS
// ============================================
function enhanceFormInteractions() {
  const formFields = document.querySelectorAll('.form-control, .form-select, input, textarea');
  
  formFields.forEach(field => {
    // Add focus class for styling
    field.addEventListener('focus', function() {
      this.classList.add('focused');
      this.style.transition = 'all 0.2s ease-out';
    });
    
    field.addEventListener('blur', function() {
      this.classList.remove('focused');
    });
    
    // Disable state animation
    field.addEventListener('input', function() {
      if (this.value.length > 0) {
        this.classList.add('has-value');
      } else {
        this.classList.remove('has-value');
      }
    });
  });
  
  // Add CSS for form field animations
  const formStyle = document.createElement('style');
  formStyle.textContent = `
    .form-control.focused,
    .form-select.focused,
    input:focus,
    textarea:focus {
      background-color: rgba(47, 109, 178, 0.02);
    }
    
    .form-control.has-value,
    .form-select.has-value,
    input.has-value,
    textarea.has-value {
      color: #222222;
      font-weight: 500;
    }
  `;
  document.head.appendChild(formStyle);
}

// ============================================
// ENHANCED TABLE ROWS
// ============================================
function enhanceTableRows() {
  const rows = document.querySelectorAll('.modern-table tbody tr');
  
  rows.forEach((row, index) => {
    row.style.animationDelay = (index * 0.05) + 's';
    
    row.addEventListener('mouseenter', function() {
      this.style.backgroundColor = 'var(--table-hover)';
      this.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.05)';
    });
    
    row.addEventListener('mouseleave', function() {
      this.style.backgroundColor = '';
      this.style.boxShadow = '';
    });
  });
}

// ============================================
// AUTO-HIDE ALERTS
// ============================================
function autoHideAlerts() {
  const alerts = document.querySelectorAll('.alert');
  
  alerts.forEach(alert => {
    // Add close button if not present
    if (!alert.querySelector('.btn-close')) {
      const closeBtn = document.createElement('button');
      closeBtn.className = 'btn-close';
      closeBtn.setAttribute('aria-label', 'Close');
      closeBtn.addEventListener('click', function() {
        alert.style.animation = 'slideOutUp 0.3s ease-out forwards';
        setTimeout(() => alert.remove(), 300);
      });
      alert.appendChild(closeBtn);
    }
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
      if (alert.parentNode) {
        alert.style.animation = 'slideOutUp 0.3s ease-out forwards';
        setTimeout(() => alert.remove(), 300);
      }
    }, 5000);
  });
}

// ============================================
// TOOLTIP FUNCTIONALITY
// ============================================
function enableTooltips() {
  const elementsWithTooltips = document.querySelectorAll('[title]');
  
  elementsWithTooltips.forEach(element => {
    element.addEventListener('mouseenter', function() {
      const title = this.getAttribute('title');
      if (!title) return;
      
      const tooltip = document.createElement('div');
      tooltip.style.position = 'absolute';
      tooltip.style.backgroundColor = '#222222';
      tooltip.style.color = '#FFFFFF';
      tooltip.style.padding = '8px 12px';
      tooltip.style.borderRadius = '4px';
      tooltip.style.fontSize = '12px';
      tooltip.style.whiteSpace = 'nowrap';
      tooltip.style.pointerEvents = 'none';
      tooltip.style.zIndex = '1001';
      tooltip.style.animation = 'fadeIn 0.2s ease-out';
      tooltip.textContent = title;
      
      document.body.appendChild(tooltip);
      
      const rect = this.getBoundingClientRect();
      tooltip.style.left = (rect.left + rect.width / 2 - tooltip.offsetWidth / 2) + 'px';
      tooltip.style.top = (rect.top - tooltip.offsetHeight - 8) + 'px';
      
      this.addEventListener('mouseleave', function() {
        tooltip.style.animation = 'fadeOut 0.2s ease-out forwards';
        setTimeout(() => tooltip.remove(), 200);
      }, { once: true });
    });
  });
}

// UPDATE STUDENT HANDLER MOVED TO public/js/app.js (jQuery version)
// Using jQuery for consistency with existing codebase

// ============================================
// UTILITY ANIMATIONS
// ============================================
const slideOutStyle = document.createElement('style');
slideOutStyle.textContent = `
  @keyframes slideOutUp {
    from {
      opacity: 1;
      transform: translateY(0);
    }
    to {
      opacity: 0;
      transform: translateY(-20px);
    }
  }
  
  @keyframes fadeOut {
    from {
      opacity: 1;
    }
    to {
      opacity: 0;
    }
  }
  
  .btn-close {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: inherit;
    opacity: 0.6;
    transition: opacity 0.2s ease-out;
  }
  
  .btn-close:hover {
    opacity: 1;
  }
`;
document.head.appendChild(slideOutStyle);

// ============================================
// PAGE TRANSITION EFFECT
// ============================================
window.addEventListener('beforeunload', function() {
  document.body.style.opacity = '0';
  document.body.style.transition = 'opacity 0.3s ease-out';
});

window.addEventListener('pageshow', function() {
  document.body.style.opacity = '1';
});

// ============================================
// SCROLL-TO-TOP BUTTON
// ============================================
function createScrollToTopButton() {
  if (document.getElementById('scroll-to-top')) return;
  
  const scrollBtn = document.createElement('button');
  scrollBtn.id = 'scroll-to-top';
  scrollBtn.innerHTML = '<i class="bi bi-chevron-up"></i>';
  scrollBtn.style.cssText = `
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--primary);
    color: white;
    border: none;
    cursor: pointer;
    font-size: 18px;
    display: none;
    z-index: 999;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease-out;
  `;
  
  document.body.appendChild(scrollBtn);
  
  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
      scrollBtn.style.display = 'flex';
    } else {
      scrollBtn.style.display = 'none';
    }
  });
  
  scrollBtn.addEventListener('click', function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
  
  scrollBtn.addEventListener('mouseenter', function() {
    this.style.transform = 'scale(1.1) translateY(-5px)';
  });
  
  scrollBtn.addEventListener('mouseleave', function() {
    this.style.transform = 'scale(1)';
  });
}

// Add scroll-to-top button when page loads
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', createScrollToTopButton);
} else {
  createScrollToTopButton();
}

// ============================================
// JQUERY FORM HANDLERS
// ============================================

// Toast Notification Helper
function showToast(message, type = 'success') {
    const toastId = 'toast-' + Date.now();
    const bgColor = type === 'success' ? '#10b981' : '#ef4444';
    const icon = type === 'success' ? '✓' : '✕';
    
    const toast = `
        <div id="${toastId}" style="
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: ${bgColor};
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            max-width: 400px;
        ">
            <span style="font-size: 18px;">${icon}</span>
            <span>${message}</span>
        </div>
        <style>
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        </style>
    `;
    
    $('body').append(toast);
    
    setTimeout(() => {
        const elem = document.getElementById(toastId);
        if (elem) {
            elem.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => elem.remove(), 300);
        }
    }, 3500);
}

// Initialize jQuery handlers
$(document).ready(function() {
    console.log('jQuery ready - initializing form handlers');

    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (!csrfToken) {
      console.warn('CSRF token meta tag missing or empty.');
    }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrfToken
      }
    });

    // If the session/token expired (common on hosted environments), refresh to recover.
    $(document).ajaxError(function(_event, xhr) {
      if (xhr && xhr.status === 419) {
        try {
          showToast('Session expired. Refreshing…', 'error');
        } catch (_) {
        }
        window.location.reload();
      }
    });

    // Save Student Handler
    $('#saveStudent').on('click', function(e) {
        e.preventDefault();
        console.log('Save Student button clicked');
        
        try {
            let fname = $('#fname').val().trim();
            let mname = $('#mname').val().trim();
            let lname = $('#lname').val().trim();
            let email = $('#email').val().trim();
            let contactInfo = $('#contactInfo').val().trim();
            let degree_id = $('#degree_id').val();
            let username = $('#username').val().trim();
            let password = $('#password').val();
            let course_ids = $('input[name="course_ids[]"]:checked').map(function() { return $(this).val(); }).get();
            
            // Validate required fields
            if (!fname || !lname || !email || !contactInfo || !degree_id || !username || !password) {
                showToast('Please fill in all required fields', 'error');
                return;
            }

            // Validate contact info is exactly 11 digits
            if (!/^\d{11}$/.test(contactInfo)) {
                showToast('Contact number must be exactly 11 digits', 'error');
                return;
            }

            // Validate email format
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showToast('Please enter a valid email address', 'error');
                return;
            }
            
            const $btn = $(this);
            const originalText = $btn.html();
            $btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Adding...');
           
            console.log('Sending student data:', {fname, mname, lname, email, contactInfo, degree_id, username, password, course_ids});

            $.ajax({
                url: '/students',
                type: 'POST',
                data: {
                    fname: fname,
                    mname: mname,
                    lname: lname,
                    email: email,
                    contactInfo: contactInfo,
                    degree_id: degree_id,
                    username: username,
                  password: password,
                  course_ids: course_ids
                },
                success: function(response) {
                    console.log('Student added successfully:', response);
                    showToast('✓ Student added successfully!', 'success');

                  // Cross-tab sync: notify other open tabs/windows to refresh student list.
                  try {
                    localStorage.setItem('sync:students', String(Date.now()));
                  } catch (e) {
                    // ignore
                  }
           
                    $('#fname, #mname, #lname, #email, #contactInfo, #username, #password').val('');
                    $('#degree_id').val('');
                    $('input[name="course_ids[]"]').prop('checked', false);
                   
                    $('#success-message').fadeIn();
                    
                    // Redirect to students page after 1.5 seconds
                    setTimeout(() => {
                        console.log('Redirecting to students page...');
                        window.location.href = '/students';
                    }, 1500);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error - Status:', xhr.status, 'Error:', error, 'Response:', xhr.responseText);
                    let errorMsg = 'Failed to add student';
                    
                    try {
                        let response = JSON.parse(xhr.responseText);
                        console.log('Server error response:', response);
                        
                        if (response.errors) {
                            let errors = response.errors;
                            let errorList = [];
                            for (let field in errors) {
                                if (Array.isArray(errors[field])) {
                                    errorList.push(errors[field][0]);
                                } else {
                                    errorList.push(errors[field]);
                                }
                            }
                            if (errorList.length > 0) {
                                errorMsg = errorList.join(', ');
                            }
                        } else if (response.message) {
                            errorMsg = response.message;
                        }
                    } catch(e) {
                        errorMsg = 'Server error: ' + xhr.status + ' ' + xhr.statusText;
                        console.log('Parse error:', e, 'Response text:', xhr.responseText);
                    }
                    
                    showToast('Error: ' + errorMsg, 'error');
                    $btn.prop('disabled', false).html(originalText);
                },
                complete: function() {
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        } catch (err) {
            console.error('Error in saveStudent click handler:', err);
            showToast('An error occurred: ' + err.message, 'error');
        }
    });

        // Save Teacher Handler
        $('#saveTeacher').on('click', function(e) {
          e.preventDefault();
          console.log('Save Teacher button clicked');

          try {
            let fname = $('#fname').val().trim();
            let mname = $('#mname').val().trim();
            let lname = $('#lname').val().trim();
            let email = $('#email').val().trim();
            let contact_no = $('#contact_no').val().trim();
            let username = $('#username').val().trim();
            let password = $('#password').val();

            if (!fname || !lname || !email || !contact_no || !username || !password) {
              showToast('Please fill in all required fields', 'error');
              return;
            }

            if (!/^\d{11}$/.test(contact_no)) {
              showToast('Contact number must be exactly 11 digits', 'error');
              return;
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
              showToast('Please enter a valid email address', 'error');
              return;
            }

            const $btn = $(this);
            const originalText = $btn.html();
            $btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Adding...');

            $.ajax({
              url: '/teachers',
              type: 'POST',
              data: {
                fname: fname,
                mname: mname,
                lname: lname,
                email: email,
                contact_no: contact_no,
                username: username,
                password: password
              },
              success: function(response) {
                console.log('Teacher added successfully:', response);
                showToast('✓ Teacher added successfully!', 'success');

                // Cross-tab sync: notify other open tabs/windows to refresh teacher list.
                try {
                  localStorage.setItem('sync:teachers', String(Date.now()));
                } catch (e) {
                  // ignore
                }

                $('#fname, #mname, #lname, #email, #contact_no, #username, #password').val('');

                $('#success-message').fadeIn();

                setTimeout(() => {
                  window.location.href = '/teachers';
                }, 1500);
              },
              error: function(xhr, status, error) {
                console.error('AJAX Error - Status:', xhr.status, 'Error:', error, 'Response:', xhr.responseText);
                let errorMsg = 'Failed to add teacher';

                try {
                  let response = JSON.parse(xhr.responseText);

                  if (response.errors) {
                    let errors = response.errors;
                    let errorList = [];
                    for (let field in errors) {
                      if (Array.isArray(errors[field])) {
                        errorList.push(errors[field][0]);
                      } else {
                        errorList.push(errors[field]);
                      }
                    }
                    if (errorList.length > 0) {
                      errorMsg = errorList.join(', ');
                    }
                  } else if (response.message) {
                    errorMsg = response.message;
                  }
                } catch (e) {
                  errorMsg = 'Server error: ' + xhr.status + ' ' + xhr.statusText;
                }

                showToast('Error: ' + errorMsg, 'error');
                $btn.prop('disabled', false).html(originalText);
              },
              complete: function() {
                $btn.prop('disabled', false).html(originalText);
              }
            });
          } catch (err) {
            console.error('Error in saveTeacher click handler:', err);
            showToast('An error occurred: ' + err.message, 'error');
          }
        });

        // Update Student Handler
        $('#updateStudent').on('click', function(e) {
          e.preventDefault();
          console.log('Update Student button clicked');

          try {
            const studentId = $(this).data('student-id');
            let f_name = $('#f_name').val().trim();
            let m_name = $('#m_name').val().trim();
            let l_name = $('#l_name').val().trim();
            let e_mail = $('#e_mail').val().trim();
            let contac_no = $('#contac_no').val().trim();
            let degree_id = $('#degree_id').val();
            let course_ids = $('input[name="course_ids[]"]:checked').map(function() { return $(this).val(); }).get();

            if (!f_name || !l_name || !e_mail || !contac_no || !degree_id) {
              showToast('Please fill in all required fields', 'error');
              return;
            }

            if (!/^\d{11}$/.test(contac_no)) {
              showToast('Contact number must be exactly 11 digits', 'error');
              return;
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e_mail)) {
              showToast('Please enter a valid email address', 'error');
              return;
            }

            const $btn = $(this);
            const originalText = $btn.html();
            $btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Updating...');

            $.ajax({
              url: '/students/' + studentId,
              type: 'POST',
              data: {
                _method: 'PUT',
                f_name: f_name,
                m_name: m_name,
                l_name: l_name,
                e_mail: e_mail,
                contac_no: contac_no,
                degree_id: degree_id,
                course_ids_present: 1,
                course_ids: course_ids,
              },
              success: function(response) {
                showToast(response.message || 'Student updated successfully.', 'success');
                $('#success-message .alert-content').text(response.message || 'Student updated successfully.');
                $('#success-message').fadeIn();
                $btn.prop('disabled', false).html(originalText);
              },
              error: function(xhr) {
                const data = xhr.responseJSON || {};
                if (data.errors) {
                  const errors = data.errors;
                  const firstError = Object.values(errors)[0];
                  showToast(Array.isArray(firstError) ? firstError[0] : 'Validation failed', 'error');
                } else {
                  showToast(data.message || 'Failed to update student.', 'error');
                }
                $btn.prop('disabled', false).html(originalText);
              },
              complete: function() {
                $btn.prop('disabled', false).html(originalText);
              }
            });
          } catch (err) {
            console.error('Error in updateStudent click handler:', err);
            showToast('An error occurred: ' + err.message, 'error');
          }
        });

        // Update Teacher Handler
        $('#updateTeacher').on('click', function(e) {
          e.preventDefault();
          console.log('Update Teacher button clicked');

          try {
            const teacherId = $(this).data('teacher-id');
            let f_name = $('#f_name').val().trim();
            let m_name = $('#m_name').val().trim();
            let l_name = $('#l_name').val().trim();
            let e_mail = $('#e_mail').val().trim();
            let phone = $('#phone').val().trim();
            let department = $('#department').val().trim();
            let degree_id = $('#degree_id').val();

            if (!f_name || !l_name || !e_mail) {
              showToast('Please fill in all required fields', 'error');
              return;
            }

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e_mail)) {
              showToast('Please enter a valid email address', 'error');
              return;
            }

            const $btn = $(this);
            const originalText = $btn.html();
            $btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Updating...');

            $.ajax({
              url: '/teachers/' + teacherId,
              type: 'POST',
              data: {
                _method: 'PUT',
                f_name: f_name,
                m_name: m_name,
                l_name: l_name,
                e_mail: e_mail,
                phone: phone,
                department: department,
                degree_id: degree_id,
              },
              success: function(response) {
                showToast(response.message || 'Teacher updated successfully.', 'success');
                $('#success-message .alert-content').text(response.message || 'Teacher updated successfully.');
                $('#success-message').fadeIn();
                $btn.prop('disabled', false).html(originalText);
              },
              error: function(xhr) {
                const data = xhr.responseJSON || {};
                if (data.errors) {
                  const errors = data.errors;
                  const firstError = Object.values(errors)[0];
                  showToast(Array.isArray(firstError) ? firstError[0] : 'Validation failed', 'error');
                } else {
                  showToast(data.message || 'Failed to update teacher.', 'error');
                }
                $btn.prop('disabled', false).html(originalText);
              },
              complete: function() {
                $btn.prop('disabled', false).html(originalText);
              }
            });
          } catch (err) {
            console.error('Error in updateTeacher click handler:', err);
            showToast('An error occurred: ' + err.message, 'error');
          }
        });

    // Student Delete Handler
    $(document).on('click', '.delete-btn', function (event) {
        event.preventDefault();
        console.log('Delete button clicked');

        const $button = $(this);
        const studentId = $button.data('student-id');
        const studentName = $button.data('student-name');
        const $row = $button.closest('tr');

        if (!confirm(`Remove ${studentName}? This cannot be undone.`)) {
            return;
        }

        $button.prop('disabled', true).css('opacity', '0.6');

        $.ajax({
            url: '/students/' + studentId,
            type: 'POST',
            data: {
                _method: 'DELETE',
            },
            success: function (data) {
                console.log('Student deleted successfully');
                $row.fadeOut(300, function () {
                    $(this).remove();
                });

                const $message = $(`
                    <div class="alert alert-success" style="margin-top: 20px;">
                        <i class="bi bi-check-circle"></i>
                        <div class="alert-content">${data.message || 'Student deleted successfully.'}</div>
                    </div>
                `);

                $('.table-wrapper').after($message);

                const $totalElement = $('.page-header .text-secondary');
                const currentTotal = parseInt($totalElement.text(), 10);
                if (!Number.isNaN(currentTotal)) {
                    $totalElement.text(Math.max(currentTotal - 1, 0) + ' total students');
                }

                setTimeout(function () {
                    $message.fadeOut(300, function () {
                        $(this).remove();
                    });
                }, 3000);
            },
            error: function (response) {
                console.log('Delete error:', response);
                const data = response.responseJSON || {};
                alert(data.message || 'Error deleting student. Please try again.');
                $button.prop('disabled', false).css('opacity', '1');
            },
        });
    });

        window.deleteStudent = function(studentId) {
          if (!confirm('Are you sure you want to delete this student? This action cannot be undone.')) {
            return;
          }

          const deleteButton = document.querySelector(`button[onclick="deleteStudent(${studentId})"]`);
          const row = deleteButton ? deleteButton.closest('tr') : null;

          $.ajax({
            url: '/students/' + studentId,
            type: 'POST',
            data: {
              _method: 'DELETE',
            },
            success: function(response) {
              showToast(response.message || 'Student deleted successfully.', 'success');

              if (row) {
                row.remove();
              }

              const totalElement = document.querySelector('.page-header .text-secondary');
              if (totalElement) {
                const match = totalElement.textContent.match(/\d+/);
                if (match) {
                  const currentTotal = parseInt(match[0], 10);
                  totalElement.textContent = Math.max(currentTotal - 1, 0) + ' total students';
                }
              }
            },
            error: function(xhr) {
              const data = xhr.responseJSON || {};
              showToast(data.message || 'Error deleting student. Please try again.', 'error');
            },
          });
        };

        window.deleteTeacher = function(teacherId) {
          if (!confirm('Are you sure you want to delete this teacher? This action cannot be undone.')) {
            return;
          }

          const deleteButton = document.querySelector(`button[onclick="deleteTeacher(${teacherId})"]`);
          const row = deleteButton ? deleteButton.closest('tr') : null;

          $.ajax({
            url: '/teachers/' + teacherId,
            type: 'POST',
            data: {
              _method: 'DELETE',
            },
            success: function(response) {
              showToast(response.message || 'Teacher deleted successfully.', 'success');

              if (row) {
                row.remove();
              }

              const totalElement = document.querySelector('.page-header .text-secondary');
              if (totalElement) {
                const match = totalElement.textContent.match(/\d+/);
                if (match) {
                  const currentTotal = parseInt(match[0], 10);
                  totalElement.textContent = Math.max(currentTotal - 1, 0) + ' total teachers';
                }
              }
            },
            error: function(xhr) {
              const data = xhr.responseJSON || {};
              showToast(data.message || 'Error deleting teacher. Please try again.', 'error');
            },
          });
        };

});
