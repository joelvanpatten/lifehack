<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Calendar, Clock, Truck, User, Leaf } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useFlashMessages } from '@/composables/useFlashMessages';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin Dashboard',
        href: '/admin/dashboard',
    },
];

// Flash message composable
const { success, error, warning, info, message } = useFlashMessages();</script>

<template>
    <Head title="Dashboard - Gesa's Garden" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-4">
            <!-- Welcome Header -->
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-green-700 dark:text-green-400">
                    Welcome to Gesa's Garden
                </h1>
                <p class="mt-2 text-xl text-muted-foreground">
                    Fresh, healthy salads delivered to your door
                </p>
            </div>

            <!-- Quick Stats -->
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle class="text-sm font-medium">Next Delivery</CardTitle>
                        <Calendar class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">Card Content</div>
                        <p class="text-xs text-muted-foreground">Lorems & Ipsums</p>
                    </CardContent>
                </Card>
            </div>

            <!-- Quick Actions -->
            <Card>
                <CardHeader>
                    <CardTitle>Quick Actions</CardTitle>
                    <CardDescription>
                        Description goes here
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4 md:grid-cols-3">
                        <Button variant="outline" as-child class="h-auto flex-col items-start p-4">
                            <Link href="/profile">
                                <User class="h-6 w-6 mb-2" />
                                <span class="font-semibold">Update Profile</span>
                                <span class="text-sm text-muted-foreground">Change delivery preferences</span>
                            </Link>
                        </Button>

                        <Button variant="outline" as-child class="h-auto flex-col items-start p-4">
                            <Link href="/brand-examples">
                                <Leaf class="h-6 w-6 mb-2" />
                                <span class="font-semibold">Brand Examples</span>
                                <span class="text-sm text-muted-foreground">View design system & utilities</span>
                            </Link>
                        </Button>
                    </div>
                </CardContent>
            </Card>

            <!-- Recent Activity -->
            <Card>
                <CardHeader>
                    <CardTitle>Recent Activity</CardTitle>
                    <CardDescription>
                        Your latest delivery updates and account activity
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="h-2 w-2 rounded-full bg-green-500"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium">Delivery completed</p>
                                <p class="text-xs text-muted-foreground">Wednesday, June 12, 2024</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium">Delivery skipped</p>
                                <p class="text-xs text-muted-foreground">Wednesday, June 5, 2024</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="h-2 w-2 rounded-full bg-green-500"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium">Delivery completed</p>
                                <p class="text-xs text-muted-foreground">Wednesday, May 29, 2024</p>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Flash Message Demo -->
            <Card>
                <CardHeader>
                    <CardTitle>Flash Message Demo</CardTitle>
                    <CardDescription>
                        Test the flash message system with different message types
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <Button @click="success('This is a success message!')" variant="outline" class="h-auto flex-col items-start p-4">
                            <div class="h-6 w-6 mb-2 rounded-full bg-green-100 flex items-center justify-center">
                                <div class="h-3 w-3 rounded-full bg-green-600"></div>
                            </div>
                            <span class="font-semibold">Success</span>
                            <span class="text-sm text-muted-foreground">Show success message</span>
                        </Button>

                        <Button @click="error('This is an error message!')" variant="outline" class="h-auto flex-col items-start p-4">
                            <div class="h-6 w-6 mb-2 rounded-full bg-red-100 flex items-center justify-center">
                                <div class="h-3 w-3 rounded-full bg-red-600"></div>
                            </div>
                            <span class="font-semibold">Error</span>
                            <span class="text-sm text-muted-foreground">Show error message</span>
                        </Button>

                        <Button @click="warning('This is a warning message!')" variant="outline" class="h-auto flex-col items-start p-4">
                            <div class="h-6 w-6 mb-2 rounded-full bg-yellow-100 flex items-center justify-center">
                                <div class="h-3 w-3 rounded-full bg-yellow-600"></div>
                            </div>
                            <span class="font-semibold">Warning</span>
                            <span class="text-sm text-muted-foreground">Show warning message</span>
                        </Button>

                        <Button @click="info('This is an info message!')" variant="outline" class="h-auto flex-col items-start p-4">
                            <div class="h-6 w-6 mb-2 rounded-full bg-blue-100 flex items-center justify-center">
                                <div class="h-3 w-3 rounded-full bg-blue-600"></div>
                            </div>
                            <span class="font-semibold">Info</span>
                            <span class="text-sm text-muted-foreground">Show info message</span>
                        </Button>

                        <Button @click="message('This is a default message!')" variant="outline" class="h-auto flex-col items-start p-4">
                            <div class="h-6 w-6 mb-2 rounded-full bg-gray-100 flex items-center justify-center">
                                <div class="h-3 w-3 rounded-full bg-gray-600"></div>
                            </div>
                            <span class="font-semibold">Message</span>
                            <span class="text-sm text-muted-foreground">Show default message</span>
                        </Button>

                        <Button as-child variant="outline" class="h-auto flex-col items-start p-4">
                            <Link href="/test">
                                <div class="h-6 w-6 mb-2 rounded-full bg-purple-100 flex items-center justify-center">
                                    <div class="h-3 w-3 rounded-full bg-purple-600"></div>
                                </div>
                                <span class="font-semibold">Server Test</span>
                                <span class="text-sm text-muted-foreground">Test server-side messages</span>
                            </Link>
                        </Button>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>