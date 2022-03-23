const defaultTheme = require("tailwindcss/lib/public/default-theme");

module.exports = {
  content: [
    "./*.php",
    "./templates/**/*.{html,js,twig,php}",
    "./src/**/*.{html,js,twig,php}"
  ],
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Proxima Nova', ...defaultTheme.default.fontFamily.sans],
      },
      colors: {
        font: {
          light: '#868686',
          normal: '#525252',
          dark: '#262626',
          url: '#F27623'
        },
        shade: {
          50: '#ffffff',
          100: '#f2f2f2',
          200: '#f4f4f4',
          300: '#525252',
          400: '#262626',
        }
      }
    },
  },
  plugins: [],
}
