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
            'name' => 'Express',
            'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/express/express-original.svg',
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
    ];

    $designTechnologies = [
        ['name' => 'Figma', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg'],
        ['name' => 'Adobe XD', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/xd/xd-plain.svg'],
        ['name' => 'Canva', 'icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/canva/canva-original.svg'],
    ];
@endphp

<section class="relative py-32 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-purple-50"></div>
    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>

    <!-- Animated Background Shapes -->
    <div
        class="absolute top-0 left-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
    </div>
    <div
        class="absolute top-0 right-0 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
    </div>
    <div
        class="absolute bottom-0 left-1/2 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-20">
            <h2 class="text-5xl font-extrabold text-gray-900 mb-6">
                Our Technology Stack
                <span class="block text-4xl font-light text-blue-600 mt-2">Building the Future</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                We leverage cutting-edge technologies to build robust, scalable, and high-performance digital solutions
                that drive innovation.
            </p>
        </div>

        <!-- Technology Categories -->
        <div class="grid gap-16 md:grid-cols-2">
            <!-- Frontend Technologies -->
            <div class="group">
                <div
                    class="relative bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500 hover:scale-[1.02]">
                    <div
                        class="absolute -inset-0.5 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative">
                        <div class="flex items-center mb-8">
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Frontend Development</h3>
                        </div>
                        <x-technologies :items="$frontendTechnologies" />
                    </div>
                </div>
            </div>

            <!-- Backend Technologies -->
            <div class="group">
                <div
                    class="relative bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500 hover:scale-[1.02]">
                    <div
                        class="absolute -inset-0.5 bg-gradient-to-r from-green-600 to-teal-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative">
                        <div class="flex items-center mb-8">
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Backend Development</h3>
                        </div>
                        <x-technologies :items="$backendTechnologies" />
                    </div>
                </div>
            </div>

            <!-- Cloud Technologies -->
            <div class="group">
                <div
                    class="relative bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500 hover:scale-[1.02]">
                    <div
                        class="absolute -inset-0.5 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative">
                        <div class="flex items-center mb-8">
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Cloud & Hosting</h3>
                        </div>
                        <x-technologies :items="$cloudTechnologies" />
                    </div>
                </div>
            </div>

            <!-- Design Technologies -->
            <div class="group">
                <div
                    class="relative bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500 hover:scale-[1.02]">
                    <div
                        class="absolute -inset-0.5 bg-gradient-to-r from-pink-600 to-rose-600 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div class="relative">
                        <div class="flex items-center mb-8">
                            <div
                                class="w-14 h-14 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Design Tools</h3>
                        </div>
                        <x-technologies :items="$designTechnologies" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-grid-pattern {
        background-image: linear-gradient(to right, #80808012 1px, transparent 1px),
            linear-gradient(to bottom, #80808012 1px, transparent 1px);
        background-size: 24px 24px;
    }

    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }

        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
