/**
 * Gesa's Garden Brand System
 * 
 * This file contains all brand-related constants, colors, fonts, and utilities
 * that can be imported and used throughout the application.
 */

// Brand Colors
export const BRAND_COLORS = {
  // Primary Colors
  GREEN: '#4CAF50',      // Leafy Green - primary brand color
  OLIVE: '#2E5339',      // Dark Olive - secondary brand color
  WHITE: '#FFFFFF',      // Crisp White - background color
  
  // Accent Colors
  ORANGE: '#F4A261',     // Carrot Orange - energy, appetite, warmth
  PURPLE: '#7B2CBF',     // Beet Purple - bold, hearty, unique flavor pop
  
  // Semantic Mappings
  PRIMARY: '#4CAF50',
  SECONDARY: '#2E5339',
  ACCENT: '#F4A261',
  SUCCESS: '#4CAF50',
  WARNING: '#F4A261',
  ERROR: '#EF4444',
  INFO: '#3B82F6',
} as const;

// Typography
export const TYPOGRAPHY = {
  FONTS: {
    PLAYFAIR: 'Playfair Display, serif',
    INTER: 'Inter, sans-serif',
    SANS: 'Inter, ui-sans-serif, system-ui, sans-serif',
  },
  WEIGHTS: {
    LIGHT: 300,
    NORMAL: 400,
    MEDIUM: 500,
    SEMIBOLD: 600,
    BOLD: 700,
  },
  SIZES: {
    HERO: '3.5rem',
    DISPLAY: '2.5rem',
    TITLE: '1.875rem',
    SUBTITLE: '1.25rem',
    BODY: '1rem',
    CAPTION: '0.875rem',
  },
} as const;

// Spacing Scale
export const SPACING = {
  XS: '0.25rem',    // 4px
  SM: '0.5rem',     // 8px
  MD: '1rem',       // 16px
  LG: '1.5rem',     // 24px
  XL: '2rem',       // 32px
  '2XL': '3rem',    // 48px
  '3XL': '4rem',    // 64px
  '4XL': '6rem',    // 96px
} as const;

// Border Radius
export const BORDER_RADIUS = {
  SM: '0.25rem',    // 4px
  MD: '0.5rem',     // 8px
  LG: '0.75rem',    // 12px
  XL: '1rem',       // 16px
  '2XL': '1.5rem',  // 24px
  FULL: '9999px',
} as const;

// Shadows
export const SHADOWS = {
  SM: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
  MD: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
  LG: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
  XL: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
  GESA: '0 10px 25px -3px rgba(76, 175, 80, 0.1), 0 4px 6px -2px rgba(76, 175, 80, 0.05)',
  'GESA-LG': '0 20px 25px -5px rgba(76, 175, 80, 0.1), 0 10px 10px -5px rgba(76, 175, 80, 0.04)',
} as const;

// Gradients
export const GRADIENTS = {
  GESA: 'linear-gradient(135deg, #4CAF50 0%, #2E5339 100%)',
  'GESA-SUBTLE': 'linear-gradient(135deg, #f0f9f0 0%, #f8f9fa 100%)',
  'GESA-REVERSE': 'linear-gradient(135deg, #2E5339 0%, #4CAF50 100%)',
  'GREEN-TO-ORANGE': 'linear-gradient(135deg, #4CAF50 0%, #F4A261 100%)',
} as const;

// Animations
export const ANIMATIONS = {
  'GESA-FADE-IN': 'gesa-fade-in 0.5s ease-out',
  'GESA-SLIDE-UP': 'gesa-slide-up 0.5s ease-out',
  'GESA-BOUNCE-GENTLE': 'gesa-bounce-gentle 2s infinite',
} as const;

// Breakpoints
export const BREAKPOINTS = {
  SM: '640px',
  MD: '768px',
  LG: '1024px',
  XL: '1280px',
  '2XL': '1536px',
} as const;

// Z-Index Scale
export const Z_INDEX = {
  DROPDOWN: 1000,
  STICKY: 1020,
  FIXED: 1030,
  MODAL_BACKDROP: 1040,
  MODAL: 1050,
  POPOVER: 1060,
  TOOLTIP: 1070,
  TOAST: 1080,
} as const;

// Utility Functions
export const brandUtils = {
  /**
   * Get a color with opacity
   */
  colorWithOpacity: (color: string, opacity: number): string => {
    // Convert hex to rgba
    const hex = color.replace('#', '');
    const r = parseInt(hex.substr(0, 2), 16);
    const g = parseInt(hex.substr(2, 2), 16);
    const b = parseInt(hex.substr(4, 2), 16);
    return `rgba(${r}, ${g}, ${b}, ${opacity})`;
  },

  /**
   * Get a lighter shade of a color
   */
  lighten: (color: string, amount: number): string => {
    const hex = color.replace('#', '');
    const r = parseInt(hex.substr(0, 2), 16);
    const g = parseInt(hex.substr(2, 2), 16);
    const b = parseInt(hex.substr(4, 2), 16);
    
    const newR = Math.min(255, r + amount);
    const newG = Math.min(255, g + amount);
    const newB = Math.min(255, b + amount);
    
    return `#${Math.round(newR).toString(16).padStart(2, '0')}${Math.round(newG).toString(16).padStart(2, '0')}${Math.round(newB).toString(16).padStart(2, '0')}`;
  },

  /**
   * Get a darker shade of a color
   */
  darken: (color: string, amount: number): string => {
    const hex = color.replace('#', '');
    const r = parseInt(hex.substr(0, 2), 16);
    const g = parseInt(hex.substr(2, 2), 16);
    const b = parseInt(hex.substr(4, 2), 16);
    
    const newR = Math.max(0, r - amount);
    const newG = Math.max(0, g - amount);
    const newB = Math.max(0, b - amount);
    
    return `#${Math.round(newR).toString(16).padStart(2, '0')}${Math.round(newG).toString(16).padStart(2, '0')}${Math.round(newB).toString(16).padStart(2, '0')}`;
  },
};

// CSS Custom Properties for use in components
export const CSS_VARIABLES = {
  '--gesa-green': BRAND_COLORS.GREEN,
  '--gesa-olive': BRAND_COLORS.OLIVE,
  '--gesa-white': BRAND_COLORS.WHITE,
  '--gesa-orange': BRAND_COLORS.ORANGE,
  '--gesa-purple': BRAND_COLORS.PURPLE,
  '--gesa-primary': BRAND_COLORS.PRIMARY,
  '--gesa-secondary': BRAND_COLORS.SECONDARY,
  '--gesa-accent': BRAND_COLORS.ACCENT,
} as const;

// Export everything as a single object for easy importing
export const GESA_BRAND = {
  colors: BRAND_COLORS,
  typography: TYPOGRAPHY,
  spacing: SPACING,
  borderRadius: BORDER_RADIUS,
  shadows: SHADOWS,
  gradients: GRADIENTS,
  animations: ANIMATIONS,
  breakpoints: BREAKPOINTS,
  zIndex: Z_INDEX,
  utils: brandUtils,
  cssVariables: CSS_VARIABLES,
} as const;

// Default export
export default GESA_BRAND;
