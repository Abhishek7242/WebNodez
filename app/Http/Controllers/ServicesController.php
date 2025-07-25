<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $achievements = Cache::remember('achievements', 60 * 60 * 24 * 30, function () {
            return Achievement::all();
        });
        return view('frontend.services', compact('achievements'));
    }
    
    public  function show($service) {
        $achievements = Cache::remember('achievements', 60 * 60 * 24 * 30, function () {
            return Achievement::all();
        });
    $servicesArray = [
        "web-development" => [
            'description' => '  We build fast, secure, and responsive websites tailored to your goals.',
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
            'faqs' => [
                [
                    'question' => 'What web development services do you offer?',
                    'answer' =>
                    'We provide end-to-end web development services including custom website design, responsive development, CMS integration (like WordPress), e-commerce development, web application development, and performance optimization.',
                ],
                [
                    'question' => 'How long does it take to develop a website?',
                    'answer' =>
                    'The timeline depends on the project scope. A standard business website typically takes 3–6 weeks, while more complex sites like e-commerce platforms or custom web apps may take 6–12 weeks. We provide a detailed timeline after the initial consultation.',
                ],
                [
                    'question' => 'How much does a website project cost?',
                    'answer' =>
                    'Our pricing is customized based on your requirements. Simple websites are more affordable, while larger or feature-rich projects cost more. We provide a detailed, transparent quote after discussing your goals and needs.',
                ],
                [
                    'question' => 'Do you offer post-launch support for websites?',
                    'answer' =>
                    'Yes, we offer ongoing website maintenance and support, including content updates, security monitoring, bug fixes, and performance improvements. We also offer support packages tailored to your needs.',
                ],
                [
                    'question' => 'How do you ensure the quality of your web development work?',
                    'answer' =>
                    'We follow modern development standards and perform extensive testing across devices and browsers. Our process includes code reviews, user testing, performance checks, and SEO optimization to ensure quality and reliability.',
                ],
                [
                    'question' => 'Can you work on or improve my existing website?',
                    'answer' =>
                    'Absolutely! We can audit your existing site and help with updates, redesigns, performance optimization, SEO improvements, and adding new features. Whether your site needs a minor tweak or a full revamp, we’ve got you covered.',
                ],
            ],
            'introImages' => [
                'https://cdn.dribbble.com/userupload/24675218/file/original-217fe0b2bffa18d19df2596909528580.gif',
                'https://img.freepik.com/free-photo/web-design-technology-browsing-programming-concept_53876-163260.jpg?semt=ais_hybrid&w=740',
                'https://images-platform.99static.com//gERmn6TxrIrnrs01YXG90zL5Rao=/0x0:533x533/fit-in/500x500/projects-files/105/10552/1055228/9e9346fc-88c9-4235-bcb7-82cbaa1f2366.gif',
                'https://cdn.dribbble.com/userupload/22267243/file/original-c55e0dc36929b801bea0ebf28c3d2be2.gif',
            ],
            'overview'=>[
                'heading'=> 'Why Web Development is Your Digital Solution',
                'description'=> " In today' s digital - first world,
                having a strong online presence is no longer optional—it 's essential.
                    Web development serves as the foundation of your digital strategy, enabling you to reach global
                    audiences,
                    showcase your brand, and drive business growth. Our comprehensive web development solutions transform
                    your
                    vision into a powerful digital platform that engages users and delivers results.",
                'image'=> 'https://blog.appseed.us/content/images/2023/02/design-web-agency-intro.gif',
            ],

            
            'tech'=>[
                'names' => [
                    "Frontend ", 'Backend',
                    'Cloud / Hosting',
                    "Design Tools"
                ],
                'frontendTechnologies' => [
            [
                'name' => 'HTML5',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg',
            ],
            ['name' => 'CSS3', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg'],
            [
                'name' => 'JavaScript',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg',
            ],
            [
                'name' => 'React',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg',
            ],
            [
                'name' => 'Vue.js',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg',
            ],
            [
                'name' => 'Laravel',
                'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/800px-Laravel.svg.png',
            ],
        ],

        'backendTechnologies' => [
            [
                'name' => 'Node.js',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg',
            ],
            [
                'name' => 'Java',
                'icon' =>
                    'https://sc.filehippo.net/images/t_app-icon-l/p/4dd9406e-96d3-11e6-aa77-00163ec9f5fa/3927985343/java-development-kit-64-icon.png',
            ],
            [
                'name' => 'Python',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg',
            ],
            ['name' => 'MongoDB', 'icon' => 'https://www.cdnlogo.com/logos/m/30/mongodb-icon.svg'],

            ['name' => 'PHP', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg'],
            [
                'name' => 'MySQL',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg',
            ],
        ],

        'cloudTechnologies' => [
            [
                'name' => 'AWS',
                'icon' => 'https://sourcebae.com/blog/wp-content/uploads/2023/08/1_b_al7C5p26tbZG4sy-CWqw.png',
            ],

            [
                'name' => 'Nginx',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nginx/nginx-original.svg',
            ],

            [
                'name' => 'Azure',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/azure/azure-original.svg',
            ],
            ['name' => 'GO Daddy', 'icon' => 'https://download.logo.wine/logo/GoDaddy/GoDaddy-Logo.wine.png'],
            [
                'name' => 'Hostinger',
                'icon' => 'https://upload.wikimedia.org/wikipedia/commons/e/e5/Hostinger_Logotype.png',
            ],
            [
                'name' => 'Google Cloud',
                'icon' =>
                    'https://cdn.prod.website-files.com/6449405754e757db07f25327/6656429d1776bd09704334e8_google.webp',
            ],
        ],

        'designTechnologies' => [
            [
                'name' => 'Figma',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg',
            ],

            ['name' => 'Adobe XD', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/xd/xd-plain.svg'],
            [
                'name' => 'Canva',
                'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/canva/canva-original.svg',
            ],
        ],
    ],
            'projects'=>$achievements[1]['number'],
            'clientSatisfaction'=>$achievements[2]['number'],




        ],
        "e_commerce" => [
            'description' => 'Beautiful, user-focused online stores that drive sales and build loyalty.',
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
            'faqs' => [
                [
                    'question' => 'What e-commerce services do you offer?',
                    'answer' =>
                    'We provide end-to-end e-commerce solutions including custom online store development, payment gateway integration, shopping cart setup, product management, and marketing tools to help grow your business.',
                ],
                [
                    'question' => 'How long does it take to launch an e-commerce website?',
                    'answer' =>
                    'Typically, e-commerce projects take 6-12 weeks depending on complexity, features, and integrations required. We work closely with you to deliver a fully functional and optimized store within the agreed timeline.',
                ],
                [
                    'question' => 'What pricing models do you follow for e-commerce projects?',
                    'answer' =>
                    'Our pricing is based on the project scope and your specific requirements. We offer transparent quotes with no hidden fees, covering design, development, testing, and deployment.',
                ],
                [
                    'question' => 'Do you provide ongoing support and maintenance?',
                    'answer' =>
                    'Yes, we offer comprehensive post-launch support including platform updates, security patches, feature enhancements, and technical assistance to ensure your e-commerce site runs smoothly.',
                ],
                [
                    'question' => 'How do you ensure the security of my e-commerce store?',
                    'answer' =>
                    'We implement industry-standard security measures including SSL certificates, secure payment gateways, regular vulnerability testing, and compliance with data protection regulations to keep your store and customers safe.',
                ],
                [
                    'question' => 'Can you integrate third-party tools with my store?',
                    'answer' =>
                    'Absolutely! We can integrate various third-party services such as payment gateways, CRM, inventory management, shipping providers, and marketing tools to enhance your store’s functionality.',
                ],
            ],

            'introImages' => [
                'https://images.unsplash.com/photo-1506765515384-028b60a970df',
                'https://cdn.dribbble.com/userupload/24675218/file/original-217fe0b2bffa18d19df2596909528580.gif',
                'https://img.freepik.com/free-photo/web-design-technology-browsing-programming-concept_53876-163260.jpg',
                'https://images-platform.99static.com//gERmn6TxrIrnrs01YXG90zL5Rao=/0x0:533x533/fit-in/500x500/projects-files/105/10552/1055228/9e9346fc-88c9-4235-bcb7-82cbaa1f2366.gif',
            ],
            'overview' => [
                'heading' => 'Why E-commerce is Your Key to Digital Success',
                'description' => " In today’s digital-first world, having a robust online store is essential to reach customers and grow your business. E-commerce development builds the foundation for your digital sales strategy, enabling you to showcase products, engage shoppers, and drive revenue. Our comprehensive e-commerce solutions turn your vision into a seamless, user-friendly shopping experience that boosts conversions and builds customer loyalty.",
                'image' => 'https://cdn.prod.website-files.com/6009ec8cda7f305645c9d91b/60107f8f3fb5ed50a4de8aeb_6002086f72b727635701e256_mueble-gif.gif',
            ],
            'tech' => [
                'names' => [
                    "Frontend ",
                    'Backend',
                    'Cloud / Hosting',
                    "Design Tools"
                ],
                'frontendTechnologies' => [
                    [
                        'name' => 'HTML5',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg',
                    ],
                    ['name' => 'CSS3', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg'],
                    [
                        'name' => 'JavaScript',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg',
                    ],
                    [
                        'name' => 'React',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg',
                    ],
                    [
                        'name' => 'Vue.js',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg',
                    ],
                    [
                        'name' => 'Laravel',
                        'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/800px-Laravel.svg.png',
                    ],
                ],

                'backendTechnologies' => [
                    [
                        'name' => 'Node.js',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg',
                    ],
                    [
                        'name' => 'Java',
                        'icon' =>
                        'https://sc.filehippo.net/images/t_app-icon-l/p/4dd9406e-96d3-11e6-aa77-00163ec9f5fa/3927985343/java-development-kit-64-icon.png',
                    ],
                    [
                        'name' => 'Python',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg',
                    ],
                    ['name' => 'MongoDB', 'icon' => 'https://www.cdnlogo.com/logos/m/30/mongodb-icon.svg'],

                    ['name' => 'PHP', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg'],
                    [
                        'name' => 'MySQL',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg',
                    ],
                ],

                'cloudTechnologies' => [
                    [
                        'name' => 'AWS',
                        'icon' => 'https://sourcebae.com/blog/wp-content/uploads/2023/08/1_b_al7C5p26tbZG4sy-CWqw.png',
                    ],

                    [
                        'name' => 'Nginx',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nginx/nginx-original.svg',
                    ],

                    [
                        'name' => 'Azure',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/azure/azure-original.svg',
                    ],
                    ['name' => 'GO Daddy', 'icon' => 'https://download.logo.wine/logo/GoDaddy/GoDaddy-Logo.wine.png'],
                    [
                        'name' => 'Hostinger',
                        'icon' => 'https://upload.wikimedia.org/wikipedia/commons/e/e5/Hostinger_Logotype.png',
                    ],
                    [
                        'name' => 'Google Cloud',
                        'icon' =>
                        'https://cdn.prod.website-files.com/6449405754e757db07f25327/6656429d1776bd09704334e8_google.webp',
                    ],
                ],

                'designTechnologies' => [
                    [
                        'name' => 'Figma',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg',
                    ],

                    ['name' => 'Adobe XD', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/xd/xd-plain.svg'],
                    [
                        'name' => 'Canva',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/canva/canva-original.svg',
                    ],
                ],
            ],
                'projects' => $achievements[1]['number'],
                'clientSatisfaction' => $achievements[2]['number'],

            ],
        "ui-ux-design" => [
            'description' => 'Intuitive, modern design that elevates your brand and delights users.',
            'detailsArray' => [
                [
                    'title' => 'User Research & Persona Development',
                    'description' => 'Conduct detailed research using interviews, surveys, and data analysis to create user personas that represent your target audience. These personas guide design decisions to ensure user-centric solutions.'
                ],
                [
                    'title' => 'Information Architecture & User Flows',
                    'description' => 'Structure content logically and design user flows that map how users navigate your product to achieve their goals efficiently, creating an intuitive and seamless experience.'
                ],
                [
                    'title' => 'Wireframing',
                    'description' => 'Create low-fidelity wireframes to visualize the layout and hierarchy of each screen, allowing for quick iteration and feedback before moving on to detailed design.'
                ],
                [
                    'title' => 'Interaction Design & Microinteractions',
                    'description' => 'Design interactive elements such as buttons, transitions, and feedback animations to enhance usability and provide clear responses to user actions.'
                ],
                [
                    'title' => 'Visual Design & Branding',
                    'description' => 'Develop high-fidelity mockups aligned with your brand’s identity, focusing on typography, colors, icons, and overall aesthetics to create an engaging and accessible interface.'
                ],
                [
                    'title' => 'Prototyping',
                    'description' => 'Build clickable prototypes to simulate real user interactions, allowing stakeholders to test and validate flows before development.'
                ],
                [
                    'title' => 'Usability Testing',
                    'description' => 'Test prototypes with real users to identify pain points and areas for improvement, refining the design to enhance user satisfaction.'
                ],
                [
                    'title' => 'Design Handoff to Development',
                    'description' => 'Prepare design assets, style guides, and documentation to ensure developers implement the design accurately and efficiently.'
                ],
                [
                    'title' => 'Post-Launch UX Optimization',
                    'description' => 'Analyze user behavior post-launch to continuously improve the interface, increasing engagement and retention based on real-world data.'
                ],
            ],

            'faqs' => [
                [
                    'question' => 'What UI/UX design services do you offer?',
                    'answer' =>
                    'We provide comprehensive UI/UX design services including user research, wireframing, prototyping, visual design, usability testing, and interaction design to create intuitive and engaging digital experiences.',
                ],
                [
                    'question' => 'How long does the UI/UX design process take?',
                    'answer' =>
                    'The design process duration varies based on project complexity. Typically, initial research and wireframing take 2-3 weeks, followed by prototyping and visual design which can take another 3-4 weeks. Timelines are customized per project.',
                ],
                [
                    'question' => 'What is your pricing structure for UI/UX design?',
                    'answer' =>
                    'Our pricing depends on the scope and scale of the design work. We offer transparent, project-based pricing after understanding your requirements, ensuring you receive value without hidden fees.',
                ],
                [
                    'question' => 'Do you provide user testing and feedback?',
                    'answer' =>
                    'Yes, user testing is an integral part of our design process. We conduct usability tests and gather user feedback to refine designs and ensure they meet real user needs effectively.',
                ],
                [
                    'question' => 'How do you ensure the designs align with our brand?',
                    'answer' =>
                    'We collaborate closely with you to understand your brand identity, values, and goals. Our designs incorporate your brand guidelines and aesthetics to create a consistent and recognizable user experience.',
                ],
                [
                    'question' => 'Can you help redesign existing interfaces?',
                    'answer' =>
                    'Absolutely! We can analyze your current UI/UX, identify pain points, and redesign interfaces to improve usability, engagement, and overall user satisfaction.',
                ],
            ],

            'introImages' => [
                'https://images.unsplash.com/photo-1506765515384-028b60a970df',
                'https://cdn.dribbble.com/userupload/24675218/file/original-217fe0b2bffa18d19df2596909528580.gif',
                'https://img.freepik.com/free-photo/web-design-technology-browsing-programming-concept_53876-163260.jpg',
                'https://images-platform.99static.com//gERmn6TxrIrnrs01YXG90zL5Rao=/0x0:533x533/fit-in/500x500/projects-files/105/10552/1055228/9e9346fc-88c9-4235-bcb7-82cbaa1f2366.gif',
            ],
            'overview' => [
                'heading' => 'Why UX/UI Design is Crucial for Your Digital Success',
                'description' => " In a digital-first world, great design is key to engaging users and building brand loyalty. UX/UI design creates intuitive, visually appealing interfaces that make every interaction effortless and enjoyable. Our design solutions transform your ideas into sleek, user-centered experiences that drive satisfaction and business growth.",
                'image' => 'https://mir-s3-cdn-cf.behance.net/project_modules/hd/be510767817393.5b472244e895f.gif',
            ],
            'tech' => [
                'names'=>[
                    "Design Tools", 'Prototyping Tools', 'Collaboration Tools', "Animation Tools"
                ],

                'frontendTechnologies' => [
                    [
                        'name' => 'Figma',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg',
                    ],
                    [
                        'name' => 'Adobe XD',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/xd/xd-plain.svg',
                    ],
                    [
                        'name' => 'Sketch',
                        'icon' => 'https://upload.wikimedia.org/wikipedia/commons/5/59/Sketch_Logo.svg',
                    ],
                    [
                        'name' => 'Canva',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/canva/canva-original.svg',
                    ],
                    [
                        'name' => ' Photoshop',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/photoshop/photoshop-plain.svg',
                    ],
                    [
                        'name' => ' Illustrator',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/illustrator/illustrator-plain.svg',
                    ],
                ],

                'backendTechnologies' => [
                    [
                        'name' => 'InVision',
                        'icon' => 'https://cdn.worldvectorlogo.com/logos/invision.svg',
                    ],
       
                    [
                        'name' => 'Framer',
                        'icon' => 'https://framerusercontent.com/images/TvJ9grdPgk3sRz6T6XwkpBrFr4k.png?scale-down-to=512',
                    ],
                ],

                'cloudTechnologies' => [
                    [
                        'name' => 'Zeplin',
                        'icon' => 'https://cdn.worldvectorlogo.com/logos/zeplin.svg',
                    ],
                    [
                        'name' => 'Miro',
                        'icon' => 'https://store-images.s-microsoft.com/image/apps.47763.13959754522315136.87be3224-9693-4fd4-8cd4-af6362fb8d37.b3c24453-164b-4d03-b561-e77aec7c076a?h=210',
                    ],
                    [
                        'name' => 'Notion',
                        'icon' => 'https://upload.wikimedia.org/wikipedia/commons/4/45/Notion_app_logo.png',
                    ],
                ],

                'designTechnologies' => [
                    [
                        'name' => 'Lottie',
                        'icon' => 'https://lottiefiles.gallerycdn.vsassets.io/extensions/lottiefiles/vscode-lottie/1.0.5/1644929862372/Microsoft.VisualStudio.Services.Icons.Default',
                    ],
                   
                    [
                        'name' => 'After Effects',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/aftereffects/aftereffects-plain.svg',
                    ],
                ],

            ],

                'projects' => $achievements[1]['number'],
                'clientSatisfaction' => $achievements[2]['number'],

            ],
        "app-development" => [
            'description' => 'Stunning, user-focused mobile apps built to elevate your brand.',
            'detailsArray' => [
                [
                    'title' => 'Discovery & Requirement Analysis',
                    'description' => 'We start by understanding your vision through workshops and stakeholder interviews to gather detailed business and technical requirements, user personas, and project goals.'
                ],
                [
                    'title' => 'Market & User Research',
                    'description' => 'We analyze user behavior, pain points, and competitors to gather insights via surveys, interviews, and usability testing to inform design and features.'
                ],
                [
                    'title' => 'Wireframing & Information Architecture',
                    'description' => 'We create wireframes outlining screen layouts, navigation, and user flows, and define information architecture to ensure intuitive usability.'
                ],
                [
                    'title' => 'UI/UX Design',
                    'description' => 'Designers craft polished mockups reflecting your brand identity, focusing on typography, color, icons, and micro-interactions. Clickable prototypes enable stakeholder feedback.'
                ],
                [
                    'title' => 'Cross-Platform App Development',
                    'description' => 'We build performant frontends using Flutter, React Native, or native Swift/Kotlin, applying modular, maintainable code practices.'
                ],
                [
                    'title' => 'Backend Development & API Integration',
                    'description' => 'We develop robust backends with Laravel, Node.js, or Firebase, integrating APIs, authentication, cloud storage, and third-party services like payments and analytics.'
                ],
                [
                    'title' => 'Quality Assurance & Testing',
                    'description' => 'Our thorough QA process covers unit, functional, regression, and real-device testing to ensure a bug-free launch and user acceptance.'
                ],
                [
                    'title' => 'App Store Submission & Deployment',
                    'description' => 'We handle app submission with all required assets, metadata, and platform compliance, guiding you through approval for Apple App Store and Google Play.'
                ],
                [
                    'title' => 'Post-Launch Support & Iteration',
                    'description' => 'After launch, we monitor performance and user feedback to continuously improve the app with updates, fixes, and new features.'
                ],
            ],

            'faqs' => [
                [
                    'question' => 'What app development services do you offer?',
                    'answer' =>
                    'We develop custom mobile applications for iOS and Android platforms, including native, hybrid, and cross-platform solutions tailored to your business needs.',
                ],
                [
                    'question' => 'How long does it take to develop an app?',
                    'answer' =>
                    'App development timelines vary by complexity. Simple apps may take 8-12 weeks, while feature-rich or enterprise apps can take 4-6 months or more. We provide detailed timelines upfront.',
                ],
                [
                    'question' => 'What is your pricing model for app development?',
                    'answer' =>
                    'Pricing depends on app complexity, features, and platforms. We offer transparent, project-based pricing with no hidden fees, and provide detailed quotes after requirement analysis.',
                ],
                [
                    'question' => 'Do you offer post-launch support and maintenance?',
                    'answer' =>
                    'Yes, we provide ongoing support including app updates, bug fixes, performance monitoring, and help with new feature development to keep your app running smoothly.',
                ],
                [
                    'question' => 'How do you ensure app quality?',
                    'answer' =>
                    'We follow best practices and conduct thorough testing, including functional, usability, performance, and security testing to deliver a high-quality app experience.',
                ],
                [
                    'question' => 'Can you assist with existing app projects?',
                    'answer' =>
                    'Absolutely! We can improve, update, or rebuild your existing app. Our team assesses your current app and suggests enhancements or necessary upgrades.',
                ],
            ],

            'introImages' => [
                'https://cdn.dribbble.com/userupload/22313184/file/original-e225092ba79998dcb1ab67dda698fa89.gif',
                'https://cdn.dribbble.com/userupload/24675218/file/original-217fe0b2bffa18d19df2596909528580.gif',
                'https://i.pinimg.com/originals/ca/bb/fc/cabbfca4b591059500ad35a9c1e7001b.gif',
                'https://www.appslure.com/wp-content/uploads/2022/07/app-development-1.gif',
            ],
            'overview' => [
                'heading' => 'Why Mobile App Development is Your Digital Solution',
                'description' => " In today’s mobile-driven world, having a seamless app experience is essential to stay competitive. Mobile app development empowers you to connect directly with users, boost engagement, and expand your reach. Our custom app solutions turn your ideas into intuitive, high-performance applications that drive real business results and enhance customer loyalty.",
                'image' => 'https://clevertap.com/wp-content/uploads/2018/10/mobile-app-design-forms-broken-up.gif',
            ],
            'tech' => [
                'names' => [
                    "Frontend ",
                    'Backend',
                    'App Store',
                    "Design Tools"
                ],

                'frontendTechnologies' => [
                    [
                        'name' => 'Flutter',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg',
                    ],
                    [
                        'name' => 'React Native',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg',
                    ],
                    [
                        'name' => 'Swift',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/swift/swift-original.svg',
                    ],
                    [
                        'name' => 'Kotlin',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/kotlin/kotlin-original.svg',
                    ],
                    [
                        'name' => 'Java',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg',
                    ],
                ],

                'backendTechnologies' => [
                    [
                        'name' => 'Node.js',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg',
                    ],
                    [
                        'name' => 'Laravel',
                        'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/800px-Laravel.svg.png',
                    ],
                    [
                        'name' => 'Django',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/django/django-plain.svg',
                    ],
                    [
                        'name' => 'Firebase',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-plain.svg',
                    ],
                    [
                        'name' => 'MongoDB',
                        'icon' => 'https://www.cdnlogo.com/logos/m/30/mongodb-icon.svg',
                    ],
                    [
                        'name' => 'MySQL',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg',
                    ],
                ],

                'cloudTechnologies' => [
                    [
                        'name' => 'Firebase',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-plain.svg',
                    ],
                    [
                        'name' => 'AWS Amplify',
                        'icon' => 'https://images.credly.com/images/1d55a25a-3ba0-492c-8dad-12c3be3f0782/blob.png',
                    ],
                    [
                        'name' => 'Google Cloud',
                        'icon' => 'https://cdn.prod.website-files.com/6449405754e757db07f25327/6656429d1776bd09704334e8_google.webp',
                    ],
                    [
                        'name' => 'Azure',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/azure/azure-original.svg',
                    ],
                ],

                'designTechnologies' => [
                    [
                        'name' => 'Figma',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg',
                    ],
                    [
                        'name' => 'Adobe XD',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/xd/xd-plain.svg',
                    ],
                    [
                        'name' => 'Canva',
                        'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/canva/canva-original.svg',
                    ],
                ],

            ],

                'projects' => $achievements[1]['number'],
                'clientSatisfaction' => $achievements[2]['number'],

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
        'faqsArray' => $serviceDetails['faqs'],
        'introImages' => $serviceDetails['introImages'],
        'projectNumber' => $serviceDetails['projects'],
        'overview' => $serviceDetails['overview'],
        'clientSatis' => $serviceDetails['clientSatisfaction'],
        'technology' => $serviceDetails['tech'],
    ]);
}
    //
}