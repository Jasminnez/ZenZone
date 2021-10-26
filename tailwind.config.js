const { backgroundColor } = require("tailwindcss/defaultTheme");
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    mode: "jit",
    purge: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                robto: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                background: "var(--bg)",
                "search-box": "var(--search-box)",
                "add-button": "var(--add-btn)",
                "edit-button": "var(--edit-btn)",
                "cancel-button": "var(--cancel-btn)",
                "card-first": "var(--card-first)",
                "card-second": "var(--card-second)",
                "card-third": "var(--card-third)",
                popup: "var(--popup)",
                "font-first": "var(--font-first)",
                "font-second": "var(--font-second)",
            },
        },
    },

    variants: {
        extend: {
            opacity: ["disabled"],
            lineClamp: ["hover"]
        },
    },

    plugins: [
        require('@tailwindcss/line-clamp'),
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
