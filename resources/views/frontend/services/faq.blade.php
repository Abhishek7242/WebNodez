@php
    $faqs = [
        [
            'question' => 'What services do you offer?',
            'answer' =>
                'We offer a comprehensive range of digital services including web development, mobile app development, UI/UX design, e-commerce solutions, and digital marketing services. Our team specializes in creating custom solutions tailored to your business needs.',
        ],
        [
            'question' => 'How long does it take to complete a project?',
            'answer' =>
                'Project timelines vary depending on the scope and complexity. A typical website project can take 4-8 weeks, while mobile apps may take 8-12 weeks. We provide detailed timelines during the initial consultation and keep you updated throughout the development process.',
        ],
        [
            'question' => 'What is your pricing structure?',
            'answer' =>
                'Our pricing is project-based and depends on your specific requirements. We offer transparent pricing with no hidden costs. After understanding your needs, we provide a detailed quote that includes all aspects of the project.',
        ],
        [
            'question' => 'Do you provide ongoing support?',
            'answer' =>
                'Yes, we offer comprehensive support and maintenance services. This includes regular updates, security patches, performance optimization, and technical support. We also provide training to help you manage your digital assets effectively.',
        ],
        [
            'question' => 'How do you ensure quality?',
            'answer' =>
                'We follow industry best practices and maintain high quality standards through rigorous testing procedures. Our development process includes multiple quality checks, user testing, and performance optimization to ensure the best possible outcome.',
        ],
        [
            'question' => 'Can you help with existing projects?',
            'answer' =>
                'Absolutely! We can help improve, maintain, or rebuild existing projects. Our team will analyze your current setup and provide recommendations for enhancements or necessary updates.',
        ],
    ];
@endphp

<x-faq :faqs='$faqs' />
