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
      colors: {
        primary: {
          '50': '#f1fcfa',
          '100': '#cef9f2',
          '200': '#9df2e5',
          '300': '#64e4d5',
          '400': '#34cdc0',
          '500': '#1ec2b7',
          '600': '#138e88',
          '700': '#14716e',
          '800': '#145b59',
          '900': '#164b4a',
          '950': '#062c2d',
        },
        secondary: {
          50: '#e0f7f4',
          100: '#b3f0e8',
          200: '#80e8db',
          300: '#4de0cf',
          400: '#26d9c4',
          500: '#00d2b9',
          600: '#00bfa6',
          700: '#00a58d',
          800: '#008b74',
          900: '#006f5b',
        },
        contrast: {
          50: '#e0f7f4',
          100: '#b3f0e8',
          200: '#80e8db',
          300: '#4de0cf',
          400: '#26d9c4',
          500: '#00d2b9',
          600: '#00bfa6',
          700: '#00a58d',
          800: '#008b74',
          900: '#006f5b',
        },
      },
    },
    fontFamily: {
      'body': [
        'Inter',
        'ui-sans-serif',
        'system-ui',
        '-apple-system',
        'system-ui',
        'Segoe UI',
        'Roboto',
        'Helvetica Neue',
        'Arial',
        'Noto Sans',
        'sans-serif',
        'Apple Color Emoji',
        'Segoe UI Emoji',
        'Segoe UI Symbol',
        'Noto Color Emoji'
      ],
      'sans': [
        'Inter',
        'ui-sans-serif',
        'system-ui',
        '-apple-system',
        'system-ui',
        'Segoe UI',
        'Roboto',
        'Helvetica Neue',
        'Arial',
        'Noto Sans',
        'sans-serif',
        'Apple Color Emoji',
        'Segoe UI Emoji',
        'Segoe UI Symbol',
        'Noto Color Emoji'
      ]
    }
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
