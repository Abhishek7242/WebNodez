   <section
       class="service-tech-section border-t bg-gradient-to-b from-gray-50 to-white py-12 sm:py-16 md:py-20 px-4 sm:px-6 md:px-12 lg:px-24">
       <div class="max-w-7xl mx-auto text-center">
           <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-4 tech-stack-heading">Tech Stack We Use</h2>
           <p class="text-gray-600 text-sm sm:text-base md:text-lg mb-8 sm:mb-12 md:mb-16 max-w-2xl mx-auto">
               From frontend to cloud, here are the tools we use to build scalable, performant digital products.
           </p>

           <!-- First Row: Frontend and Backend -->
           <div class="service-tech-containers grid gap-8 sm:gap-12 md:gap-16 md:grid-cols-2 mb-8 sm:mb-12 md:mb-16">
               <!-- Frontend -->
               <div
                   class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 md:p-8 transform hover:scale-[1.02] transition-all duration-300">
                   <h3
                       class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 md:mb-8 border-b pb-3 sm:pb-4 tech-category-heading">
                       {{ $technology['names'][0] }}</h3>
                   <x-technologies :items="$technology['frontendTechnologies']" />
               </div>

               <!-- Backend -->
               <div
                   class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 md:p-8 transform hover:scale-[1.02] transition-all duration-300">
                   <h3
                       class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 md:mb-8 border-b pb-3 sm:pb-4 tech-category-heading">
                       {{ $technology['names'][1] }}</h3>
                   <x-technologies :items="$technology['backendTechnologies']" />
               </div>
           </div>

           <!-- Second Row: Cloud/Hosting and Design Tools -->
           <div class="service-tech-containers grid gap-8 sm:gap-12 md:gap-16 md:grid-cols-2">
               <!-- Cloud & Hosting -->
               <div
                   class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 md:p-8 transform hover:scale-[1.02] transition-all duration-300">
                   <h3
                       class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 md:mb-8 border-b pb-3 sm:pb-4 tech-category-heading">
                       {{ $technology['names'][2] }}</h3>
                   <x-technologies :items="$technology['cloudTechnologies']" />
               </div>

               <!-- Design Tools -->
               <div
                   class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-6 md:p-8 transform hover:scale-[1.02] transition-all duration-300">
                   <h3
                       class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 md:mb-8 border-b pb-3 sm:pb-4 tech-category-heading">
                       {{ $technology['names'][3] }}</h3>
                   <x-technologies :items="$technology['designTechnologies']" />
               </div>
           </div>
       </div>
   </section>
