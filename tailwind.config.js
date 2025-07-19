/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/Presentation/Templates/html/*.html", "./src/Presentation/Templates/html/components/*.html", "./public/js/zafkiel/*.js"],
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