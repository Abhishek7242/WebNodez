@php
    $whyUsPoints = [
        [
            'title' => 'Expert Team',
            'description' =>
                'Our team consists of certified professionals with years of industry experience and proven track records.',
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-12 h-12" fill="currentColor"><path d="M352 128c0 70.7-57.3 128-128 128s-128-57.3-128-128S153.3 0 224 0s128 57.3 128 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>',
        ],
        [
            'title' => 'Innovative Solutions',
            'description' =>
                'We leverage cutting-edge technologies and creative approaches to deliver unique solutions that drive results.',
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12" fill="currentColor"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>',
        ],
        [
            'title' => 'Quality Assurance',
            'description' =>
                'We maintain rigorous quality standards and thorough testing procedures to ensure flawless delivery.',
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12" fill="currentColor"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>',
        ],
        [
            'title' => '24/7 Support',
            'description' =>
                'Our dedicated support team is available round the clock to assist you with any queries or concerns.',
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12" fill="currentColor"><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 464c-114.7 0-208-93.31-208-208S141.3 48 256 48s208 93.31 208 208S370.7 464 256 464zM296 336h-16V248C280 234.8 269.3 224 256 224H224C210.8 224 200 234.8 200 248S210.8 272 224 272h8v64h-16C202.8 336 192 346.8 192 360S202.8 384 216 384h80c13.25 0 24-10.75 24-24S309.3 336 296 336zM256 192c17.67 0 32-14.33 32-32c0-17.67-14.33-32-32-32S224 142.3 224 160C224 177.7 238.3 192 256 192z"/></svg>',
        ],
        [
            'title' => 'Cost-Effective',
            'description' =>
                'We offer competitive pricing without compromising on quality, ensuring maximum value for your investment.',
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12" fill="currentColor"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>',
        ],
        [
            'title' => 'Timely Delivery',
            'description' => 'We understand the importance of deadlines and ensure timely delivery of all projects.',
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12" fill="currentColor"><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>',
        ],
    ];
@endphp

<section class="why-us-section">
    <div class="why-us-container">
        <!-- Left Side - Main Content -->
        <div class="why-us-content">
            <div class="section-header">
                <span class="section-subtitle">Why Choose Us</span>
                <h2 class="section-title">Excellence in Every Detail</h2>
                <p class="section-description">
                    We combine expertise, innovation, and dedication to deliver exceptional results
                </p>
            </div>

            <!-- Feature Cards -->
            <div class="feature-grid">
                @foreach ($whyUsPoints as $index => $point)
                    <div class="feature-card" data-index="{{ $index }}">
                        <div class="feature-icon">
                            {!! $point['icon'] !!}
                        </div>
                        <div class="feature-content">
                            <h3>{{ $point['title'] }}</h3>
                            <p>{{ $point['description'] }}</p>
                        </div>
                        <div class="feature-line"></div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Side - Stats -->
        <div class="stats-container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-circle">
                        <span class="stat-number">500+</span>
                    </div>
                    <span class="stat-label">Projects Completed</span>
                    <p class="stat-detail">Successfully delivered projects across various industries with proven results
                    </p>
                </div>
                <div class="stat-item">
                    <div class="stat-circle">
                        <span class="stat-number">98%</span>
                    </div>
                    <span class="stat-label">Client Satisfaction</span>
                    <p class="stat-detail">Consistently high ratings from our satisfied clients worldwide</p>
                </div>
                <div class="stat-item">
                    <div class="stat-circle">
                        <span class="stat-number">15+</span>
                    </div>
                    <span class="stat-label">Years Experience</span>
                    <p class="stat-detail">Decades of expertise in delivering cutting-edge solutions</p>
                </div>
                <div class="stat-item">
                    <div class="stat-circle">
                        <span class="stat-number">24/7</span>
                    </div>
                    <span class="stat-label">Support Available</span>
                    <p class="stat-detail">Round-the-clock technical support and assistance for all clients</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Background Elements -->
    <div class="bg-elements">
        <div class="bg-circle circle-1"></div>
        <div class="bg-circle circle-2"></div>
        <div class="bg-circle circle-3"></div>
        <div class="bg-dots"></div>
    </div>
</section>
