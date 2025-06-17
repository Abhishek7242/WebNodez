@php
    use App\Models\DesignGallery;
    use Illuminate\Support\Facades\Cache;

    $designs = Cache::remember('design_gallery_featured', 60 * 60 * 24, function () {
        return DesignGallery::where('is_featured', true)->orderBy('order', 'asc')->get();
    });

    $totalDesigns = $designs->count();
@endphp

<section id="design-gallery" class="design-gallery-section">
    <div class="design-gallery-container">
        <div class="design-gallery-header">
            <span class="design-gallery-subtitle">Our Portfolio</span>
            <h2 class="design-gallery-title">Design Gallery</h2>
            <p class="design-gallery-description">Explore our latest design projects and creative solutions</p>
        </div>

        <div class="design-gallery-filter">
            <button class="design-gallery-filter-btn active" data-filter="all">All</button>
            <button class="design-gallery-filter-btn" data-filter="web_dev">Web Development</button>
            <button class="design-gallery-filter-btn" data-filter="app_dev">App Development</button>
            <button class="design-gallery-filter-btn" data-filter="ui_ux">UI/UX Design</button>
        </div>

        <div class="design-gallery-grid">
            @foreach ($designs as $index => $design)
                <div class="design-gallery-item {{ $index >= 6 ? 'design-gallery-hidden' : '' }}"
                    data-category="{{ $design->category }}">
                    <div class="design-gallery-image">
                        <img loading="lazy" src="{{ $design->image }}" alt="{{ $design->title }}">
                        <div class="design-gallery-overlay">
                            <h3 class="design-gallery-item-title">{{ $design->title }}</h3>
                            @if ($design->link)
                                
                            <a href="{{ $design->link }}" class="design-gallery-view-btn">View Project</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($totalDesigns > 6)
            <div class="design-gallery-load-more">
                <button class="design-gallery-load-more-btn" data-shown="6" data-total="{{ $totalDesigns }}">Load
                    More</button>
            </div>
        @endif
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.design-gallery-filter-btn');
        const galleryItems = document.querySelectorAll('.design-gallery-item');
        const loadMoreBtn = document.querySelector('.design-gallery-load-more-btn');
        const ITEMS_PER_LOAD = 6;

        // Function to filter gallery items
        function filterGallery(category) {
            galleryItems.forEach(item => {
                item.classList.add('design-gallery-transitioning');

                setTimeout(() => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.classList.remove('design-gallery-hidden');
                    } else {
                        item.classList.add('design-gallery-hidden');
                    }

                    setTimeout(() => {
                        item.classList.remove('design-gallery-transitioning');
                    }, 300);
                }, 50);
            });
        }

        // Add click event listeners to filter buttons
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                const filter = button.getAttribute('data-filter');
                filterGallery(filter);
            });
        });

        // Load More functionality
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => {
                const currentlyShown = parseInt(loadMoreBtn.getAttribute('data-shown'));
                const totalItems = parseInt(loadMoreBtn.getAttribute('data-total'));
                const itemsToShow = Math.min(currentlyShown + ITEMS_PER_LOAD, totalItems);

                // Show next batch of items
                galleryItems.forEach((item, index) => {
                    if (index >= currentlyShown && index < itemsToShow) {
                        item.classList.remove('design-gallery-hidden');
                    }
                });

                // Update shown count
                loadMoreBtn.setAttribute('data-shown', itemsToShow);

                // Hide button if all items are shown
                if (itemsToShow >= totalItems) {
                    loadMoreBtn.style.display = 'none';
                }
            });
        }

        // Add animation on scroll
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('design-gallery-animate-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all gallery items
        galleryItems.forEach(item => {
            observer.observe(item);
        });
    });
</script>
