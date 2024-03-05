/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
      },
      variants: {
        extend: {
            display: ["group-hover"],
        },
    },
    plugins: [
        require('tailwindcss'),
        require('autoprefixer'),
      ]
  }
