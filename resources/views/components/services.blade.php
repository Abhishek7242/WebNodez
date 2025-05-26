<a href="{{$link}}" class="service-container bg-black flex items-center relative justify-center rounded-full">

  <!-- Left Image Container -->
  <div class="overflow-hidden flex-1 h-full rounded-l-full">
    <img src="{{$img1}}" alt="Left"
         class="h-full object-cover w-full transition-transform duration-400 ease-in-out" />
  </div>

  <!-- Center border div: thin vertical border in center -->

  <!-- Right Image Container -->
  <div class="overflow-hidden flex-1 h-full rounded-r-full">
    <img src="{{$img2}}" alt="Right"
         class="h-full object-cover w-full transition-transform duration-400 ease-in-out" />
  </div>

  <!-- Centered Circle absolutely positioned on border -->
  <div class="service-text absolute  h-40 rounded-full flex items-center justify-center p-4 left-1/2 top-1/2 
              transform -translate-x-1/2 -translate-y-1/2 z-10">
              <div class="text-center px-4">
                  <h2 class="text-white text-4xl md:text-3xl font-bold mb-2 drop-shadow-md">
                    {{$title}}
                  </h2>
                  <p class="text-gray-100 text-base md:text-lg font-medium drop-shadow-sm">
                   {{$description}}
                  </p>
                </div>
                
  </div>

</a>
