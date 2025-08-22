@extends('frontend/layouts/main')
@section('title', 'Linkuss - Terms & Conditions')
@section('meta_description',
    'Read Linkuss Terms and Conditions. Understand our service agreements, user
    responsibilities, intellectual property rights, and legal terms for using our web development and digital services.')
@section('meta_keywords',
    'terms and conditions, service agreement, legal terms, user agreement, website terms, service
    terms, legal policy, terms of use')
@section('og_image', asset('images/terms-og-image.jpg'))
@section('', 'active')
@section('main-section')
    <link href="{{ asset('css/terms_conditions.css') }}" rel="stylesheet">

    <script>
        // Set theme colors
        document.documentElement.style.setProperty('--text-color', 'var(--color-text)');
        document.documentElement.style.setProperty('--intro-bg', 'var(--color-bg)');

        // Check for dark mode preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.body.classList.add('dark-mode');
            document.documentElement.style.setProperty('--intro-bg', 'var(--dark-bg)');
        }

        // Listen for dark mode changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (e.matches) {
                document.body.classList.add('dark-mode');
                document.documentElement.style.setProperty('--intro-bg', 'var(--dark-bg)');
            } else {
                document.body.classList.remove('dark-mode');
                document.documentElement.style.setProperty('--intro-bg', 'var(--color-bg)');
            }
        });
    </script>

    <section class="max-w-4xl mx-auto text-center py-12 px-6 terms-section">
        <h1 class="text-5xl font-extrabold mb-4 tracking-tight text-primary">
            Terms and Conditions
        </h1>
        <p class="text-lg text-secondary max-w-3xl mx-auto">
            Please read these Terms and Conditions carefully before using our website and services. They outline your
            rights, responsibilities, and obligations when accessing or using our platform.
        </p>
    </section>
    </header>

    @php
        $termsSections = [
            [
                'id' => 'introduction',
                'title' => 'Introduction',
                'description' =>
                    'Welcome to Linkuss. By accessing or using our website and services, you agree to be bound by these Terms and Conditions. These terms constitute a legally binding agreement between you and Linkuss. If you do not agree to these terms, please do not use our services.',
            ],
            [
                'id' => 'definitions',
                'title' => 'Definitions',
                'description' =>
                    '"Service" refers to all services provided by Linkuss. "User," "you," and "your" refer to individuals or entities accessing or using our services. "We," "us," and "our" refer to Linkuss. "Content" includes all materials, information, and data available through our services.',
            ],
            [
                'id' => 'use-of-services',
                'title' => 'Use of Services',
                'description' => 'You agree to use our services only for lawful purposes and in compliance with all applicable laws and regulations. You shall not:
                <ul class="list-disc pl-6 mt-2 text-lg leading-relaxed">
                    <li>Use our services for any illegal or unauthorized purpose</li>
                    <li>Attempt to gain unauthorized access to any part of our services</li>
                    <li>Interfere with or disrupt the services or servers</li>
                    <li>Use automated systems or software to extract data from our services</li>
                    <li>Engage in any activity that could harm or impair the services</li>
                </ul>',
            ],
            [
                'id' => 'intellectual-property',
                'title' => 'Intellectual Property',
                'description' =>
                    'All content, trademarks, logos, and intellectual property displayed on this site are the property of Linkuss or its licensors. You may not use, reproduce, modify, distribute, or create derivative works without our express written consent. Any unauthorized use may result in legal action.',
            ],
            [
                'id' => 'user-accounts',
                'title' => 'User Accounts',
                'description' => 'When creating an account, you must provide accurate and complete information. You are responsible for:
                <ul class="list-disc pl-6 mt-2 text-lg leading-relaxed">
                    <li>Maintaining the confidentiality of your account credentials</li>
                    <li>All activities that occur under your account</li>
                    <li>Notifying us immediately of any unauthorized access</li>
                    <li>Ensuring your account information remains current and accurate</li>
                </ul>',
            ],
            [
                'id' => 'chatbot',
                'title' => 'Chatbot Usage Terms',
                'description' => '<p class="text-lg leading-relaxed mb-4">By using our chatbot, you acknowledge and agree to the following terms and conditions. The chatbot is provided as an automated tool for general assistance, customer support, and basic inquiries. It is not a substitute for professional advice.</p>
                <p class="text-lg leading-relaxed mb-4">All conversations with the chatbot may be recorded and stored for quality assurance, training, analytics, and service improvement purposes. By continuing to use the chatbot, you consent to this data collection. We take data privacy seriously, and any stored information is handled in accordance with our <a href="/privacy-policy#chatbot-policy" class="text-blue-600 underline">Privacy Policy</a>.</p>
                <p class="text-lg leading-relaxed mb-4">Users must not share sensitive personal information such as credit card numbers, passwords, or government-issued IDs within the chatbot. Any misuse of the chatbot, including abusive language, spamming, or attempts to manipulate the system, may result in temporary or permanent suspension of access.</p>
                <p class="text-lg leading-relaxed mb-4">While we strive for accuracy and helpfulness, the chatbot\'s responses may not always be correct, complete, or up-to-date. We do not accept liability for any loss or damage arising from reliance on chatbot responses.</p>
                <p class="text-lg leading-relaxed">Your use of the chatbot indicates your acceptance of these terms. If you do not agree, please refrain from using the chatbot feature.</p>',
            ],
            [
                'id' => 'payments-refunds',
                'title' => 'Payments and Refunds',
                'description' => 'All payments must be made in full and on time. Our refund policy is as follows:
                <ul class="list-disc pl-6 mt-2 text-lg leading-relaxed">
                    <li>Refunds are processed within 30 days of request approval</li>
                    <li>Service cancellations must be made 30 days in advance</li>
                    <li>No refunds for services already delivered or used</li>
                    <li>Processing fees are non-refundable</li>
                </ul>',
            ],
            [
                'id' => 'service-levels',
                'title' => 'Service Level Agreements',
                'description' => 'We commit to maintaining the following service levels:
                <ul class="list-disc pl-6 mt-2 text-lg leading-relaxed">
                    <li>99.9% uptime for our services</li>
                    <li>24/7 technical support availability</li>
                    <li>Response time within 24 hours for support requests</li>
                  <li>Regular security updates and maintenance (additional charges may apply for extra services)</li>

                </ul>',
            ],
            [
                'id' => 'limitation-liability',
                'title' => 'Limitation of Liability',
                'description' => 'To the maximum extent permitted by law:
                <ul class="list-disc pl-6 mt-2 text-lg leading-relaxed">
                    <li>We provide our services "as is" without warranties of any kind</li>
                    <li>We are not liable for any indirect, incidental, or consequential damages</li>
                    <li>Our total liability shall not exceed the amount paid for the services</li>
                    <li>We are not responsible for any third-party content or services</li>
                </ul>',
            ],
            [
                'id' => 'privacy',
                'title' => 'Privacy and Data Protection',
                'description' =>
                    'We are committed to protecting your privacy and handling your data in accordance with applicable data protection laws. Please refer to our <a href="/privacy-policy" class="text-blue-600 underline hover:text-blue-800">Privacy Policy</a> for detailed information about how we collect, use, and protect your personal information.',
            ],
            [
                'id' => 'termination',
                'title' => 'Termination',
                'description' => 'We reserve the right to suspend or terminate your access to the services immediately, without prior notice, for any reason including but not limited to:
                <ul class="list-disc pl-6 mt-2 text-lg leading-relaxed">
                    <li>Violation of these Terms and Conditions</li>
                    <li>Fraudulent or illegal activities</li>
                    <li>Non-payment of fees</li>
                    <li>Abuse of our services or other users</li>
                </ul>',
            ],
            [
                'id' => 'dispute-resolution',
                'title' => 'Dispute Resolution',
                'description' => 'Any disputes arising from these terms shall be resolved through:
                <ul class="list-disc pl-6 mt-2 text-lg leading-relaxed">
                    <li>First, through good-faith negotiations</li>
                    <li>If unresolved, through mediation</li>
                    <li>As a last resort, through binding arbitration</li>
                    <li>Each party shall bear their own costs in dispute resolution</li>
                </ul>',
            ],
            [
                'id' => 'changes-terms',
                'title' => 'Changes to Terms',
                'description' =>
                    'We may modify these terms at any time. Continued use of our services after changes means you accept the updated terms. If you disagree with the changes, you must stop using our services.',
            ],
            [
                'id' => 'governing-law',
                'title' => 'Governing Law',
                'description' =>
                    'These Terms and Conditions are governed by the laws of the India. Any disputes will be resolved in the courts of competent jurisdiction in the state of Delhi, India.',
            ],
            [
                'id' => 'force-majeure',
                'title' => 'Force Majeure',
                'description' =>
                    'We shall not be liable for any failure or delay in performance due to circumstances beyond our reasonable control, including but not limited to acts of God, war, terrorism, natural disasters, or governmental actions.',
            ],
        [
    'id' => 'contact-us',
    'title' => 'Contact Us',
    'description' =>
        'For any questions or concerns regarding these Terms and Conditions, please contact us at <a href="mailto:support@linkuss.com" class="text-blue-600 underline hover:text-blue-800">support@linkuss.com</a>. We aim to respond to all inquiries within 24 hours.<br><br>
        By contacting us, you agree that we may store and process the personal data you provide, such as your name, email address, phone number  and the contents of your message, solely for the purpose of addressing your inquiry and improving our services. We are committed to protecting your privacy and will not share your contact details with third parties without your explicit consent, except as required by law.<br><br>
        For more information on how we handle your data, please refer to our <a href="/privacy-policy" class="text-blue-600 underline hover:text-blue-800">Privacy Policy</a>.',
],

        ];
    @endphp

    <section class="py-16 px-6 max-w-6xl mx-auto font-sans transition-colors duration-300">
        <div class="flex flex-col lg:flex-row lg:space-x-12">
            <!-- Side Navigation -->
            <nav class="terms-nav hidden lg:block sticky top-20 self-start w-48">
                <ul class="space-y-4 text-sm font-medium">
                    @foreach ($termsSections as $index => $section)
                        <li><a href="#{{ $section['id'] }}" class="terms-nav-link">{{ $index + 1 }}.
                                {{ $section['title'] }}</a></li>
                    @endforeach
                </ul>
            </nav>

            <!-- Content -->
            <div class="flex-1 space-y-12">
                @foreach ($termsSections as $index => $section)
                    <article id="{{ $section['id'] }}"
                        class="terms-article border-b border-gray-200 dark:border-gray-700 pb-6">
                        <h3 class="text-3xl font-semibold mb-3">{{ $index + 1 }}. {{ $section['title'] }}</h3>
                        <div class="text-lg leading-relaxed">{!! $section['description'] !!}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        // Intersection Observer for fade-in animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });

        // Observe all terms sections
        document.querySelectorAll('.terms-section').forEach(section => {
            observer.observe(section);
        });

        // Active link highlighting
        const navLinks = document.querySelectorAll('.terms-nav-link');
        const sections = document.querySelectorAll('.terms-article');

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5
        };

        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${id}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }, observerOptions);

        sections.forEach(section => {
            sectionObserver.observe(section);
        });
    </script>
@endsection
