@php
    use App\Models\DesignGallery;
    use Illuminate\Support\Facades\Cache;

    $designs = Cache::remember('design_gallery_featured', 60 * 60 * 24, function () {
        return DesignGallery::where('is_featured', true)->orderBy('order', 'asc')->get();
    });

    $totalDesigns = $designs->count();
@endphp

<section class="home-design-gallery-section">
    <div class="home-design-gallery-container">
        <div class="home-design-gallery-header ">
            <span class="home-design-gallery-subtitle">Our Portfolio</span>
            <h2 class="home-design-gallery-title">Design Gallery</h2>
            <p class="home-design-gallery-description">Explore our latest design projects and creative solutions</p>
        </div>

        {{-- <div class="home-design-gallery-filter">
            <button class="home-design-gallery-filter-btn active" data-filter="all">All</button>
            <button class="home-design-gallery-filter-btn" data-filter="web_dev">Web Development</button>
            <button class="home-design-gallery-filter-btn" data-filter="app_dev">App Development</button>
            <button class="home-design-gallery-filter-btn" data-filter="ui_ux">UI/UX Design</button>
        </div> --}}

        <div class="home-design-gallery-grid">
            @foreach ($designs as $design)
                <div class="home-design-gallery-item" data-category="{{ $design->category }}">
                    <div class="home-design-gallery-image">
                        <img loading="lazy" src="{{ $design->image }}" alt="{{ $design->title }}">
                        <div class="home-design-gallery-overlay">
                            <h3 class="home-design-gallery-item-title">{{ $design->title }}</h3>
                            @if ($design->link)
                                <a target="_blank" href="{{ $design->link }}" class="home-design-gallery-view-btn">View Project</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="home-design-gallery-load-more">
            <a href="/portfolio#design-gallery">
                <button class="home-design-gallery-load-more-btn">Show More</button>
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.home-design-gallery-filter-btn');
        const galleryItems = document.querySelectorAll('.home-design-gallery-item');
        let visibleItems = 6;

        // Function to filter gallery items
        function filterGallery(category) {
            galleryItems.forEach(item => {
                item.classList.add('home-design-gallery-transitioning');

                setTimeout(() => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.classList.remove('home-design-gallery-hidden');
                    } else {
                        item.classList.add('home-design-gallery-hidden');
                    }

                    setTimeout(() => {
                        item.classList.remove('home-design-gallery-transitioning');
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

        // Add animation on scroll
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('home-design-gallery-animate-in');
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
