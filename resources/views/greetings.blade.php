@extends ('format.layout')

 @section ('title')
    Welcome - Client Portal
@endsection

@section ('header')
    @parent
@endsection

@section ('content')
    <div class="hero">
        <div style="font-size: 3rem; margin-bottom: 1rem;">👋</div>
        <h1>Welcome to the Client Portal</h1>
        <p>We're thrilled to have you here. This is your central hub for managing all your projects and collaborations.</p>
    </div>

    <div class="grid-2">
        <div class="card">
            <h2 class="card-title">✨ Getting Started</h2>
            <p class="card-text">New to our platform? Follow these simple steps to get up and running:</p>
            <ol style="margin-top: 1rem; padding-left: 1.5rem; color: var(--muted); line-height: 1.8;">
                <li><strong style="color: var(--ink);">Complete your profile</strong> - Add your information and preferences</li>
                <li><strong style="color: var(--ink);">Explore the dashboard</strong> - See all your projects at a glance</li>
                <li><strong style="color: var(--ink);">Set up your preferences</strong> - Customize notifications and settings</li>
                <li><strong style="color: var(--ink);">Connect with your team</strong> - Start collaborating</li>
            </ol>
        </div>

        <div class="card">
            <h2 class="card-title">📚 Resources</h2>
            <p class="card-text">We have comprehensive documentation and tutorials to help you:</p>
            <div style="margin-top: 1.5rem; display: flex; flex-direction: column; gap: 0.8rem;">
                <a href="#" style="padding: 0.7rem; background: rgba(15, 118, 110, 0.08); border-radius: 8px; text-decoration: none; color: var(--accent); font-weight: 600; border-left: 3px solid var(--accent); padding-left: 1rem;">📖 User Guide & Documentation</a>
                <a href="#" style="padding: 0.7rem; background: rgba(231, 111, 81, 0.08); border-radius: 8px; text-decoration: none; color: var(--accent-2); font-weight: 600; border-left: 3px solid var(--accent-2); padding-left: 1rem;">🎓 Video Tutorials</a>
                <a href="#" style="padding: 0.7rem; background: rgba(99, 102, 241, 0.08); border-radius: 8px; text-decoration: none; color: #6366f1; font-weight: 600; border-left: 3px solid #6366f1; padding-left: 1rem;">💡 Best Practices</a>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">🆘 Support</h2>
            <p class="card-text">Need help? We're here for you. Contact our support team anytime:</p>
            <div style="margin-top: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                <div style="padding: 0.8rem; border-left: 3px solid var(--accent); background: rgba(15, 118, 110, 0.05); border-radius: 8px;">
                    <p style="margin: 0; font-weight: 600; color: var(--ink);">📧 Email Support</p>
                    <p style="margin: 0.3rem 0 0 0; color: var(--muted); font-size: 0.9rem;">support@clientportal.com</p>
                </div>
                <div style="padding: 0.8rem; border-left: 3px solid var(--accent-2); background: rgba(231, 111, 81, 0.05); border-radius: 8px;">
                    <p style="margin: 0; font-weight: 600; color: var(--ink);">💬 Live Chat</p>
                    <p style="margin: 0.3rem 0 0 0; color: var(--muted); font-size: 0.9rem;">Available 24/7 during business hours</p>
                </div>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">🎉 What's New</h2>
            <p class="card-text">Check out our latest updates and features:</p>
            <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                <li style="padding: 0.8rem 0; border-bottom: 1px solid rgba(20,33,61,0.1);">
                    <span style="display: inline-block; width: 8px; height: 8px; background: var(--accent); border-radius: 50%; margin-right: 0.5rem; vertical-align: middle;"></span>
                    <strong>Advanced Reporting Tools</strong> - Now live!
                </li>
                <li style="padding: 0.8rem 0; border-bottom: 1px solid rgba(20,33,61,0.1);">
                    <span style="display: inline-block; width: 8px; height: 8px; background: var(--accent); border-radius: 50%; margin-right: 0.5rem; vertical-align: middle;"></span>
                    <strong>Mobile App Update</strong> - Coming next week
                </li>
                <li style="padding: 0.8rem 0;">
                    <span style="display: inline-block; width: 8px; height: 8px; background: var(--accent); border-radius: 50%; margin-right: 0.5rem; vertical-align: middle;"></span>
                    <strong>AI-Powered Insights</strong> - Beta testing now open
                </li>
            </ul>
        </div>
    </div>

    <div class="card" style="text-align: center; margin-top: 2rem; background: linear-gradient(135deg, rgba(15, 118, 110, 0.1), rgba(231, 111, 81, 0.08));">
        <h2 class="card-title">Ready to Get Started?</h2>
        <p class="card-text" style="font-size: 1.05rem; max-width: 600px; margin-left: auto; margin-right: auto;">Explore your dashboard, connect with your team, and start achieving your goals today.</p>
        <div style="margin-top: 1.5rem; display: flex; gap: 1rem; justify-content: center;">
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
            <a href="{{ route('profile') }}" class="btn btn-secondary">Complete Profile</a>
        </div>
    </div>
@endsection

@section ('footer')
    @parent
@endsection