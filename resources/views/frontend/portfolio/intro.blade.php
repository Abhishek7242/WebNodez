<section class="portfolio-intro">
    <div class="portfolio-intro-container flex">
        <div class="portfolio-intro-content">
            <h1 class="portfolio-intro-title">Our Portfolio</h1>
            <p class="portfolio-intro-subtitle">Discover our innovative web solutions and successful projects that have
                helped businesses thrive in the digital world</p>
        </div>
        <div class="portfolio-gallery">
            <div class="portfolio-gallery-container">
                <div class="portfolio-gallery-box">
                    <!-- Front card -->
                    <div class="portfolio-gallery-card portfolio-gallery-front">
                        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/78a97163065537.5aa76fff8bb77.gif"
                            alt="Website Image">
                        <div class="portfolio-gallery-card-content">
                            <h2>Web Devlopment</h2>
                        </div>
                    </div>

                    <!-- Back card -->
                    <div class="portfolio-gallery-card portfolio-gallery-back">
                        <img src="https://miro.medium.com/v2/resize:fit:1400/1*9qqnO6ZXTQhEdlxL4AxvKg.gif"
                            alt="App Image">
                        <div class="portfolio-gallery-card-content">
                            <h2>App Development</h2>
                        </div>
                    </div>

                    <!-- Left card -->
                    <div class="portfolio-gallery-card portfolio-gallery-left">
                        <img src="https://www.oakyweb.com/images/dc6df7e28e51cb7dcec3bdda8b502f7e.gif" alt="E-Commerce Image">
                        <div class="portfolio-gallery-card-content">
                            <h2>E-Commerce</h2>
                        </div>
                    </div>

                    <!-- Right card -->
                    <div class="portfolio-gallery-card portfolio-gallery-right">
                        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/hd/ce963767817393.5b472244e81a7.gif"
                            alt="UI/UX Design Image">
                        <div class="portfolio-gallery-card-content">
                            <h2>UI/UX Design</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <div class="portfolio-gallery-controls">
                <button id="portfolio-gallery-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg>
                </button>
                <button id="portfolio-gallery-next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="portfolio-images">
        <div class="portfolio-image-grid">
            <div class="image-item design-1">
                <img src="https://www.windmillstrategy.com/wp-content/uploads/2023/11/Best-Industrial-Website-Design-Example-Image-Path-Robotics.gif"
                    alt="Website">
            </div>
            <div class="image-item design-2">
                <img src="https://nix-united.com/wp-content/uploads/2021/03/dark-and-light-theme.gif" alt="App">
            </div>
            <div class="image-item design-3">
                <img src="https://fireart.studio/wp-content/uploads/2021/01/top0.gif" alt="E-commerce">
            </div>
            <div class="image-item design-4">
                <img src="https://content-management-files.canva.com/18bc5b91-0539-4f80-8380-2e8fc8fcc5fa/0001.png"
                    alt="UI/UX">
            </div>
            <div class="image-item design-5">
                <img src="https://cdn.dribbble.com/userupload/23474978/file/original-464a614ea2c94c039e75f8c1654f9abf.gif"
                    alt="Website">
            </div>
            <div class="image-item design-6">
                <img src="https://miro.medium.com/v2/resize:fit:1400/1*lZ16mhuFp84Nu4CJObW3lQ.gif" alt="App">
            </div>
            <div class="image-item design-7">
                <img src="https://cdn.dribbble.com/userupload/41696512/file/original-4a84e5b6b575110b27839f39bdc973c9.gif" alt="E-commerce">
            </div>
            <div class="image-item design-8">
                <img src="https://thumbor.forbes.com/thumbor/fit-in/900x510/https://www.forbes.com/advisor/wp-content/uploads/2022/09/Image_-_How_to_design_a_website_.jpeg.jpg"
                    alt="UI/UX">
            </div>
            <div class="image-item design-9">
                <img src="https://img.freepik.com/free-vector/cartoon-web-design-landing-page_52683-70880.jpg?semt=ais_items_boosted&w=740"
                    alt="Website">
            </div>
        </div>
    </div>
</section>

<script>
    let currentAngle = 0;
    const box = document.querySelector('.portfolio-gallery-box');
    let autoRotateInterval;

    // Function to rotate to next
    function rotateNext() {
        currentAngle -= 90;
        box.style.transform = `perspective(1000px) rotateY(${currentAngle}deg)`;
    }

    // Function to rotate to previous
    function rotatePrev() {
        currentAngle += 90;
        box.style.transform = `perspective(1000px) rotateY(${currentAngle}deg)`;
    }

    // Start auto rotation
    function startAutoRotate() {
        autoRotateInterval = setInterval(rotateNext, 3000);
    }

    // Stop auto rotation
    function stopAutoRotate() {
        clearInterval(autoRotateInterval);
    }

    // Event listeners for buttons
    document.getElementById('portfolio-gallery-next').addEventListener('click', () => {
        rotateNext();
        // Reset the interval when manually clicking
        stopAutoRotate();
        startAutoRotate();
    });

    document.getElementById('portfolio-gallery-prev').addEventListener('click', () => {
        rotatePrev();
        // Reset the interval when manually clicking
        stopAutoRotate();
        startAutoRotate();
    });

    // Pause rotation on hover
    box.addEventListener('mouseenter', stopAutoRotate);
    box.addEventListener('mouseleave', startAutoRotate);

    // Start auto rotation when page loads
    startAutoRotate();
</script>
