@php
    $services = [
        'web-development' => [
            'id' => 'web-development',
            'title' => 'Web Development',
            'description' =>
                'We create responsive, modern websites that deliver exceptional user experiences. Our web development services include custom website design, e-commerce solutions, and web applications.',
            'features' => ['Custom Website Development', 'E-commerce Solutions', 'Web Applications'],
            'link' => '/services/web-development',
            'image' => 'https://i.gifer.com/GR7w.gif',
            'active' => true,
        ],
        'app-development' => [
            'id' => 'app-development',
            'title' => 'App Development',
            'description' =>
                'Transform your ideas into powerful mobile applications. We develop native and cross-platform apps for iOS and Android that are scalable, secure, and user-friendly.',
            'features' => ['Native iOS & Android Apps', 'Cross-Platform Development', 'App Maintenance & Support'],
            'link' => '/services/app-design&development',
            'image' => 'https://miro.medium.com/v2/resize:fit:1200/0*psY5ZbMSEk7UXrw-.gif',
            'active' => false,
        ],
        'e-commerce' => [
            'id' => 'e-commerce',
            'title' => 'E-Commerce',
            'description' =>
                'Build your online store with our comprehensive e-commerce solutions. We create secure, scalable, and user-friendly platforms that drive sales and enhance customer experience.',
            'features' => ['Custom E-commerce Platforms', 'Payment Gateway Integration', 'Inventory Management'],
            'link' => '/services/e_commerce',
            'image' => 'https://i.pinimg.com/originals/99/1f/9e/991f9e7a79a5fc945310b8c54f0fb9d2.gif',
            'active' => false,
        ],
        'ui-ux-design' => [
            'id' => 'ui-ux-design',
            'title' => 'UI/UX Design',
            'description' =>
                'Create engaging user experiences with our UI/UX design services. We combine creativity with user-centered design principles to deliver intuitive and visually appealing interfaces.',
            'features' => ['User Interface Design', 'User Experience Design', 'Prototyping & Wireframing'],
            'link' => '/services/ui-ux-design',
            'image' =>
                'https://cdn.dribbble.com/userupload/24153620/file/original-644051f8226411aebdb7df782ef56a7e.gif',
            'active' => false,
        ],
    ];

    $buttons = [
        [
            'id' => 'web-development',
            'title' => 'Web Development',
            'icon' => 'fas fa-code',
            'active' => true,
        ],
        [
            'id' => 'app-development',
            'title' => 'App Development',
            'icon' => 'fas fa-mobile-alt',
            'active' => false,
        ],
        [
            'id' => 'e-commerce',
            'title' => 'E-Commerce',
            'icon' => 'fas fa-shopping-cart',
            'active' => false,
        ],
        [
            'id' => 'ui-ux-design',
            'title' => 'UI/UX Design',
            'icon' => 'fas fa-paint-brush',
            'active' => false,
        ],
    ];
@endphp

{{-- Our Services Section --}}
<section id="services"
    class="our-services-section py-12 md:py-16 lg:py-20 px-4 md:px-8 lg:px-24 bg-gradient-to-br from-gray-50 pb-24 md:pb-32 to-white">
    <div class="our-services-container max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="our-services-header text-center mb-12 md:mb-16">
            <div class="our-services-badge inline-flex items-center space-x-2 md:space-x-3 mb-3 md:mb-4">
                <div class="our-services-badge-line w-1.5 md:w-2 h-6 md:h-8 rounded-full"></div>
                <span class="our-services-badge-text font-medium text-base md:text-lg">What We Offer</span>
            </div>
            <h2 class="our-services-title text-3xl md:text-4xl lg:text-5xl font-bold mb-4 md:mb-6">Our Services</h2>
            <p class="our-services-description text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                We provide comprehensive digital solutions to help your business grow. Choose from our range of services
                below to learn more about how we can help you achieve your goals.
            </p>
        </div>

        <!-- Service Buttons -->
        <div class="our-services-buttons grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-8 md:mb-12">
            @foreach ($buttons as $button)
                <x-service-button :button="$button" />
            @endforeach
        </div>

        <!-- Service Content -->
        <div class="our-services-content">
            @foreach ($services as $service)
                <x-service-content :service='$service' />
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.our-services-button');
        const contentItems = document.querySelectorAll('.our-services-content-item');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and content items
                buttons.forEach(btn => btn.classList.remove('active'));
                contentItems.forEach(item => item.classList.remove('active'));

                // Add active class to clicked button
                button.classList.add('active');

                // Show corresponding content
                const serviceId = button.getAttribute('data-service');
                document.getElementById(serviceId).classList.add('active');
            });
        });
    });
</script>
