@php
  $processSection = [
    
          [
              'title' => 'Discovery & Research',
              'description' => 'We begin by understanding your business, users, and goals — building a strong foundation through market research and stakeholder interviews.',
          ],
          [
              'title' => 'UI/UX Design',
              'description' => 'Our designers craft intuitive interfaces and seamless user journeys that reflect your brand and delight your users.',
          ],
          [
              'title' => 'Prototyping',
              'description' => 'Interactive prototypes bring your product to life early — allowing for real-time feedback and iterative refinement before development.',
          ],
          [
              'title' => 'Development',
              'description' => 'Our engineers build fast, scalable, and secure applications — using the latest frameworks and agile methodologies.',
          ],
          [
              'title' => 'Quality Assurance',
              'description' => 'Rigorous testing ensures flawless functionality across devices, browsers, and user scenarios before launch.',
          ],
          [
              'title' => 'Launch & Scale',
              'description' => 'We deploy your product smoothly and offer ongoing support, updates, and growth optimization strategies.',
          ],
  ];
@endphp

<section id="our-process" class="border-t bg-white py-24 px-6 sm:px-12 lg:px-24">
  <div class="max-w-5xl mx-auto text-center">
    <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">Our Process - <span class="text-gray-700">How we work</span></h2>
    <p class="text-gray-500 text-lg sm:text-xl mb-20">A full-cycle approach — from strategy to scale — for world-class digital products.</p>
  </div>

  <div class="max-w-5xl mx-auto relative">
    <div class="absolute left-6 top-0 h-full border-l-4 border-[var(--color-primary)]"></div>

    <div class="space-y-16 pl-16 sm:pl-20 relative z-10">
      @php
      $number = 1;
    @endphp
    
    @foreach ($processSection as $step)
      <x-process-step
        :number="$number"
        :title="$step['title']"
        :description="$step['description']"
      />
      
      @php
        $number++;
      @endphp
    @endforeach
    
    </div>
  </div>
</section>
