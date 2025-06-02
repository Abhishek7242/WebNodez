{{-- @props(['faqs']) --}}

@php
    $faqs = [
        [
            'question' => 'What services do you offer?',
            'answer' =>
                'We offer a comprehensive range of web development services including custom website development, e-commerce solutions, web applications, mobile app development, and digital marketing services. Our team specializes in creating responsive, user-friendly, and scalable solutions tailored to your business needs.',
        ],
        [
            'question' => 'How long does it take to complete a project?',
            'answer' =>
                'Project timelines vary depending on the scope and complexity. A basic website might take 2-4 weeks, while more complex projects could take 2-3 months. We provide detailed timelines during the initial consultation and keep you updated throughout the development process.',
        ],
        [
            'question' => 'What is your pricing structure?',
            'answer' =>
                'Our pricing is project-based and depends on your specific requirements. We offer competitive rates and provide detailed quotes after understanding your project needs. We also offer flexible payment plans and can discuss budget-friendly options that meet your requirements.',
        ],
        [
            'question' => 'Do you provide ongoing support after project completion?',
            'answer' =>
                'Yes, we offer comprehensive post-launch support and maintenance services. This includes regular updates, security patches, performance monitoring, and technical support. We also provide training and documentation to help you manage your website effectively.',
        ],
        [
            'question' => 'What technologies do you use?',
            'answer' =>
                'We use modern, industry-standard technologies including HTML5, CSS3, JavaScript, PHP, Laravel, React, Node.js, and various other frameworks and tools. We choose the best technology stack based on your project requirements and goals.',
        ],
        [
            'question' => 'Can you help with existing websites?',
            'answer' =>
                'Absolutely! We can help improve, update, or redesign your existing website. Our team can analyze your current site, identify areas for improvement, and implement necessary changes to enhance performance, security, and user experience.',
        ],
    ];
@endphp

<section class="faq-section py-20 md:py-32 lg:py-40 px-4 md:px-8 lg:px-24 bg-gradient-to-br from-gray-50 to-white">
    <div class="faq-container max-w-4xl mx-auto">
        <!-- Section Header -->
        <div class="faq-header text-center mb-12 md:mb-16 lg:mb-24">
            <div class="faq-badge flex items-center justify-center space-x-3 mb-4 md:mb-6">
                <div class="faq-badge-line w-2 h-6 md:h-8 rounded-full"></div>
                <span class="faq-badge-text font-medium text-base md:text-lg">FAQ</span>
            </div>
            <h2 class="faq-title text-3xl md:text-4xl lg:text-5xl font-bold mb-4 md:mb-8">Frequently Asked Questions</h2>
            <p class="faq-description text-lg md:text-xl text-gray-600">
                Find answers to common questions about our services, process, and support. If you don't see your
                question here, feel free to contact us.
            </p>
        </div>

        <!-- FAQ Items -->
        <div class="faq-items space-y-4 md:space-y-6">
            @foreach ($faqs as $index => $faq)
                <div class="faq-item rounded-xl overflow-hidden">
                    <div class="faq-question p-4 md:p-6 flex items-center justify-between cursor-pointer"
                        onclick="toggleFAQ(this)">
                        <span
                            class="faq-question-text text-base md:text-lg lg:text-xl font-semibold text-gray-800">{{ $faq['question'] }}</span>
                        <div class="faq-icon-wrapper">
                            <i class="fas fa-chevron-down faq-icon transition-transform duration-300"></i>
                        </div>
                    </div>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300">
                        <div class="faq-answer-content p-4 md:p-6 text-sm md:text-base text-gray-600">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;
        const icon = element.querySelector('.faq-icon');

        // Toggle active class on question
        element.classList.toggle('active');

        // Toggle answer visibility
        if (answer.style.maxHeight) {
            answer.style.maxHeight = null;
            icon.style.transform = 'rotate(0deg)';
        } else {
            answer.style.maxHeight = answer.scrollHeight + "px";
            icon.style.transform = 'rotate(180deg)';
        }
    }
</script>
