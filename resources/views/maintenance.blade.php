@extends('format.maintenance-layout')

@section('title','Students Management')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@300;400;500&display=swap');

:root {
  --navy: #1E3A8A;
  --blue: #3B82F6;
  --orange: #F97316;
  --bg: #F8FAFC;
  --card: #FFFFFF;
  --text: #111827;
  --text-2: #6B7280;
  --border: #E5E7EB;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

.maintenance-container {
  width: 100%;
  max-width: 700px;
  padding: 2rem;
  margin: 2rem auto;
}

.maintenance-card {
  background: var(--card);
  border-radius: 16px;
  padding: 3.5rem 2.5rem;
  text-align: center;
  box-shadow: 0 20px 60px rgba(30, 58, 138, 0.3);
  position: relative;
  overflow: hidden;
  animation: slideUp 0.6s 0.2s ease-out forwards;
  opacity: 0;
}

.maintenance-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--blue), var(--orange));
}

.maintenance-card::after {
  content: '';
  position: absolute;
  top: -100px;
  right: -100px;
  width: 300px;
  height: 300px;
  background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
  border-radius: 50%;
  z-index: 0;
}

.card-content {
  position: relative;
  z-index: 1;
}

.maintenance-icon {
  width: 120px;
  height: 120px;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(249, 115, 22, 0.2));
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 2rem;
  font-size: 56px;
  color: var(--orange);
  animation: pulse 2s ease-in-out infinite;
}

.maintenance-title {
  font-family: 'Playfair Display', serif;
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 0.5rem;
  line-height: 1.2;
  letter-spacing: -0.02em;
}

.maintenance-subtitle {
  font-size: 15px;
  color: var(--text-2);
  margin-bottom: 2rem;
  line-height: 1.6;
}

.maintenance-message {
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(249, 115, 22, 0.05));
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 1.5rem;
  margin-bottom: 2rem;
  color: var(--text);
  font-size: 14px;
  line-height: 1.7;
}

.maintenance-meta {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  margin-bottom: 2rem;
  padding: 0 1rem;
}

.meta-item {
  flex: 1;
}

.meta-label {
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-2);
  margin-bottom: 0.3rem;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 4px;
}

.meta-value {
  font-size: 14px;
  font-weight: 600;
  color: var(--navy);
}

.maintenance-status {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 0.5rem 1rem;
  background: #fef3c7;
  border: 1px solid #fcd34d;
  border-radius: 20px;
  font-size: 13px;
  font-weight: 600;
  color: #92400e;
  margin-bottom: 2rem;
}

.status-indicator {
  width: 8px;
  height: 8px;
  background: #f59e0b;
  border-radius: 50%;
  animation: blink 1.5s ease-in-out infinite;
}

.maintenance-footer {
  padding-top: 2rem;
  border-top: 1px solid var(--border);
  color: var(--text-2);
  font-size: 13px;
  line-height: 1.6;
}

.back-home-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  margin-top: 2rem;
  padding: 0.75rem 1.5rem;
  background: linear-gradient(135deg, var(--blue), #2563eb);
  color: white;
  text-decoration: none;
  border-radius: 8px;
  font-weight: 600;
  font-size: 13px;
  transition: all 0.3s ease;
  cursor: pointer;
  border: none;
}

.back-home-link:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.05);
  }
}

@keyframes blink {
  0%, 49%, 100% {
    opacity: 1;
  }
  50%, 99% {
    opacity: 0.3;
  }
}

@media (max-width: 600px) {
  .maintenance-card {
    padding: 2.5rem 1.5rem;
  }
  
  .maintenance-title {
    font-size: 1.8rem;
  }
  
  .maintenance-icon {
    width: 100px;
    height: 100px;
    font-size: 48px;
  }
  
  .maintenance-meta {
    grid-template-columns: 1fr;
    padding: 0;
  }
}
</style>

<div class="maintenance-container">
  <div class="maintenance-card">
    <div class="card-content">
      <div class="maintenance-icon">
        <i class="bi bi-tools"></i>
      </div>
      
      <h1 class="maintenance-title">Down for Maintenance</h1>
      <p class="maintenance-subtitle">We're making improvements to serve you better</p>
      
      <div class="maintenance-status">
        <span class="status-indicator"></span>
        Scheduled Maintenance in Progress
      </div>
      
      <div class="maintenance-message">
        <p>We're currently performing important maintenance and upgrades to our Student Management system. We apologize for any inconvenience and appreciate your patience as we work to improve your experience.</p>
      </div>
      
      <div class="maintenance-meta">
        <div class="meta-item">
          <div class="meta-label">
            <i class="bi bi-clock"></i> Expected Back
          </div>
          <div class="meta-value">{{ date('h:i A') }}</div>
        </div>
        <div class="meta-item">
          <div class="meta-label">
            <i class="bi bi-info-circle"></i> Status
          </div>
          <div class="meta-value">In Progress</div>
        </div>
      </div>
<!--       
      <a href="/" class="back-home-link">
        <i class="bi bi-arrow-left"></i> Back to Home
      </a> -->
      
      <div class="maintenance-footer">
        <p>Thank you for your patience.</p>
        <p>For more information, please contact our support team.</p>
      </div>
    </div>
  </div>
</div>

@endsection

@section('footer')
@parent
<p>Copyright 2024. All rights reserved.</p>
@endsection