import './bootstrap';

// Turbo Drive removed — causes conflicts between Bootstrap (app) and Tailwind (public) layouts

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import 'preline/preline';

// Preline auto-init
const initPreline = () => {
    if (window.HSStaticMethods && typeof window.HSStaticMethods.autoInit === 'function') {
        window.HSStaticMethods.autoInit();
    }
};

initPreline();
document.addEventListener('livewire:navigated', initPreline);

// ==============================
// Dark Mode
// ==============================
function syncThemeIcons() {
    var isDark = document.documentElement.classList.contains('dark');
    document.querySelectorAll('.theme-icon-moon').forEach(function (el) { el.style.display = isDark ? 'none' : ''; });
    document.querySelectorAll('.theme-icon-sun').forEach(function (el) { el.style.display = isDark ? '' : 'none'; });
}

// Global toggle function used by navbar buttons
window.toggleDarkMode = function () {
    var isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    syncThemeIcons();
};

// Sync icons on page load (dark class already set by inline script in <head>)
syncThemeIcons();
