@extends('format.layout')

@section('title','Activity Log')

@section('content')

<style>
  .log-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: var(--spacing-lg);
    flex-wrap: wrap;
    gap: var(--spacing-md);
  }

  .log-header-content h1 {
    margin: 0;
  }

  .log-actions {
    display: flex;
    gap: var(--spacing-md);
  }

  .log-container {
    background-color: var(--bg-surface);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-lg);
    overflow: hidden;
  }

  .log-table-wrap {
    width: 100%;
    overflow-x: auto;
  }

  .log-table {
    width: 100%;
    border-collapse: collapse;
    font-size: var(--font-size-base);
    background: var(--bg-surface);
  }

  .log-table thead tr {
    background: var(--table-header-bg);
    border-bottom: 1px solid var(--border-element);
  }

  .log-table thead th {
    padding: var(--spacing-md) var(--spacing-lg);
    font-size: var(--font-size-sm);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    color: var(--text-secondary);
    white-space: nowrap;
    text-align: left;
  }

  .log-table tbody tr {
    border-bottom: 1px solid var(--border-light);
    transition: background var(--transition-fast);
  }

  .log-table tbody tr:last-child {
    border-bottom: none;
  }

  .log-table tbody tr:hover {
    background: var(--table-hover-bg);
  }

  .log-table td {
    padding: var(--spacing-md) var(--spacing-lg);
    vertical-align: middle;
    color: var(--text-main);
  }

  .row-index {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
    font-weight: 600;
    min-width: 28px;
    display: inline-block;
    text-align: center;
    background: var(--table-header-bg);
    border-radius: 20px;
    padding: 2px 8px;
  }

  .log-timestamp {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
    font-weight: 500;
  }

  .log-message {
    font-size: var(--font-size-base);
    color: var(--text-main);
    margin: 0 0 var(--spacing-sm) 0;
    font-weight: 500;
  }

  .log-full-message {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
    background: var(--bg-secondary);
    padding: var(--spacing-md);
    border-radius: var(--radius-md);
    border-left: 2px solid var(--border-element);
    overflow-x: auto;
    word-break: break-word;
    margin-top: var(--spacing-sm);
  }

  .log-pagination {
    padding: var(--spacing-lg);
    border-top: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--spacing-md);
  }

  .pagination-info {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
  }

  .pagination-links {
    display: flex;
    gap: 4px;
  }

  .pagination-link {
    height: 32px;
    min-width: 32px;
    padding: 0 var(--spacing-sm);
    border: 1px solid var(--border-light);
    border-radius: var(--radius-md);
    background: var(--bg-surface);
    color: var(--text-secondary);
    font-size: var(--font-size-sm);
    font-family: inherit;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background var(--transition-fast);
  }

  .pagination-link:hover {
    background: var(--table-header-bg);
  }

  .pagination-link.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
    font-weight: 600;
  }

  .pagination-link.disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .log-empty {
    padding: var(--spacing-xl) var(--spacing-lg);
    text-align: center;
    color: var(--text-secondary);
  }

  .log-empty-icon {
    font-size: 48px;
    margin-bottom: var(--spacing-md);
  }

  .log-empty-text {
    margin: 0;
    font-size: var(--font-size-base);
  }

  @media (max-width: 768px) {
    .log-header {
      flex-direction: column;
    }

    .log-actions {
      width: 100%;
      flex-direction: column;
    }

    .log-actions .btn {
      width: 100%;
    }

    .log-pagination {
      flex-direction: column;
      align-items: flex-start;
    }

    .pagination-links {
      width: 100%;
      justify-content: center;
    }
  }
</style>

<div class="log-header">
  <div class="log-header-content">
    <h1>Activity Log</h1>
    <p class="text-secondary">Monitor all system activities and events</p>
  </div>
  <div class="log-actions">
    <button id="refreshBtn" class="btn btn-primary" title="Refresh activity log">
      <i class="bi bi-arrow-clockwise"></i> Refresh
    </button>
    <form method="POST" action="/activity-log/clear" style="display: inline;" onsubmit="return confirm('Are you sure you want to clear all activity logs? This action cannot be undone.');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">
        <i class="bi bi-trash"></i> Clear
      </button>
    </form>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success">
    <i class="bi bi-check-circle"></i>
    <strong>Success!</strong> {{ session('success') }}
  </div>
