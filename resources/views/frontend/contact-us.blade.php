@extends('frontend/layouts/main')
@section('title', 'WebNodez - Contact Us')
@section('contact', 'active')
@section('main-section')
 <script>
  
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', '#FBFBFC');
        
    </script>
    <style>
      .dark-mode .contact-us-section{
        background: var(--dark-bg);
        color: white;
      }
     
    </style>
 
 <section class="contact-us-section relative  text-black py-24 px-6 md:px-16 lg:px-32 overflow-hidden">
    <div class="max-w-4xl mx-auto text-center z-10 relative">
      <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight ">
        Get in Touch with <span class="text-[--color-primary]">WebNodez Team</span>
      </h1>
      <p class="text-lg md:text-xl text-gray-500 mb-10">
        Let’s build something amazing together. Whether it’s a question, project idea, or just a hello — we’d love to hear from you.
      </p>
    
    </div>
  
    <!-- Background Shape / Decoration -->
    <div class="absolute top-0 right-0 w-80 h-80 bg-[--color-secondary] rounded-full opacity-20 blur-3xl animate-pulse-slow z-0"></div>
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
    <section class="contact-us-team-section bg-gray-50 py-20 px-6 md:px-20 max-w-7xl mx-auto">
      <div class="text-center max-w-4xl mx-auto mb-16">
        <h2 class="text-5xl font-bold text-gray-900 mb-4">Connect With Our Team</h2>
        <p class="text-gray-600 text-lg max-w-xl mx-auto leading-relaxed">
          We’re here to help! Reach out with questions, feedback, or anything else — and experience our quick, personalized support.
        </p>
      </div>
    
      <div class="contact-us-team-info-container grid md:grid-cols-3 gap-10">
    
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-2xl font-bold mb-4 text-green-600 border-l-4 border-green-400 pl-4">Our Team</h3>
          <p class="text-gray-700 mb-6 leading-relaxed">
            Meet the friendly experts dedicated to delivering fast, human-centered support. No bots, just real people who care.
          </p>
          <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Available Mon–Fri, 9am–6pm</li>
            <li>Multilingual & globally accessible</li>
            <li>Always up-to-date training</li>
          </ul>
        </div>
    
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-2xl font-bold mb-4 text-green-600 border-l-4 border-blue-400 pl-4">Our Services</h3>
          <p class="text-gray-700 mb-6 leading-relaxed">
            Multiple ways to connect, whichever suits you best.
          </p>
          <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Phone support with specialists</li>
            <li>24/7 email replies within 24 hours</li>
            <li>Live chat during business hours</li>
            <li>Dedicated account managers</li>
          </ul>
        </div>
    
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-2xl font-bold mb-4 text-green-600 border-l-4 border-purple-400 pl-4">Feedback & Response</h3>
          <p class="text-gray-700 mb-6 leading-relaxed">
            Your feedback shapes us. Here’s how we keep improving:
          </p>
          <ul class="list-disc list-inside text-gray-600 space-y-2">
            <li>Listening carefully to every suggestion</li>
            <li>Customer satisfaction surveys after support</li>
            <li>Feature updates based on your needs</li>
            <li>Clear and timely communication</li>
          </ul>
          <p class="mt-6 italic text-gray-500 text-sm">
            "Your voice matters — help us serve you better."
          </p>
        </div>
    
      </div>
    </section>
    


@endsection