
<div class="our-services-content-item {{ $service['active'] ? 'active' : '' }}" id="{{ $service['id'] }}">
    <div class="our-services-content-wrapper bg-white rounded-2xl p-8 shadow-sm">
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="our-services-content-title text-2xl font-bold mb-4">{{ $service['title'] }}</h3>
                <p class="our-services-content-description text-gray-600 mb-6">
                    {{ $service['description'] }}
                </p>
                <div class="our-services-features space-y-4 mb-6">
                    @foreach ($service['features'] as $feature)
                        <div class="our-services-feature flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span>{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>
                <a href="{{ $service['link'] }}" class="our-services-learn-more">
                    Learn More
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="our-services-image">
                <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}" class="rounded-lg shadow-md">
            </div>
        </div>
    </div>
</div>
