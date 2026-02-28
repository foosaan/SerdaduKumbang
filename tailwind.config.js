import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import plugin from 'tailwindcss/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        'node_modules/preline/dist/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#fef2f2',
                    100: '#fee2e2',
                    500: '#ef4444',
                    600: '#dc2626',
                    700: '#b91c1c',
                    900: '#7f1d1d',
                }
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'fade-up': 'fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1)',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            }
        },
    },

    plugins: [
        forms,
        plugin(function ({ addVariant }) {
            addVariant('hs-collapse-open', [
                '&.hs-collapse.open',
                '&.hs-collapse-toggle.open',
                '.hs-collapse.open &',
                '.hs-collapse-toggle.open &'
            ]);
            addVariant('hs-dropdown-open', [
                '&.hs-dropdown-menu.open',
                '.hs-dropdown.open > &',
                '.hs-dropdown.open > .hs-dropdown-toggle &',
                '.hs-dropdown.open > .hs-dropdown-menu > &'
            ]);
            addVariant('hs-carousel-active', [
                '&.active',
                '.active &'
            ]);
            addVariant('hs-tab-active', [
                '&[data-hs-tab].active',
                '[data-hs-tab].active &'
            ]);
        })
    ],
};
