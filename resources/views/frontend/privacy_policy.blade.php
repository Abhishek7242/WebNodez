@extends('frontend/layouts/main')
@section('title', 'WebNodez - Privacy Policy')
@section('meta_description',
    'Read WebNodez comprehensive privacy policy. Learn how we collect, use, and protect your
    data, including information about our chatbot and AI services, data retention, and your privacy rights.')
@section('meta_keywords',
    'privacy policy, data protection, user privacy, data security, GDPR compliance, privacy
    rights, data collection, cookie policy, chatbot privacy, AI services privacy')
@section('og_image', asset('images/privacy-og-image.jpg'))
@section('main-section')
    <link href="{{ asset('css/privacy_policy.css') }}" rel="stylesheet">

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

    <section class="max-w-4xl mx-auto text-center py-12 px-6 privacy-section">
        <h1 class="text-5xl font-extrabold mb-4 tracking-tight text-primary">
            Privacy Policy
        </h1>
        <p class="text-lg text-secondary max-w-3xl mx-auto">
            Your privacy matters to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your
            information when you visit our website or use our services. Please take a moment to review it carefully.
        </p>
    </section>
    </header>
    @php
        $privacySections = [
            [
                'id' => 'information-we-collect',
                'title' => 'Information We Collect',
                'description' => 'We collect several types of information for various purposes:
                <ul class="list-disc pl-6 mt-2">
                    <li>Personal Information: Name, email address, phone number, billing address</li>
                    <li>Account Information: Username, password, account preferences</li>
                    <li>Technical Information: IP address, browser type, device information, cookies</li>
                    <li>Usage Data: Pages visited, time spent, features used</li>
                    <li>Communication Data: Emails, messages, support tickets</li>
                </ul>',
            ],
            [
                'id' => 'how-we-use',
                'title' => 'How We Use Your Information',
                'description' => 'We use your information for the following purposes:
                <ul class="list-disc pl-6 mt-2">
                    <li>Providing and maintaining our services</li>
                    <li>Processing transactions and managing accounts</li>
                    <li>Improving and personalizing user experience</li>
                    <li>Communicating with you about services and updates</li>
                    <li>Ensuring security and preventing fraud</li>
                    <li>Complying with legal obligations</li>
                </ul>',
            ],
            [
                'id' => 'cookies-tracking',
                'title' => 'Cookies and Tracking Technologies',
                'description' => 'We use cookies and similar tracking technologies to:
                <ul class="list-disc pl-6 mt-2">
                    <li>Remember your preferences and settings</li>
                    <li>Analyze website traffic and usage patterns</li>
                    <li>Enhance security and prevent fraud</li>
                    <li>Improve website performance</li>
                </ul>
                You can control cookie settings through your browser preferences. However, disabling certain cookies may limit your ability to use some features of our services.',
            ],
            [
                'id' => 'data-sharing',
                'title' => 'Data Sharing and Disclosure',
                'description' => 'We may share your information with:
                <ul class="list-disc pl-6 mt-2">
                    <li>Service providers and business partners who assist in operating our services</li>
                    <li>Legal authorities when required by law or to protect our rights</li>
                    <li>Third parties with your explicit consent</li>
                </ul>
                We do not sell your personal information to third parties.',
            ],
            [
                'id' => 'chatbot-policy',
                'title' => 'Chatbot and AI Services Policy',
                'description' => 'Our chatbot and AI services are designed to enhance your experience. Here\'s how we handle your interactions:
                <ul class="list-disc pl-6 mt-2">
                    <li><strong>Data Collection and Processing:</strong>
                        <ul class="list-disc pl-6 mt-2">
                            <li>Conversation history and user inputs</li>
                            <li>User preferences and interaction patterns</li>
                            <li>Technical data about your device and connection</li>
                            <li>Feedback and ratings you provide</li>
                        </ul>
                    </li>
                    <li><strong>Data Usage:</strong>
                        <ul class="list-disc pl-6 mt-2">
                            <li>To provide and improve chatbot responses</li>
                            <li>To train and enhance our AI models</li>
                            <li>To personalize your experience</li>
                            <li>To maintain service quality and security</li>
                        </ul>
                    </li>
                    <li><strong>Data Storage and Retention:</strong>
                        <ul class="list-disc pl-6 mt-2">
                            <li>Conversations are stored securely for up to 30 days</li>
                            <li>Anonymized data may be retained longer for service improvement</li>
                            <li>You can request deletion of your conversation history</li>
                        </ul>
                    </li>
                    <li><strong>Privacy Controls:</strong>
                        <ul class="list-disc pl-6 mt-2">
                            <li>Option to opt-out of conversation storage</li>
                            <li>Ability to delete individual conversations</li>
                            <li>Control over data sharing preferences</li>
                        </ul>
                    </li>
                    <li><strong>AI Model Training:</strong>
                        <ul class="list-disc pl-6 mt-2">
                            <li>Your interactions may be used to improve our AI models</li>
                            <li>Personal information is removed before training</li>
                            <li>You can opt-out of data usage for training</li>
                        </ul>
                    </li>
                    <li><strong>Third-Party Integration:</strong>
                        <ul class="list-disc pl-6 mt-2">
                            <li>We may use third-party AI services</li>
                            <li>Data sharing follows strict security protocols</li>
                            <li>Third parties are bound by confidentiality agreements</li>
                        </ul>
                    </li>
                    <li><strong>Security Measures:</strong>
                        <ul class="list-disc pl-6 mt-2">
                            <li>End-to-end encryption for sensitive conversations</li>
                            <li>Regular security audits and updates</li>
                            <li>Access controls and authentication</li>
                        </ul>
                    </li>
                    <li><strong>User Rights:</strong>
                        <ul class="list-disc pl-6 mt-2">
                            <li>Access your conversation history</li>
                            <li>Export your data</li>
                            <li>Request data deletion</li>
                            <li>Opt-out of AI training</li>
                        </ul>
                    </li>
                </ul>
                <p class="mt-4">For any questions about our chatbot and AI services, please contact us at privacy@webnodez.com.</p>',
            ],
            [
                'id' => 'data-retention',
                'title' => 'Data Retention',
                'description' => 'We retain your information for as long as necessary to:
                <ul class="list-disc pl-6 mt-2">
                    <li>Fulfill the purposes outlined in this policy</li>
                    <li>Comply with legal obligations</li>
                    <li>Resolve disputes</li>
                    <li>Enforce our agreements</li>
                </ul>
                When we no longer need your information, we will securely delete or anonymize it.',
            ],
            [
                'id' => 'security',
                'title' => 'Security of Your Information',
                'description' => 'We implement appropriate technical and organizational measures to protect your data:
                <ul class="list-disc pl-6 mt-2">
                    <li>Encryption of sensitive data</li>
                    <li>Regular security assessments</li>
                    <li>Access controls and authentication</li>
                    <li>Secure data storage and transmission</li>
                    <li>Employee training on data protection</li>
                </ul>
                While we strive to protect your information, no method of transmission over the internet is 100% secure.',
            ],
            [
                'id' => 'your-rights',
                'title' => 'Your Privacy Rights',
                'description' => 'Depending on your location, you may have the right to:
                <ul class="list-disc pl-6 mt-2">
                    <li>Access your personal information</li>
                    <li>Correct inaccurate data</li>
                    <li>Request deletion of your data</li>
                    <li>Object to processing of your data</li>
                    <li>Data portability</li>
                    <li>Withdraw consent</li>
                </ul>
                To exercise these rights, please contact us at privacy@webnodez.com.',
            ],
            [
                'id' => 'children-privacy',
                'title' => 'Children\'s Privacy',
                'description' =>
                    'Our services are not intended for children under 13. We do not knowingly collect personal information from children under 13. If you believe we have collected information from a child under 13, please contact us immediately.',
            ],
            [
                'id' => 'international-transfers',
                'title' => 'International Data Transfers',
                'description' =>
                    'Your information may be transferred to and processed in countries other than your country of residence. We ensure appropriate safeguards are in place for such transfers in compliance with applicable data protection laws.',
            ],
            [
                'id' => 'changes-policy',
                'title' => 'Changes to This Policy',
                'description' =>
                    'We may update this Privacy Policy periodically.  Continued use of our services after changes means you accept the updated policy.',
            ],
            [
                'id' => 'contact-us',
                'title' => 'Contact Us',
                'description' => 'If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:
                <ul class="list-disc pl-6 mt-2">
                    <li>Email: privacy@webnodez.com</li>
                    <li>Phone: [Your Phone Number]</li>
                    <li>Address: [Your Business Address]</li>
                </ul>
                We aim to respond to all privacy-related inquiries within 48 hours.',
            ],
        ];
    @endphp

    <section class="py-16 px-6 max-w-6xl mx-auto font-sans transition-colors duration-300">
        <div class="flex flex-col lg:flex-row lg:space-x-12">
            <!-- Side Navigation -->
            <nav class="privacy-nav hidden lg:block sticky top-20 self-start w-48">
                <ul class="space-y-4 text-sm font-medium">
                    @foreach ($privacySections as $index => $section)
                        <li><a href="#{{ $section['id'] }}" class="privacy-nav-link">{{ $index + 1 }}.
                                {{ $section['title'] }}</a></li>
                    @endforeach
                </ul>
            </nav>

            <!-- Content -->
            <div class="flex-1 space-y-12">
                @foreach ($privacySections as $index => $section)
                    <article id="{{ $section['id'] }}" class="privacy-article">
                        <h3 class="text-3xl font-semibold mb-3">{{ $index + 1 }}. {{ $section['title'] }}</h3>
                        <div>{!! $section['description'] !!}</div>
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

        // Observe all privacy sections
        document.querySelectorAll('.privacy-section').forEach(section => {
            observer.observe(section);
        });

        // Active link highlighting
        const navLinks = document.querySelectorAll('.privacy-nav-link');
        const sections = document.querySelectorAll('.privacy-article');

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