@endif

<div class="log-container" data-current-page="{{ $currentPage }}">
  {{-- Log Table --}}
  <div class="log-table-wrap">
    <table class="log-table">
      <thead>
        <tr>
          <th width="60">#</th>
          <th width="180">Time</th>
          <th>Activity</th>
        </tr>
      </thead>
      <tbody>
        @forelse($logs as $log)
          <tr>
            <td>
              <span class="row-index">{{ ($currentPage - 1) * $perPage + $loop->iteration }}</span>
            </td>

            <td>
              <p class="log-timestamp">{{ $log['timestamp'] }}</p>
            </td>

            <td>
              <div>
                <p class="log-message">{{ $log['message'] }}</p>
                @if(strlen($log['full_message']) > 100)
                  <div class="log-full-message">
                    <strong>Full Details:</strong><br>
                    {{ $log['full_message'] }}
                  </div>
                @endif
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3">
              <div class="log-empty">
                <div class="log-empty-icon">📋</div>
                <p class="log-empty-text">No activity logs found</p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  @if($totalPages > 1)
    <div class="log-pagination">
      <span class="pagination-info">
        Showing {{ ($currentPage - 1) * $perPage + 1 }}–{{ min($currentPage * $perPage, $total) }} of {{ $total }} log entries
      </span>
      <div class="pagination-links">
        @if($currentPage > 1)
          <a href="/activity-log?page=1" class="pagination-link" title="Go to first page">« First</a>
          <a href="/activity-log?page={{ $currentPage - 1 }}" class="pagination-link" title="Go to previous page">‹ Prev</a>
        @else
          <span class="pagination-link disabled">« First</span>
          <span class="pagination-link disabled">‹ Prev</span>
        @endif

        @for($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++)
          @if($i == $currentPage)
            <span class="pagination-link active">{{ $i }}</span>
          @else
            <a href="/activity-log?page={{ $i }}" class="pagination-link">{{ $i }}</a>
          @endif
        @endfor

        @if($currentPage < $totalPages)
          <a href="/activity-log?page={{ $currentPage + 1 }}" class="pagination-link" title="Go to next page">Next ›</a>
          <a href="/activity-log?page={{ $totalPages }}" class="pagination-link" title="Go to last page">Last »</a>
        @else
          <span class="pagination-link disabled">Next ›</span>
          <span class="pagination-link disabled">Last »</span>
        @endif
      </div>
    </div>
  @endif
</div>

@endsection

@section('footer')
@parent
<p>Copyright 2024. All rights reserved.</p>
@endsection

<script>
  // Auto-refresh activity log every 5 seconds
  const refreshBtn = document.getElementById('refreshBtn');
  const currentPage = parseInt(document.querySelector('.log-container').dataset.currentPage);

  function refreshActivityLog() {
    fetch(`/activity-log/refresh?page=${currentPage}`)
      .then(response => response.json())
      .then(data => {
        const tbody = document.querySelector('.log-table tbody');
        
        if (data.logs.length === 0) {
          tbody.innerHTML = `
            <tr>
              <td colspan="3">
                <div class="log-empty">
                  <div class="log-empty-icon">📋</div>
                  <p class="log-empty-text">No activity logs found</p>
                </div>
              </td>
            </tr>
          `;
          return;
        }

        let html = '';
        const startIndex = (data.currentPage - 1) * data.perPage;
        
        data.logs.forEach((log, index) => {
          const rowIndex = startIndex + index + 1;
          const fullDetails = log.full_message.length > 100 ? `
            <div class="log-full-message">
              <strong>Full Details:</strong><br>
              ${log.full_message}
            </div>
          ` : '';

          html += `
            <tr>
              <td>
                <span class="row-index">${rowIndex}</span>
              </td>
              <td>
                <p class="log-timestamp">${log.timestamp}</p>
              </td>
              <td>
                <div>
                  <p class="log-message">${log.message}</p>
                  ${fullDetails}
                </div>
              </td>
            </tr>
          `;
        });

        tbody.innerHTML = html;
      })
      .catch(error => console.error('Error refreshing activity log:', error));
  }

  // Refresh on button click
  refreshBtn.addEventListener('click', refreshActivityLog);

  // Set up auto-refresh every 5 seconds
  setInterval(refreshActivityLog, 5000);
</script>