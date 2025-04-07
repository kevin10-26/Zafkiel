/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/Templates/html/*.html",
    "./src/Templates/html/components/**/*.html",
    "./../../../public/js/zafkiel/*.js"
  ],
  theme: {
    extend: {
      animation: {
        fade: 'fadeInOut 10s ease-in-out infinite',
        slowSpin: 'slowSpin 2s linear infinite',
        slowPulse: 'slowPulse 3s ease-in-out infinite',
        fadeInUp: 'fadeInUp 0.6s ease-out forwards'
      },
      keyframes: {
        fadeInOut: {
          '0%': { opacity: '0' },
          '50%': { opacity: '0.7' },
          '100%': { opacity: '1' },
        },
        slowSpin: {
          '0%': {
            transform: 'rotate(0deg)',
          },
          '100%': {
            transform: 'rotate(360deg)',
          },
        },
        slowPulse: {
          '0%': {
            transform: 'scale(1)',
            opacity: '1',
          },
          '50%': {
            transform: 'scale(1.05)',
            opacity: '0.5',
          },
          '100%': {
            transform: 'scale(1)',
            opacity: '1',
          },
        },
        fadeInUp:{
          "0%": {
            opacity: '0',
            transform: 'translateY(20px)'
          },
          "100%": {
            opacity: '1',
            transform: 'translateY(0)'
          }
        }
      },
    },
  },
  plugins: [
    function ({ addUtilities }) {
      addUtilities({
        '.selected-picture-slideshow': {
          borderStyle: 'solid',
          borderWidth: '2px',
          borderColor: '#D1D5DC',
          backgroundColor: '#E5E7EB'
        },
        '.snackbar-container': {
          opacity: '0',
          width: 'fit-content',
          textAlign: 'center',
          borderRadius: '0.25rem',
          padding: '0.625rem',
          margin: '0.25rem auto',
          wordBreak: 'break-all',
        }
      });
    },
  ],
}

