@extends('frontend/layouts/main')
@section('title', 'WebNodez - Privacy Policy')
@section('', 'active')
@section('main-section')
<script>
    const el = document.querySelector('#header');
el.style.setProperty('--intro-bg', `url('https://w0.peakpx.com/wallpaper/251/431/HD-wallpaper-black-with-green-background-technology-other-entertainment-people.jpg')`);

 </script>
 <section class=" py-16 px-6">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Privacy Policy</h1>
      <p class="text-lg text-gray-300 leading-relaxed max-w-2xl mx-auto">
        Your privacy matters to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website or use our services. Please take a moment to review it carefully.
      </p>
    </div>
  </section>
  
    
    </header>
    @php
    $privacySections = [
        [
            'id' => 'information-we-collect',
            'title' => 'Information We Collect',
            'description' => 'We collect personal information that you voluntarily provide to us when registering, expressing interest in our services, or contacting us. This may include your name, email address, phone number, and any other information you choose to provide.',
        ],
        [
            'id' => 'how-we-use',
            'title' => 'How We Use Your Information',
            'description' => 'We use your information to provide and improve our services, communicate with you, offer customer support, and comply with legal obligations. We do not sell or share your data with third parties for marketing purposes.',
        ],
        [
            'id' => 'cookies-tracking',
            'title' => 'Cookies and Tracking',
            'description' => 'Our site may use cookies and similar tracking technologies to enhance user experience and analyze website traffic. You can control cookie settings through your browser preferences.',
        ],
        [
            'id' => 'data-retention',
            'title' => 'Data Retention',
            'description' => 'We retain your information for as long as necessary to fulfill the purposes outlined in this policy, unless a longer retention period is required or permitted by law.',
        ],
        [
            'id' => 'security',
            'title' => 'Security of Your Information',
            'description' => 'We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, loss, or alteration. However, no system is 100% secure, and we cannot guarantee absolute security.',
        ],
        [
            'id' => 'your-rights',
            'title' => 'Your Privacy Rights',
            'description' => 'Depending on your location, you may have the right to access, correct, delete, or restrict the use of your personal information. To exercise these rights, please contact us at the email provided below.',
        ],
        [
            'id' => 'contact-us',
            'title' => 'Contact Us',
            'description' => 'If you have any questions or concerns about this Privacy Policy, please contact us at <a href="mailto:privacy@example.com" class="text-blue-600 underline">privacy@example.com</a>.',
        ],
    ];
    @endphp
    
    <section class="bg-white py-16 px-6 max-w-5xl mx-auto">
      
    
      <div class="space-y-10 text-gray-700 leading-relaxed">
        @foreach($privacySections as $index => $section)
          <div id="{{ $section['id'] }}">
            <h3 class="text-2xl font-semibold mb-3">{{ $index + 1 }}. {{ $section['title'] }}</h3>
            <p>{!! $section['description'] !!}</p>
          </div>
        @endforeach
      </div>
    </section>
    
@endsection