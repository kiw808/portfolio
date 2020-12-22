module.exports = {
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '4rem',
                xl: '5rem',
                '2xl': '6rem',
            },
        },
        extend: {
            colors: {
                'primary': '#f05454',
                'secondary': '#30475e',
                'dark': '#222831',
                'light': '#e8e8e8',
            },
        },
        variants: {
            extend: {
                borderWidth: ['hover', 'focus'],
            },
        },
    },
}
