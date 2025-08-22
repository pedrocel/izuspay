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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    light: '#1E293B',
                    dark: '#0F172A',
                },
                secondary: {
                    light: '#64748B',
                    dark: '#94A3B8',
                },
                accent: {
                    light: '#0EA5E9',
                    dark: '#38BDF8',
                },
                danger: {
                    light: '#DC2626',
                    dark: '#F87171',
                },
                success: {
                    light: '#16A34A',
                    dark: '#4ADE80',
                },
                background: {
                    light: '#F9FAFB',
                    dark: '#111827',
                },
            },
            backgroundImage: {
                'create-gradient': 'linear-gradient(to right, #50a8f2, #6affe2)',
            },
            borderRadius: {
                'custom-rounded': '0.5rem',
            },
        },
    },
    darkMode: 'class',
    plugins: [
        forms,
        function ({ addComponents }) {
            addComponents({
                '.btn-create': {
                    backgroundImage: 'linear-gradient(to right, #50a8f2, #6affe2)',
                    color: '#ffffff',
                    padding: '0.5rem 1rem',
                    borderRadius: '0.5rem',
                    textAlign: 'center',
                    display: 'inline-block',
                    fontWeight: 'bold',
                    transition: 'all 0.3s ease-in-out',
                    cursor: 'pointer',
                    '&:hover': {
                        opacity: '0.9',
                    },
                    '&:active': {
                        transform: 'scale(0.98)',
                    },
                },
                '.table-blue-degrade': {
                    backgroundImage: 'linear-gradient(to right, #50a8f2, #6affe2)',
                }
            });
        },
    ],
};
