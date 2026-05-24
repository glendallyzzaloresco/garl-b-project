@forelse($teachers as $teacher)
  <tr>
    <td>{{ $teachers->firstItem() + $loop->index }}</td>
    <td>
      <div class="name-cell">
        <div class="avatar">{{ strtoupper(substr($teacher->fname, 0, 1)) }}</div>
        <div class="name-info">
          <p class="full-name">{{ trim($teacher->fname . ' ' . ($teacher->mname ?? '') . ' ' . $teacher->lname) }}</p>
          <p class="middle-name">ID: {{ $teacher->id }}</p>
        </div>
      </div>
    </td>
    <td>{{ $teacher->userAccount?->email ?? $teacher->email ?? 'N/A' }}</td>
    <td>{{ $teacher->phone ?: 'N/A' }}</td>
    <td>{{ $teacher->department ?: 'N/A' }}</td>
    <td><span class="badge">👨‍🏫 Teacher</span></td>
    <td>
      <div class="action-cell">
        <a href="/teachers/{{ $teacher->id }}" class="btn btn-primary" title="View Teacher">
          <i class="bi bi-eye"></i> <span class="btn-label">View</span>
        </a>
        <a href="/teachers/{{ $teacher->id }}/edit" class="btn btn-warning" title="Edit Teacher">
          <i class="bi bi-pencil"></i> <span class="btn-label">Edit</span>
        </a>
        <button type="button" class="btn btn-danger js-delete-teacher" data-teacher-id="{{ $teacher->id }}" title="Delete Teacher">
          <i class="bi bi-trash"></i> <span class="btn-label">Delete</span>
        </button>
      </div>
    </td>
  </tr>
@empty
  <tr>
      <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-secondary);">
  </tr>
@endforelse
