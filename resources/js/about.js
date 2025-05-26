document.addEventListener('DOMContentLoaded', function () {
    const playground = document.querySelector('.interactive-playground');
    const floatingItems = document.querySelectorAll('.floating-item');
    const particles = document.querySelector('.particles');

    // Position floating items randomly
    floatingItems.forEach(item => {
        const x = Math.random() * 80 + 10;
        const y = Math.random() * 80 + 10;
        item.style.left = `${x}%`;
        item.style.top = `${y}%`;
    });

    // Mouse move interaction
    playground.addEventListener('mousemove', (e) => {
        const rect = playground.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        // Move floating items
        floatingItems.forEach(item => {
            const speed = item.getAttribute('data-speed');
            const itemX = (x - rect.width / 2) / speed;
            const itemY = (y - rect.height / 2) / speed;
            item.style.transform = `translate(${itemX}px, ${itemY}px)`;
        });

        // Create particles
        createParticle(x, y);
    });

    // Create particle effect
    function createParticle(x, y) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = x + 'px';
        particle.style.top = y + 'px';
        particles.appendChild(particle);

        // Animate particle
        const angle = Math.random() * Math.PI * 2;
        const velocity = 2 + Math.random() * 2;
        const vx = Math.cos(angle) * velocity;
        const vy = Math.sin(angle) * velocity;
        let opacity = 1;

        const animate = () => {
            if (opacity <= 0) {
                particle.remove();
                return;
            }
            opacity -= 0.02;
            particle.style.opacity = opacity;
            particle.style.transform = `translate(${vx}px, ${vy}px)`;
            requestAnimationFrame(animate);
        };
        animate();
    }

    // Click interaction
    floatingItems.forEach(item => {
        item.addEventListener('click', () => {
            item.style.transform = 'scale(1.2)';
            setTimeout(() => {
                item.style.transform = 'scale(1)';
            }, 200);
        });
    });
}); 