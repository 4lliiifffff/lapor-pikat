import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navy: {
                    DEFAULT: '#0A315F',
                    50: '#f0f5fa',
                    100: '#e1ebf5',
                    200: '#c3d7eb',
                    500: '#0A315F',
                    600: '#08284e',
                    700: '#061f3d',
                    800: '#04152a',
                    900: '#020b16',
                },
                brandRed: {
                    DEFAULT: '#E63038',
                    50: '#fdf2f2',
                    100: '#fce4e5',
                    500: '#E63038',
                    600: '#d0252d',
                    700: '#b21c23',
                },
                brandOrange: {
                    DEFAULT: '#FBA239',
                    50: '#fffbf2',
                    100: '#ffedd5',
                    500: '#FBA239',
                    600: '#e58e24',
                    700: '#cc7912',
                },
                brandDark: {
                    DEFAULT: '#2E2E2E',
                    50: '#f5f5f5',
                    100: '#e5e5e5',
                    800: '#2E2E2E',
                    900: '#1c1c1c',
                },
                brandGray: {
                    DEFAULT: '#7D7D7D',
                    100: '#f0f0f0',
                    200: '#dcdcdc',
                    500: '#7D7D7D',
                    600: '#636363',
                },
                brandLight: {
                    DEFAULT: '#EDEDED',
                    50: '#fafafa',
                    100: '#EDEDED',
                    200: '#dbdbdb',
                },
            },
        },
    },

    plugins: [forms],
};
