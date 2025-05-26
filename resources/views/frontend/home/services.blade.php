{{-- @php
$services = [
    [
        'title' => 'Web Development',
        'description' => '   Transforming ideas into modern web realities.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 18l6-6-6-6M8 6l-6 6 6 6" />
        </svg>',
        'link' => '/services/web-development',
    ],
    [
        'title' => 'App Design & Development',
        'description' => 'Custom mobile apps that are fast, beautiful, and user-friendly across platforms.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 18h.01M8 6h8M8 10h8m-4 8h.01M6 6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2H6z" />
        </svg>',
        'link' => '/services/app-design&development',
    ],
    [
        'title' => 'UI/UX Design',
        'description' => 'Human-first design with clean, modern interfaces for an effortless user experience.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h16M4 18h16M4 12h8" />
        </svg>',
        'link' => '/services/ui-ux-design',
    ],
    [
        'title' => 'E-Commerce Solutions',
        'description' => 'Secure and scalable online stores designed to convert and grow your brand.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007 17h10a1 1 0 00.95-.68L20 13M7 13V6H5" />
        </svg>',
        'link' => '/services/e_commerce-solutions',
    ],
    [
        'title' => 'Testing',
        'description' => 'End-to-end quality assurance to ensure smooth performance, security, and user satisfaction across all platforms.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M9 12h6m-6 4h3m-3-8h6M4 6h16a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
        </svg>',
        'link' => '/services/testing',
    ],
    [
        'title' => 'Maintenance & Support',
        'description' => 'Ongoing updates, monitoring, and fixes to keep your site or app running flawlessly.',
        'icon' => '<svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M12 6v6l4 2M6 18h12M6 6h12a2 2 0 012 2v8a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2z" />
        </svg>',
        'link' => '/services/maintenance&support',
    ],
];
@endphp --}}
@php
$services = [
    [
        'title' => 'Web Development',
        'description' => '   Transforming ideas into modern web realities.',
       
        'link' => '/services/web-development',
        'img1'=>'https://amazing7.com/images/blog_pages-cover.jpg',
        'img2'=>'https://digitalnotebook.in/up/2023/06/Website-design.jpg',
    ],
    [
        'title' => 'App Development',
        'description' => 'Smart, sleek apps for every platform.',
          'img1'=>'https://i0.wp.com/procreator.design/blog/wp-content/uploads/2024/12/Neumorphism-2.0.png?resize=1024%2C682&ssl=1',
        'img2'=>'https://img.freepik.com/free-vector/fashion-shopping-app-interface_23-2148655476.jpg?semt=ais_hybrid&w=740',
        'link' => '/services/app-design&development',
    ],
    [
        'title' => 'UI/UX Design',
        'description' => 'Intuitive, modern design for effortless UX.',
           'img1'=>'https://miro.medium.com/v2/resize:fit:800/1*SiM1_ovtlvvQfLdR3mofGw.jpeg',
        'img2'=>'https://cdn.dribbble.com/userupload/28378009/file/original-9cd2c6319038dd9f63e095ab2abac12e.jpg?format=webp&resize=400x300&vertical=center',
        'link' => '/services/ui-ux-design',
    ],
    [
        'title' => 'E-Commerce Solutions',
        'description' => 'Online stores designed to grow your brand.',
           'img1'=>'https://www.intellectoutsource.com/blog/images/how-attractive-templates-are-helpful-for-ecommerce-business.jpg',
        'img2'=>'https://5.imimg.com/data5/SELLER/Default/2023/5/312281422/DM/CL/ZE/190312336/ecommerce-website.png',
        'link' => '/services/e_commerce-solutions',
    ],
    // [
    //     'title' => 'Testing',
    //     'description' => 'Quality assurance that drives reliability and trust.',
    //       'img1'=>'https://amazing7.com/images/blog_pages-cover.jpg',
    //     'img2'=>'https://digitalnotebook.in/up/2023/06/Website-design.jpg',
    //     'link' => '/services/testing',
    // ],
    // [
    //     'title' => 'Maintenance & Support',
    //     'description' => 'Maintenance that keeps your digital presence flawless.',
    //        'img1'=>'https://amazing7.com/images/blog_pages-cover.jpg',
    //     'img2'=>'https://digitalnotebook.in/up/2023/06/Website-design.jpg',
    //     'link' => '/services/maintenance&support',
    // ],
];
@endphp

<section class="border-tbg-gray-50 py-20 px-6 md:px-12 lg:px-24">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Services - <span class="text-gray-700" >What We Do Best</span></h2>
    <p class="text-gray-400 text-lg mb-16  mx-auto">
      From stunning web designs to high-performing apps, we build digital products your users will love.
    </p>

    <div class="flex flex-col gap-16">
    {{-- <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3"> --}}
      
      <!-- Card Template -->
      
      @foreach ($services as $service)
      <x-services
      :title="$service['title']"
      :description="$service['description']"
      :link="$service['link']"
      :img1="$service['img1']"
      :img2="$service['img2']"
  />
  
  @endforeach
  
      

    </div>
  </div>
</section>
