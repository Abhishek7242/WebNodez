@extends('frontend/layouts/main')
@section('title', 'WebNodez - About Us')
@section('about', 'active')
@section('main-section')
<script>
    const el = document.querySelector('#header');
el.style.setProperty('--intro-bg', `url('https://w0.peakpx.com/wallpaper/251/431/HD-wallpaper-black-with-green-background-technology-other-entertainment-people.jpg')`);

 </script>
    <section class=" to-green-700 text-white py-20 px-6 md:px-12 lg:px-24">
        <div class="max-w-5xl mx-auto text-center">
          <h1 class="text-5xl md:text-6xl font-extrabold mb-6 drop-shadow-lg">
            Building Innovative Software <br class="hidden md:block" /> Solutions That Empower Businesses
          </h1>
          <p class="text-lg md:text-xl max-w-3xl mx-auto mb-10 leading-relaxed opacity-90">
            At WebNodez, we combine creativity, technology, and expertise to deliver scalable, high-performance software tailored to your business needs. From concept to deployment, we transform ideas into impactful digital experiences.
          </p>
       
        </div>
      </section>
      
    </header>
    <section id="our-story" class="py-20 px-6 md:px-12 lg:px-24 bg-gray-50">
        <div class="max-w-5xl mx-auto">
          <h2 class="text-4xl font-extrabold text-gray-900 mb-12 text-center">Our Story</h2>
          <div class="relative border-l-4 border-green-600 pl-8 space-y-12">
            
            <!-- Milestone 1 -->
            <div>
              <div class="absolute -left-5 top-1 bg-green-600 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold shadow-lg">2015</div>
              <h3 class="text-2xl font-semibold text-gray-800 mb-2">Founded with a Vision</h3>
              <p class="text-gray-600 leading-relaxed">
                WebNodez was established in 2015 with a mission to innovate and deliver cutting-edge software solutions to businesses worldwide.
              </p>
            </div>
      
            <!-- Milestone 2 -->
            <div>
              <div class="absolute -left-5 top-1 bg-green-600 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold shadow-lg">2018</div>
              <h3 class="text-2xl font-semibold text-gray-800 mb-2">Expanded Our Services</h3>
              <p class="text-gray-600 leading-relaxed">
                We expanded our offerings to include mobile app development, cloud hosting, and UI/UX design services, strengthening our client portfolio.
              </p>
            </div>
      
            <!-- Milestone 3 -->
            <div>
              <div class="absolute -left-5 top-1 bg-green-600 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold shadow-lg">2022</div>
              <h3 class="text-2xl font-semibold text-gray-800 mb-2">Global Reach</h3>
              <p class="text-gray-600 leading-relaxed">
                Our solutions now power businesses across multiple continents, delivering scalable and reliable technology that drives growth.
              </p>
            </div>
            
          </div>
        </div>
      </section>
      

      {{-- 3rd Section --}}
      <section id="mission-vision-values" class="py-20 px-6 md:px-12 lg:px-24 bg-white">
        <div class="max-w-6xl mx-auto text-center">
          <h2 class="text-4xl font-bold text-gray-900 mb-12">Mission, Vision & Values</h2>
          <div class="grid md:grid-cols-3 gap-10">
      
            <!-- Mission -->
            <div class="p-8 bg-gradient-to-br from-[var(--color-primary)] to-black rounded-lg shadow-lg text-white hover:brightness-110 transition duration-300">
              <h3 class="text-2xl font-semibold mb-6 border-b">Our Mission</h3>
              <p class="leading-relaxed text-sm">
                To deliver innovative, reliable, and scalable software solutions that empower businesses to grow and succeed in a digital-first world.
              </p>
            </div>
      
            <!-- Vision -->
            <div class="p-8 bg-gradient-to-br from-[var(--color-primary)] to-black rounded-lg shadow-lg text-white hover:brightness-110 transition duration-300">
              <h3 class="text-2xl font-semibold mb-6 border-b">Our Vision</h3>
              <p class="leading-relaxed text-sm">
                To be a global leader in technology innovation, transforming industries with cutting-edge digital products and exceptional customer experiences.
              </p>
            </div>
      
            <!-- Values -->
            <div class="text-start p-8 bg-gradient-to-br from-[var(--color-primary)] to-black rounded-lg shadow-lg text-white hover:brightness-110 transition duration-300">
              <h3 class="text-2xl font-semibold mb-6 text-center border-b">Our Values</h3>
              <ul class="leading-relaxed space-y-4 text-sm">
                <li class="flex items-start space-x-3">
                  <svg class="w-6 h-6 flex-shrink-0 text-yellow-400 mt-1" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"/></svg>
                  <span><strong>Integrity:</strong> We uphold honesty and transparency in all our dealings.</span>
                </li>
                <li class="flex items-start space-x-3">
                  <svg class="w-6 h-6 flex-shrink-0 text-yellow-400 mt-1" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"/></svg>
                  <span><strong>Innovation:</strong> We continuously seek creative solutions to solve complex problems.</span>
                </li>
                <li class="flex items-start space-x-3">
                  <svg class="w-6 h-6 flex-shrink-0 text-yellow-400 mt-1" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"/></svg>
                  <span><strong>Customer Centricity:</strong> Our clients’ success is at the heart of everything we do.</span>
                </li>
                <li class="flex items-start space-x-3">
                  <svg class="w-6 h-6 flex-shrink-0 text-yellow-400 mt-1" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"/></svg>
                  <span><strong>Collaboration:</strong> We believe in teamwork and open communication.</span>
                </li>
                <li class="flex items-start space-x-3">
                  <svg class="w-6 h-6 flex-shrink-0 text-yellow-400 mt-1" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"/></svg>
                  <span><strong>Excellence:</strong> We strive for the highest quality in our work and delivery.</span>
                </li>
              </ul>
            </div>
      
          </div>
        </div>
      </section>
      

