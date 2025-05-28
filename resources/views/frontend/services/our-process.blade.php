@php
    $processes = [
        [
            'number' => '01',
            'title' => 'Initial Consultation',
            'description' =>
                'We start with a detailed discussion to understand your business needs, goals, and vision. This includes analyzing your current digital presence, identifying pain points, and setting clear objectives.',
            'icon' => 'fas fa-comments',
            'color' => 'from-blue-500 to-blue-600',
            'substeps' => ['Business Analysis', 'Goal Setting', 'Requirement Gathering', 'Budget Planning'],
        ],
        [
            'number' => '02',
            'title' => 'Planning',
            'description' =>
                'Our team develops a comprehensive strategy tailored to your needs. We create detailed project timelines, resource allocation, and technical specifications to ensure smooth execution.',
            'icon' => 'fas fa-chess',
            'color' => 'from-purple-500 to-purple-600',
            'substeps' => ['Project Roadmap', 'Resource Planning', 'Technical Architecture', 'Risk Assessment'],
        ],
        [
            'number' => '03',
            'title' => 'Design',
            'description' =>
                'We create intuitive and engaging user interfaces that align with your brand. Our design process includes wireframing, prototyping, and user testing to ensure optimal user experience.',
            'icon' => 'fas fa-pencil-ruler',
            'color' => 'from-pink-500 to-pink-600',
            'substeps' => ['UI/UX Design', 'Wireframing', 'Prototyping', 'User Testing'],
        ],
        [
            'number' => '04',
            'title' => 'Development',
            'description' =>
                'Our expert developers bring the design to life using cutting-edge technologies. We follow agile methodologies, ensuring regular updates and maintaining high code quality standards.',
            'icon' => 'fas fa-code',
            'color' => 'from-green-500 to-green-600',
            'substeps' => ['Frontend Development', 'Backend Development', 'API Integration', 'Database Design'],
        ],
        [
            'number' => '05',
            'title' => 'Quality Assurance',
            'description' =>
                'Rigorous testing ensures your solution is robust and reliable. We conduct comprehensive testing across different devices, browsers, and scenarios to guarantee optimal performance.',
            'icon' => 'fas fa-vial',
            'color' => 'from-yellow-500 to-yellow-600',
            'substeps' => ['Unit Testing', 'Integration Testing', 'Performance Testing', 'Security Testing'],
        ],
        [
            'number' => '06',
            'title' => 'Deployment & Launch',
            'description' =>
                'We handle the deployment process with meticulous attention to detail. Our team ensures a smooth transition to production, with comprehensive documentation and training.',
            'icon' => 'fas fa-rocket',
            'color' => 'from-red-500 to-red-600',
            'substeps' => ['Server Setup', 'Deployment', 'Performance Monitoring', 'Launch Support'],
        ],
        [
            'number' => '07',
            'title' => 'Post-Launch Support',
            'description' =>
                'Our relationship continues after launch with comprehensive support and maintenance. We provide regular updates, security patches, and performance optimizations.',
            'icon' => 'fas fa-headset',
            'color' => 'from-indigo-500 to-indigo-600',
            'substeps' => ['Technical Support', 'Regular Updates', 'Performance Monitoring', 'Security Maintenance'],
        ],
        [
            'number' => '08',
            'title' => 'Growth & Optimization',
            'description' =>
                'We continuously analyze and optimize your solution for better performance. Our team provides insights and recommendations for ongoing improvements and growth.',
            'icon' => 'fas fa-chart-line',
            'color' => 'from-teal-500 to-teal-600',
            'substeps' => ['Performance Analytics', 'User Feedback', 'Feature Enhancement', 'Growth Strategy'],
        ],
    ];
@endphp

<section class="our-process-section py-40 px-6 md:px-12 lg:px-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="our-process-container max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="our-process-header text-center mb-24">
            <div class="our-process-badge flex items-center space-x-3 mb-6">
                <div class="our-process-badge-line w-2 h-8 rounded-full"></div>
                <span class="our-process-badge-text font-medium text-lg">How We Work</span>
            </div>
            <h2 class="our-process-title text-5xl md:text-6xl font-bold mb-8">Our Development Process</h2>
            <div class="our-process-description-container max-w-4xl mx-auto">
                <p class="our-process-description text-xl text-gray-600 mb-8">
                    We follow a proven methodology to ensure your project's success. Our process is designed to be
                    transparent, efficient, and results-driven.
                </p>
                <div class="our-process-key-points grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                    <div class="our-process-key-point">
                        <div class="our-process-key-point-icon">
                            <i class="fas fa-clock text-3xl text-primary"></i>
                        </div>
                        <h3 class="our-process-key-point-title text-xl font-semibold mt-4 mb-2">Time-Efficient</h3>
                        <p class="our-process-key-point-text text-gray-600">Streamlined process to deliver results
                            faster without compromising quality</p>
                    </div>
                    <div class="our-process-key-point">
                        <div class="our-process-key-point-icon">
                            <i class="fas fa-comments text-3xl text-primary"></i>
                        </div>
                        <h3 class="our-process-key-point-title text-xl font-semibold mt-4 mb-2">Clear Communication</h3>
                        <p class="our-process-key-point-text text-gray-600">Regular updates and transparent
                            communication throughout the project</p>
                    </div>
                    <div class="our-process-key-point">
                        <div class="our-process-key-point-icon">
                            <i class="fas fa-check-circle text-3xl text-primary"></i>
                        </div>
                        <h3 class="our-process-key-point-title text-xl font-semibold mt-4 mb-2">Quality Assured</h3>
                        <p class="our-process-key-point-text text-gray-600">Rigorous testing and quality checks at every
                            stage of development</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Process Steps -->
        <div class="our-process-steps grid grid-cols-1 md:grid-cols-2 gap-12">
            @foreach ($processes as $process)
                <div class="our-process-step group">
                    <div
                        class="our-process-step-inner bg-white rounded-2xl p-10 shadow-sm hover:shadow-xl transition-all duration-300 h-full">
                        <div class="flex items-start gap-8">
                            <div class="flex-shrink-0">
                                <div class="our-process-step-number mb-6">
                                    <span
                                        class="text-7xl font-bold bg-gradient-to-r {{ $process['color'] }} bg-clip-text text-transparent">
                                        {{ $process['number'] }}
                                    </span>
                                </div>
                                <div class="our-process-step-icon">
                                    <div
                                        class="w-24 h-24 rounded-full bg-gradient-to-r {{ $process['color'] }} flex items-center justify-center text-white text-4xl transform group-hover:scale-110 transition-transform duration-300">
                                        <i class="{{ $process['icon'] }}"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h3 class="our-process-step-title text-2xl font-bold mb-4">{{ $process['title'] }}</h3>
                                <p class="our-process-step-description text-gray-600 mb-6">
                                    {{ $process['description'] }}
                                </p>
                                <div class="our-process-substeps space-y-3">
                                    @foreach ($process['substeps'] as $substep)
                                        <div class="our-process-substep flex items-center text-sm">
                                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                            <span>{{ $substep }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Process Timeline -->
        <div class="our-process-timeline mt-32 relative">
            <div
                class="our-process-timeline-line absolute top-0 left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-blue-500 to-teal-600">
            </div>
            <div class="our-process-timeline-dots grid grid-cols-1 md:grid-cols-2 gap-12">
                @foreach ($processes as $index => $process)
                    <div class="our-process-timeline-dot {{ $index % 2 === 0 ? 'md:pr-12' : 'md:pl-12' }}">
                        <div
                            class="our-process-timeline-dot-inner bg-white rounded-full w-10 h-10 border-4 border-white shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
