<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import BrandExample from '@/components/BrandExample.vue';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Brand Examples',
        href: '/brand-examples',
    },
];
</script>

<template>
    <Head title="Brand Examples - Gesa's Garden" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="min-h-screen bg-gray-50">
            <!-- Header -->
            <div class="bg-white border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="text-center space-y-4">
                        <h1 class="font-playfair text-4xl font-bold text-gesa-olive">
                            🌿 Brand System Examples
                        </h1>
                        <p class="font-inter text-xl text-gray-600 max-w-3xl mx-auto">
                            A comprehensive showcase of all available brand utilities, colors, fonts, and design tokens for Gesa's Garden
                        </p>
                        <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
                            <span class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-gesa-green rounded-full"></div>
                                <span>Available to logged-in users only</span>
                            </span>
                            <span class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-gesa-orange rounded-full"></div>
                                <span>Developer reference</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Brand Examples Component -->
            <div class="py-8">
                <BrandExample />
            </div>

            <!-- Usage Instructions -->
            <div class="bg-white border-t border-gray-200 py-12">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center space-y-6">
                        <h2 class="font-playfair text-2xl font-bold text-gesa-olive">
                            How to Use This Brand System
                        </h2>
                        <div class="grid md:grid-cols-3 gap-6 text-left">
                            <div class="space-y-3">
                                <h3 class="font-inter font-semibold text-gesa-green">1. Tailwind Classes</h3>
                                <p class="font-inter text-sm text-gray-600">
                                    Use utility classes like <code class="bg-gray-100 px-1 rounded">bg-gesa-green</code>, 
                                    <code class="bg-gray-100 px-1 rounded">font-playfair</code>, etc.
                                </p>
                            </div>
                            <div class="space-y-3">
                                <h3 class="font-inter font-semibold text-gesa-green">2. TypeScript Constants</h3>
                                <p class="font-inter text-sm text-gray-600">
                                    Import <code class="bg-gray-100 px-1 rounded">GESA_BRAND</code> for programmatic access to colors, fonts, and utilities.
                                </p>
                            </div>
                            <div class="space-y-3">
                                <h3 class="font-inter font-semibold text-gesa-green">3. CSS Variables</h3>
                                <p class="font-inter text-sm text-gray-600">
                                    Use <code class="bg-gray-100 px-1 rounded">var(--gesa-green)</code> in custom CSS for advanced styling.
                                </p>
                            </div>
                        </div>
                        <div class="pt-6">
                            <a 
                                href="/BRAND_SYSTEM.md" 
                                target="_blank"
                                class="inline-flex items-center space-x-2 bg-gesa-green hover:bg-gesa-orange text-white px-6 py-3 rounded-lg font-inter font-medium transition-colors duration-200"
                            >
                                <span>📚 View Full Documentation</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
