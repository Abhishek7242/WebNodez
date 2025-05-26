// Initialize GSAP
gsap.registerPlugin(ScrollTrigger);

// Performance optimization
const debounce = (func, wait) => {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

// Enhanced header scroll effect
const initHeaderScroll = () => {
    const header = document.querySelector('.header');
    let lastScroll = 0;

    window.addEventListener('scroll', debounce(() => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
    }, 10));
};

// Custom cursor
const initCustomCursor = () => {
    const cursor = document.querySelector('.custom-cursor');
    const cursorDot = document.querySelector('.custom-cursor-dot');
    const links = document.querySelectorAll('a, button, .hover-glow');

    document.addEventListener('mousemove', (e) => {
        gsap.to(cursor, {
            x: e.clientX,
            y: e.clientY,
            duration: 0.1,
            ease: 'power2.out'
        });
        gsap.to(cursorDot, {
            x: e.clientX,
            y: e.clientY,
            duration: 0.3,
            ease: 'power2.out'
        });
    });

    links.forEach(link => {
        link.addEventListener('mouseenter', () => {
            cursor.classList.add('active');
            cursorDot.classList.add('active');
        });
        link.addEventListener('mouseleave', () => {
            cursor.classList.remove('active');
            cursorDot.classList.remove('active');
        });
    });
};

// Scroll progress indicator
const initScrollProgress = () => {
    const progressBar = document.querySelector('.scroll-progress');
    
    window.addEventListener('scroll', debounce(() => {
        const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (window.scrollY / windowHeight) * 100;
        gsap.to(progressBar, {
            scaleX: scrolled / 100,
            duration: 0.3,
            ease: 'power2.out'
        });
    }, 10));
};

// Enhanced Three.js scene
const initThreeScene = () => {
    const container = document.getElementById('hero-3d');
    if (!container) return;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    container.appendChild(renderer.domElement);

    // Optimize performance
    renderer.powerPreference = 'high-performance';
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;

    // Add ambient light
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
    scene.add(ambientLight);

    // Add directional light
    const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position.set(5, 5, 5);
    directionalLight.castShadow = true;
    scene.add(directionalLight);

    // Create particles
    const particlesGeometry = new THREE.BufferGeometry();
    const particlesCount = 2000;
    const posArray = new Float32Array(particlesCount * 3);

    for (let i = 0; i < particlesCount * 3; i++) {
        posArray[i] = (Math.random() - 0.5) * 5;
    }

    particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
    const particlesMaterial = new THREE.PointsMaterial({
        size: 0.005,
        color: 0x6366f1,
        transparent: true,
        opacity: 0.8
    });

    const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
    scene.add(particlesMesh);

    camera.position.z = 3;

    // Animation
    const animate = () => {
        requestAnimationFrame(animate);
        particlesMesh.rotation.y += 0.001;
        renderer.render(scene, camera);
    };

    animate();

    // Handle resize
    window.addEventListener('resize', debounce(() => {
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    }, 250));
};

// Enhanced animations
const initAnimations = () => {
    // Hero section animations - simple fade up
    gsap.from('.hero-title', {
        y: 20,
        opacity: 0,
        duration: 1,
        ease: 'power2.out'
    });

    gsap.from('.hero-description', {
        y: 20,
        opacity: 0,
        duration: 1,
        delay: 0.2,
        ease: 'power2.out'
    });

    gsap.from('.hero-buttons', {
        y: 20,
        opacity: 0,
        duration: 1,
        delay: 0.4,
        ease: 'power2.out'
    });

    // Simple fade up for all sections
    const fadeUpElements = [
        '.service-card',
        '.portfolio-item',
        '.process-card',
        '.section-title',
        '.contact-info',
        '.footer-info'
    ];

    fadeUpElements.forEach(selector => {
        gsap.utils.toArray(selector).forEach((element, i) => {
            gsap.from(element, {
                scrollTrigger: {
                    trigger: element,
                    start: 'top bottom-=20',
                    toggleActions: 'play none none reverse'
                },
                y: 20,
                opacity: 0,
                duration: 0.6,
                delay: i * 0.1,
                ease: 'power2.out',
                clearProps: 'all'
            });
        });
    });

    // Simple scale for images
    gsap.utils.toArray('.portfolio-item img').forEach((img, i) => {
        gsap.from(img, {
            scrollTrigger: {
                trigger: img,
                start: 'top bottom-=20',
                toggleActions: 'play none none reverse'
            },
            scale: 0.98,
            opacity: 0,
            duration: 0.6,
            delay: i * 0.1,
            ease: 'power2.out',
            clearProps: 'all'
        });
    });
};

