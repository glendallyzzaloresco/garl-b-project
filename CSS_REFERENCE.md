# Quick CSS Class Reference

## Buttons

### Primary Buttons (Main actions)
```html
<a href="/..." class="btn btn-primary">Action</a>          <!-- Normal -->
<a href="/..." class="btn btn-primary btn-lg">Action</a>   <!-- Large -->
<a href="/..." class="btn btn-primary btn-sm">Action</a>   <!-- Small -->
```

### Contextual Buttons
```html
<a class="btn btn-success">Save</a>          <!-- Green -->
<a class="btn btn-warning">Edit</a>         <!-- Orange -->
<a class="btn btn-danger">Delete</a>        <!-- Red -->
<a class="btn btn-secondary">Cancel</a>     <!-- Gray -->
<a class="btn btn-outline">Link Action</a>  <!-- Transparent -->
<a class="btn btn-ghost">Subtle</a>         <!-- No border -->
```

### With Icons (Bootstrap Icons)
```html
<a class="btn btn-primary">
  <i class="bi bi-plus-circle"></i> Add
</a>

<a class="btn btn-warning">
  <i class="bi bi-pencil"></i> Edit
</a>

<button class="btn btn-danger">
  <i class="bi bi-trash"></i> Delete
</button>
```

---

## Tables

```html
<div class="table-wrapper">
  <table class="modern-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><span class="badge badge-primary">1</span></td>
        <td>John Doe</td>
        <td>john@example.com</td>
        <td>
          <div class="action-cell">
            <a href="/..." class="btn btn-primary btn-sm">
              <i class="bi bi-eye"></i> View
            </a>
            <a href="/..." class="btn btn-warning btn-sm">
              <i class="bi bi-pencil"></i> Edit
            </a>
            <button class="btn btn-danger btn-sm">
              <i class="bi bi-trash"></i> Delete
            </button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
```

---

## Badges

```html
<span class="badge badge-primary">1</span>
<span class="badge badge-success">Active</span>
<span class="badge badge-warning">Pending</span>
<span class="badge badge-danger">Blocked</span>
<span class="badge badge-info">Info</span>
```

---

## Alerts

```html
<!-- Success -->
<div class="alert alert-success">
  <i class="bi bi-check-circle"></i>
  <div class="alert-content">
    Operation completed successfully
  </div>
</div>

<!-- Warning -->
<div class="alert alert-warning">
  <i class="bi bi-exclamation-triangle"></i>
  <div class="alert-content">
    Please review before proceeding
  </div>
</div>

<!-- Danger -->
<div class="alert alert-danger">
  <i class="bi bi-exclamation-circle"></i>
  <div class="alert-content">
    An error occurred
  </div>
</div>

<!-- Info -->
<div class="alert alert-info">
  <i class="bi bi-info-circle"></i>
  <div class="alert-content">
    Additional information
  </div>
</div>
```

---

## Forms

```html
<div class="form-group">
  <label for="name">Full Name</label>
  <input type="text" id="name" placeholder="Enter your name">
</div>

<!-- Form Grid (Responsive columns) -->
<div class="form-grid-3">
  <div class="form-group">
    <label for="fname">First Name</label>
    <input type="text" id="fname">
  </div>
  <div class="form-group">
    <label for="mname">Middle Name</label>
    <input type="text" id="mname">
  </div>
  <div class="form-group">
    <label for="lname">Last Name</label>
    <input type="text" id="lname">
  </div>
</div>

<!-- Buttons -->
<div class="btn-group">
  <button class="btn btn-primary">Save</button>
  <a href="/back" class="btn btn-secondary">Cancel</a>
</div>
```

---

## Typography

```html
<h1>Page Title</h1>              <!-- 32px, bold -->
<h2>Section Title</h2>           <!-- 24px, bold -->
<h3>Subsection</h3>             <!-- 18px, bold -->

<p class="text-primary">Primary text</p>
<p class="text-secondary">Secondary text</p>
<p class="text-success">Success message</p>
<p class="text-warning">Warning message</p>
<p class="text-danger">Danger message</p>
```

---

## Spacing Utilities

```html
<!-- Margin Top -->
<div class="mt-sm">Small top margin</div>
<div class="mt-md">Medium top margin</div>
<div class="mt-lg">Large top margin</div>

<!-- Margin Bottom -->
<div class="mb-sm">Small bottom margin</div>
<div class="mb-md">Medium bottom margin</div>
<div class="mb-lg">Large bottom margin</div>

<!-- Padding -->
<div class="px-sm">Small horizontal padding</div>
<div class="px-md">Medium horizontal padding</div>
<div class="px-lg">Large horizontal padding</div>

<!-- Gaps in flexbox -->
<div class="flex gap-sm">Flex with small gap</div>
<div class="flex gap-md">Flex with medium gap</div>
<div class="flex gap-lg">Flex with large gap</div>
```

---

## Grid Layouts

```html
<!-- 2-column grid -->
<div class="grid grid-2">
  <div>Column 1</div>
  <div>Column 2</div>
</div>

<!-- 3-column grid -->
<div class="grid grid-3">
  <div>Column 1</div>
  <div>Column 2</div>
  <div>Column 3</div>
</div>

<!-- Auto-responsive form grid -->
<div class="form-grid-3">
  <!-- Auto-adjusts to 1 column on mobile -->
</div>
```

