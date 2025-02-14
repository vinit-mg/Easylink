/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/balajidharma/laravel-crud/src/resources/views/*.blade.php',
        './vendor/balajidharma/laravel-admin-core/Grid/*.php',
        './storage/framework/views/*.php',
        './resources/views/components/admin/**/*.blade.php',
        './resources/views/admin/**/*.blade.php',
        './app/Forms/Admin/*.php',
        './config/form-builder.php',
    ],

    plugins: [
        require('daisyui')
    ],
};
