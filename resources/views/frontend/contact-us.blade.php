@extends('frontend/layouts/main')
@section('title', 'WebNodez - Contact Us')
@section('meta_description',
    'Contact WebNodez for professional web development and digital solutions. Get in touch with
    our expert team for project inquiries, support, or consultations. Available Mon-Fri, 9am-6pm with multilingual
    support.')
@section('meta_keywords',
    'contact webnodez, web development contact, IT support contact, project consultation, customer
    support, technical support, business inquiry, digital solutions contact')
@section('og_image', asset('images/contact-og-image.jpg'))
@section('contact', 'active')
@section('main-section')
    <link href="{{ asset('css/contact-us.css') }}" rel="stylesheet">

    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');
    </script>

    {{-- intro section --}}
    <section class="contact-us-section relative text-black py-16 md:py-20 lg:py-24 px-4 md:px-8 lg:px-16 overflow-hidden">
        <div class="max-w-4xl mx-auto text-center z-10 relative">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-3 md:mb-4 tracking-tight leading-tight">
                Get in Touch with <span class="text-[--color-primary]">WebNodez Team</span>
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-gray-500 mb-6 md:mb-10 max-w-2xl mx-auto leading-relaxed">
                Let's build something amazing together. Whether it's a question, project idea, or just a hello — we'd love
                to hear from you.
            </p>
        </div>

        <!-- Background Shape / Decoration -->
        <div
            class="absolute top-0 right-0 w-40 h-40 md:w-60 md:h-60 lg:w-80 lg:h-80 bg-[--color-secondary] rounded-full opacity-20 blur-3xl animate-pulse-slow z-0">
        </div>
    </section>


    </header>
    <section id="contact-us-section">


        <div id="contact-us-container">
            <div id="contact-us-inner-container">
                <div id="contact-us-info">

                    <div>

                        <x-contact-form />
                    </div>



                </div>
            </div>
        </div>
        </div>
    </section>

    {{-- contact-us-team --}}
    <section class="contact-us-team-section bg-gray-50 py-16 md:py-20 px-4 md:px-8 lg:px-20 max-w-7xl mx-auto">
        <div class="text-center max-w-4xl mx-auto mb-12 md:mb-16">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-3 md:mb-4">Connect With Our Team</h2>
            <p class="text-base sm:text-lg text-gray-600 max-w-xl mx-auto leading-relaxed">
                We're here to help! Reach out with questions, feedback, or anything else — and experience our quick,
                personalized support.
            </p>
        </div>

        <div class="contact-us-team-info-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10">
            <div
                class="bg-white p-6 md:p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col">
                <h3 class="text-xl md:text-2xl font-bold mb-3 md:mb-4 text-green-600 border-l-4 border-green-400 pl-4">Our
                    Team</h3>
                <div class="content-wrapper">
                    <p class="text-sm md:text-base text-gray-700 leading-relaxed">
                        Meet the friendly experts dedicated to delivering fast, human-centered support. No bots, just real
                        people who care.
                    </p>
                    <ul class="list-disc list-inside text-sm md:text-base text-gray-600 space-y-2">
                        <li>Available Mon–Fri, 9am–6pm</li>
                        <li>Multilingual & globally accessible</li>
                        <li>Always up-to-date training</li>
                    </ul>
                </div>
            </div>

            <div
                class="bg-white p-6 md:p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col">
                <h3 class="text-xl md:text-2xl font-bold mb-3 md:mb-4 text-green-600 border-l-4 border-blue-400 pl-4">Our
                    Services</h3>
                <div class="content-wrapper">
                    <p class="text-sm md:text-base text-gray-700 leading-relaxed">
                        Multiple ways to connect, whichever suits you best.
                    </p>
                    <ul class="list-disc list-inside text-sm md:text-base text-gray-600 space-y-2">
                        <li>Phone support with specialists</li>
                        <li>24/7 email replies within 24 hours</li>
                        <li>Live chat during business hours</li>
                        <li>Dedicated account managers</li>
                    </ul>
                </div>
            </div>

            <div
                class="bg-white p-6 md:p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col sm:col-span-2 lg:col-span-1">
                <h3 class="text-xl md:text-2xl font-bold mb-3 md:mb-4 text-green-600 border-l-4 border-purple-400 pl-4">
                    Feedback & Response</h3>
                <div class="content-wrapper">
                    <p class="text-sm md:text-base text-gray-700 leading-relaxed">
                        Your feedback shapes us. Here's how we keep improving:
                    </p>
                    <ul class="list-disc list-inside text-sm md:text-base text-gray-600 space-y-2">
                        <li>Listening carefully to every suggestion</li>
                        <li>Customer satisfaction surveys after support</li>
                        <li>Feature updates based on your needs</li>
                        <li>Clear and timely communication</li>
                    </ul>
                    <p class="mt-4 md:mt-6 italic text-xs md:text-sm text-gray-500">
                        "Your voice matters — help us serve you better."
                    </p>
                </div>
            </div>
        </div>
    </section>



@endsection
