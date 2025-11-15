<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Leaf, Clock, Truck, Star, Users, Salad, Calendar } from 'lucide-vue-next';
</script>

<template>
    <Head title="Gesa's Garden - Fresh, Healthy Salads Delivered">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </Head>

    <div class="min-h-screen bg-white">
        <!-- Navigation -->
        <nav class="bg-white/95 backdrop-blur-sm border-b border-green-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-[#4CAF50] rounded-lg flex items-center justify-center">
                                    <Leaf class="w-5 h-5 text-white" />
                                </div>
                                <span class="font-['Playfair_Display'] text-xl font-semibold text-[#2E5339]">
                                    Gesa's Garden
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-8">
                            <a href="#how-it-works" class="font-['Inter'] text-[#2E5339] hover:text-[#4CAF50] px-3 py-2 text-sm font-medium transition-colors">
                                How It Works
                            </a>
                            <a href="#menu" class="font-['Inter'] text-[#2E5339] hover:text-[#4CAF50] px-3 py-2 text-sm font-medium transition-colors">
                                Menu
                            </a>
                            <a href="#about" class="font-['Inter'] text-[#2E5339] hover:text-[#4CAF50] px-3 py-2 text-sm font-medium transition-colors">
                                About
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <Link 
                            :href="route('login')" 
                            class="font-['Inter'] text-[#2E5339] hover:text-[#4CAF50] px-3 py-2 text-sm font-medium transition-colors"
                        >
                            Log in
                        </Link>
                        <Link 
                            :href="route('register')" 
                            class="bg-[#4CAF50] hover:bg-[#F4A261] text-white px-4 py-2 rounded-lg font-['Inter'] text-sm font-medium transition-colors duration-200"
                        >
                            Get Started
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 to-white py-20 lg:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <h1 class="font-['Playfair_Display'] text-4xl lg:text-6xl font-bold text-[#2E5339] leading-tight">
                                Fresh, Healthy Salads
                                <span class="text-[#4CAF50]">Delivered</span>
                            </h1>
                            <p class="font-['Inter'] text-xl text-gray-600 max-w-2xl leading-relaxed">
                                Experience the crisp, vibrant flavors of locally-sourced ingredients in every bowl. 
                                Our hearty salads are crafted with care and delivered fresh to your door.
                            </p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <Link 
                                :href="route('register')" 
                                class="bg-[#4CAF50] hover:bg-[#F4A261] text-white px-8 py-4 rounded-lg font-['Inter'] text-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl"
                            >
                                Start Your Subscription
                            </Link>
                            <Link 
                                :href="route('login')" 
                                class="border-2 border-[#4CAF50] text-[#4CAF50] hover:bg-[#4CAF50] hover:text-white px-8 py-4 rounded-lg font-['Inter'] text-lg font-semibold transition-all duration-200"
                            >
                                View Menu
                            </Link>
                        </div>

                        <div class="flex items-center space-x-8 text-sm text-gray-600">
                            <div class="flex items-center space-x-2">
                                <Clock class="w-5 h-5 text-[#4CAF50]" />
                                <span class="font-['Inter']">Weekly Delivery</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <Truck class="w-5 h-5 text-[#4CAF50]" />
                                <span class="font-['Inter']">Free Delivery</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <Star class="w-5 h-5 text-[#4CAF50]" />
                                <span class="font-['Inter']">Fresh Daily</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="relative z-10">
                            <div class="bg-gradient-to-br from-[#4CAF50] to-[#2E5339] rounded-3xl p-8 shadow-2xl">
                                <div class="bg-white rounded-2xl p-6 shadow-lg">
                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between">
                                            <h3 class="font-['Playfair_Display'] text-xl font-semibold text-[#2E5339]">
                                                This Week's Special
                                            </h3>
                                            <span class="bg-[#7B2CBF] text-white px-3 py-1 rounded-full text-xs font-['Inter'] font-medium">
                                                New!
                                            </span>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 bg-[#4CAF50] rounded-full"></div>
                                                <span class="font-['Inter'] text-[#2E5339]">Mixed Greens & Arugula</span>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 bg-[#F4A261] rounded-full"></div>
                                                <span class="font-['Inter'] text-[#2E5339]">Roasted Sweet Potatoes</span>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <div class="w-3 h-3 bg-[#7B2CBF] rounded-full"></div>
                                                <span class="font-['Inter'] text-[#2E5339]">Beet & Goat Cheese</span>
                                            </div>
                                        </div>
                                        <div class="pt-4 border-t border-gray-100">
                                            <div class="flex items-center justify-between">
                                                <span class="font-['Inter'] text-sm text-gray-600">Next Delivery:</span>
                                                <span class="font-['Inter'] font-semibold text-[#4CAF50]">Wednesday</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -top-4 -right-4 w-24 h-24 bg-[#F4A261] rounded-full opacity-20"></div>
                        <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-[#7B2CBF] rounded-full opacity-20"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center space-y-4 mb-16">
                    <h2 class="font-['Playfair_Display'] text-4xl font-bold text-[#2E5339]">
                        How It Works
                    </h2>
                    <p class="font-['Inter'] text-xl text-gray-600 max-w-3xl mx-auto">
                        Get fresh, healthy salads delivered to your door in just three simple steps
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center space-y-4">
                        <div class="mx-auto w-16 h-16 bg-[#4CAF50] rounded-full flex items-center justify-center">
                            <span class="font-['Playfair_Display'] text-2xl font-bold text-white">1</span>
                        </div>
                        <h3 class="font-['Playfair_Display'] text-xl font-semibold text-[#2E5339]">
                            Choose Your Plan
                        </h3>
                        <p class="font-['Inter'] text-gray-600">
                            Select from our weekly or bi-weekly subscription plans. 
                            Customize your delivery schedule and preferences.
                        </p>
                    </div>

                    <div class="text-center space-y-4">
                        <div class="mx-auto w-16 h-16 bg-[#2E5339] rounded-full flex items-center justify-center">
                            <span class="font-['Playfair_Display'] text-2xl font-bold text-white">2</span>
                        </div>
                        <h3 class="font-['Playfair_Display'] text-xl font-semibold text-[#2E5339]">
                            We Harvest Fresh
                        </h3>
                        <p class="font-['Inter'] text-gray-600">
                            Our team hand-picks the freshest ingredients from local farms 
                            and prepares your salads with care.
                        </p>
                    </div>

                    <div class="text-center space-y-4">
                        <div class="mx-auto w-16 h-16 bg-[#F4A261] rounded-full flex items-center justify-center">
                            <span class="font-['Playfair_Display'] text-2xl font-bold text-white">3</span>
                        </div>
                        <h3 class="font-['Playfair_Display'] text-xl font-semibold text-[#2E5339]">
                            Fresh Delivery
                        </h3>
                        <p class="font-['Inter'] text-gray-600">
                            Enjoy your crisp, fresh salads delivered right to your doorstep 
                            on your chosen delivery day.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Salads Section -->
        <section id="menu" class="py-20 bg-gradient-to-br from-green-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center space-y-4 mb-16">
                    <h2 class="font-['Playfair_Display'] text-4xl font-bold text-[#2E5339]">
                        Our Signature Salads
                    </h2>
                    <p class="font-['Inter'] text-xl text-gray-600 max-w-3xl mx-auto">
                        Each salad is crafted with seasonal ingredients and bold flavors
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <Card class="bg-white border-0 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <CardHeader class="pb-4">
                            <div class="w-full h-48 bg-gradient-to-br from-green-200 to-green-300 rounded-t-lg flex items-center justify-center">
                                <Salad class="w-16 h-16 text-[#4CAF50]" />
                            </div>
                        </CardHeader>
                        <CardContent class="space-y-3">
                            <CardTitle class="font-['Playfair_Display'] text-xl text-[#2E5339]">
                                Garden Harvest
                            </CardTitle>
                            <CardDescription class="font-['Inter'] text-gray-600">
                                Mixed greens, cherry tomatoes, cucumber, radish, and our house vinaigrette
                            </CardDescription>
                            <div class="flex items-center justify-between pt-2">
                                <span class="font-['Inter'] font-semibold text-[#4CAF50]">$12.99</span>
                                <span class="bg-[#4CAF50] text-white px-3 py-1 rounded-full text-xs font-['Inter'] font-medium">
                                    Popular
                                </span>
                            </div>
                        </CardContent>
                    </Card>

                    <Card class="bg-white border-0 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <CardHeader class="pb-4">
                            <div class="w-full h-48 bg-gradient-to-br from-orange-200 to-orange-300 rounded-t-lg flex items-center justify-center">
                                <Salad class="w-16 h-16 text-[#F4A261]" />
                            </div>
                        </CardHeader>
                        <CardContent class="space-y-3">
                            <CardTitle class="font-['Playfair_Display'] text-xl text-[#2E5339]">
                                Autumn Roots
                            </CardTitle>
                            <CardDescription class="font-['Inter'] text-gray-600">
                                Roasted sweet potatoes, beets, goat cheese, and maple balsamic
                            </CardDescription>
                            <div class="flex items-center justify-between pt-2">
                                <span class="font-['Inter'] font-semibold text-[#4CAF50]">$14.99</span>
                                <span class="bg-[#7B2CBF] text-white px-3 py-1 rounded-full text-xs font-['Inter'] font-medium">
                                    Seasonal
                                </span>
                            </div>
                        </CardContent>
                    </Card>

                    <Card class="bg-white border-0 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <CardHeader class="pb-4">
                            <div class="w-full h-48 bg-gradient-to-br from-purple-200 to-purple-300 rounded-t-lg flex items-center justify-center">
                                <Salad class="w-16 h-16 text-[#7B2CBF]" />
                            </div>
                        </CardHeader>
                        <CardContent class="space-y-3">
                            <CardTitle class="font-['Playfair_Display'] text-xl text-[#2E5339]">
                                Mediterranean Bowl
                            </CardTitle>
                            <CardDescription class="font-['Inter'] text-gray-600">
                                Quinoa, olives, feta, roasted peppers, and lemon herb dressing
                            </CardDescription>
                            <div class="flex items-center justify-between pt-2">
                                <span class="font-['Inter'] font-semibold text-[#4CAF50]">$15.99</span>
                                <span class="bg-[#F4A261] text-white px-3 py-1 rounded-full text-xs font-['Inter'] font-medium">
                                    Protein Rich
                                </span>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <div class="text-center mt-12">
                    <Link 
                        :href="route('register')" 
                        class="bg-[#4CAF50] hover:bg-[#F4A261] text-white px-8 py-4 rounded-lg font-['Inter'] text-lg font-semibold transition-all duration-200 inline-flex items-center space-x-2"
                    >
                        <span>View Full Menu</span>
                        <Salad class="w-5 h-5" />
                    </Link>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <h2 class="font-['Playfair_Display'] text-4xl font-bold text-[#2E5339]">
                            About Gesa's Garden
                        </h2>
                        <p class="font-['Inter'] text-lg text-gray-600 leading-relaxed">
                            We believe that healthy eating should be delicious, convenient, and sustainable. 
                            Our mission is to bring the freshest, most flavorful ingredients from local farms 
                            directly to your table.
                        </p>
                        <p class="font-['Inter'] text-lg text-gray-600 leading-relaxed">
                            Every salad is handcrafted with care, using seasonal produce and bold flavors 
                            that will make you excited about eating healthy. We're committed to supporting 
                            local farmers and reducing our environmental impact.
                        </p>
                        
                        <div class="grid grid-cols-2 gap-6 pt-6">
                            <div class="text-center">
                                <div class="text-3xl font-['Playfair_Display'] font-bold text-[#4CAF50]">500+</div>
                                <div class="font-['Inter'] text-sm text-gray-600">Happy Customers</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-['Playfair_Display'] font-bold text-[#4CAF50]">50+</div>
                                <div class="font-['Inter'] text-sm text-gray-600">Local Farms</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="bg-gradient-to-br from-[#4CAF50] to-[#2E5339] rounded-3xl p-8">
                            <div class="bg-white rounded-2xl p-6 space-y-4">
                                <h3 class="font-['Playfair_Display'] text-xl font-semibold text-[#2E5339]">
                                    Why Choose Us?
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-[#4CAF50] rounded-full"></div>
                                        <span class="font-['Inter'] text-sm text-[#2E5339]">100% Organic Ingredients</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-[#4CAF50] rounded-full"></div>
                                        <span class="font-['Inter'] text-sm text-[#2E5339]">Local Farm Partnerships</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-[#4CAF50] rounded-full"></div>
                                        <span class="font-['Inter'] text-sm text-[#2E5339]">Eco-Friendly Packaging</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-[#4CAF50] rounded-full"></div>
                                        <span class="font-['Inter'] text-sm text-[#2E5339]">Flexible Delivery Options</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-[#2E5339] to-[#4CAF50]">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="font-['Playfair_Display'] text-4xl font-bold text-white mb-6">
                    Ready to Experience Fresh?
                </h2>
                <p class="font-['Inter'] text-xl text-green-100 mb-8 max-w-2xl mx-auto">
                    Join hundreds of customers who are already enjoying fresh, healthy salads delivered weekly
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <Link 
                        :href="route('register')" 
                        class="bg-white text-[#2E5339] hover:bg-green-50 px-8 py-4 rounded-lg font-['Inter'] text-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg"
                    >
                        Start Your Subscription
                    </Link>
                    <Link 
                        :href="route('login')" 
                        class="border-2 border-white text-white hover:bg-white hover:text-[#2E5339] px-8 py-4 rounded-lg font-['Inter'] text-lg font-semibold transition-all duration-200"
                    >
                        Log In
                    </Link>
                </div>
            </div>
        </section>



        <!-- Footer -->
        <footer class="bg-[#2E5339] text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-[#4CAF50] rounded-lg flex items-center justify-center">
                                <Leaf class="w-5 h-5 text-white" />
                            </div>
                            <span class="font-['Playfair_Display'] text-xl font-semibold">
                                Gesa's Garden
                            </span>
                        </div>
                        <p class="font-['Inter'] text-green-100 text-sm">
                            Fresh, healthy salads delivered to your door
                        </p>
                    </div>
                    
                    <div class="space-y-4">
                        <h3 class="font-['Playfair_Display'] font-semibold">Quick Links</h3>
                        <ul class="space-y-2 font-['Inter'] text-sm text-green-100">
                            <li><a href="#how-it-works" class="hover:text-white transition-colors">How It Works</a></li>
                            <li><a href="#menu" class="hover:text-white transition-colors">Menu</a></li>
                            <li><a href="#about" class="hover:text-white transition-colors">About</a></li>
                        </ul>
                    </div>
                    
                    <div class="space-y-4">
                        <h3 class="font-['Playfair_Display'] font-semibold">Support</h3>
                        <ul class="space-y-2 font-['Inter'] text-sm text-green-100">
                            <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Delivery Info</a></li>
                        </ul>
                    </div>
                    
                    <div class="space-y-4">
                        <h3 class="font-['Playfair_Display'] font-semibold">Connect</h3>
                        <ul class="space-y-2 font-['Inter'] text-sm text-green-100">
                            <li><a href="#" class="hover:text-white transition-colors">Instagram</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Facebook</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Newsletter</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-green-700 mt-8 pt-8 text-center">
                    <p class="font-['Inter'] text-sm text-green-100">
                        © 2024 Gesa's Garden. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
/* Custom font classes */
.font-playfair {
    font-family: 'Playfair Display', serif;
}

.font-inter {
    font-family: 'Inter', sans-serif;
}
</style>
