<section class="home-design-gallery-section">
    <div class="home-design-gallery-container">
        <div class="home-design-gallery-header ">
            <span class="home-design-gallery-subtitle">Our Portfolio</span>
            <h2 class="home-design-gallery-title">Design Gallery</h2>
            <p class="home-design-gallery-description">Explore our latest design projects and creative solutions</p>
        </div>

        <div class="home-design-gallery-filter">
            <button class="home-design-gallery-filter-btn active" data-filter="all">All</button>
            <button class="home-design-gallery-filter-btn" data-filter="web">Web Development</button>
            <button class="home-design-gallery-filter-btn" data-filter="app">App Development</button>
            <button class="home-design-gallery-filter-btn" data-filter="ui">UI/UX Design</button>
        </div>

        <div class="home-design-gallery-grid">
            <!-- Web Development Projects -->
            <div class="home-design-gallery-item" data-category="web">
                <div class="home-design-gallery-image">
                    <img src="https://s3u.tmimgcdn.com/u1635272/ba94c8b2675b46c7702e36961744b0c6.jpg"
                        alt="E-commerce Website">
                    <div class="home-design-gallery-overlay">
                        <h3 class="home-design-gallery-item-title">E-commerce Website</h3>
                        <a href="#" class="home-design-gallery-view-btn">View Project</a>
                    </div>
                </div>
            </div>

            <div class="home-design-gallery-item" data-category="web">
                <div class="home-design-gallery-image">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/1d5e3b174890851.64aa8bf1d92be.jpg"
                        alt="Corporate Website">
                    <div class="home-design-gallery-overlay">
                        <h3 class="home-design-gallery-item-title">Fitness Website</h3>
                        <a href="#" class="home-design-gallery-view-btn">View Project</a>
                    </div>
                </div>
            </div>

            <!-- App Development Projects -->
            <div class="home-design-gallery-item" data-category="app">
                <div class="home-design-gallery-image">
                    <img src="https://www.appindia.co.in/blog/wp-content/uploads/2021/10/fitness-app.jpg"
                        alt="Fitness App">
                    <div class="home-design-gallery-overlay">
                        <h3 class="home-design-gallery-item-title">Fitness Tracking App</h3>
                        <a href="#" class="home-design-gallery-view-btn">View Project</a>
                    </div>
                </div>
            </div>

            <div class="home-design-gallery-item" data-category="app">
                <div class="home-design-gallery-image">
                    <img src="https://cdn.dribbble.com/userupload/33242602/file/original-39adc0e253d8de6e2f26392eb259a38d.png?resize=752x&vertical=center"
                        alt="Food Delivery App">
                    <div class="home-design-gallery-overlay">
                        <h3 class="home-design-gallery-item-title">Food Delivery App</h3>
                        <a href="#" class="home-design-gallery-view-btn">View Project</a>
                    </div>
                </div>
            </div>

            <!-- UI/UX Design Projects -->
            <div class="home-design-gallery-item" data-category="web">
                <div class="home-design-gallery-image">
                    <img src="https://i.ytimg.com/vi/XAHGoh1W10Q/maxresdefault.jpg"
                        alt="Food Recipe Website Image">
                    <div class="home-design-gallery-overlay">
                        <h3 class="home-design-gallery-item-title">Food Recipe Website</h3>
                        <a href="#" class="home-design-gallery-view-btn">View Project</a>
                    </div>
                </div>
            </div>

            <div class="home-design-gallery-item" data-category="ui">
                <div class="home-design-gallery-image">
                    <img src="https://mastercaweb.u-strasbg.fr/wp-content/uploads/2022/08/5726865-edited-scaled.jpg"
                        alt="UX Research">
                    <div class="home-design-gallery-overlay">
                        <h3 class="home-design-gallery-item-title">UI/UX Design</h3>
                        <a href="#" class="home-design-gallery-view-btn">View Project</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-design-gallery-load-more">
            <a href="/portfolio">
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
