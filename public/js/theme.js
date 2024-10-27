// Theme toggle script
document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');

    // Function to set the theme based on the preference
    function setTheme(theme) {
        if (theme === 'light') {
            document.documentElement.classList.remove('dark');
            themeIcon.textContent = 'light_mode';
        } else {
            document.documentElement.classList.add('dark');
            themeIcon.textContent = 'dark_mode';
        }
        localStorage.setItem('theme', theme);
    }

    // Check for saved user preference, if any, on initial load
    const savedTheme = localStorage.getItem('theme') || 'dark';
    setTheme(savedTheme);

    // Toggle theme and update localStorage
    themeToggleBtn.addEventListener('click', () => {
        const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    });
});

// Dropdown toggle script
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    dropdown.classList.toggle('hidden');
}

