@extends ('format.layout')

 @section ('title')
    Profile - Client Portal
@endsection

@section ('header')
    @parent
@endsection

@section ('content')
    <div class="hero">
        <h1>Dashboard</h1>
        <p>Welcome to your client portal. Monitor your activity and manage your account from here.</p>
    </div>

    <div class="grid-2">
        <div class="card">
            <h2 class="card-title">📊 Statistics</h2>
            <p class="card-text">View your account performance and key metrics at a glance.</p>
            <div style="margin-top: 1.5rem;">
                <span class="stat">Total Requests: 24</span>
                <span class="stat" style="margin-left: 1rem;">Active Projects: 5</span>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">🔔 Recent Activities</h2>
            <p class="card-text">Your latest updates and notifications appear here.</p>
            <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                <li style="padding: 0.5rem 0; border-bottom: 1px solid rgba(20,33,61,0.1);">
                    <strong>Project Updated</strong> · 2 hours ago
                </li>
                <li style="padding: 0.5rem 0; border-bottom: 1px solid rgba(20,33,61,0.1);">
                    <strong>New Message</strong> · 5 hours ago
                </li>
                <li style="padding: 0.5rem 0;">
                    <strong>Invoice Ready</strong> · 1 day ago
                </li>
            </ul>
        </div>

        <div class="card">
            <h2 class="card-title">📁 Quick Access</h2>
            <p class="card-text">Fast links to your most-used features and documents.</p>
            <div style="margin-top: 1.5rem; display: flex; flex-direction: column; gap: 0.8rem;">
                <a href="#" class="btn btn-secondary">View Projects</a>
                <a href="#" class="btn btn-secondary">Download Reports</a>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">⚡ Quick Stats</h2>
            <p class="card-text">Essential metrics about your account usage.</p>
            <div style="margin-top: 1.5rem;">
                <div style="margin-bottom: 1rem;">
                    <div style="font-size: 0.9rem; color: var(--muted); margin-bottom: 0.3rem;">Storage Used</div>
                    <div style="width: 100%; height: 8px; background: rgba(20,33,61,0.1); border-radius: 4px; overflow: hidden;">
                        <div style="width: 65%; height: 100%; background: linear-gradient(90deg, var(--accent), #0a5a54);"></div>
                    </div>
                    <div style="font-size: 0.85rem; color: var(--muted); margin-top: 0.3rem;">6.5 GB of 10 GB</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top: 2rem;">
        <h2 class="card-title">💡 Tips & Resources</h2>
        <div class="grid-2">
            <div style="padding: 1rem; background: rgba(15, 118, 110, 0.05); border-radius: 8px;">
                <h3 style="margin: 0 0 0.5rem 0; color: var(--accent);">Getting Started</h3>
                <p style="margin: 0; font-size: 0.9rem; color: var(--muted);">Learn the basics of managing your account and projects.</p>
            </div>
            <div style="padding: 1rem; background: rgba(231, 111, 81, 0.05); border-radius: 8px;">
                <h3 style="margin: 0 0 0.5rem 0; color: var(--accent-2);">Need Help?</h3>
                <p style="margin: 0; font-size: 0.9rem; color: var(--muted);">Check our documentation or contact support.</p>
            </div>
        </div>
    </div>
@endsection

@section ('footer')
    @parent
@endsection
Aly
@extends('format.layout')

@section('title')
    My Profile - Client Portal
@endsection


@section('header')
    @parent
@endsection


