module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/views/**/**/*.blade.php',
    './resources/js/**/*.vue'
  ],
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
