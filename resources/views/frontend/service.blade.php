@extends('frontend/layouts/main')
@section('title', 'Services - ' . $service)

@section('services', 'active')
@section('main-section')
    <script>
        document.documentElement.style.setProperty('--text-color', 'black');
        document.documentElement.style.setProperty('--intro-bg', 'linear-gradient(135deg, #f0fff4, #ffffff)');
    </script>
    {{-- <section class="relative py-20 px-6 md:px-16">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">{{$service}}</h1>
      <p class="text-lg md:text-xl text-gray-300 leading-relaxed">
       {{ $details['description']}}
      </p>
    </div>
  </section> --}}

    <style>
        .service {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4rem 6%;
            min-height: 100vh;
            background: url('background-pattern.png') no-repeat center/cover;
        }
       

        .our-service-text {
            max-width: 50%;
        }

        .our-service-text small {
            font-size: 0.9rem;
            color: var(--text-color);
            display: block;
            margin-bottom: 1rem;
        }
        .dark-mode .our-service-text small{
            color: var(--color-primary);
        }

        .our-service-text h1 {
            color: var(--text-color);
            font-size: 3rem;
            font-weight: bold;
            line-height: 1.2;
        }
         .dark-mode .our-service-text h1{
            color: var(--dark-top-heading);
        }

        .our-service-desc-text {
            color: var(--color-text-light);
            font-weight: 100;
        }

        .our-service-text button {
            margin-top: 2rem;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--color-primary) 0%, #22C55E 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .our-service-text button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .our-service-text button:active {
            transform: translateY(0);
        }

        .our-service-text button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            transition: 0.5s;
        }

        .our-service-text button:hover::before {
            left: 100%;
        }

        .our-service-text button::after {
            content: '→';
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .our-service-text button:hover::after {
            transform: translateX(5px);
        }

        .triangles {
            position: relative;
            width: 320px;
            height: 500px;
        }

        .triangle {
            position: absolute;
            width: 160px;
            height: 140px;
            background-size: cover;
            background-position: center;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        }

        .triangle:nth-child(1) {
            clip-path: polygon(0% 0%, 100% 0%, 50% 100%);
            height: 200px;
            width: 237px;
            top: 51px;
            left: -86px;
        }


        .triangle:nth-child(2) {
            top: 128px;
            left: -254px;
            height: 300px;
            width: 353px;
        }

        .triangle:nth-child(3) {
            top: 124px;
            left: 60px;
        }

        .triangle:nth-child(4) {
            top: 296px;
            left: 62px;
            clip-path: polygon(0% 0%, 100% 0%, 50% 100%);
        }

        /* Stats Section Styles */
        .stats-container {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin: 4rem 0;
            padding: 0 1rem;
        }

        .stat-card {
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(34, 197, 94, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            min-width: 250px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(34, 197, 94, 0.3);
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #22C55E, var(--color-primary));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #f8fafc 0%, #22C55E 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(34, 197, 94, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            color: #22C55E;
            transition: all 0.4s ease;
        }

        .stat-card:hover .stat-icon {
            background: linear-gradient(135deg, #22C55E, var(--color-primary));
            color: white;
            transform: rotateY(180deg);
        }

        @media (max-width: 768px) {
            .stats-container {
                flex-direction: column;
                gap: 2rem;
                margin: 3rem 0;
            }

            .stat-card {
                min-width: auto;
                padding: 2rem;
            }

            .stat-number {
                font-size: 3rem;
            }
        }

        /* Why Web Development is Solution Section Styles */
        .why-solution-section {
            padding: 6rem 6%;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            position: relative;
            overflow: hidden;
        }

        .why-solution-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(34, 197, 94, 0.3),
                    transparent);
        }

        .why-solution-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .why-solution-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .why-solution-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: rgba(34, 197, 94, 0.1);
            color: #22C55E;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .why-solution-title {
            font-size: 3rem;
            font-weight: 800;
            color: #f8fafc;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(135deg, #f8fafc 0%, #22C55E 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .why-solution-subtitle {
            color: #94a3b8;
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .why-solution-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .why-solution-card {
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(34, 197, 94, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .why-solution-card:hover {
            transform: translateY(-5px);
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(34, 197, 94, 0.3);
            box-shadow: 0 0 30px rgba(34, 197, 94, 0.1);
        }

        .why-solution-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #22C55E, var(--color-primary));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .why-solution-card:hover::before {
            opacity: 1;
        }

        .why-solution-icon {
            width: 60px;
            height: 60px;
            background: rgba(34, 197, 94, 0.1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
        }

        .why-solution-card:hover .why-solution-icon {
            background: linear-gradient(135deg, #22C55E, var(--color-primary));
            transform: rotateY(180deg);
        }

        .why-solution-card-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #f8fafc;
            margin-bottom: 1rem;
        }

        .why-solution-card-text {
            color: #94a3b8;
            line-height: 1.7;
            font-size: 1.1rem;
        }

        @media (max-width: 1024px) {
            .why-solution-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .why-solution-section {
                padding: 4rem 4%;
            }

            .why-solution-grid {
                grid-template-columns: 1fr;
            }

            .why-solution-title {
                font-size: 2.5rem;
            }

            .why-solution-subtitle {
                font-size: 1.1rem;
                padding: 0 1rem;
            }

            .why-solution-card {
                padding: 2rem;
            }
        }
    </style>

    <section class="service">
        <div class="our-service-text">
            <small class="text-[var(--color-primary)] font-medium tracking-wide">Innovating Digital Solutions for
                Tomorrow's Success</small>
            <h1>
                {{ $service }}
                <div class="our-service-desc-text">
                    {{ $details['description'] }}
                </div>
            </h1>
            <button>Get Started</button>
        </div>

        <div class="triangles">
            <div class="triangle" style="background-image: url('{{ $introImages[0] }}');">
            </div>
            <div class="triangle" style="background-image: url('{{ $introImages[1] }}');">
            </div>
            <div class="triangle" style="background-image: url('{{ $introImages[2] }}');">
            </div>
            <div class="triangle" style="background-image: url('{{ $introImages[3] }}');">
            </div>
        </div>
    </section>


    </header>
    {{-- service overview --}}
    <section class="service-overview">
        <div class="service-overview-container">
            <div class="service-overview-content">
                <h2 class="service-overview-title"> {{ $overview['heading'] }} </h2>
                <p class="service-overview-description">
                    {{ $overview['description'] }}
                </p>
            </div>
            <div class="service-overview-image">
                <img src="{{ $overview['image'] }}" alt="Web Development Solution" class="overview-img">
                <div class="image-overlay"></div>
            </div>
        </div>
    </section>

    <style>
        .service-overview {
            padding: 6rem 6%;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            position: relative;
            overflow: hidden;
        }
        .dark-mode .service-overview {
            background: var(--dark-bg);
          
        }

        .service-overview-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .service-overview-content {
            position: relative;
            z-index: 2;
        }

        .service-overview-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
       .dark-mode .service-overview-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(135deg, #c9ccd3 0%, #334155 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .service-overview-description {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #475569;
        }

        .service-overview-image {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .overview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(15, 23, 42, 0.2) 100%);
        }

        .service-overview-image:hover .overview-img {
            transform: scale(1.05);
        }

        @media (max-width: 1024px) {
            .service-overview-container {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .service-overview-image {
                order: -1;
                max-height: 400px;
            }

            .service-overview-title {
                font-size: 2.4rem;
            }
        }

        @media (max-width: 768px) {
            .service-overview {
                padding: 4rem 4%;
            }

            .service-overview-title {
                font-size: 2rem;
            }

            .service-overview-description {
                font-size: 1rem;
            }
        }
    </style>
    {{-- Why web dev is solution  --}}

    <x-service-detail :serviceHeading="$service" :detailsArray='$detailsArray' />

    {{-- Tech we use section --}}
<style>
    .dark-mode .service-tech-section{
        background: var(--dark-bg);
    }
    .dark-mode .service-tech-section h2{
      color: var(--dark-top-heading);
    }
    .dark-mode .service-tech-containers > div{
          background: none;
          border: 1px solid gray;
    }
    .dark-mode .service-tech-containers > div h3{
          color: var(--dark-top-heading);
    }
</style>

    <section class="service-tech-section border-t bg-gradient-to-b from-gray-50 to-white py-20 px-6 md:px-12 lg:px-24">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-4 tech-stack-heading">Tech Stack We Use</h2>
            <p class="text-gray-600 text-lg mb-16 max-w-2xl mx-auto">
                From frontend to cloud, here are the tools we use to build scalable, performant digital products.
            </p>

            <!-- First Row: Frontend and Backend -->
            <div class="service-tech-containers grid gap-16 md:grid-cols-2 mb-16">
                <!-- Frontend -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transform hover:scale-[1.02] transition-all duration-300">
                    
                    <h3 class="text-2xl font-bold mb-8 border-b pb-4 tech-category-heading">{{$technology['names'][0]}}</h3>
                    <x-technologies :items="$technology['frontendTechnologies']" />
                </div>

                <!-- Backend -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transform hover:scale-[1.02] transition-all duration-300">
                    <h3 class="text-2xl font-bold mb-8 border-b pb-4 tech-category-heading">{{$technology['names'][1]}}</h3>
                    <x-technologies :items="$technology['backendTechnologies']" />
                </div>
            </div>

            <!-- Second Row: Cloud/Hosting and Design Tools -->
            <div class="service-tech-containers grid gap-16 md:grid-cols-2">
                <!-- Cloud & Hosting -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transform hover:scale-[1.02] transition-all duration-300">
                    <h3 class="text-2xl font-bold mb-8 border-b pb-4 tech-category-heading">{{$technology['names'][2]}}</h3>
                    <x-technologies :items="$technology['cloudTechnologies']" />
                </div>

                <!-- Design Tools -->
                <div class="bg-white rounded-2xl shadow-lg p-8 transform hover:scale-[1.02] transition-all duration-300">
                    <h3 class="text-2xl font-bold mb-8 border-b pb-4 tech-category-heading">{{$technology['names'][3]}}</h3>
                    <x-technologies :items="$technology['designTechnologies']" />
                </div>
            </div>
        </div>
    </section>




    {{-- Tech we use section --}}
    <x-why-choose-us :projectNumber='$projectNumber' :clientSatis="$clientSatis" />

    @include('frontend/services/contact-page')

    <x-faq :faqs='$faqsArray' />


    {{-- <section class="bg-gray-50 py-20 px-6 md:px-12">
        <div class="max-w-4xl mx-auto text-center">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">Ready to Start Your Project?</h2>
          <p class="text-lg text-gray-600 mb-8">
            Whether you're launching a new app, redesigning your website, or need help bringing your product to life — we're here to help. Let's build something great together.
          </p>
          <a href="/contact-us" class="inline-block bg-[var(--color-primary)] hover:bg-[var(--color-secondary)] text-white text-lg font-semibold py-3 px-8 rounded-full transition duration-300">
            Contact Us
          </a>
        </div>
      </section> --}}



@endsection
