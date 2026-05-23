@extends('format.layout')

@section('title','User Profile')

@section('content')

<style>
  .profile-header {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-xl);
    margin-bottom: var(--spacing-xl);
    flex-wrap: wrap;
  }

  .profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    font-size: 48px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
  }

  .profile-info {
    flex: 1;
    min-width: 250px;
  }

  .profile-info h1 {
    margin: 0 0 var(--spacing-sm) 0;
    font-size: var(--font-size-xxl);
  }

  .profile-email {
    color: var(--text-secondary);
    font-size: var(--font-size-lg);
    margin-bottom: var(--spacing-md);
  }

  .profile-card {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: var(--radius-lg);
    padding: var(--spacing-lg);
    margin-bottom: var(--spacing-lg);
  }

  .profile-card h2 {
    font-size: var(--font-size-lg);
    margin-bottom: var(--spacing-md);
    color: var(--text-primary);
  }

  .profile-bio {
    color: var(--text-secondary);
    line-height: 1.6;
    min-height: 60px;
    padding: var(--spacing-md);
    background: var(--bg-light);
    border-radius: var(--radius-md);
  }

  .profile-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: var(--spacing-md);
    margin-top: var(--spacing-md);
  }

  .stat-item {
    text-align: center;
    padding: var(--spacing-md);
    background: var(--bg-light);
    border-radius: var(--radius-md);
  }

  .stat-value {
    font-size: var(--font-size-xl);
    font-weight: 700;
    color: var(--primary);
  }

  .stat-label {
    font-size: var(--font-size-sm);
    color: var(--text-secondary);
    margin-top: var(--spacing-xs);
  }

  @media (max-width: 768px) {
    .profile-header {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    .profile-info {
      width: 100%;
    }

    .profile-avatar {
      width: 100px;
      height: 100px;
      font-size: 40px;
    }
  }
</style>

<div class="profile-header">
  <div class="profile-avatar">
    {{ strtoupper(substr($user->name, 0, 1)) }}
  </div>
  <div class="profile-info">
    <h1>{{ $user->name }}</h1>
    <p class="profile-email">{{ $user->email }}</p>
    @if($user->created_at)
      <p style="color: var(--text-secondary); margin: 0;">Member since {{ \Carbon\Carbon::parse($user->created_at)->format('F Y') }}</p>
    @endif
  </div>
</div>

@if($user->profile)
  <div class="profile-card">
    <h2>Bio</h2>
    <div class="profile-bio">
      {{ $user->profile->bio ?? 'No bio added yet.' }}
    </div>
  </div>
@endif

<div class="profile-card">

  <div class="profile-stats">
    <div class="stat-item">
      <div class="stat-value">{{ $user->posts->count() }}</div>
      <div class="stat-label">Posts Created</div>
    </div>
  </div>
</div>

@endsection

@section('footer')
@parent
<p>Copyright 2024. All rights reserved.</p>
@endsection
