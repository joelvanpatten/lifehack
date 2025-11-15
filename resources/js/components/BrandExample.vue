<script setup lang="ts">
import { BRAND_COLORS, TYPOGRAPHY, GESA_BRAND } from '@/lib/brand';
</script>

<template>
  <div class="p-8 space-y-8">
    <!-- Brand Colors Demo -->
    <section class="space-y-4">
      <h2 class="font-playfair text-title text-gesa-olive">Brand Colors</h2>
      <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="text-center">
          <div class="w-20 h-20 bg-gesa-green rounded-lg mb-2"></div>
          <p class="text-sm font-inter text-gray-600">Gesa Green</p>
          <p class="text-xs font-inter text-gray-500">{{ BRAND_COLORS.GREEN }}</p>
        </div>
        <div class="text-center">
          <div class="w-20 h-20 bg-gesa-olive rounded-lg mb-2"></div>
          <p class="text-sm font-inter text-gray-600">Gesa Olive</p>
          <p class="text-xs font-inter text-gray-500">{{ BRAND_COLORS.OLIVE }}</p>
        </div>
        <div class="text-center">
          <div class="w-20 h-20 bg-gesa-orange rounded-lg mb-2"></div>
          <p class="text-sm font-inter text-gray-600">Gesa Orange</p>
          <p class="text-xs font-inter text-gray-500">{{ BRAND_COLORS.ORANGE }}</p>
        </div>
        <div class="text-center">
          <div class="w-20 h-20 bg-gesa-purple rounded-lg mb-2"></div>
          <p class="text-sm font-inter text-gray-600">Gesa Purple</p>
          <p class="text-xs font-inter text-gray-500">{{ BRAND_COLORS.PURPLE }}</p>
        </div>
        <div class="text-center">
          <div class="w-20 h-20 bg-gesa-white border border-gray-200 rounded-lg mb-2"></div>
          <p class="text-sm font-inter text-gray-600">Gesa White</p>
          <p class="text-xs font-inter text-gray-500">{{ BRAND_COLORS.WHITE }}</p>
        </div>
      </div>
    </section>

    <!-- Typography Demo -->
    <section class="space-y-4">
      <h2 class="font-playfair text-title text-gesa-olive">Typography</h2>
      <div class="space-y-2">
        <h1 class="font-playfair text-hero text-gesa-green">Hero Heading</h1>
        <h2 class="font-playfair text-display text-gesa-olive">Display Heading</h2>
        <h3 class="font-playfair text-title text-gesa-olive">Title Heading</h3>
        <h4 class="font-playfair text-subtitle text-gesa-olive">Subtitle Heading</h4>
        <p class="font-inter text-body text-gray-700">Body text using Inter font family</p>
        <p class="font-inter text-caption text-gray-500">Caption text for smaller details</p>
      </div>
    </section>

    <!-- Utility Classes Demo -->
    <section class="space-y-4">
      <h2 class="font-playfair text-title text-gesa-olive">Utility Classes</h2>
      
      <!-- Buttons -->
      <div class="space-y-4">
        <h3 class="font-inter text-subtitle text-gesa-olive">Buttons</h3>
        <div class="flex flex-wrap gap-4">
          <button class="bg-gesa-green hover:bg-gesa-orange text-white px-6 py-3 rounded-lg font-inter font-medium transition-colors duration-200">
            Primary Button
          </button>
          <button class="bg-gesa-olive hover:bg-gesa-green text-white px-6 py-3 rounded-lg font-inter font-medium transition-colors duration-200">
            Secondary Button
          </button>
          <button class="border-2 border-gesa-green text-gesa-green hover:bg-gesa-green hover:text-white px-6 py-3 rounded-lg font-inter font-medium transition-colors duration-200">
            Outline Button
          </button>
        </div>
      </div>

      <!-- Cards -->
      <div class="space-y-4">
        <h3 class="font-inter text-subtitle text-gesa-olive">Cards</h3>
        <div class="grid md:grid-cols-3 gap-6">
          <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-gesa hover:shadow-gesa-lg transition-shadow duration-300">
            <h4 class="font-playfair text-lg font-semibold text-gesa-olive mb-2">Card Title</h4>
            <p class="font-inter text-gray-600">This card uses the Gesa brand shadow and hover effects.</p>
          </div>
          <div class="bg-gradient-gesa-subtle border border-gray-200 rounded-xl p-6">
            <h4 class="font-playfair text-lg font-semibold text-gesa-olive mb-2">Gradient Card</h4>
            <p class="font-inter text-gray-600">This card uses the subtle Gesa gradient background.</p>
          </div>
          <div class="bg-gesa-green text-white rounded-xl p-6">
            <h4 class="font-playfair text-lg font-semibold mb-2">Brand Color Card</h4>
            <p class="font-inter opacity-90">This card uses the primary Gesa green color.</p>
          </div>
        </div>
      </div>

      <!-- Animations -->
      <div class="space-y-4">
        <h3 class="font-inter text-subtitle text-gesa-olive">Animations</h3>
        <div class="flex gap-4">
          <div class="animate-gesa-fade-in bg-gesa-orange text-white px-6 py-3 rounded-lg font-inter">
            Fade In Animation
          </div>
          <div class="animate-gesa-slide-up bg-gesa-purple text-white px-6 py-3 rounded-lg font-inter">
            Slide Up Animation
          </div>
          <div class="animate-gesa-bounce-gentle bg-gesa-green text-white px-6 py-3 rounded-lg font-inter">
            Bounce Animation
          </div>
        </div>
      </div>
    </section>

    <!-- Imported Constants Demo -->
    <section class="space-y-4">
      <h2 class="font-playfair text-title text-gesa-olive">Imported Constants</h2>
      <div class="bg-gray-50 p-6 rounded-lg">
        <p class="font-inter text-gray-700 mb-2">
          <strong>Primary Color:</strong> {{ GESA_BRAND.colors.PRIMARY }}
        </p>
        <p class="font-inter text-gray-700 mb-2">
          <strong>Font Family:</strong> {{ GESA_BRAND.typography.FONTS.PLAYFAIR }}
        </p>
        <p class="font-inter text-gray-700 mb-2">
          <strong>Spacing XL:</strong> {{ GESA_BRAND.spacing.XL }}
        </p>
        <p class="font-inter text-gray-700">
          <strong>Border Radius LG:</strong> {{ GESA_BRAND.borderRadius.LG }}
        </p>
      </div>
    </section>
  </div>
</template>

<style scoped>
/* You can also use the CSS variables directly */
.custom-style {
  color: var(--gesa-green);
  background: var(--gesa-olive);
  font-family: var(--gesa-playfair);
}
</style>
