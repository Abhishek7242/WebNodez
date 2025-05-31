document.addEventListener('DOMContentLoaded', function () {
    const playground = document.querySelector('.services-playground');
    const serviceNames = document.querySelectorAll('.services-name');
    const floatingIcons = document.querySelectorAll('.services-icon');
    const elements = [...serviceNames, ...floatingIcons];

    // Set initial positions in a circle
    elements.forEach((element, index) => {
        const angle = (index * (360 / elements.length)) * (Math.PI / 180);
        const radius = 120;
        const x = Math.cos(angle) * radius;
        const y = Math.sin(angle) * radius;
        element.style.transform = `translate(calc(-50% + ${x}px), calc(-50% + ${y}px))`;
    });

    let mouseX = 0;
    let mouseY = 0;
    let centerX = 0;
    let centerY = 0;

    // Update center position on resize
    function updateCenter() {
        const rect = playground.getBoundingClientRect();
        centerX = rect.width / 2;
        centerY = rect.height / 2;
    }
    updateCenter();
    window.addEventListener('resize', updateCenter);

    // Mouse move effect
    playground.addEventListener('mousemove', (e) => {
        const rect = playground.getBoundingClientRect();
        mouseX = e.clientX - rect.left;
        mouseY = e.clientY - rect.top;

        // Calculate mouse position relative to center
        const deltaX = mouseX - centerX;
        const deltaY = mouseY - centerY;

        elements.forEach((element, index) => {
            const angle = (index * (360 / elements.length)) * (Math.PI / 180);
            const radius = 120;

            // Calculate base position
            const baseX = Math.cos(angle) * radius;
            const baseY = Math.sin(angle) * radius;

            // Add mouse influence
            const influenceX = deltaX * 0.2;
            const influenceY = deltaY * 0.2;

            // Apply movement with smooth transition
            element.style.transform =
                `translate(calc(-50% + ${baseX + influenceX}px), calc(-50% + ${baseY + influenceY}px))`;
        });
    });

    // Reset positions when mouse leaves
    playground.addEventListener('mouseleave', () => {
        elements.forEach((element, index) => {
            const angle = (index * (360 / elements.length)) * (Math.PI / 180);
            const radius = 120;
            const x = Math.cos(angle) * radius;
            const y = Math.sin(angle) * radius;
            element.style.transform = `translate(calc(-50% + ${x}px), calc(-50% + ${y}px))`;
        });
    });

    // Add hover effect for icons
    floatingIcons.forEach(icon => {
        icon.addEventListener('mouseenter', () => {
            icon.style.zIndex = '3';
        });

        icon.addEventListener('mouseleave', () => {
            icon.style.zIndex = '1';
        });
    });
});