@section('content')
    <div class="hero">
        <h1>My Profile</h1>
        <p>Manage your account information and preferences.</p>
    </div>

    <div style="max-width: 800px;">
        <div class="card">
            <h2 class="card-title">👤 Profile Information</h2>
            <form style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; color: var(--ink); margin-bottom: 0.5rem;">Full Name</label>
                    <input type="text" value="John Doe" style="width: 100%; padding: 0.7rem; border: 1px solid rgba(20,33,61,0.2); border-radius: 8px; font-family: inherit; font-size: 1rem;" placeholder="Your full name">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: var(--ink); margin-bottom: 0.5rem;">Email Address</label>
                    <input type="email" value="john.doe@example.com" style="width: 100%; padding: 0.7rem; border: 1px solid rgba(20,33,61,0.2); border-radius: 8px; font-family: inherit; font-size: 1rem;" placeholder="your.email@example.com">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: var(--ink); margin-bottom: 0.5rem;">Phone Number</label>
                    <input type="tel" value="+1 (555) 123-4567" style="width: 100%; padding: 0.7rem; border: 1px solid rgba(20,33,61,0.2); border-radius: 8px; font-family: inherit; font-size: 1rem;" placeholder="+1 (555) 123-4567">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: var(--ink); margin-bottom: 0.5rem;">Company</label>
                    <input type="text" value="Acme Corporation" style="width: 100%; padding: 0.7rem; border: 1px solid rgba(20,33,61,0.2); border-radius: 8px; font-family: inherit; font-size: 1rem;" placeholder="Your company name">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: var(--ink); margin-bottom: 0.5rem;">Bio</label>
                    <textarea style="width: 100%; padding: 0.7rem; border: 1px solid rgba(20,33,61,0.2); border-radius: 8px; font-family: inherit; font-size: 1rem; resize: vertical; min-height: 100px;" placeholder="Tell us about yourself...">Passionate professional with expertise in project management and strategic planning.</textarea>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button class="btn btn-primary">Save Changes</button>
                    <button class="btn btn-secondary" type="button">Cancel</button>
                </div>
            </form>
        </div>

        <div class="card">
            <h2 class="card-title">🔐 Security Settings</h2>
            <div style="display: grid; gap: 1rem;">
                <div style="padding: 1rem; background: rgba(20,33,61,0.05); border-radius: 8px;">
                    <h3 style="margin: 0 0 0.5rem 0; color: var(--ink);">Password</h3>
                    <p class="card-text" style="margin: 0 0 1rem 0;">Last changed 3 months ago</p>
                    <button class="btn btn-secondary">Change Password</button>
                </div>

                <div style="padding: 1rem; background: rgba(20,33,61,0.05); border-radius: 8px;">
                    <h3 style="margin: 0 0 0.5rem 0; color: var(--ink);">Two-Factor Authentication</h3>
                    <p class="card-text" style="margin: 0;">Status: <span style="color: var(--accent); font-weight: 600;">Enabled ✓</span></p>
                </div>

                <div style="padding: 1rem; background: rgba(20,33,61,0.05); border-radius: 8px;">
                    <h3 style="margin: 0 0 0.5rem 0; color: var(--ink);">Active Sessions</h3>
                    <p class="card-text" style="margin: 0 0 1rem 0;">You have 2 active sessions</p>
                    <button class="btn btn-secondary">Manage Sessions</button>
                </div>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">⚙️ Preferences</h2>
            <div style="display: flex; flex-direction: column; gap: 1.2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.8rem 0; border-bottom: 1px solid rgba(20,33,61,0.1);">
                    <div>
                        <h4 style="margin: 0; color: var(--ink);">Email Notifications</h4>
                        <p style="margin: 0.5rem 0 0 0; font-size: 0.9rem; color: var(--muted);">Receive updates via email</p>
                    </div>
                    <input type="checkbox" checked style="width: 20px; height: 20px; cursor: pointer;">
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.8rem 0; border-bottom: 1px solid rgba(20,33,61,0.1);">
                    <div>
                        <h4 style="margin: 0; color: var(--ink);">Marketing Communications</h4>
                        <p style="margin: 0.5rem 0 0 0; font-size: 0.9rem; color: var(--muted);">Hear about new features and offers</p>
                    </div>
                    <input type="checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.8rem 0;">
                    <div>
                        <h4 style="margin: 0; color: var(--ink);">Dark Mode</h4>
                        <p style="margin: 0.5rem 0 0 0; font-size: 0.9rem; color: var(--muted);">Prefer dark interface</p>
                    </div>
                    <input type="checkbox" style="width: 20px; height: 20px; cursor: pointer;">
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    <p>All rights reserved</p>
@endsection