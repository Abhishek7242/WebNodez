<div class="blog-container">
    <div class="blog-category-tag">{{ $category }}</div>
    <div class="blog-image-wrapper">
        <img loading="lazy" src="{{ asset($image) }}" alt="{{ $title }}" />
        <div class="blog-overlay"></div>
        {{-- <div class="card-loading-indicator">
            <div class="card-loading-text">Loading...</div>
        </div> --}}
    </div>
    <div class="blog-content">
        <h2>{{ $title }}</h2>
        <a href="{{ $link }}" class="blog-card-read-more-btn">
            <span>Read More</span>
            <span class="arrow">→</span>
        </a>
    </div>
</div>


{{-- <div class="blog-container">
    <div class="blog-category-tag">{{ $category }}</div>
    <div class="blog-image-wrapper">
  <img loading="lazy" src="{{ asset('storage/app/public/blog-images/' . basename($image)) }}" alt="{{ $title }}">

        <div class="blog-overlay"></div>
    </div>
    <div class="blog-content">
        <h2>{{ $title }}</h2>
        <a href="{{ $link }}" class="blog-card-read-more-btn">
            <span>Read More</span>
            <span class="arrow">→</span>
        </a>
    </div>
</div> --}}
