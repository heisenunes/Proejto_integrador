const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js"
    ],
    theme: {
        extend: {
            fontFamily: {
                'source-code-pro': ['Source Code Pro', ...defaultTheme.fontFamily.sans]
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
