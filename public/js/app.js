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

function reloadStudentsTable() {
    $.get('/students', function(data) {
        
        const tempDiv = $('<div>').html(data);
        const tableBody = tempDiv.find('#table-body').html();
        if (tableBody) {
            $('#table-body').html(tableBody);
        }
    });
}

// Initialize form handlers
$(document).ready(function() {
    console.log('Document ready, initializing form handlers');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        // Demo button click


        // Demo form submit
        $('#demo-form').submit(
            function (event) {
                event.preventDefault(); 
                alert('Form submitted!');
            }
        );
    $('#viewStudent').click(
        function(){
            $.get('/students', function(data) {
                $('#students-list').html(data); 
            });

        }
    )

  
    $('#updateStudent').click(function(e) {
        e.preventDefault();
        console.log('Update button clicked');
        let f_name = $('#f_name').val();
        let m_name = $('#m_name').val();
        let l_name = $('#l_name').val();
        let e_mail = $('#e_mail').val();
        let contac_no = $('#contac_no').val();
        let degree_id = $('#degree_id').val();
        let studentId = $(this).attr('data-student-id');
        
        console.log('Form values:', {f_name, m_name, l_name, e_mail, contac_no, degree_id, studentId});
  
        if (!f_name || !l_name || !e_mail || !contac_no || !degree_id) {
            alert('Please fill in all required fields');
            return;
        }
        
        $.ajax({
            url: '/students/' + studentId,
            type: 'PUT',
            data: {
                f_name: f_name,
                m_name: m_name,
                l_name: l_name,
                e_mail: e_mail,
                contac_no: contac_no,
                degree_id: degree_id
            },
            success: function(response) {
                console.log('Update successful:', response);
                $('#error-container').empty();
                $('#success-message').show();
                window.scrollTo(0, 0);
            },
            error: function(response) {
                console.log('Update error:', response);
                let errorMsg = 'Failed to update student';
                if (response.responseJSON && response.responseJSON.errors) {
                    let errors = response.responseJSON.errors;
                    let errorList = [];
                    for (let field in errors) {
                        if (Array.isArray(errors[field])) {
                            errorList.push(errors[field][0]);
                        } else {
                            errorList.push(errors[field]);
                        }
                    }
                    if (errorList.length > 0) {
                        errorMsg = errorList.join('\n');
                    }
                }
                $('#error-container').html('<div class="alert alert-danger"><strong>Error:</strong> ' + errorMsg.replace(/\n/g, '<br>') + '</div>');
                window.scrollTo(0, 0);
            }
        });
    });

 
    $('#updateTeacher').click(function(e) {
        e.preventDefault();
        let f_name = $('#f_name').val();
        let m_name = $('#m_name').val();
        let l_name = $('#l_name').val();
        let e_mail = $('#e_mail').val();
        let phone = $('#phone').val();
        let department = $('#department').val();
        let teacherId = $(this).attr('data-teacher-id');
        
        // Validate required fields
        if (!f_name || !l_name || !e_mail) {
            alert('Please fill in all required fields (First Name, Last Name, Email)');
            return;
        }
        
        $.ajax({
            url: '/teachers/' + teacherId,
            type: 'PUT',
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded',
            headers: {
                'Accept': 'application/json'
            },
            data: {
                f_name: f_name,
                m_name: m_name,
                l_name: l_name,
                e_mail: e_mail,
                phone: phone,
                department: department
            },
            success: function(response) {
                console.log('Success response:', response);
                $('#error-container').empty();
                $('#success-message').show();
                window.scrollTo(0, 0);
            },
            error: function(xhr, status, error) {
                console.log('Error response:', xhr);
                console.log('Status:', status);
                console.log('Error:', error);
                let errorMsg = 'Failed to update teacher';
                
                // Try to parse the response
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
                            errorMsg = errorList.join('\n');
                        }
                    } else if (response.message) {
                        errorMsg = response.message;
                    }
                } catch(e) {
                    errorMsg = 'Server error: ' + xhr.status + ' ' + xhr.statusText;
                }
                
                $('#error-container').html('<div class="alert alert-danger"><strong>Error:</strong> ' + errorMsg.replace(/\n/g, '<br>') + '</div>');
                window.scrollTo(0, 0);
            }
        });
    });

    

    $('#saveStudent').click(
        function() {
       try {
       let fname = $('#fname').val().trim();
       let mname = $('#mname').val().trim();
       let lname = $('#lname').val().trim();
       let email = $('#email').val().trim();
       let contactInfo = $('#contactInfo').val().trim();
       let degree_id = $('#degree_id').val();
       let username = $('#username').val().trim();
       let password = $('#password').val();
       
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
      
       console.log('Sending student data:', {fname, mname, lname, email, contactInfo, degree_id, username, password});

       $.ajax({
        url: '/students',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            fname: fname,
            mname: mname,
            lname: lname,
            email: email,
            contactInfo: contactInfo,
            degree_id: degree_id,
            username: username,
            password: password
        },
        success: function(response) {
            console.log('Student added successfully:', response);
            showToast('✓ Student added successfully!', 'success');
   
            $('#fname, #mname, #lname, #email, #contactInfo, #username, #password').val('');
            $('#degree_id').val('');
           
            $('#success-message').fadeIn();
            
            // Show notification for 2 seconds before redirecting
            setTimeout(() => {
                console.log('Redirecting to students page...');
                window.location.href = '/students';
            }, 2000);
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

    $('#saveTeacher').click(
        function() {
       let fname = $('#fname').val();
       let mname = $('#mname').val();
       let lname = $('#lname').val();
       let email = $('#email').val();
       let contact_no = $('#contact_no').val();
       let username = $('#username').val();
       let password = $('#password').val();
       
       // Validate required fields
       if (!fname || !lname || !email || !contact_no || !username || !password) {
           showToast('Please fill in all required fields', 'error');
           return;
       }
       
       const $btn = $(this);
       const originalText = $btn.html();
       $btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Adding...');
      
       $.ajax({
        url: '/teachers',
        type: 'POST',
        data:{
            fname: fname,
            mname: mname,
            lname: lname,
            email: email,
            contact_no: contact_no,
            username: username,
            password: password
        },
        success: function(response) {
            showToast('✓ Teacher added successfully!', 'success');
   
            $('#fname, #mname, #lname, #email, #contact_no, #username, #password').val('');
           
            $('#success-message').fadeIn().delay(2000).fadeOut();
            
            // Reload teacher list after 500ms
            setTimeout(() => {
                if (typeof reloadTeacherList === 'function') {
                    reloadTeacherList();
                }
            }, 500);
        },
        error: function(xhr, status, error) {
            console.log('Error:', xhr);
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
            } catch(e) {
                errorMsg = 'Server error: ' + xhr.status;
            }
            
            showToast('Error: ' + errorMsg, 'error');
        },
        complete: function() {
            $btn.prop('disabled', false).html(originalText);
        }
       });
    
    });
        const usernameField = document.getElementById('username');
        const passwordField = document.getElementById('password');
        
        if (usernameField) usernameField.value = '';
        if (passwordField) passwordField.value = '';
    }
    
    
    $(window).on('load', clearAuthFields);
    setTimeout(clearAuthFields, 100);
    setTimeout(clearAuthFields, 500);
    
    // Also clear when DOM is ready
    clearAuthFields();

    $('#view-students').click(
        function() {
            $.get('/students', function(data) {
                $('#students-list').html(data);
            });
        }
    );

});

// Delete functions (outside of document.ready)
   
    if (!confirm('Are you sure you want to delete this student? This action cannot be undone.')) {
        return;
    }
    
    $.ajax({
        url: '/students/' + studentId,
        type: 'DELETE',
        dataType: 'json',
        headers: {
            'Accept': 'application/json'
        },
        success: function(response) {
            showToast('✓ Student deleted successfully!', 'success');
            
            // Reload student list after delete
            setTimeout(() => {
                if (typeof reloadStudentList === 'function') {
                    reloadStudentList();
                }
            }, 300);
        },
    });
}

function deleteTeacher(teacherId) {

    if (!confirm('Are you sure you want to delete this teacher? This action cannot be undone.')) {
        return;
    }
    
    $.ajax({
        url: '/teachers/' + teacherId,
        type: 'DELETE',
        dataType: 'json',
        headers: {
            'Accept': 'application/json'
        },
        success: function(response) {
            alert('✓ Teacher deleted successfully!');
            
            // Reload teacher list after delete
            setTimeout(() => {
                if (typeof reloadTeacherList === 'function') {
                    reloadTeacherList();
                }
            }, 300);
        },
    });
}

// Student Delete Handler
$(document).on('click', '.delete-btn', function (event) {
    event.preventDefault();

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
            const data = response.responseJSON || {};
            alert(data.message || 'Error deleting student. Please try again.');
            $button.prop('disabled', false).css('opacity', '1');
        },
    });
});




