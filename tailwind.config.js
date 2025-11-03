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
                'sans': ['Volkhov', 'ui-serif', 'Georgia', 'Cambria', 'Times New Roman', 'serif'],
                'serif': ['Volkhov', 'ui-serif', 'Georgia', 'serif'],
                'volkhov': ['Volkhov', 'serif'],
            },
        },
    },

    plugins: [forms],
};
