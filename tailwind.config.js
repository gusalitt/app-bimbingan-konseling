/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
  content: [
    "./app/Views/**/*.{html,php}",
    "./public/assets/**/*.{css,js}",
    "./public/src/**/*.css"
  ],
  theme: {
    extend: {
      fontFamily: {
        Nunito: ["Nunito"],
      },
      colors: {
        light: {
          bg: '#f1f5f9',
          card: '#fff',
          shadow: '#e2e8f0',
          text: '#000',
          danger: '#ef4444',
        },
        dark: {
          bg: '#111827',
          card: '#172030',
          shadow: '#1e293b',
          text: '#fff',
          danger: '#ff6b6b',
        }
      },
      spacing: {
        'calc-100-250': 'calc(100% - 250px)',
        'calc-100-70': 'calc(100% - 70px)',
      },
      backgroundImage: {
        'custom-gradient': 'linear-gradient(160deg, #ff147f, #8624c2)',
      },

    },
  },
  plugins: [],
}

