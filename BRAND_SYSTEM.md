# 🌿 Gesa's Garden Brand System

This document explains how to use the Gesa's Garden brand colors, fonts, and design tokens across your entire site.

## 🎨 Brand Colors

### Primary Colors
- **Gesa Green** (`#4CAF50`) - Primary brand color, use for CTAs, links, and primary actions
- **Gesa Olive** (`#2E5339`) - Secondary brand color, use for headings and important text
- **Gesa White** (`#FFFFFF`) - Background color, use for cards and content areas

### Accent Colors
- **Gesa Orange** (`#F4A261`) - Energy color, use for hover states and secondary actions
- **Gesa Purple** (`#7B2CBF`) - Highlight color, use sparingly for special elements

## 🔤 Typography

### Font Families
- **Playfair Display** - Use for all headings (h1, h2, h3, h4, h5, h6)
- **Inter** - Use for body text, buttons, and UI elements

### Font Weights
- **Light** (300) - Subtle text
- **Normal** (400) - Body text
- **Medium** (500) - Emphasis
- **Semibold** (600) - Strong emphasis
- **Bold** (700) - Headings

## 🚀 How to Use

### 1. Tailwind CSS Classes (Recommended)

The easiest way to use your brand system is through Tailwind CSS classes:

```html
<!-- Colors -->
<div class="bg-gesa-green text-white">Primary Button</div>
<div class="bg-gesa-olive text-white">Secondary Button</div>
<div class="text-gesa-green">Green Text</div>
<div class="border-gesa-orange">Orange Border</div>

<!-- Typography -->
<h1 class="font-playfair text-hero text-gesa-olive">Hero Heading</h1>
<h2 class="font-playfair text-display text-gesa-olive">Display Heading</h2>
<p class="font-inter text-body text-gray-700">Body text</p>

<!-- Shadows -->
<div class="shadow-gesa">Card with Gesa shadow</div>
<div class="shadow-gesa-lg">Card with large Gesa shadow</div>

<!-- Gradients -->
<div class="bg-gradient-gesa">Gesa gradient background</div>
<div class="bg-gradient-gesa-subtle">Subtle Gesa gradient</div>

<!-- Animations -->
<div class="animate-gesa-fade-in">Fade in animation</div>
<div class="animate-gesa-slide-up">Slide up animation</div>
```

### 2. CSS Custom Properties

You can also use CSS custom properties directly:

```css
.custom-button {
  background-color: var(--gesa-green);
  color: var(--gesa-white);
  font-family: var(--gesa-playfair);
}

.custom-card {
  box-shadow: var(--gesa-shadow);
  border-radius: var(--gesa-border-radius);
}
```

### 3. TypeScript Constants

Import and use the brand constants in your Vue components:

```vue
<script setup lang="ts">
import { BRAND_COLORS, TYPOGRAPHY, GESA_BRAND } from '@/lib/brand';

// Use in your component logic
const primaryColor = BRAND_COLORS.GREEN;
const headingFont = TYPOGRAPHY.FONTS.PLAYFAIR;
</script>

<template>
  <div :style="{ color: BRAND_COLORS.GREEN }">
    This text uses the imported brand color
  </div>
</template>
```

## 📱 Responsive Design

Your brand system includes responsive breakpoints:

```html
<!-- Responsive typography -->
<h1 class="font-playfair text-2xl md:text-hero text-gesa-olive">
  Responsive Heading
</h1>

<!-- Responsive spacing -->
<div class="p-4 md:p-8 lg:p-12">
  Responsive padding
</div>
```

## 🎭 Component Examples

### Buttons
```html
<!-- Primary Button -->
<button class="bg-gesa-green hover:bg-gesa-orange text-white px-6 py-3 rounded-lg font-inter font-medium transition-colors duration-200">
  Get Started
</button>

<!-- Secondary Button -->
<button class="bg-gesa-olive hover:bg-gesa-green text-white px-6 py-3 rounded-lg font-inter font-medium transition-colors duration-200">
  Learn More
</button>

<!-- Outline Button -->
<button class="border-2 border-gesa-green text-gesa-green hover:bg-gesa-green hover:text-white px-6 py-3 rounded-lg font-inter font-medium transition-colors duration-200">
  View Menu
</button>
```

