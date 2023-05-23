/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./templates/**/*.html.twig"],
    theme: {
        colors: {
            "primary-color": "#7BD389",
            "secondary-color": "#38E4AE",
            "secondary-color-light": "#B0FFE6",
            "gold-light": "#F7CA89",
            "gold-dark": "#a07543",
            "gold-dark-opacity": "#a2764457",
            "gold-light-opacity": "#f7c9895b",
            "dark-color": "#2D3047",
            "danger-color": "#CC2936",
            "warning-color": "#FFA630",
            white: "#FFFFFF",
            black: "#000000",
        },
        fontFamily: {
            "merriweather-sans": ['"Merriweather Sans"', "sans-serif"],
        },
        minWidth: {
            "1/2": "50%",
            "7/10": "70%",
        },
        width: {
            "9/10": "90%",
        },

        extend: {},
    },
    plugins: [],
};
