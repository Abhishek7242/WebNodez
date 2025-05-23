<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.home');
});
Route::get('/contact-us', function () {
    return view('frontend.contact-us');
});
Route::get('/about-us', function () {
    return view('frontend.about-us');
});
Route::get('/services', function () {
    return view('frontend.services');
});
Route::get('/terms&conditions', function () {
    return view('frontend.terms_conditions');
});
Route::get('/privacy-policy', function () {
    return view('frontend.privacy_policy');
});
Route::get('/services/{service}', function ($service) {
    $servicesArray = [
        "web-development" => [
            'description' => '  We build fast, responsive, and secure websites tailored to your business goals. Whether it’s a sleek landing page or a full-featured web application, our development team ensures high performance and scalability every step of the way.',
            'detailsArray' => [
                [
                    'title' => 'Requirement Gathering & Analysis',
                    'description' => 'We collaborate with you to understand your business goals, target audience, desired features, and technical requirements. This phase sets the foundation by clarifying project scope, timelines, and expectations to ensure alignment from the start.'
                ],
                [
                    'title' => 'Project Planning & Architecture Design',
                    'description' => 'Based on requirements, we plan the project workflow, define the technology stack (e.g., Laravel, React, Vue, Tailwind), and design the system architecture. This includes database schema design, API planning, and scalability considerations to build a solid foundation.'
                ],
                [
                    'title' => 'Wireframing & Prototyping',
                    'description' => 'We create wireframes and interactive prototypes to visualize the layout and user flows. This helps stakeholders review and provide feedback early, ensuring the design meets usability and business objectives before development starts.'
                ],
                [
                    'title' => 'UI/UX Design',
                    'description' => 'Our design team crafts engaging, accessible, and mobile-friendly interfaces that align with your brand identity. We prioritize user experience by creating intuitive navigation, consistent visuals, and responsive layouts that look great on all devices.'
                ],
                [
                    'title' => 'Frontend Development',
                    'description' => 'Using modern frameworks like React, Vue, or vanilla JavaScript along with Tailwind CSS or Bootstrap, we build the client-facing parts of your website. Emphasis is placed on responsiveness, fast load times, and smooth interactions to maximize user engagement.'
                ],
                [
                    'title' => 'Backend Development',
                    'description' => 'We develop robust backend systems using Laravel, Node.js, or Django that handle business logic, data management, and integrations. This includes creating secure REST or GraphQL APIs, user authentication, and seamless database interactions.'
                ],
                [
                    'title' => 'SEO Optimization',
                    'description' => 'To improve your site’s visibility on search engines, we implement SEO best practices such as semantic HTML, proper meta tags, structured data, fast page speeds, and mobile optimization, helping you attract and retain organic traffic.'
                ],
                [
                    'title' => 'Testing & Quality Assurance',
                    'description' => 'Comprehensive testing is conducted across devices and browsers to identify bugs and performance issues. We perform functional, usability, performance, security, and accessibility testing to ensure a flawless and inclusive user experience.'
                ],
                [
                    'title' => 'Deployment & Hosting Setup',
                    'description' => 'We deploy your website to reliable hosting platforms such as AWS, Vercel, or DigitalOcean. This includes configuring servers, setting up CI/CD pipelines, SSL certificates, and CDN integration to guarantee fast, secure, and scalable delivery.'
                ],
                [
                    'title' => 'Post-Launch Monitoring & Maintenance',
                    'description' => 'After launch, we continuously monitor your website’s performance, uptime, and security. Regular updates, backups, and optimizations keep your site running smoothly while adapting to evolving user needs and technology advancements.'
                ],
            ],
        

        ],
        "e_commerce-solutions" => [
            'description' => 'Innovative, user-focused online stores designed to showcase your brand’s uniqueness, engage customers, and drive sales. We combine beautiful design with seamless functionality to create shopping experiences that build loyalty and grow your business.',
            'detailsArray' => [
                [
                    'title' => 'Business & Market Discovery',
                    'description' => 'We start by understanding your business model, products, target audience, and competitors. This discovery phase helps us define a strategy that aligns with your goals — whether it’s launching a new online store, migrating from an existing platform, or optimizing for conversion. We document requirements, sales funnels, and customer journeys to guide the entire build.'
                ],
                [
                    'title' => 'Platform Selection & Architecture Planning',
                    'description' => 'Based on your needs — scalability, integrations, budget, and timeline — we help you choose the right platform (Shopify, WooCommerce, Magento, or custom Laravel/Vue solutions). We then map out the store’s technical architecture, including product catalog structure, payment systems, shipping logic, and inventory management.'
                ],
                [
                    'title' => 'User Experience Design (UX)',
                    'description' => 'We design intuitive user flows to guide customers from landing page to checkout seamlessly. This includes optimizing site navigation, category hierarchy, product filters, and calls-to-action. Our goal is to reduce friction, increase product discoverability, and enhance the overall shopping experience.'
                ],
                [
                    'title' => 'UI Design & Branding',
                    'description' => 'We create a visually engaging and consistent design that reflects your brand identity. From homepage to checkout, every screen is crafted with attention to typography, color palettes, imagery, and spacing. We also design mobile-first to ensure your store looks and performs perfectly on all devices.'
                ],
                [
                    'title' => 'Storefront Development',
                    'description' => 'Using modern frameworks like Next.js, Vue.js, Tailwind CSS, and others, we develop a responsive, fast-loading storefront. Features include dynamic product pages, smart search, quick views, and real-time stock updates. We prioritize accessibility and performance from day one.'
                ],
                [
                    'title' => 'Backend & CMS Integration',
                    'description' => 'We integrate powerful backend systems that allow easy product, order, and customer management. This includes setting up secure databases, managing product variants and SKUs, automating taxes, handling discounts, and integrating ERP/CRM solutions if required.'
                ],
                [
                    'title' => 'Payment, Shipping & Security Setup',
                    'description' => 'We configure secure, PCI-compliant payment gateways (Stripe, PayPal, Razorpay, etc.) and real-time shipping APIs (Shiprocket, FedEx, etc.). Your store is protected with HTTPS, anti-fraud tools, and GDPR compliance features to build trust with customers globally.'
                ],
                [
                    'title' => 'Testing & Quality Assurance',
                    'description' => 'Our team performs rigorous testing across devices and browsers to ensure a flawless experience. We test everything — product flows, checkout logic, mobile behavior, speed, and accessibility — to ensure your site is ready for real-world shoppers.'
                ],
                [
                    'title' => 'Launch & Post-Launch Optimization',
                    'description' => 'Once your store is launched, we continue to monitor performance, user engagement, and sales data. We offer A/B testing, CRO (Conversion Rate Optimization), SEO enhancements, and campaign tracking to continuously improve your store’s effectiveness and drive long-term growth.'
                ],
            ],
        ],
        "ui-ux-design" => [
            'description' => 'Human-centered design that combines creativity, clarity, and usability — delivering sleek, modern interfaces that not only look stunning but also feel intuitive and effortless to use. Every interaction is thoughtfully crafted to elevate your brand and create lasting user satisfaction.',
            'detailsArray' => [
                [
                    'title' => 'User Research & Persona Development',
                    'description' => 'We begin with in-depth research to understand your users’ needs, goals, frustrations, and behaviors. Through methods such as interviews, surveys, and competitor analysis, we gather insights to build realistic user personas — fictional yet data-driven representations of your ideal users. These personas guide all design decisions to ensure we create experiences that truly resonate with your audience.'
                ],
                [
                    'title' => 'Information Architecture & User Flows',
                    'description' => 'We organize your content and features into a logical, user-friendly structure. This includes creating sitemaps and user flow diagrams that map how users will navigate the product to complete tasks efficiently. Good information architecture reduces confusion and enhances discoverability, making the experience intuitive and frictionless from the first tap.'
                ],
                [
                    'title' => 'Wireframing',
                    'description' => 'Wireframes are skeletal blueprints of the interface. They help visualize the layout, hierarchy, and functionality of each screen without distraction from colors or images. These grayscale sketches enable fast iteration and feedback, ensuring we lock down the best possible user experience before investing in visual design or development.'
                ],
                [
                    'title' => 'Interaction Design & Microinteractions',
                    'description' => 'We define how users interact with the interface — buttons, forms, animations, hover effects, transitions, and feedback responses. These microinteractions play a big role in making the app feel intuitive and responsive. Every tap, swipe, and scroll is thoughtfully crafted to provide clear feedback and create a seamless flow.'
                ],
                [
                    'title' => 'Visual Design & Branding',
                    'description' => 'Once wireframes and interactions are approved, we design pixel-perfect mockups aligned with your brand’s identity. This includes typography, color schemes, iconography, imagery, and spacing. The goal is to create an emotionally engaging experience that’s not only beautiful but also functional and accessible.'
                ],
                [
                    'title' => 'Prototyping',
                    'description' => 'We build interactive prototypes that simulate real user journeys. These prototypes allow stakeholders and test users to click through the app like they would in a live environment. It’s a powerful tool for validating flows and spotting usability issues early, before moving into development.'
                ],
                [
                    'title' => 'Usability Testing',
                    'description' => 'We test the prototype with real users to gather feedback on ease of use, layout, and flow. This step uncovers friction points and identifies areas of confusion. Based on these findings, we iterate the design to improve user satisfaction and ensure the final product aligns with real-world expectations.'
                ],
                [
                    'title' => 'Design Handoff to Development',
                    'description' => 'Once the design is finalized, we prepare all assets and documentation for the development team. This includes style guides, component libraries, and responsive behavior notes. We use tools like Figma, Zeplin, or Adobe XD to ensure a smooth handoff, with all design specifications clearly communicated.'
                ],
                [
                    'title' => 'Post-Launch UX Optimization',
                    'description' => 'After the product goes live, we monitor user behavior using analytics tools like Hotjar, Mixpanel, or Google Analytics. We use real usage data and user feedback to identify opportunities for improvement. UX is an ongoing process, and we continuously refine the design to enhance engagement, retention, and overall user satisfaction.'
                ],
            ],
        ],
        "app-design&development" => [
            'description' => 'Innovative, user-centric mobile app solutions that combine stunning design with flawless functionality — built to elevate your brand and engage your audience across all platforms.',
            'detailsArray' => [
                [
                    'title' => 'Discovery & Requirement Analysis',
                    'description' => 'We begin by understanding your vision and objectives through discovery workshops, stakeholder interviews, and competitor analysis. This helps us gather all technical and business requirements. The outcome is a detailed requirements document, user personas, and a shared understanding of the app’s purpose, goals, and challenges — ensuring we are aligned before any design or development begins.'
                ],
                [
                    'title' => 'Market & User Research',
                    'description' => 'To build a product that truly resonates, we conduct user research and market analysis. This includes identifying pain points, studying user behavior, and analyzing competitor apps to find differentiation opportunities. We may conduct surveys, user interviews, and usability testing of similar products to gather actionable insights that influence both design and functionality.'
                ],
                [
                    'title' => 'Wireframing & Information Architecture',
                    'description' => 'Once we understand the users and their goals, we create wireframes that map out each screen’s layout, navigation, and user interactions. We also define the information architecture — how content is organized and accessed — to ensure intuitive user flows. Wireframes serve as the foundation for both UI design and backend logic.'
                ],
                [
                    'title' => 'UI/UX Design',
                    'description' => 'Our designers turn wireframes into visually polished mockups, incorporating your brand’s identity with modern design standards. This includes typography, color schemes, iconography, and micro-interactions. We prioritize consistency, accessibility, and engagement. Clickable prototypes are shared for stakeholder feedback before development begins.'
                ],
                [
                    'title' => 'Cross-Platform App Development',
                    'description' => 'We develop the frontend of your app using technologies like Flutter, React Native, or native Swift/Kotlin based on your goals. Features are implemented modularly for better maintainability, and performance is optimized from the start. Our code is version-controlled, thoroughly documented, and aligned with industry best practices for scalability and security.'
                ],
                [
                    'title' => 'Backend Development & API Integration',
                    'description' => 'The backend is the engine of your app — we use Laravel, Node.js, or Firebase to build RESTful or GraphQL APIs, handle authentication, data processing, cloud storage, and push notifications. We also integrate third-party services like payment processors, maps, chat, CRMs, and analytics tools to enhance the app’s ecosystem.'
                ],
                [
                    'title' => 'Quality Assurance & Testing',
                    'description' => 'We employ a rigorous QA process involving unit testing, functional testing, regression testing, and real-device testing across multiple OS versions and screen sizes. Our goal is zero critical bugs at launch. We also perform user acceptance testing (UAT) with stakeholders to validate that the app meets business requirements.'
                ],
                [
                    'title' => 'App Store Submission & Deployment',
                    'description' => 'We prepare your app for release, including creating app icons, screenshots, marketing text, and metadata for the App Store and Google Play. We handle submission, guide you through Apple/Google approval processes, and ensure compliance with platform guidelines. CI/CD pipelines may be implemented for automated builds and releases.'
                ],
                [
                    'title' => 'Post-Launch Support & Iteration',
                    'description' => 'Launch is just the beginning. We monitor app performance, crash logs, and user behavior using tools like Firebase, Sentry, and Mixpanel. Based on user feedback and analytics, we iterate with bug fixes, feature updates, and performance improvements. We offer maintenance contracts to keep your app up-to-date and growing with your users.'
                ],
            ],
        ],
        "maintenance&support" => [
            'description' => 'Creative designs to make your brand stand out.',
            'detailsArray' => [
                [
                    'title' => 'Regular Updates & Patch Management',
                    'description' => 'We continuously update your software, frameworks, and plugins to the latest versions to improve performance, add features, and fix vulnerabilities. This proactive approach minimizes risks and keeps your system secure and up-to-date.'
                ],
                [
                    'title' => 'Performance Monitoring & Optimization',
                    'description' => 'We monitor your site or app’s performance metrics such as load times, server response, and resource usage in real-time. Using this data, we optimize infrastructure and code to ensure fast, reliable experiences for all users.'
                ],
                [
                    'title' => 'Security Audits & Vulnerability Management',
                    'description' => 'Regular security scans and audits help us identify potential threats or weaknesses. We apply patches, configure firewalls, and implement best security practices to protect your data and maintain user trust.'
                ],
                [
                    'title' => 'Bug Fixes & Issue Resolution',
                    'description' => 'Our support team quickly addresses any bugs or errors that arise, no matter how small, to prevent disruptions. We track issues through a ticketing system to ensure timely and transparent resolution.'
                ],
                [
                    'title' => 'Backup & Disaster Recovery',
                    'description' => 'Automated backups are performed regularly to secure your data. In case of system failures or data loss, we have recovery plans in place to restore your site or app swiftly and minimize downtime.'
                ],
                [
                    'title' => 'User Support & Training',
                    'description' => 'We provide ongoing user support, including answering questions, troubleshooting problems, and offering training materials or sessions to empower your team in using the system effectively.'
                ],
                [
                    'title' => 'Feature Enhancements & Scalability Planning',
                    'description' => 'As your business grows, we help plan and implement new features, integrations, and scaling solutions. This ensures your app or site evolves alongside your needs without sacrificing performance.'
                ],
            ],
        ],
        "testing" => [
            'description' => 'Comprehensive quality assurance that guarantees your product performs flawlessly, remains secure, and delivers a seamless experience — ensuring your brand stands strong in every interaction.',
            'detailsArray' => [
                [
                    'title' => 'Requirement Analysis & Test Planning',
                    'description' => 'We begin by reviewing project requirements, specifications, and acceptance criteria to develop a comprehensive test plan. This includes defining testing scope, types of testing needed (functional, performance, security), resource allocation, timelines, and risk assessment.'
                ],
                [
                    'title' => 'Test Case Design & Preparation',
                    'description' => 'Detailed test cases and scenarios are created to cover all functionalities, user flows, and edge cases. These test cases serve as the foundation for manual and automated testing, ensuring that every feature behaves as expected under different conditions.'
                ],
                [
                    'title' => 'Functional Testing',
                    'description' => 'We verify that all features work correctly according to requirements. This includes UI/UX elements, input validations, business logic, and integration points. Both positive and negative test cases are executed to catch errors and unexpected behaviors.'
                ],
                [
                    'title' => 'Performance & Load Testing',
                    'description' => 'The system is tested under varying loads to assess speed, responsiveness, and stability. We simulate multiple concurrent users and transactions to identify bottlenecks, memory leaks, and scalability issues, ensuring the app performs well even at peak demand.'
                ],
                [
                    'title' => 'Security Testing',
                    'description' => 'We conduct vulnerability assessments and penetration testing to identify and fix security risks. This includes testing for SQL injection, cross-site scripting (XSS), authentication flaws, data encryption, and compliance with security best practices to protect user data.'
                ],
                [
                    'title' => 'Cross-Browser & Device Testing',
                    'description' => 'Testing is performed across a wide range of browsers, operating systems, and devices to ensure consistent behavior and appearance. This guarantees that all users, regardless of their environment, experience a smooth and visually coherent product.'
                ],
                [
                    'title' => 'Automated Testing & Continuous Integration',
                    'description' => 'Where possible, we implement automated tests for regression, unit, and integration testing. These tests are integrated into CI/CD pipelines to provide rapid feedback on code changes, reduce human error, and accelerate delivery without sacrificing quality.'
                ],
                [
                    'title' => 'User Acceptance Testing (UAT)',
                    'description' => 'We facilitate UAT sessions with stakeholders and end-users to validate that the product meets business needs and user expectations. Feedback from this phase is critical for final adjustments before launch.'
                ],
                [
                    'title' => 'Bug Reporting & Resolution',
                    'description' => 'All issues found during testing are logged with detailed reports including steps to reproduce, screenshots, and severity levels. Our team prioritizes and addresses bugs promptly to maintain a stable, high-quality product.'
                ],
                [
                    'title' => 'Final Regression Testing & Release Preparation',
                    'description' => 'After all fixes, a final round of regression testing ensures that new changes haven’t introduced any new issues. We confirm readiness for deployment, ensuring the product is robust and reliable for end-users.'
                ],
            ],
        ],
        // Add more services here
    ];

    // Check if the requested service exists
    if (!array_key_exists($service, $servicesArray)) {
        abort(404); // Service not found
    }

    // Format the service name: replace dashes and ampersands, then capitalize
    $formattedService = str_replace(['-'], ' ', $service);
    $formattedService = str_replace(['&'], ' & ', $formattedService);
    $formattedService = str_replace(['_'], ' - ', $formattedService);
    $formattedService = ucwords($formattedService);
    $formattedService = str_replace([' - '], '-', $formattedService);

    // Fix UI/UX casing specifically after ucwords
    $formattedService = str_ireplace(['Ui/Ux', 'Ui-Ux', 'Ui Ux'], 'UI/UX', $formattedService);


    // Get the service details from the array
    $serviceDetails = $servicesArray[$service];

    // Pass both formatted name and details to the view
    return view('frontend.service', [
        'service' => $formattedService,
        'details' => $serviceDetails,
        'detailsArray'=> $serviceDetails['detailsArray'],
    ]);
});
Route::get('/pricing/{service}', function ($service) {
    $servicesArray = [
        "fixed-price" => [
            'description' => '  We build fast, responsive, and secure websites tailored to your business goals. Whether it’s a sleek landing page or a full-featured web application, our development team ensures high performance and scalability every step of the way.',
            'detailsArray' => [
[
'title' => 'Fixed Price Project Workflow',
'description' => 'This structured sequence outlines the ideal workflow for managing a fixed price project. It ensures clear communication, predictable costs, and smooth delivery by breaking the process into well-defined stages.'
],
[
'title' => 'Define Project Scope',
'description' => 'Clearly specify the goals, features, deliverables, and boundaries of the project. Ensure all parties have a shared understanding to avoid scope creep.'
],
[
'title' => 'Create Requirements Documentation',
'description' => 'Develop detailed functional and technical specifications. This acts as a blueprint and must be reviewed and approved by stakeholders before proceeding.'
],
[
'title' => 'Estimate Cost and Timeline',
'description' => 'Provide a fixed quote based on the scope and effort required. Include a timeline with buffers for testing, revisions, and handover.'
],
[
'title' => 'Draft Contract and Milestones',
'description' => 'Outline payment terms, project phases, and responsibilities in a written agreement. Include milestone-based payments and revision limits.'
],
[
'title' => 'Design Phase',
'description' => 'Start with wireframes and UI/UX design or technical architecture. Get client approval before development begins to avoid rework.'
],
[
'title' => 'Development Phase',
'description' => 'Implement features based on the approved designs and documentation. Ensure code quality and meet predefined milestones.'
],
[
'title' => 'Testing and Quality Assurance',
'description' => 'Thoroughly test the product for functionality, performance, and security. Fix all bugs and ensure it meets the agreed-upon criteria.'
],
[
'title' => 'Final Delivery and Approval',
'description' => 'Deliver the completed project or product. Ensure everything functions as expected. Obtain client sign-off to confirm project completion.'
],
[
'title' => 'Post-Launch Support (Optional)',
'description' => 'Offer a short-term support window for minor bug fixes or adjustments. Include terms in the original contract if provided.'
]
],

              
        

        ],
        "hourly-model" => [
            'description' => 'Innovative, user-focused online stores designed to showcase your brand’s uniqueness, engage customers, and drive sales. We combine beautiful design with seamless functionality to create shopping experiences that build loyalty and grow your business.',
            'detailsArray' => [
  [
    'title' => 'Initial Consultation & Requirement Gathering',
    'description' => 'Discuss project goals, priorities, and areas likely to evolve. Identify core deliverables and understand how flexibility will be managed.'
  ],
  [
    'title' => 'Set Up Hourly Rate & Tracking Tools',
    'description' => 'Agree on hourly rates, billing cycles, and choose a time tracking tool (e.g., Toggl, Harvest) to ensure transparent and accurate logging of work hours.'
  ],
  [
    'title' => 'Define Communication & Reporting Protocol',
    'description' => 'Establish regular check-ins and progress updates to keep everyone aligned. Set expectations for status reports and how change requests will be handled.'
  ],
  [
    'title' => 'Begin Agile Development or Work',
    'description' => 'Start work in small increments or sprints, delivering value continuously and adapting priorities as requirements evolve.'
  ],
  [
    'title' => 'Track Hours & Deliverables',
    'description' => 'Log all work hours diligently. Track completed tasks alongside hours spent to maintain clear accountability.'
  ],
  [
    'title' => 'Review & Adjust Priorities',
    'description' => 'Conduct regular reviews to assess progress and pivot as needed based on feedback and changing needs.'
  ],
  [
    'title' => 'Invoice & Payment',
    'description' => 'Generate invoices based on tracked hours at agreed intervals. Ensure payments are timely to maintain workflow continuity.'
  ],
  [
    'title' => 'Ongoing Support & Iteration',
    'description' => 'Continue iterative work and support as requested, with billing continuing hourly as per usage.'
  ]
  ],

        ],
        "dedicated-team" => [
            'description' => 'A comprehensive guide to hiring and managing a dedicated team or resource on a monthly basis. This model is ideal for projects requiring sustained growth, continuous support, and close collaboration with a specialized team.',
            'detailsArray' =>  [
  [
    'title' => 'Understand Business Needs & Team Requirements',
    'description' => 'Discuss long-term goals, technical needs, and team roles to determine the size and skill set of the dedicated team.'
  ],
  [
    'title' => 'Define Scope & Responsibilities',
    'description' => 'Clarify the team’s responsibilities, expected deliverables, working hours, communication channels, and performance metrics.'
  ],
  [
    'title' => 'Recruitment & Team Formation',
    'description' => 'Hire or allocate skilled professionals aligned with the project needs. Set up onboarding and introduce them to your company culture.'
  ],
  [
    'title' => 'Set Up Project Infrastructure & Tools',
    'description' => 'Provide access to required software, tools, and collaboration platforms. Establish workflows and communication protocols.'
  ],
  [
    'title' => 'Kickoff & Planning',
    'description' => 'Initiate the project with a detailed plan, sprint schedules, and clear milestones. Align team goals with business objectives.'
  ],
  [
    'title' => 'Execution & Continuous Delivery',
    'description' => 'The dedicated team works full-time on your project, iterating based on feedback and evolving requirements.'
  ],
  [
    'title' => 'Regular Reporting & Reviews',
    'description' => 'Conduct weekly or bi-weekly meetings to review progress, discuss blockers, and adjust priorities.'
  ],
  [
    'title' => 'Monthly Billing & Contract Management',
    'description' => 'Invoices are generated monthly based on the team size and agreed terms. Contracts can be adjusted as needs evolve.'
  ],
  [
    'title' => 'Ongoing Support & Scaling',
    'description' => 'Scale the team up or down based on business needs and continue support for long-term growth.'
  ]
  ],

        ],
       
        // Add more services here
    ];

    // Check if the requested service exists
    if (!array_key_exists($service, $servicesArray)) {
        abort(404); // Service not found
    }

    // Format the service name: replace dashes and ampersands, then capitalize
    $formattedService = str_replace(['-'], ' ', $service);
    $formattedService = str_replace(['&'], ' & ', $formattedService);
    $formattedService = ucwords($formattedService);
    $formattedService = str_replace([' - '], '-', $formattedService);

    // Fix UI/UX casing specifically after ucwords
    $formattedService = str_ireplace(['Ui/Ux', 'Ui-Ux', 'Ui Ux'], 'UI/UX', $formattedService);


    // Get the service details from the array
    $serviceDetails = $servicesArray[$service];

    // Pass both formatted name and details to the view
    return view('frontend.pricing', [
        'service' => $formattedService,
        'details' => $serviceDetails,
        'detailsArray'=> $serviceDetails['detailsArray'],
    ]);
});
