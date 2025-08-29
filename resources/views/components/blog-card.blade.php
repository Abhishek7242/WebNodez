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
  <script>
    
        // Handle hero image loading
        document.addEventListener('DOMContentLoaded', function() {
   
            const loadingIndicator = document.querySelector('.loading-indicator');

     

            // Handle blog card image loading
            const blogCardImages = document.querySelectorAll('.blog-container img');
            blogCardImages.forEach(function(img) {
                const imageWrapper = img.closest('.blog-image-wrapper');
                const loadingIndicator = imageWrapper.querySelector('.card-loading-indicator');

                if (img.complete) {
                    img.classList.add('loaded');
                    imageWrapper.classList.add('loaded');
                    if (loadingIndicator) {
                        loadingIndicator.style.display = 'none';
                    }
                } else {
                    img.addEventListener('load', function() {
                        this.classList.add('loaded');
                        imageWrapper.classList.add('loaded');
                        if (loadingIndicator) {
                            loadingIndicator.style.opacity = '0';
                            setTimeout(() => {
                                loadingIndicator.style.display = 'none';
                            }, 300);
                        }
                    });
                    img.addEventListener('error', function() {
                        // Fchallback for failed image load
                        this.style.display = 'none';
                        if (loadingIndicator) {
                            loadingIndicator.innerHTML =
                                '<div class="card-loading-text">Image unavailable</div>';
                        }
                    });
                }
            });
        });
    </script>