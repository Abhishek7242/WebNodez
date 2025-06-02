@extends('frontend/layouts/main')
@section('title', 'WebNodez - Terms & Conditions')
@section('main-section')
    <link href="{{ asset('css/terms_conditions.css') }}" rel="stylesheet">

<script>
    const el = document.querySelector('#header');
el.style.setProperty('--intro-bg', `url('https://w0.peakpx.com/wallpaper/251/431/HD-wallpaper-black-with-green-background-technology-other-entertainment-people.jpg')`);

 </script>
    <section class="max-w-4xl mx-auto text-center py-12 px-6">
        <h1 class="text-5xl font-extrabold text-white mb-4 tracking-tight">
          Terms and Conditions
        </h1>
        <p class="text-lg text-gray-300 max-w-3xl mx-auto">
          Please read these Terms and Conditions carefully before using our website and services. They outline your rights, responsibilities, and obligations when accessing or using our platform.
        </p>
      </section>
      
    </header>
    <section class="bg-gray-50 py-16 px-6 max-w-6xl mx-auto font-sans text-gray-800">
       
      
        <div class="flex flex-col lg:flex-row lg:space-x-12">
          <!-- Side Navigation -->
          <nav class=" terms-nav hidden lg:block sticky top-20 self-start w-48 text-gray-600">
            <ul class="space-y-4 text-sm font-medium">
              <li><a href="#introduction" class="">1. Introduction</a></li>
              <li><a href="#use-of-services" class="">2. Use of Services</a></li>
              <li><a href="#intellectual-property" class="">3. Intellectual Property</a></li>
              <li><a href="#user-accounts" class="">4. User Accounts</a></li>
              <li><a href="#payments-refunds" class="">5. Payments and Refunds</a></li>
              <li><a href="#limitation-liability" class="">6. Limitation of Liability</a></li>
              <li><a href="#privacy" class="">7. Privacy</a></li>
              <li><a href="#termination" class="">8. Termination</a></li>
              <li><a href="#changes-terms" class="">9. Changes to Terms</a></li>
              <li><a href="#governing-law" class="">10. Governing Law</a></li>
              <li><a href="#contact-us" class="">11. Contact Us</a></li>
            </ul>
          </nav>
      
          <!-- Content -->
          <div class="flex-1 space-y-12">
            <article id="introduction" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">1. Introduction</h3>
              <p class="text-lg leading-relaxed">Welcome to our website. By accessing or using our services, you agree to comply with and be bound by these Terms and Conditions. Please read them carefully to understand your rights and responsibilities.</p>
            </article>
      
            <article id="use-of-services" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">2. Use of Services</h3>
              <p class="text-lg leading-relaxed">You agree to use our services only for lawful purposes and in a way that does not infringe on the rights of others or restrict or inhibit their use and enjoyment of the services. Misuse of services will result in suspension or termination.</p>
            </article>
      
            <article id="intellectual-property" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">3. Intellectual Property</h3>
              <p class="text-lg leading-relaxed">All content, trademarks, logos, and intellectual property displayed on this site are the property of their respective owners. You may not use, reproduce, or distribute any content without prior written consent.</p>
            </article>
      
            <article id="user-accounts" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">4. User Accounts</h3>
              <p class="text-lg leading-relaxed">If you create an account, you agree to provide accurate information and maintain the security of your login credentials. You are responsible for all activities under your account and should notify us immediately if you suspect any unauthorized use.</p>
            </article>
      
            <article id="payments-refunds" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">5. Payments and Refunds</h3>
              <p class="text-lg leading-relaxed">Payments for services or products must be made in full and on time. Refund policies are clearly described on our Refund Policy page. Please review them before making a purchase to avoid any confusion.</p>
            </article>
      
            <article id="limitation-liability" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">6. Limitation of Liability</h3>
              <p class="text-lg leading-relaxed">We provide our services “as is” without warranties of any kind. We are not liable for any damages arising from your use of the services, including indirect or consequential losses, to the fullest extent permitted by law.</p>
            </article>
      
            <article id="privacy" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">7. Privacy</h3>
              <p class="text-lg leading-relaxed">Your privacy is very important to us. Please refer to our <a href="/privacy-policy" class="text-blue-600 underline hover:text-blue-800">Privacy Policy</a> to understand how we collect, use, and protect your personal information.</p>
            </article>
      
            <article id="termination" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">8. Termination</h3>
              <p class="text-lg leading-relaxed">We reserve the right to suspend or terminate your access to the services if you violate these Terms and Conditions or engage in unlawful or harmful conduct.</p>
            </article>
      
            <article id="changes-terms" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">9. Changes to Terms</h3>
              <p class="text-lg leading-relaxed">We may update these Terms and Conditions periodically. Continued use of our services after changes means you accept the updated terms. Please review this page regularly.</p>
            </article>
      
            <article id="governing-law" class="border-b border-gray-300 pb-6">
              <h3 class="text-3xl font-semibold mb-3">10. Governing Law</h3>
              <p class="text-lg leading-relaxed">These Terms and Conditions are governed by the laws of <strong>[Your Country/State]</strong>. Any disputes will be resolved in the courts located within this jurisdiction.</p>
            </article>
      
            <article id="contact-us" class="pb-6">
              <h3 class="text-3xl font-semibold mb-3">11. Contact Us</h3>
              <p class="text-lg leading-relaxed">If you have any questions or concerns about these Terms, please contact us at <a href="mailto:support@example.com" class="text-blue-600 underline hover:text-blue-800">support@example.com</a>. We're here to help!</p>
            </article>
          </div>
        </div>
      </section>
      

@endsection