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
                    DEFAULT: '#1E3A8A',
                    50: '#F0F5FA',
                    100: '#E0E7FF',
                    200: '#C7D2FE',
                    300: '#93C5FD',
                    400: '#60A5FA',
                    500: '#2563EB',
                    600: '#1D4ED8',
                    700: '#1E3A8A',
                    800: '#1E293B',
                    900: '#0F172A',
                },
                brandRed: {
                    DEFAULT: '#E11D48',
                    50: '#FFF1F2',
                    100: '#FFE4E6',
                    200: '#FECDD3',
                    500: '#E11D48',
                    600: '#BE123C',
                    700: '#9F1239',
                },
                brandOrange: {
                    DEFAULT: '#D97706',
                    50: '#FEF3C7',
                    100: '#FDE68A',
                    200: '#FCD34D',
                    500: '#F59E0B',
                    600: '#D97706',
                    700: '#B45309',
                },
                brandDark: {
                    DEFAULT: '#1E293B',
                    50: '#F8FAFC',
                    100: '#F1F5F9',
                    500: '#1E293B',
                    800: '#0F172A',
                    900: '#020617',
                },
                brandGray: {
                    DEFAULT: '#64748B',
                    50: '#F8FAFC',
                    100: '#F1F5F9',
                    200: '#E2E8F0',
                    500: '#64748B',
                    600: '#475569',
                    700: '#334155',
                },
                brandLight: {
                    DEFAULT: '#F1F5F9',
                    50: '#F8FAFC',
                    100: '#F1F5F9',
                    200: '#E2E8F0',
                    300: '#CBD5E1',
                },
            },
        },
    },

    plugins: [forms],
};