// Loading screen
const initLoadingScreen = () => {
    const loadingScreen = document.querySelector('.loading-screen');
    if (!loadingScreen) return;

    window.addEventListener('load', () => {
        gsap.to(loadingScreen, {
            opacity: 0,
            duration: 1,
            ease: 'power2.inOut',
            onComplete: () => {
                loadingScreen.style.display = 'none';
            }
        });
    });
};

// Enhanced mobile menu
const initMobileMenu = () => {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    const body = document.body;
    
    if (!menuToggle || !navLinks) return;

    menuToggle.addEventListener('click', () => {
        const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', !isExpanded);
        menuToggle.classList.toggle('active');
        
        gsap.to(navLinks, {
            height: isExpanded ? 0 : 'auto',
            opacity: isExpanded ? 0 : 1,
            duration: 0.3,
            ease: 'power2.inOut'
        });

        if (!isExpanded) {
            body.style.overflow = 'hidden';
        } else {
            body.style.overflow = '';
        }
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!menuToggle.contains(e.target) && !navLinks.contains(e.target)) {
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.classList.remove('active');
            gsap.to(navLinks, {
                height: 0,
                opacity: 0,
                duration: 0.3,
                ease: 'power2.inOut'
            });
            body.style.overflow = '';
        }
    });
};

// Form validation
const initFormValidation = () => {
    const form = document.getElementById('contact-form');
    if (!form) return;

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        
        // Basic validation
        let isValid = true;
        const errors = {};

        if (!data.name.trim()) {
            errors.name = 'Name is required';
            isValid = false;
        }

        if (!data.email.trim()) {
            errors.email = 'Email is required';
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email)) {
            errors.email = 'Invalid email format';
            isValid = false;
        }

        if (!data.message.trim()) {
            errors.message = 'Message is required';
            isValid = false;
        }

        if (isValid) {
            // Show success message
            const successMessage = document.createElement('div');
            successMessage.className = 'success-message';
            successMessage.textContent = 'Message sent successfully!';
            form.appendChild(successMessage);

            // Reset form
            form.reset();

            // Remove success message after 3 seconds
            setTimeout(() => {
                successMessage.remove();
            }, 3000);
        } else {
            // Show error messages
            Object.entries(errors).forEach(([field, message]) => {
                const input = form.querySelector(`[name="${field}"]`);
                if (input) {
                    input.classList.add('error');
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'error-message';
                    errorMessage.textContent = message;
                    input.parentNode.appendChild(errorMessage);

                    // Remove error message after 3 seconds
                    setTimeout(() => {
                        errorMessage.remove();
                        input.classList.remove('error');
                    }, 3000);
                }
            });
        }
    });
};

// Theme toggle
const initThemeToggle = () => {
    const themeToggle = document.querySelector('.theme-toggle');
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    
    if (!themeToggle) return;

    // Set initial theme
    if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && prefersDarkScheme.matches)) {
        document.body.classList.add('dark-theme');
        themeToggle.querySelector('i').classList.replace('fa-moon', 'fa-sun');
    }

    themeToggle.addEventListener('click', () => {
        const isDark = document.body.classList.toggle('dark-theme');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        themeToggle.querySelector('i').classList.replace(
            isDark ? 'fa-moon' : 'fa-sun',
            isDark ? 'fa-sun' : 'fa-moon'
        );
    });
};

// Font size toggle
const initFontSizeToggle = () => {
    const fontSizeToggle = document.getElementById('font-size-toggle');
    if (!fontSizeToggle) return;

    let currentSize = 1;
    const sizes = [1, 1.2, 1.4];

    fontSizeToggle.addEventListener('click', () => {
        currentSize = (currentSize + 1) % sizes.length;
        document.body.style.fontSize = `${sizes[currentSize]}rem`;
        localStorage.setItem('fontSize', sizes[currentSize]);
    });

    // Set initial font size
    const savedSize = localStorage.getItem('fontSize');
    if (savedSize) {
        currentSize = sizes.indexOf(parseFloat(savedSize));
        document.body.style.fontSize = `${savedSize}rem`;
    }
};

// Smooth scroll
const initSmoothScroll = () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                gsap.to(window, {
                    duration: 1,
                    scrollTo: {
                        y: target,
                        offsetY: 70
                    },
                    ease: 'power3.inOut'
                });
            }
        });
    });
};

// Initialize all features
document.addEventListener('DOMContentLoaded', () => {
    initCustomCursor();
    initScrollProgress();
    initThreeScene();
    initAnimations();
    initLoadingScreen();
    initMobileMenu();
    initFormValidation();
    initThemeToggle();
    initFontSizeToggle();
    initSmoothScroll();
    initHeaderScroll();
}); 