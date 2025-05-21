<div class="grid grid-cols-3 gap-4">
    @foreach ($items as $item)
        <div
            class="bg-gray-50 rounded-xl p-4 flex flex-col items-center hover:bg-white hover:shadow-md transition-all tech-card">
            <img src="{{ $item['icon'] }}" alt="{{ $item['name'] }}"
                class="w-12 h-12 mb-3 transform hover:scale-110 transition-transform">
            <span class="font-medium text-sm tech-name">{{ $item['name'] }}</span>
        </div>
    @endforeach
</div>
