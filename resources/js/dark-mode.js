// Dark mode functionality
const initDarkMode = () => {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const icon = darkModeToggle.querySelector('i');

    // Check for saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
    }

    // Toggle dark mode
    darkModeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');

        // Update icon
        if (document.documentElement.classList.contains('dark')) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
            localStorage.setItem('theme', 'dark');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
            localStorage.setItem('theme', 'light');
        }
    });
};

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initDarkMode); 