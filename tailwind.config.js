/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/Templates/html/*.html", "./src/Templates/html/components/*.html"],
  theme: {
    extend: {
      animation: {
        fade: 'fadeInOut 10s ease-in-out infinite',
      },
      keyframes: {
        fadeInOut: {
          '0%': { opacity: '0' },
          '50%': { opacity: '0.7' },
          '100%': { opacity: '1' },
        },
      },
    },
  },
  plugins: [
    function ({ addUtilities }) {
      addUtilities({
        '.selected-picture-slideshow': {
          borderStyle: 'double',
          borderWidth: '6px',
          borderColor: '#372AAC',
        },
      });
    },
  ],
}

