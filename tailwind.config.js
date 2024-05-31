/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  daisyui:{
    themes: ["synthwave"],
  },
  theme: {
    extend: {},
  },
  plugins: [require('daisyui'),],
}

