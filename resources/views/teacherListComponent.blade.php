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
    <td>{{ $teacher->userAccount->email ?? 'N/A' }}</td>
    <td>{{ $teacher->phone ?: 'N/A' }}</td>
    <td>{{ $teacher->department ?: 'N/A' }}</td>
    <td><span class="badge">👨‍🏫 Teacher</span></td>
    <td>
      <div class="action-cell">
        <a href="/teachers/{{ $teacher->id }}" class="btn btn-primary">
          <i class="bi bi-eye"></i> View
        </a>
        <a href="/teachers/{{ $teacher->id }}/edit" class="btn btn-warning">
          <i class="bi bi-pencil"></i> Edit
        </a>
        <button onclick="deleteTeacher({{ $teacher->id }})" class="btn btn-danger">
          <i class="bi bi-trash"></i> Delete
        </button>
      </div>
    </td>
  </tr>
@empty
  <tr>
    <td colspan="7" style="text-align: center; padding: 2rem; color: var(--text-secondary);">
      No teachers found.
    </td>
  </tr>
@endforelse
