@php
    $frontendTechnologies = [
        ['name' => 'HTML5', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg'],
        ['name' => 'CSS3', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg'],
        [
            'name' => 'JavaScript',
            'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg',
        ],
        ['name' => 'React', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg'],
        ['name' => 'Vue.js', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg'],
        [
            'name' => 'Laravel',
            'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/800px-Laravel.svg.png',
        ],
    ];

    $backendTechnologies = [
        [
            'name' => 'Node.js',
            'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg',
        ],
        [
            'name' => 'Java',
            'icon' => 'https://sc.filehippo.net/images/t_app-icon-l/p/4dd9406e-96d3-11e6-aa77-00163ec9f5fa/3927985343/java-development-kit-64-icon.png',
        ],
        ['name' => 'Python', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg'],
        ['name' => 'MongoDB', 'icon' => 'https://www.cdnlogo.com/logos/m/30/mongodb-icon.svg'],

        ['name' => 'PHP', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg'],
        ['name' => 'MySQL', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg'],
    ];

    $cloudTechnologies = [
        [
            'name' => 'AWS',
            'icon' => 'https://sourcebae.com/blog/wp-content/uploads/2023/08/1_b_al7C5p26tbZG4sy-CWqw.png',
        ],

        ['name' => 'Nginx', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nginx/nginx-original.svg'],

        ['name' => 'Azure', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/azure/azure-original.svg'],
        ['name' => 'GO Daddy', 'icon' => 'https://download.logo.wine/logo/GoDaddy/GoDaddy-Logo.wine.png'],
        ['name' => 'Hostinger', 'icon' => 'https://upload.wikimedia.org/wikipedia/commons/e/e5/Hostinger_Logotype.png'],
        ['name' => 'Google Cloud', 'icon' => 'https://cdn.prod.website-files.com/6449405754e757db07f25327/6656429d1776bd09704334e8_google.webp'],
    ];

    $designTechnologies = [
        ['name' => 'Figma', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg'],

        ['name' => 'Adobe XD', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/xd/xd-plain.svg'],
        ['name' => 'Canva', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/canva/canva-original.svg'],
    ];
@endphp

<section class="border-t bg-gradient-to-b from-gray-50 to-white py-20 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-4 tech-stack-heading">Tech Stack We Use</h2>
        <p class="text-gray-600 text-lg mb-16 max-w-2xl mx-auto">
            From frontend to cloud, here are the tools we use to build scalable, performant digital products.
        </p>

        <!-- First Row: Frontend and Backend -->
        <div class="grid gap-16 md:grid-cols-2 mb-16">
            <!-- Frontend -->
            <div class="bg-white rounded-2xl shadow-lg p-8 transform hover:scale-[1.02] transition-all duration-300">
                <h3 class="text-2xl font-bold mb-8 border-b pb-4 tech-category-heading">Frontend</h3>
                <x-technologies :items="$frontendTechnologies" />
            </div>

            <!-- Backend -->
            <div class="bg-white rounded-2xl shadow-lg p-8 transform hover:scale-[1.02] transition-all duration-300">
                <h3 class="text-2xl font-bold mb-8 border-b pb-4 tech-category-heading">Backend</h3>
                <x-technologies :items="$backendTechnologies" />
            </div>
        </div>

        <!-- Second Row: Cloud/Hosting and Design Tools -->
        <div class="grid gap-16 md:grid-cols-2">
            <!-- Cloud & Hosting -->
            <div class="bg-white rounded-2xl shadow-lg p-8 transform hover:scale-[1.02] transition-all duration-300">
                <h3 class="text-2xl font-bold mb-8 border-b pb-4 tech-category-heading">Cloud / Hosting</h3>
                <x-technologies :items="$cloudTechnologies" />
            </div>

            <!-- Design Tools -->
            <div class="bg-white rounded-2xl shadow-lg p-8 transform hover:scale-[1.02] transition-all duration-300">
                <h3 class="text-2xl font-bold mb-8 border-b pb-4 tech-category-heading">Design Tools</h3>
                <x-technologies :items="$designTechnologies" />
            </div>
        </div>
    </div>
</section>
