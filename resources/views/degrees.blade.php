@extends('format.layout')

@section('title','Degrees')

@section('content')

<style>
  .degrees-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--spacing-lg);
    flex-wrap: wrap;
    gap: var(--spacing-md);
    padding: 2.5rem 2rem;
    border-radius: 16px;
    background: linear-gradient(135deg, #3B82F6, #2563EB);
    border: 1px solid var(--border-light);
    box-shadow: var(--shadow-md);
    animation: slideDown 0.6s ease-out;
  }

  .degrees-title {
    margin: 0;
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    font-weight: 700;
    color: white;
    letter-spacing: -0.02em;
  }
  
  .degrees-header .text-secondary {
    font-size: 15px;
    color: rgba(255, 255, 255, 0.9);
    margin-top: 0.3rem !important;
    font-weight: 500;
  }

  .action-cell {
    display: flex;
    gap: var(--spacing-sm);
    justify-content: flex-end;
  }

  .action-cell .btn {
    padding: 6px 12px;
    font-size: var(--font-size-sm);
    border-radius: 8px;
    transition: all 0.3s ease;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  
  .action-cell .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
  }

  .modern-table tbody tr {
    height: auto;
    transition: all 0.3s ease;
  }
  
  .modern-table tbody tr:hover {
    background-color: rgba(59, 130, 246, 0.08);
  }

  .modern-table tbody td {
    padding: 12px var(--spacing-md) !important;
    vertical-align: middle;
  }

  .modern-table tbody .badge {
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 6px;
    font-weight: 600;
  }
  
  .modern-table tbody td strong {
    font-weight: 600;
    font-size: 15px;
    color: var(--text-main);
  }

  .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.08), rgba(59, 130, 246, 0.05));
    border-radius: 12px;
    border: 1px solid rgba(59, 130, 246, 0.15);
  }

  .empty-state-icon {
    font-size: 56px;
    margin-bottom: var(--spacing-lg);
    animation: bounce 2s ease-in-out infinite;
  }

  .empty-state h3 {
    margin: 0 0 var(--spacing-sm) 0;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-main);
  }

  .empty-state p {
    color: var(--text-secondary);
    margin: 0 0 var(--spacing-lg) 0;
    font-size: 15px;
  }

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

  @keyframes bounce {
    0%, 100% {
      transform: translateY(0);
    }
    50% {
      transform: translateY(-10px);
    }
  }

  @media (max-width: 768px) {
    .degrees-header {
      flex-direction: column;
      padding: 1.5rem 1rem;
    }
    
    .degrees-title {
      font-size: 1.8rem;
    }

    .degrees-header .btn {
      width: 100%;
    }

    .action-cell {
      flex-direction: column;
    }

    .action-cell .btn {
      width: 100%;
    }
  }
</style>

<div class="degrees-header">
  <div>
    <h1 class="degrees-title">Degree Programs</h1>
    <p class="text-secondary" style="margin-top: var(--spacing-sm);">Manage all available degree programs in the system</p>
  </div>
  <a href="/degrees/create" class="btn btn-primary" style="background-color: white; color: #3B82F6; padding: var(--spacing-md) var(--spacing-lg); text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: var(--spacing-sm); border-radius: var(--radius-md); transition: all var(--transition-normal); border: none; cursor: pointer;">➕ Add Degree</a>
</div>

@if($message = Session::get('success'))
  <div class="alert alert-success">
    <i class="bi bi-check-circle"></i>
    <div class="alert-content">{{ $message }}</div>
  </div>
@endif

<div class="table-wrapper">
  <table class="modern-table">
    <thead>
      <tr>
        <th style="width: 10%;">#</th>
        <th>Degree Title</th>
        <th style="text-align: right;">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($degrees as $degree)
        <tr>
          <td>
            <span class="badge badge-primary">{{ $loop->iteration }}</span>
          </td>
          <td>
            <strong>{{ $degree->degree_title }}</strong>
          </td>
          <td>
            <div class="action-cell" style="justify-content: flex-end;">
              <a href="/degrees/{{ $degree->id }}" class="btn btn-primary btn-sm">
                <i class="bi bi-eye"></i> View
              </a>
              <a href="/degrees/{{ $degree->id }}/edit" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
              </a>
              <form action="/degrees/{{ $degree->id }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this degree?')">
                  <i class="bi bi-trash"></i> Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3">
            <div class="empty-state">
              <div class="empty-state-icon">📚</div>
              <h3>No degree programs found</h3>
              <p>Start by creating your first degree program.</p>
              <a href="/degrees/create" class="btn btn-primary btn-lg">
                <i class="bi bi-plus-circle"></i> Create First Degree
              </a>
            </div>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection

@section('footer')
@parent
<p>Copyright 2024. All rights reserved.</p>
@endsection