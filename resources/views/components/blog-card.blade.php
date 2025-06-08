<div class="blog-container">
    <div class="blog-category-tag">{{ $category }}</div>
    <div class="blog-image-wrapper">
        <img src="{{ $image }}" alt="{{ $title }}" />
        <div class="blog-overlay"></div>
    </div>
    <div class="blog-content">
        <h2>{{ $title }}</h2>
        <a href="{{ $link }}" class="blog-card-read-more-btn">
            <span>Read More</span>
            <span class="arrow">→</span>
        </a>
    </div>
</div>
