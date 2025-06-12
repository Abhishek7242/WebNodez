@props([
    'projectNumber' => 50,
    'clientSatis' => 98,
])

<style>
    @media (max-width: 280px) {
        .stat-icon svg {
            width: 20px;
            height: 20px;
        }

        .why-solution-icon svg {
            width: 20px;
            height: 20px;
        }
    }
</style>
<section class="why-solution-section">
    <div class="why-solution-container">
        <div class="why-solution-header">
            <span class="why-solution-badge">Why Choose Us</span>
            <h2 class="why-solution-title">Empowering Your Digital Success</h2>
            <p class="why-solution-subtitle">Experience excellence in web development with our comprehensive
                solutions designed to elevate your online presence</p>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number" data-target="{{ $projectNumber }}">0</div>
                <div class="stat-label">Successful Projects</div>
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-target="{{ $clientSatis }}">0</div>
                <div class="stat-label">Client Satisfaction</div>
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="why-solution-grid">
            @php
                $solutionCards = [
                    [
                        'icon' => '<path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>',
                        'title' => 'Scalable Solutions',
                        'text' =>
                            'Build a foundation that grows with your business, ensuring your digital presence remains robust and efficient.',
                    ],
                    [
                        'icon' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
                        'title' => 'Expert Team',
                        'text' =>
                            'Work with experienced developers who understand your vision and bring it to life with precision and expertise.',
                    ],
                    [
                        'icon' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
                        'title' => 'Performance Focus',
                        'text' =>
                            'Optimize your website for speed and efficiency, providing an exceptional user experience across all devices.',
                    ],
                    [
                        'icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
                        'title' => 'Security First',
                        'text' =>
                            'Implement robust security measures to protect your data and ensure your website remains safe and secure.',
                    ],
                    [
                        'icon' =>
                            '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
                        'title' => 'Modern Technology',
                        'text' =>
                            'Stay ahead with cutting-edge technologies and frameworks that power modern, efficient web applications.',
                    ],
                    [
                        'icon' => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
                        'title' => '24/7 Support',
                        'text' =>
                            'Get round-the-clock assistance and maintenance to ensure your website runs smoothly at all times.',
                    ],
                    [
                        'icon' =>
                            '<path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/><line x1="16" y1="8" x2="2" y2="22"/><line x1="17.5" y1="15" x2="9" y2="15"/>',
                        'title' => 'Custom Solutions',
                        'text' =>
                            'Tailored development approaches that perfectly match your unique business requirements and goals.',
                    ],
                    [
                        'icon' => '<path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-6"/>',
                        'title' => 'SEO Optimization',
                        'text' =>
                            'Built-in search engine optimization to help your website rank higher and reach more potential customers.',
                    ],
                    [
                        'icon' =>
                            '<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/>',
                        'title' => 'User Experience',
                        'text' =>
                            'Intuitive interfaces and smooth interactions that keep your visitors engaged and coming back for more.',
                    ],
                ];
            @endphp

            @foreach ($solutionCards as $card)
                <div class="why-solution-card">
                    <div class="why-solution-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            {!! $card['icon'] !!}
                        </svg>
                    </div>
                    <h3 class="why-solution-card-title">{{ $card['title'] }}</h3>
                    <p class="why-solution-card-text">{{ $card['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stats = document.querySelectorAll('.stat-number');

        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const targetValue = parseInt(target.getAttribute('data-target'));
                    const duration = 2000; // 2 seconds
                    const step = targetValue / (duration / 16); // 60fps
                    let current = 0;

                    const updateCount = () => {
                        current += step;
                        if (current < targetValue) {
                            target.textContent = Math.floor(current) + (targetValue ===
                                {{ $projectNumber }} ? '+' : '%');
                            requestAnimationFrame(updateCount);
                        } else {
                            target.textContent = targetValue + (targetValue ===
                                {{ $projectNumber }} ? '+' : '%');
                        }
                    };

                    updateCount();
                    observer.unobserve(target);
                }
            });
        }, observerOptions);

        stats.forEach(stat => observer.observe(stat));
    });
</script>