{{-- 4th Section --}}

<section class="bg-gray-150 text-white py-20 px-6 md:px-12 border-t">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-4 text-black">What We Do</h2>
      <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto">
        We craft digital experiences that drive results — blending innovation, design, and code.
      </p>
  
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Web Development -->
        <div class="bg-gradient-to-br from-[var(--color-primary)] to-gray-900 rounded-xl p-8 shadow-lg hover:scale-105 transition-transform duration-300">
          <div class="mb-4">
            <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2H3V4zm0 4h18v12a1 1 0 01-1 1H4a1 1 0 01-1-1V8z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Web Development</h3>
          <p class="text-gray-300">Fast, scalable, and secure websites and web apps tailored to your business.</p>
        </div>
  
        <!-- UI/UX Design -->
        <div class="bg-gradient-to-br from-[var(--color-primary)] to-gray-900 rounded-xl p-8 shadow-lg hover:scale-105 transition-transform duration-300">
          <div class="mb-4">
            <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M12 2L2 7l10 5 10-5-10-5zm0 13l-8.5-4.5v9L12 24l8.5-4.5v-9L12 15z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">UI/UX Design</h3>
          <p class="text-gray-300">Human-centered design that enhances usability, accessibility, and visual appeal.</p>
        </div>
  
        <!-- Mobile App Development -->
        <div class="bg-gradient-to-br from-[var(--color-primary)] to-gray-900 rounded-xl p-8 shadow-lg hover:scale-105 transition-transform duration-300">
          <div class="mb-4">
            <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M7 2a2 2 0 00-2 2v16a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H7zm5 18a1 1 0 110-2 1 1 0 010 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Mobile App Development</h3>
          <p class="text-gray-300">Custom iOS and Android apps designed for performance and user delight.</p>
        </div>
  
        <!-- Cloud & Hosting -->
        <div class="bg-gradient-to-br from-[var(--color-primary)] to-gray-900 rounded-xl p-8 shadow-lg hover:scale-105 transition-transform duration-300">
          <div class="mb-4">
            <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M3 15a4 4 0 013.87-3h.26A6.5 6.5 0 1118 17H6a3 3 0 01-3-3z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Cloud & Hosting</h3>
          <p class="text-gray-300">Robust cloud architecture with reliable uptime and secure deployment.</p>
        </div>
  
        <!-- Branding & Identity -->
        <div class="bg-gradient-to-br from-[var(--color-primary)] to-gray-900 rounded-xl p-8 shadow-lg hover:scale-105 transition-transform duration-300">
          <div class="mb-4">
            <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M3 7h18M3 12h18M3 17h18" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Branding & Identity</h3>
          <p class="text-gray-300">We craft your brand story through logo, design, and messaging consistency.</p>
        </div>
  
        <!-- QA & Testing -->
        <div class="bg-gradient-to-br from-[var(--color-primary)] to-gray-900 rounded-xl p-8 shadow-lg hover:scale-105 transition-transform duration-300">
          <div class="mb-4">
            <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path d="M9 12l2 2 4-4M5 6h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">QA & Testing</h3>
          <p class="text-gray-300">Comprehensive quality assurance to ensure bug-free and robust solutions.</p>
        </div>
      </div>
    </div>
  </section>
  

  <section class="bg-white py-20 px-6 md:px-12">
    <div class="max-w-6xl mx-auto">
      <!-- Heading -->
      <div class="text-center mb-16">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Life at WebNodez</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
          We’ve built a culture that empowers people to do the best work of their lives. Here’s what it’s like to be part of our journey.
        </p>
      </div>
  
      <!-- 3 Columns -->
      <div class="grid md:grid-cols-3 gap-10">
        <!-- Card 1 -->
        <div class="p-8 bg-gray-50 border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition duration-300 group">
          <div class="mb-4">
            <svg class="w-10 h-10 text-[var(--color-primary)] group-hover:scale-110 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M8 10h.01M12 14h.01M16 10h.01M21 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2M3 10h18M4 4h16v4H4z"/>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">Transparent Communication</h3>
          <p class="text-gray-600">We foster a culture where openness and trust build stronger teams. Every voice counts, always.</p>
        </div>
  
        <!-- Card 2 -->
        <div class="p-8 bg-gray-50 border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition duration-300 group">
          <div class="mb-4">
            <svg class="w-10 h-10 text-[var(--color-primary)] group-hover:scale-110 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M12 20h9M3 4v1a3 3 0 003 3h11a3 3 0 003-3V4M16 20l-4-4-4 4"/>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">People-First Culture</h3>
          <p class="text-gray-600">We value flexibility, creativity, and well-being, supporting our people both personally and professionally.</p>
        </div>
  
        <!-- Card 3 -->
        <div class="p-8 bg-gray-50 border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition duration-300 group">
          <div class="mb-4">
            <svg class="w-10 h-10 text-[var(--color-primary)] group-hover:scale-110 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M9 17v-6a3 3 0 116 0v6M4 10h16M12 21c4.418 0 8-1.79 8-4H4c0 2.21 3.582 4 8 4z"/>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900">Shared Success</h3>
          <p class="text-gray-600">We win together. Collaboration is in our DNA — with clients and teammates alike.</p>
        </div>
      </div>
  
      <!-- Final Call -->
      <div class="text-center mt-16">
        <p class="text-gray-500 text-base">We’re not just building software — we’re building a culture of impact, growth, and shared success.</p>
      </div>
    </div>
  </section>
  

@endsection