@extends('format.layout')

@section('title', 'Admin Dashboard')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap');

:root {
  --navy: #1E3A8A;
  --blue: #3B82F6;
  --orange: #F97316;
  --green: #10B981;
  --purple: #8B5CF6;
  --red: #EF4444;
  --bg: #F8FAFC;
  --card: #FFFFFF;
  --text: #1f2937;
  --text-2: #6B7280;
  --border: #E5E7EB;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

.dashboard-container {
  padding: 2rem;
  background: var(--bg);
  min-height: calc(100vh - 100px);
}

/* Hero Section */
.hero-panel {
  background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 100%);
  border-radius: 16px;
  padding: 3rem;
  margin-bottom: 2.5rem;
  color: white;
  position: relative;
  overflow: hidden;
  box-shadow: 0 10px 40px rgba(30, 58, 138, 0.2);
  animation: slideDown 0.6s ease-out;
}

.hero-panel::before {
  content: '';
  position: absolute;
  top: -50px;
  right: -50px;
  width: 300px;
  height: 300px;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
  border-radius: 50%;
}

.hero-panel::after {
  content: '';
  position: absolute;
  bottom: -100px;
  left: -100px;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
  border-radius: 50%;
}

.hero-content {
  position: relative;
  z-index: 1;
}

.hero-panel h2 {
  font-family: 'Playfair Display', serif;
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  line-height: 1.2;
  color: white;
}

.hero-subtitle {
  font-size: 16px;
  opacity: 0.95;
  margin-bottom: 1.5rem;
  font-weight: 400;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.stat-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.stat-card:hover {
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  transform: translateY(-2px);
}

.stat-icon {
  font-size: 2rem;
  margin-bottom: 0.5rem;
}

.stat-label {
  font-size: 0.9rem;
  color: var(--text-2);
  font-weight: 500;
  margin-bottom: 0.5rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.stat-value {
  font-size: 2rem;
  font-weight: 700;
  color: var(--navy);
}

/* Header Section */
.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  flex-wrap: wrap;
  gap: 1rem;
}

.page-header h1 {
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--text);
  margin: 0;
}

.header-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
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
}

.btn-primary {
  background: var(--blue);
  color: white;
}

.btn-primary:hover {
  background: var(--navy);
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
}

.btn-secondary {
  background: var(--orange);
  color: white;
}

.btn-secondary:hover {
  background: var(--red);
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(249, 115, 22, 0.3);
}

.btn-danger {
  background: var(--border);
  color: var(--text);
}

.btn-danger:hover {
  background: #d1d5db;
}

/* Search Box */
.search-box {
  position: relative;
  max-width: 400px;
  width: 100%;
  margin-bottom: 2rem;
}

.search-box input {
  width: 100%;
  padding: 0.75rem 1rem 0.75rem 2.5rem;
  border-radius: 8px;
  border: 1.5px solid var(--border);
  transition: all 0.3s ease;
  font-size: 0.95rem;
  background: var(--card);
}

