
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

<section class="our-service-container  py-20 px-6 md:px-12 lg:px-24 ">
  <div class="max-w-7xl mx-auto text-center">
    <h2 class="our-service-heading-text text-4xl font-bold text-gray-900 mb-4">Our Services - <span class="text-gray-700" >What We Do Best</span></h2>
    <p class="our-service-desc-text text-gray-400 text-lg mb-16  mx-auto">
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
