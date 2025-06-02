const initDarkMode = () => {
    const toggles = [document.getElementById('darkModeToggle'), document.getElementById('darkModeMobile')];

    // Set icons based on current mode
    const updateIcons = (isDark) => {
        toggles.forEach(toggle => {
            const icon = toggle.querySelector('i');
            if (isDark) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });
    };

    // Check saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark-mode') {
        document.body.classList.add('dark-mode');
        updateIcons(true);
    }

    // Toggle dark mode on click
    toggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const isDark = document.body.classList.toggle('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark-mode' : 'light');
            updateIcons(isDark);
        });
    });
};

document.addEventListener('DOMContentLoaded', initDarkMode);