---

## Flexbox Utilities

```html
<!-- Centered content -->
<div class="flex-center">Content</div>

<!-- Space between -->
<div class="flex-between">
  <span>Left</span>
  <span>Right</span>
</div>

<!-- Column direction -->
<div class="flex-column gap-md">
  <div>Row 1</div>
  <div>Row 2</div>
</div>
```

---

## Detail Items (For display pages)

```html
<div class="detail-grid">
  <div class="detail-item">
    <div class="detail-label">First Name</div>
    <div class="detail-value">John</div>
  </div>
  <div class="detail-item">
    <div class="detail-label">Last Name</div>
    <div class="detail-value">Doe</div>
  </div>
</div>
```

---

## Shadow & Rounded Utilities

```html
<div class="rounded">Border radius 8px</div>
<div class="rounded-sm">Border radius 4px</div>
<div class="rounded-lg">Border radius 12px</div>

<div class="shadow-sm">Small shadow</div>
<div class="shadow-md">Medium shadow</div>
```

---

## Color Variables (For Custom CSS)

```css
/* Use in your custom styles */
.custom-element {
  color: var(--text-main);
  background-color: var(--bg-surface);
  border: 1px solid var(--border-light);
}

.custom-button {
  background-color: var(--primary);
}

.custom-button:hover {
  background-color: var(--primary-hover);
}

.custom-success {
  color: var(--success);
  background-color: var(--success-light);
}
```

---

## Responsive Classes

```html
<!-- Hidden on mobile, visible on tablet+ -->
<div class="hide-mobile">Show on tablet+</div>

<!-- Full width buttons on mobile -->
<button class="btn btn-primary">Responsive</button>  <!-- Auto responsive -->
```

---

## Example Page Structure

```blade.php
@extends('format.layout')

@section('title', 'Page Title')

@section('content')

<style>
  /* Page-specific styles using CSS variables */
  .page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-lg);
  }
</style>

<!-- Header -->
<div class="page-header">
  <h1>Page Title</h1>
  <a href="/create" class="btn btn-primary btn-lg">Add New</a>
</div>

<!-- Alerts -->
@if(session('success'))
  <div class="alert alert-success">
    <i class="bi bi-check-circle"></i>
    <div class="alert-content">{{ session('success') }}</div>
  </div>
@endif

<!-- Search/Filter -->
<input type="text" placeholder="Search..." style="max-width: 500px; margin-bottom: var(--spacing-lg);">

<!-- Table -->
<div class="table-wrapper">
  <table class="modern-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($items as $item)
        <tr>
          <td><span class="badge badge-primary">{{ $loop->iteration }}</span></td>
          <td>{{ $item->name }}</td>
          <td>
            <div class="action-cell">
              <a href="/{{ $item->id }}" class="btn btn-primary btn-sm">View</a>
              <a href="/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
              <button class="btn btn-danger btn-sm">Delete</button>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Pagination -->
<div class="pagination-wrapper">
  <span class="pagination-info">Showing X-Y of Z items</span>
  <div>{{ $items->links('pagination::bootstrap-5') }}</div>
</div>

@endsection
```

---

## Key CSS Variables to Remember

```css
/* Colors */
var(--primary)              /* #2F6DB2 - Click actions */
var(--success)              /* #7BAE7F - Positive actions */
var(--warning)              /* #E6B85C - Caution/Edit */
var(--danger)               /* #D97A7A - Delete/Destructive */
var(--text-main)            /* #222222 - Primary text */
var(--text-secondary)       /* #7A7A7A - Muted text */
var(--bg-surface)           /* #FFFFFF - Card/table bg */
var(--border-light)         /* #E9E5DC - Light borders */

/* Spacing (8px base) */
var(--spacing-sm)           /* 8px */
var(--spacing-md)           /* 16px */
var(--spacing-lg)           /* 24px */
var(--spacing-xl)           /* 32px */

/* Typography */
var(--font-size-sm)         /* 12px */
var(--font-size-base)       /* 14px */
var(--font-size-lg)         /* 16px */
var(--font-size-xl)         /* 18px */
var(--font-size-2xl)        /* 24px */
var(--font-size-3xl)        /* 32px */

/* Radius */
var(--radius-sm)            /* 4px */
var(--radius-md)            /* 8px */
var(--radius-lg)            /* 12px */
var(--radius-full)          /* 9999px - circles */
```

---

## Next Steps

1. **Test Students Page** - Refresh and verify visual changes
2. **Update Other Pages** - Follow this pattern for:
   - `resources/views/degrees/index.blade.php`
   - `resources/views/addstudent.blade.php`
   - `resources/views/editStudent.blade.php`
   - `resources/views/addDegree.blade.php`
   - `resources/views/editDegree.blade.php`
   - `resources/views/studentDetails.blade.php`
   - `resources/views/activityLog.blade.php`
3. **Test on Mobile** - Ensure responsive design works
4. **Consistency Check** - Verify all colors use variables