.search-box input:focus {
  outline: none;
  border-color: var(--blue);
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-icon {
  position: absolute;
  left: 0.75rem;
  top: 50%;
  transform: translateY(-50%);
  color: var(--text-2);
  pointer-events: none;
}

/* Table Styles */
.table-wrapper {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.modern-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 0.95rem;
}

.modern-table thead {
  background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
  border-bottom: 2px solid var(--border);
}

.modern-table th {
  padding: 1rem 1.5rem;
  text-align: left;
  font-weight: 700;
  color: var(--text);
  text-transform: uppercase;
  font-size: 0.8rem;
  letter-spacing: 0.05em;
}

.modern-table th:last-child {
  text-align: center;
}

.modern-table tbody tr {
  border-bottom: 1px solid var(--border);
  transition: background-color 0.2s ease;
}

.modern-table tbody tr:hover {
  background-color: #f9fafb;
}

.modern-table td {
  padding: 1rem 1.5rem;
  vertical-align: middle;
  color: var(--text);
}

.modern-table tbody td:last-child {
  text-align: center;
}

.avatar {
  width: 40px;
  height: 40px;
  border-radius: 8px;
  background: linear-gradient(135deg, var(--blue), var(--purple));
  color: white;
  font-size: 0.85rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 0.75rem;
}

.user-name {
  display: flex;
  align-items: center;
}

.user-info {
  margin-left: 0.75rem;
}

.user-info strong {
  display: block;
  color: var(--text);
  margin-bottom: 0.25rem;
}

.user-info small {
  color: var(--text-2);
  font-size: 0.8rem;
}

/* Action Buttons */
.action-buttons {
  display: flex;
  gap: 0.5rem;
  justify-content: center;
  align-items: center;
}

.btn-small {
  padding: 0.4rem 0.8rem;
  border-radius: 6px;
  border: none;
  font-size: 0.8rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.3rem;
}

.btn-view {
  background: rgba(59, 130, 246, 0.1);
  color: var(--blue);
}

.btn-view:hover {
  background: var(--blue);
  color: white;
}

.btn-edit {
  background: rgba(249, 115, 22, 0.1);
  color: var(--orange);
}

.btn-edit:hover {
  background: var(--orange);
  color: white;
}

.btn-delete {
  background: rgba(239, 68, 68, 0.1);
  color: var(--red);
}

.btn-delete:hover {
  background: var(--red);
  color: white;
}

.badge {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
}

.badge-student {
  background: rgba(59, 130, 246, 0.1);
  color: var(--blue);
}

.badge-teacher {
  background: rgba(249, 115, 22, 0.1);
  color: var(--orange);
}

.badge-admin {
  background: rgba(239, 68, 68, 0.1);
  color: var(--red);
}

/* Pagination */
.pagination {
  display: flex;
  justify-content: center;
  gap: 0.5rem;
  margin-top: 2rem;
}

.pagination a, .pagination span {
  padding: 0.5rem 0.75rem;
  border-radius: 6px;
  border: 1px solid var(--border);
  text-decoration: none;
  color: var(--text);
  transition: all 0.2s ease;
  font-weight: 500;
}

.pagination a:hover {
  background: var(--blue);
  color: white;
  border-color: var(--blue);
}

.pagination .active {
  background: var(--blue);
  color: white;
  border-color: var(--blue);
}

/* Animation */
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

.hero-panel, .stat-card, .table-wrapper {
  animation: slideDown 0.6s ease-out;
}

.stat-card:nth-child(2) {
  animation-delay: 0.1s;
}

.stat-card:nth-child(3) {
  animation-delay: 0.2s;
}

/* Notification Toast */
.notification-toast {
  position: fixed;
  top: 20px;
  right: 20px;
  background: linear-gradient(135deg, var(--green) 0%, #059669 100%);
  color: white;
  padding: 16px 24px;
  border-radius: 12px;
  box-shadow: 0 10px 32px rgba(16, 185, 129, 0.35);
  display: none;
  align-items: center;
  gap: 12px;
  font-size: 15px;
  font-weight: 600;
  z-index: 9999;
  pointer-events: none;
}

.notification-toast.success {
  background: linear-gradient(135deg, var(--green) 0%, #059669 100%);
  animation: slideInRight 0.4s ease-out forwards;
}

.notification-toast.error {
  background: linear-gradient(135deg, var(--red) 0%, #991b1b 100%);
  animation: slideInRight 0.4s ease-out forwards;
}

.notification-toast.success::before {
  content: '✓';
  font-size: 20px;
  font-weight: bold;
}

.notification-toast.error::before {
  content: '✕';
  font-size: 20px;
  font-weight: bold;
}

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(400px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideOutRight {
  from {
    opacity: 1;
    transform: translateX(0);
  }
  to {
    opacity: 0;
    transform: translateX(400px);
  }
}

.notification-toast.hide {
  animation: slideOutRight 0.4s ease-out forwards;
}

@media (max-width: 768px) {
  .notification-toast {
    top: 10px;
    right: 10px;
    left: 10px;
    margin: 0 auto;
  }
}
</style>

<div class="dashboard-container">
  <!-- Hero Section -->
  <div class="hero-panel">
    <div class="hero-content">
      <h2>⚙️ Admin Dashboard</h2>
      <p class="hero-subtitle">Manage users and system settings</p>
    </div>
  </div>

  <!-- Stats -->
  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-icon">👥</div>
      <div class="stat-label">Total Students</div>
      <div class="stat-value">{{ $totalStudents }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon">👨‍🏫</div>
      <div class="stat-label">Total Teachers</div>
      <div class="stat-value">{{ $totalTeachers }}</div>
    </div>
    <!-- <div class="stat-card">
      <div class="stat-icon">👨‍🏫</div>
      <div class="stat-label">System Status</div>
      <div class="stat-value" style="color: var(--green);">Active</div>
    </div>
    -->
  </div>

  <!-- Header with Actions -->
  <div class="page-header">
    <div>
      <h1>👨‍💼 User Management</h1>
      <p style="color: var(--text-2); margin-top: 0.5rem;">Add and manage students and teachers</p>
    </div>
    <div class="header-actions">
      <a href="/students/create" class="btn btn-primary">➕ Add Student</a>
      <a href="/teachers/create" class="btn btn-secondary">➕ Add Teacher</a>
    </div>
  </div>

  <!-- Manage Students Section -->
  <div style="margin-top: 3rem; padding: 2rem; background: var(--card); border: 1px solid var(--border); border-radius: 12px;">
    <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text); margin-bottom: 1.5rem;">📚 Manage Students</h2>
    
    <!-- Search Box -->
    <div class="search-box">
      <span class="search-icon">🔍</span>
      <input type="text" id="searchInput" placeholder="Search students by name or email..." onkeyup="filterTable()">
    </div>

    <!-- Students Table -->
    <div class="table-wrapper">
      @if($students->count() > 0)
        <table class="modern-table" id="usersTable">
          <thead>
            <tr>
              <th>User Name</th>
              <th>Middle Name</th>
              <th>Email</th>
              <th>Contact</th>
              <th>Degree</th>
              <th>Role</th>
            </tr>
          </thead>
        <tbody>
          @foreach($students as $student)
            <tr>
              <td>
                <div class="user-name">
                  <div class="avatar">{{ strtoupper(substr($student->fname, 0, 1) . substr($student->lname, 0, 1)) }}</div>
                  <div class="user-info">
                    <strong>{{ $student->fname }} {{ $student->lname }}</strong>
                    <small>ID: {{ $student->id }}</small>
                  </div>
                </div>
              </td>
              <td>{{ $student->mname ?: 'N/A' }}</td>
              <td>{{ $student->userAccount?->email ?? $student->email ?? 'N/A' }}</td>
              <td>{{ $student->contactInfo ?: 'N/A' }}</td>
              <td>{{ $student->degree ? $student->degree->degree_title : 'Not Assigned' }}</td>
              <td>
                <span class="badge badge-student">📚 Student</span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="pagination">
        {{ $students->links() }}
      </div>
    @else
      <div style="text-align: center; padding: 3rem 1rem;">
        <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
        <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--text); margin-bottom: 0.5rem;">No Users Yet</h3>
        <p style="color: var(--text-2); margin-bottom: 1.5rem;">Start by adding your first student to the system.</p>
        <a href="/students/create" class="btn btn-primary">➕ Add Your First Student</a>
      </div>
    @endif
    </div>
  </div>

  <!-- Teachers Table Section -->
  <div id="teachers-section" style="margin-top: 3rem; padding: 2rem; background: var(--card); border: 1px solid var(--border); border-radius: 12px;">
    <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text); margin-bottom: 1.5rem;">👨‍🏫 Manage Teachers</h2>
    
    <!-- Teachers Table -->
    <div class="table-wrapper">
      @if($teachers->count() > 0)
        <table class="modern-table" id="teachersTable">
          <thead>
            <tr>
              <th>Full Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Department</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            @foreach($teachers as $teacher)
              <tr>
                <td>
                  <div class="user-name">
                    <div class="avatar">{{ strtoupper(substr($teacher->fname, 0, 1)) }}</div>
                    <div class="user-info">
                      <strong>{{ $teacher->fname }} {{ $teacher->mname }} {{ $teacher->lname }}</strong>
                      <small>ID: {{ $teacher->id }}</small>
                    </div>
                  </div>
                </td>
                <td>{{ $teacher->email }}</td>
                <td>{{ $teacher->phone ?: 'N/A' }}</td>
                <td>
                  @if($teacher->degree)
                    <span style="background: rgba(34, 197, 94, 0.1); color: #16a34a; padding: 4px 8px; border-radius: 4px; font-weight: 600; font-size: 0.85rem;">{{ $teacher->degree->degree_title }}</span>
                  @else
                    <span style="color: #9CA3AF; font-size: 0.85rem;">No Department Assigned</span>
                  @endif
                </td>
                <td><span style="background: rgba(59, 130, 246, 0.1); color: #3B82F6; padding: 4px 8px; border-radius: 4px; font-weight: 600; font-size: 0.85rem;">👨‍🏫 Teacher</span></td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
          {{ $teachers->links() }}
        </div>
      @else
        <div style="text-align: center; padding: 3rem 1rem;">
          <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
          <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--text); margin-bottom: 0.5rem;">No Teachers Yet</h3>
          <p style="color: var(--text-2); margin-bottom: 1.5rem;">Start by adding your first teacher to the system.</p>
          <a href="/teachers/create" class="btn btn-secondary">➕ Add Your First Teacher</a>
        </div>
      @endif
    </div>
  </div>

  <!-- Admin Section -->
  <div style="margin-top: 3rem; padding: 2rem; background: var(--card); border: 1px solid var(--border); border-radius: 12px;">
    <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--text); margin-bottom: 1.5rem;">⚙️ Admin Tools</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
      <a href="/students/create" class="btn btn-primary" style="justify-content: center;">➕ Add Student</a>
      <a href="/teachers/create" class="btn btn-secondary" style="justify-content: center;">➕ Add Teacher</a>
      <a href="{{ route('admin.create') }}" class="btn btn-secondary" style="justify-content: center;">➕ Add Admin</a>
      <a href="/change-password" class="btn btn-secondary" style="justify-content: center;">🔐 Change Password</a>
      <a href="/activity-log" class="btn btn-secondary" style="justify-content: center;">📋 Activity Log</a>
    </div>
  </div>
</div>

<script>
  function filterTable() {
    const input = document.getElementById('searchInput');
    const table = document.getElementById('usersTable');
    const tr = table.getElementsByTagName('tr');
    const filter = input.value.toUpperCase();

    for (let i = 1; i < tr.length; i++) {
      const td = tr[i].getElementsByTagName('td');
      let found = false;
      
      for (let j = 0; j < td.length - 1; j++) {
        const txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
      
      tr[i].style.display = found ? '' : 'none';
    }
  }
</script>

<!-- Notification Toast -->
<div id="notificationToast" class="notification-toast"></div>

<script>
  // Show notification toast if there are session messages
  function showNotification(type, message) {
    const toast = document.getElementById('notificationToast');
    if (!toast) return;
    
    toast.textContent = message;
    toast.className = `notification-toast ${type}`;
    toast.style.display = 'flex';
    
    // Auto-hide after 4 seconds
    setTimeout(() => {
      toast.classList.add('hide');
      setTimeout(() => {
        toast.style.display = 'none';
        toast.classList.remove('hide');
      }, 400);
    }, 4000);
  }

</script>

@endsection