### Cards
```html
<!-- Standard Card -->
<div class="bg-white border border-gray-200 rounded-xl p-6 shadow-gesa hover:shadow-gesa-lg transition-shadow duration-300">
  <h3 class="font-playfair text-lg font-semibold text-gesa-olive mb-2">Card Title</h3>
  <p class="font-inter text-gray-600">Card content goes here.</p>
</div>

<!-- Gradient Card -->
<div class="bg-gradient-gesa-subtle border border-gray-200 rounded-xl p-6">
  <h3 class="font-playfair text-lg font-semibold text-gesa-olive mb-2">Gradient Card</h3>
  <p class="font-inter text-gray-600">This card uses a subtle Gesa gradient.</p>
</div>
```

### Navigation
```html
<nav class="bg-white/95 backdrop-blur-sm border-b border-green-100 sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <!-- Logo -->
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-gesa-green rounded-lg flex items-center justify-center">
          <Leaf class="w-5 h-5 text-white" />
        </div>
        <span class="font-playfair text-xl font-semibold text-gesa-olive">
          Gesa's Garden
        </span>
      </div>
      
      <!-- Navigation Links -->
      <div class="hidden md:block">
        <div class="ml-10 flex items-baseline space-x-8">
          <a href="#" class="font-inter text-gesa-olive hover:text-gesa-green px-3 py-2 text-sm font-medium transition-colors">
            How It Works
          </a>
          <a href="#" class="font-inter text-gesa-olive hover:text-gesa-green px-3 py-2 text-sm font-medium transition-colors">
            Menu
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
```

## 🔧 Customization

### Adding New Colors
To add new brand colors, update both files:

1. **`tailwind.config.js`** - Add to the `gesa` color object
2. **`resources/js/lib/brand.ts`** - Add to `BRAND_COLORS`
3. **`resources/css/app.css`** - Add CSS variable and utility classes

### Adding New Utilities
To add new utility classes:

1. **`tailwind.config.js`** - Add to the `extend` section
2. **`resources/css/app.css`** - Add to the `@layer utilities` section

## 📚 Best Practices

1. **Consistency** - Always use the brand colors and fonts for a cohesive look
2. **Accessibility** - Ensure sufficient contrast between text and background colors
3. **Hover States** - Use `hover:bg-gesa-orange` for primary buttons and `hover:bg-gesa-green` for secondary buttons
4. **Typography** - Use Playfair Display for headings and Inter for body text
5. **Spacing** - Use the defined spacing scale for consistent layouts
6. **Shadows** - Use `shadow-gesa` for cards and `shadow-gesa-lg` for elevated elements

## 🎨 Color Usage Guidelines

- **Green** (`#4CAF50`) - Primary actions, success states, CTAs
- **Olive** (`#2E5339`) - Headings, important text, navigation
- **Orange** (`#F4A261`) - Hover states, secondary actions, highlights
- **Purple** (`#7B2CBF`) - Special elements, badges, seasonal items
- **White** (`#FFFFFF`) - Backgrounds, cards, content areas

## 🚀 Getting Started

1. **Import the brand system** in your components:
   ```vue
   import { GESA_BRAND } from '@/lib/brand';
   ```

2. **Use Tailwind classes** for quick styling:
   ```html
   <div class="bg-gesa-green text-white font-playfair">
     Branded Content
   </div>
   ```

3. **Apply consistent spacing** using the defined scale:
   ```html
   <div class="p-8 space-y-6">
     <!-- 8 = 2rem padding, 6 = 1.5rem spacing between children -->
   </div>
   ```

4. **Use brand shadows** for depth:
   ```html
   <div class="shadow-gesa hover:shadow-gesa-lg">
     Interactive Card
   </div>
   ```

Your brand system is now available across your entire site! Use these utilities to maintain consistency and create a beautiful, cohesive user experience that reflects the fresh, healthy nature of Gesa's Garden.
