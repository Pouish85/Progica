/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./assets/**/*.js", "./templates/**/*.html.twig"],
    theme: {
        colors: {
            "primary-color": "#7BD389",
            "secondary-color": "#38E4AE",
            "secondary-color-light": "#B0FFE6",
            "dark-color": "#2D3047",
            "danger-color": "#CC2936",
            "warning-color": "#FFA630",
        },
        fontFamily: {
            "merriweather-sans": ['"Merriweather Sans"', "sans-serif"],
        },
        extend: {},
    },
    plugins: [],
};
