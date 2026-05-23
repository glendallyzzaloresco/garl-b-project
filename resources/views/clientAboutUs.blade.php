@extends ('format.layout')

 @section ('title')
    About Us - Client Portal
@endsection

@section ('header')
    @parent
@endsection

@section ('content')
    <div class="hero">
        <h1>About Us</h1>
        <p>Learn about our mission, values, and the team behind the Client Portal.</p>
    </div>

    <div class="card">
        <h2 class="card-title">📖 Our Story</h2>
        <p class="card-text">The Client Portal was created with a vision to simplify client management and streamline communication. Founded in 2020, we've been dedicated to providing innovative solutions that help businesses thrive in the digital age.</p>
        <p class="card-text">Our platform has grown to serve thousands of clients worldwide, helping them manage their projects, collaborate efficiently, and achieve their business goals.</p>
    </div>

    <div class="card">
        <h2 class="card-title">🎯 Our Mission</h2>
        <p class="card-text">To empower businesses by providing intuitive, reliable, and secure tools that enhance productivity and foster meaningful client relationships.</p>
    </div>

    <div class="card">
        <h2 class="card-title">💎 Our Values</h2>
        <div class="grid-2">
            <div style="padding: 1.5rem; background: linear-gradient(135deg, rgba(15, 118, 110, 0.1), rgba(231, 111, 81, 0.05)); border-radius: 12px;">
                <h3 style="margin: 0 0 0.8rem 0; color: var(--accent); font-size: 1.1rem;">🚀 Innovation</h3>
                <p style="margin: 0; font-size: 0.95rem; color: var(--muted); line-height: 1.6;">We continuously improve and evolve our platform to meet the changing needs of our clients.</p>
            </div>

            <div style="padding: 1.5rem; background: linear-gradient(135deg, rgba(15, 118, 110, 0.1), rgba(231, 111, 81, 0.05)); border-radius: 12px;">
                <h3 style="margin: 0 0 0.8rem 0; color: var(--accent); font-size: 1.1rem;">🤝 Integrity</h3>
                <p style="margin: 0; font-size: 0.95rem; color: var(--muted); line-height: 1.6;">We operate with transparency and honesty in all our dealings with clients and partners.</p>
            </div>

            <div style="padding: 1.5rem; background: linear-gradient(135deg, rgba(15, 118, 110, 0.1), rgba(231, 111, 81, 0.05)); border-radius: 12px;">
                <h3 style="margin: 0 0 0.8rem 0; color: var(--accent); font-size: 1.1rem;">🛡️ Security</h3>
                <p style="margin: 0; font-size: 0.95rem; color: var(--muted); line-height: 1.6;">Your data security is our top priority. We implement industry-leading security measures.</p>
            </div>

            <div style="padding: 1.5rem; background: linear-gradient(135deg, rgba(15, 118, 110, 0.1), rgba(231, 111, 81, 0.05)); border-radius: 12px;">
                <h3 style="margin: 0 0 0.8rem 0; color: var(--accent); font-size: 1.1rem;">👥 Customer Focus</h3>
                <p style="margin: 0; font-size: 0.95rem; color: var(--muted); line-height: 1.6;">We prioritize our clients' success and provide exceptional support at every step.</p>
            </div>
        </div>
    </div>

    <div class="card">
        <h2 class="card-title">👨‍💼 Leadership Team</h2>
        <div class="grid-2">
            <div style="text-align: center; padding: 1.5rem; background: rgba(20,33,61,0.05); border-radius: 12px;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), #0a5a54); margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 2rem; font-weight: 700;">JD</div>
                <h3 style="margin: 0; color: var(--ink);">Jane Doe</h3>
                <p style="margin: 0.5rem 0 0 0; color: var(--accent); font-weight: 600;">CEO & Founder</p>
                <p style="margin: 0.8rem 0 0 0; color: var(--muted); font-size: 0.9rem;">15+ years of industry expertise</p>
            </div>

            <div style="text-align: center; padding: 1.5rem; background: rgba(20,33,61,0.05); border-radius: 12px;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-2), #d45a3a); margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 2rem; font-weight: 700;">MS</div>
                <h3 style="margin: 0; color: var(--ink);">Michael Smith</h3>
                <p style="margin: 0.5rem 0 0 0; color: var(--accent-2); font-weight: 600;">CTO & Co-Founder</p>
                <p style="margin: 0.8rem 0 0 0; color: var(--muted); font-size: 0.9rem;">Technical innovation leader</p>
            </div>

            <div style="text-align: center; padding: 1.5rem; background: rgba(20,33,61,0.05); border-radius: 12px;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #6366f1, #4f46e5); margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 2rem; font-weight: 700;">SJ</div>
                <h3 style="margin: 0; color: var(--ink);">Sarah Johnson</h3>
                <p style="margin: 0.5rem 0 0 0; color: #6366f1; font-weight: 600;">VP of Operations</p>
                <p style="margin: 0.8rem 0 0 0; color: var(--muted); font-size: 0.9rem;">Process optimization expert</p>
            </div>

            <div style="text-align: center; padding: 1.5rem; background: rgba(20,33,61,0.05); border-radius: 12px;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #ec4899, #db2777); margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 2rem; font-weight: 700;">RC</div>
                <h3 style="margin: 0; color: var(--ink);">Robert Chen</h3>
                <p style="margin: 0.5rem 0 0 0; color: #ec4899; font-weight: 600;">VP of Product</p>
                <p style="margin: 0.8rem 0 0 0; color: var(--muted); font-size: 0.9rem;">Product strategy leader</p>
            </div>
        </div>
    </div>

    <div class="card">
        <h2 class="card-title">📊 By The Numbers</h2>
        <div class="grid-2">
            <div style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; font-weight: 700; color: var(--accent);">5000+</div>
                <p style="margin: 0.5rem 0 0 0; color: var(--muted);">Active Clients</p>
            </div>

            <div style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; font-weight: 700; color: var(--accent-2);">120+</div>
                <p style="margin: 0.5rem 0 0 0; color: var(--muted);">Team Members</p>
            </div>

            <div style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; font-weight: 700; color: #6366f1;">50+</div>
                <p style="margin: 0.5rem 0 0 0; color: var(--muted);">Countries Served</p>
            </div>

            <div style="text-align: center; padding: 1.5rem;">
                <div style="font-size: 2.5rem; font-weight: 700; color: #ec4899;">99.9%</div>
                <p style="margin: 0.5rem 0 0 0; color: var(--muted);">Uptime Guarantee</p>
            </div>
        </div>
    </div>

    <div class="card">
        <h2 class="card-title">📞 Get In Touch</h2>
        <p class="card-text">We'd love to hear from you. Whether you have questions, feedback, or partnership opportunities, feel free to reach out.</p>
        <div style="margin-top: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
            <a href="mailto:contact@clientportal.com" class="btn btn-primary">Send us an Email</a>
            <a href="#" class="btn btn-secondary">Visit Our Website</a>
        </div>
    </div>
@endsection

@section ('footer')
    @parent
@endsection