/** @type {import('tailwindcss').Config} */
export default {
  darkMode: ["class"],
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.{vue,js,ts,jsx,tsx}',
  ],
  theme: {
    extend: {
      colors: {
        // Gesa's Garden Brand Colors
        'gesa': {
          'green': '#4CAF50',      // Leafy Green - primary
          'olive': '#2E5339',      // Dark Olive - secondary  
          'white': '#FFFFFF',      // Crisp White - background
          'orange': '#F4A261',     // Carrot Orange - accent
          'purple': '#7B2CBF',     // Beet Purple - optional accent
        },
        // Semantic color mappings
        primary: {
          DEFAULT: '#4CAF50',
          foreground: '#FFFFFF',
        },
        secondary: {
          DEFAULT: '#2E5339',
          foreground: '#FFFFFF',
        },
        accent: {
          DEFAULT: '#F4A261',
          foreground: '#2E5339',
        },
        muted: {
          DEFAULT: '#F8F9FA',
          foreground: '#6B7280',
        },
        background: '#FFFFFF',
        foreground: '#2E5339',
        card: {
          DEFAULT: '#FFFFFF',
          foreground: '#2E5339',
        },
        border: '#E5E7EB',
        input: '#F3F4F6',
        ring: '#4CAF50',
      },
      fontFamily: {
        'playfair': ['Playfair Display', 'serif'],
        'inter': ['Inter', 'sans-serif'],
        'sans': ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        'hero': ['3.5rem', { lineHeight: '1.1', letterSpacing: '-0.02em' }],
        'display': ['2.5rem', { lineHeight: '1.2', letterSpacing: '-0.01em' }],
        'title': ['1.875rem', { lineHeight: '1.3', letterSpacing: '-0.01em' }],
        'subtitle': ['1.25rem', { lineHeight: '1.4', letterSpacing: '0' }],
        'body': ['1rem', { lineHeight: '1.6', letterSpacing: '0' }],
        'caption': ['0.875rem', { lineHeight: '1.5', letterSpacing: '0.01em' }],
      },
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
        '128': '32rem',
      },
      borderRadius: {
        'xl': '0.75rem',
        '2xl': '1rem',
        '3xl': '1.5rem',
      },
      boxShadow: {
        'gesa': '0 10px 25px -3px rgba(76, 175, 80, 0.1), 0 4px 6px -2px rgba(76, 175, 80, 0.05)',
        'gesa-lg': '0 20px 25px -5px rgba(76, 175, 80, 0.1), 0 10px 10px -5px rgba(76, 175, 80, 0.04)',
      },
      animation: {
        'gesa-fade-in': 'gesa-fade-in 0.5s ease-out',
        'gesa-slide-up': 'gesa-slide-up 0.5s ease-out',
        'gesa-bounce-gentle': 'gesa-bounce-gentle 2s infinite',
      },
      keyframes: {
        'gesa-fade-in': {
          '0%': { opacity: '0', transform: 'translateY(10px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        'gesa-slide-up': {
          '0%': { opacity: '0', transform: 'translateY(20px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        'gesa-bounce-gentle': {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-5px)' },
        },
      },
    },
  },
  // Note: Tailwind CSS v4 doesn't use plugins in the same way
  // The typography and forms utilities are built-in or can be added via CSS
}
