@foreach ($students as $student)
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td>
      <div class="name-cell">
        <div class="avatar">{{ strtoupper(substr($student->fname, 0, 1)) }}</div>
        <div class="name-info">
          <p class="full-name">{{ $student->fname }} {{ $student->lname }}</p>
          <p class="middle-name">{{ $student->mname }}</p>
        </div>
      </div>
    </td>
    <td>{{ $student->userAccount?->email ?? $student->email ?? 'N/A' }}</td>
    <td>{{ $student->contactInfo }}</td>
    <td>
      @if($student->degree)
        <span class="badge">{{ $student->degree->degree_title }}</span>
      @else
        <span class="badge" style="background-color: #e0e0e0; color: #666;">N/A</span>
      @endif
    </td>
    <td>
      <div class="action-cell">
        <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary">
          <i class="bi bi-eye"></i> View
        </a>
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">
          <i class="bi bi-pencil"></i> Edit
        </a>
        <button type="button" class="btn btn-danger js-delete-student" data-student-id="{{ $student->id }}">
          <i class="bi bi-trash"></i> Delete
        </button>
      </div>
    </td>
  </tr>
@endforeach