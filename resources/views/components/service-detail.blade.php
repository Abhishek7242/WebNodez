<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-4">
      

        <div class="relative border-l-4 border-[var(--color-primary)] pl-12 space-y-10">
            @foreach ($detailsArray as $index => $step)
                <div class="relative">
                    <div
                        class="absolute top-0 w-10 h-10 rounded-full bg-[var(--color-primary)] text-white flex items-center justify-center font-bold shadow-lg"
                        style="left: -71px;">
                        {{ $index + 1 }}
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $step['title'] }}</h3>
                    <p class="text-gray-600 mt-2">
                        {{ $step['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>