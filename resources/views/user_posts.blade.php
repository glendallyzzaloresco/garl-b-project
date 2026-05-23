@extends('format.layout')

@section('title','User Posts')

@section('content')

<style>
  .posts-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: var(--spacing-xl);
    flex-wrap: wrap;
    gap: var(--spacing-lg);
  }

  .posts-title {
    margin: 0;
  }

  .post-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    margin-bottom: var(--spacing-lg);
    transition: all 0.3s ease;
  }

  .post-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-color: var(--primary);
  }

  .post-header {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-md);
    padding-bottom: var(--spacing-md);
    border-bottom: 1px solid var(--border-color);
  }

  .post-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--primary);
    color: white;
    font-size: var(--font-size-md);
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .post-meta {
    flex: 1;
  }

  .post-author {
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
  }

  .post-date {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
    margin: 0;
  }

  .post-title {
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 var(--spacing-sm) 0;
  }

  .post-content {
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
  }

  .empty-state {
    text-align: center;
    padding: var(--spacing-xl) var(--spacing-lg);
    background: var(--card-bg);
    border: 2px dashed var(--border-color);
    border-radius: var(--radius-lg);
  }

  .empty-state-icon {
    font-size: 48px;
    margin-bottom: var(--spacing-lg);
    opacity: 0.5;
  }

  .empty-state h3 {
    margin-bottom: var(--spacing-sm);
  }

  .empty-state p {
    color: var(--text-secondary);
    margin: 0;
  }

  @media (max-width: 768px) {
    .posts-header {
      flex-direction: column;
      align-items: flex-start;
    }

    .post-header {
      flex-wrap: wrap;
    }

    .post-title {
      font-size: var(--font-size-md);
    }
  }
</style>

<div class="posts-header">
  <div>
    <h1 class="posts-title">{{ $user->name }}'s Posts</h1>
    <p class="text-secondary" style="margin-top: var(--spacing-sm);">{{ $user->posts->count() }} post{{ $user->posts->count() !== 1 ? 's' : '' }} published</p>
  </div>
</div>

@if($user->posts->count() > 0)
  @foreach($user->posts as $post)
    <div class="post-card">
      <div class="post-header">
        <div class="post-avatar">
          {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="post-meta">
          <p class="post-author">{{ $user->name }}</p>
          @if($post->created_at)
            <p class="post-date">{{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y \a\t H:i') }}</p>
          @endif
        </div>
      </div>
      <h2 class="post-title">{{ $post->title }}</h2>
      <p class="post-content">{{ $post->content }}</p>
    </div>
  @endforeach
@else
  <div class="empty-state">
    <div class="empty-state-icon">📝</div>
    <h3>No posts yet</h3>
    <p>{{ $user->name }} hasn't published any posts yet.</p>
  </div>
@endif

<div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-lg); border-top: 1px solid var(--border-color);">
  <h3>Upload New Post</h3>
  <form action="/upload-image" method="POST" enctype="multipart/form-data">
      @csrf

      <input type="text" name="title" placeholder="Post Title"  style="width: 100%; padding: var(--spacing-sm); margin-bottom: var(--spacing-sm); border: 1px solid var(--border-color); border-radius: var(--radius-md);">
      <textarea name="content" placeholder="Post Content"  style="width: 100%; padding: var(--spacing-sm); margin-bottom: var(--spacing-sm); border: 1px solid var(--border-color); border-radius: var(--radius-md); min-height: 120px;"></textarea>
      <input type="file" name="image"  style="margin-bottom: var(--spacing-sm);">

      <button type="submit" style="background: var(--primary); color: white; padding: var(--spacing-sm) var(--spacing-lg); border: none; border-radius: var(--radius-md); cursor: pointer;">Upload</button>
  </form>

  @if ($errors->any())
      <div style="background: #fee; padding: var(--spacing-md); border-radius: var(--radius-md); margin-top: var(--spacing-md);">
          @foreach ($errors->all() as $error)
              <p style="color: #c00; margin: var(--spacing-sm) 0;">{{ $error }}</p>
          @endforeach
      </div>
  @endif
</div>

@endsection

@section('footer')
@parent
<p>Copyright 2024. All rights reserved.</p>
@endsection
