import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    
    // Aquesta secció 'content' és la clau. Analitzarà TOTS els fitxers .blade.php.
    content: [
        // Aquesta línia analitza totes les vistes Blade del teu projecte
        './resources/views/**/*.blade.php', 
        
        // Manté les línies estàndard de Laravel per si de cas
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};