<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import { Calendar, CalendarDays, Clock, MapPin, Truck } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import axios from 'axios';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Calendar',
        href: '/calendar',
    },
];

// State
const selectedDate = ref<Date | null>(null);
const isModalOpen = ref(false);
const deliveryDay = ref('Wednesday'); // Default delivery day
const deliveryTime = ref('9:00 AM - 2:00 PM');
const subscription = ref<any>(null);
const deliveryDates = ref<any[]>([]);
const loading = ref(false);
const error = ref<string | null>(null);

// Computed properties for calendar
const currentDate = ref(new Date());
const currentMonth = computed(() => currentDate.value.getMonth());
const currentYear = computed(() => currentDate.value.getFullYear());

// Generate calendar dates for current month
const calendarDates = computed(() => {
    const firstDay = new Date(currentYear.value, currentMonth.value, 1);
    const lastDay = new Date(currentYear.value, currentMonth.value + 1, 0);
    const startDate = new Date(firstDay);
    startDate.setDate(startDate.getDate() - firstDay.getDay());

    const dates = [];
    const current = new Date(startDate);

    while (current <= lastDay || dates.length < 42) {
        dates.push(new Date(current));
        current.setDate(current.getDate() + 1);
    }

    return dates;
});

// Check if a date is a delivery date
const isDeliveryDate = (date: Date) => {
    const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    return dayNames[date.getDay()] === deliveryDay.value;
};

// Check delivery status for a specific date
const getDeliveryStatus = (date: Date) => {
    const dateString = date.toISOString().split('T')[0];
    const status = deliveryDates.value.find(dd => {
        const apiDate = dd.delivery_date.split('T')[0]; // Normalize API date
        return apiDate === dateString;
    });
    console.log(`Delivery status for ${dateString}:`, status || 'No status found');
    return status || (isDeliveryDate(date) && !isPastDate(date) ? { status: 'scheduled' } : null);
};

// Check if a delivery date is clickable (future delivery date)
const isDeliveryClickable = (date: Date) => {
    if (!isDeliveryDate(date) || isPastDate(date)) return false;

    const deliveryStatus = getDeliveryStatus(date);
    return deliveryStatus?.status === 'scheduled';
};

// Check if a date is today
const isToday = (date: Date) => {
    const today = new Date();
    return date.toDateString() === today.toDateString();
};

// Check if a date is in the past
const isPastDate = (date: Date) => {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    return date < today;
};

// Navigation
const previousMonth = () => {
    currentDate.value = new Date(currentYear.value, currentMonth.value - 1, 1);
    fetchMonthData(currentYear.value, currentMonth.value - 1);
};

const nextMonth = () => {
    currentDate.value = new Date(currentYear.value, currentMonth.value + 1, 1);
    fetchMonthData(currentYear.value, currentMonth.value + 1);
};

// Load data when component mounts
onMounted(() => {
    fetchCalendarData();
});

// Modal actions
const skipWeek = async () => {
    if (!selectedDate.value) return;

    try {
        await axios.post('/api/calendar/skip', {
            delivery_date: selectedDate.value.toISOString().split('T')[0],
        });

        // Refresh calendar data
        await fetchCalendarData();
        isModalOpen.value = false;

        console.log('Delivery skipped successfully');
    } catch (err) {
        console.error('Error skipping delivery:', err);
        error.value = err.response?.data?.message || err.message || 'Failed to skip delivery';
    }
};

const cancelService = async () => {
    try {
        await axios.post('/api/calendar/cancel');

        // Refresh calendar data
        await fetchCalendarData();
        isModalOpen.value = false;

        console.log('Service cancelled successfully');
    } catch (err) {
        console.error('Error cancelling service:', err);
        error.value = err.response?.data?.message || err.message || 'Failed to cancel service';
    }
};

const openModal = (date: Date) => {
    if (isDeliveryClickable(date)) {
        selectedDate.value = date;
        isModalOpen.value = true;
    }
};

const formatDate = (date: Date) => {
    return date.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};

const formatDeliveryTime = (startTime: string, endTime: string): string => {
    try {
        let start, end;

        if (startTime instanceof Date) {
            start = startTime;
        } else if (typeof startTime === 'string') {
            const startParts = startTime.split(':');
            start = new Date(2000, 0, 1, parseInt(startParts[0]), parseInt(startParts[1]), startParts[2] ? parseInt(startParts[2]) : 0);
        } else {
            throw new Error('Invalid start time format');
        }

        if (endTime instanceof Date) {
            end = endTime;
        } else if (typeof endTime === 'string') {
            const endParts = endTime.split(':');
            end = new Date(2000, 0, 1, parseInt(endParts[0]), parseInt(endParts[1]), endParts[2] ? parseInt(endParts[2]) : 0);
        } else {
            throw new Error('Invalid end time format');
        }

        if (isNaN(start.getTime()) || isNaN(end.getTime())) {
            throw new Error('Invalid date created');
        }

        const startFormatted = start.toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });

        const endFormatted = end.toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });

        return `${startFormatted} - ${endFormatted}`;
    } catch (error) {
        console.error('Error formatting delivery time:', error, { startTime, endTime });
        return `${startTime} - ${endTime}`;
    }
};

const getDeliveryWindowDescription = (startTime: string, endTime: string): string => {
    try {
        let start;

        if (startTime instanceof Date) {
            start = startTime;
        } else if (typeof startTime === 'string') {
            const startParts = startTime.split(':');
            start = new Date(2000, 0, 1, parseInt(startParts[0]), parseInt(startParts[1]), startParts[2] ? parseInt(startParts[2]) : 0);
        } else {
            throw new Error('Invalid start time format');
        }

        if (isNaN(start.getTime())) {
            throw new Error('Invalid date created');
        }

        const startHour = start.getHours();

        if (startHour < 12) {
            return 'Morning delivery';
        } else if (startHour < 17) {
            return 'Afternoon delivery';
        } else {
            return 'Evening delivery';
        }
    } catch (error) {
        console.error('Error getting delivery window description:', error, { startTime });
        return 'Flexible delivery window';
    }
};

const monthNames = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
];

// API functions
const fetchCalendarData = async () => {
    loading.value = true;
    error.value = null;

    try {
        const response = await axios.get('/api/calendar');
        subscription.value = response.data.subscription;
        deliveryDates.value = response.data.delivery_dates || [];
        console.log('Fetched delivery dates:', deliveryDates.value);
        console.log('Subscription:', subscription.value);
    } catch (err) {
        error.value = err.response?.data?.message || err.message || 'An error occurred';
        console.error('Error fetching calendar data:', err);
    } finally {
        loading.value = false;
    }
};

const fetchMonthData = async (year: number, month: number) => {
    try {
        const response = await axios.get(`/api/calendar/month?year=${year}&month=${month}`);
        const newDeliveryDates = response.data.delivery_dates || [];
        console.log(`Fetched month data for ${year}-${month + 1}:`, newDeliveryDates);

        // Merge new data with existing deliveryDates, updating only matching dates
        deliveryDates.value = [
            // Keep existing dates that are not in the fetched month
            ...deliveryDates.value.filter(dd => {
                const date = new Date(dd.delivery_date);
                return date.getFullYear() !== year || date.getMonth() !== month;
            }),
            // Add or update dates from the new response
            ...newDeliveryDates.map(dd => ({
                delivery_date: dd.delivery_date.split('T')[0],
                status: dd.status
            }))
        ];
        console.log('Updated deliveryDates:', deliveryDates.value);
    } catch (err) {
        console.error('Error fetching month data:', err);
    }
};
</script>

<template>
    <Head title="Calendar - Gesa's Garden" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-4">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Delivery Calendar</h1>
                    <p class="text-muted-foreground">
                        Manage your weekly fresh salad deliveries
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <Calendar class="h-5 w-5 text-primary" />
                    <span class="text-sm font-medium">{{ deliveryDay }}s</span>
                </div>
            </div>

            <!-- Error Message -->
            <div v-if="error" class="rounded-lg border border-red-200 bg-red-50 p-4 dark:border-red-800 dark:bg-red-950">
                <p class="text-sm text-red-800 dark:text-red-200">{{ error }}</p>
            </div>

            <!-- Loading State -->
            <div v-if="loading" class="flex items-center justify-center p-8">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto mb-2"></div>
                    <p class="text-muted-foreground">Loading calendar data...</p>
                </div>
            </div>

            <!-- Delivery Info Card -->
            <Card v-if="!loading">
                <CardHeader>
                    <CardTitle class="flex items-center gap-2">
                        <Truck class="h-5 w-5" />
                        Delivery Information
                    </CardTitle>
                    <CardDescription>
                        Your weekly delivery schedule and preferences
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="flex items-center gap-3">
                            <CalendarDays class="h-5 w-5 text-muted-foreground" />
                            <div>
                                <p class="font-medium">Delivery Day</p>
                                <p class="text-sm text-muted-foreground">{{ deliveryDay }}s</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <Clock class="h-5 w-5 text-muted-foreground" />
                            <div>
                                <p class="font-medium">Delivery Window</p>
                                <p class="text-sm text-muted-foreground">{{ deliveryTime }}</p>
                                <p class="text-xs text-muted-foreground">
                                    {{ subscription ? getDeliveryWindowDescription(subscription.delivery_start_time, subscription.delivery_end_time) : 'Flexible delivery window' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Calendar -->
            <Card v-if="!loading">
                <CardHeader>
                    <div class="flex items-center justify-between">
                        <CardTitle>Delivery Calendar</CardTitle>
                        <div class="flex items-center gap-2">
                            <Button variant="outline" size="sm" @click="previousMonth">
                                ←
                            </Button>
                            <span class="text-lg font-semibold">
                                {{ monthNames[currentMonth] }} {{ currentYear }}
                            </span>
                            <Button variant="outline" size="sm" @click="nextMonth">
                                →
                            </Button>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <!-- Calendar Grid -->
                    <div class="grid grid-cols-7 gap-1">
                        <!-- Day headers -->
                        <div class="p-2 text-center text-sm font-medium text-muted-foreground">Sun</div>
                        <div class="p-2 text-center text-sm font-medium text-muted-foreground">Mon</div>
                        <div class="p-2 text-center text-sm font-medium text-muted-foreground">Tue</div>
                        <div class="p-2 text-center text-sm font-medium text-muted-foreground">Wed</div>
                        <div class="p-2 text-center text-sm font-medium text-muted-foreground">Thu</div>
                        <div class="p-2 text-center text-sm font-medium text-muted-foreground">Fri</div>
                        <div class="p-2 text-center text-sm font-medium text-muted-foreground">Sat</div>

                        <!-- Calendar dates -->
                        <template v-for="date in calendarDates" :key="date.toISOString()">
                            <button
                                @click="openModal(date)"
                                :class="[
                                    'relative p-2 text-sm transition-colors hover:bg-accent hover:text-accent-foreground',
                                    'min-h-[60px] flex flex-col items-center justify-start gap-1',
                                    isToday(date) ? 'bg-primary text-primary-foreground font-semibold' : '',
                                    isPastDate(date) ? 'text-muted-foreground' : '',
                                    !isDeliveryDate(date) ? 'cursor-default' : '',
                                    {
                                        'border-2 border-gesa-green ring-2 ring-primary/20': isDeliveryClickable(date),
                                        'border-2 border-muted bg-muted/20': isDeliveryDate(date) && getDeliveryStatus(date)?.status === 'skipped',
                                        'border-2 border-destructive bg-destructive/10': isDeliveryDate(date) && getDeliveryStatus(date)?.status === 'cancelled',
                                        'border-2 border-gesa-green': isDeliveryDate(date) && getDeliveryStatus(date)?.status === 'scheduled' && !isDeliveryClickable(date),
                                    }
                                ]"
                                :disabled="!isDeliveryClickable(date)"
                            >
                                <span>{{ date.getDate() }}</span>
                                <div v-if="isDeliveryDate(date)" class="flex items-center gap-1">
                                    <Truck class="h-2 w-2" />
                                    <span class="text-xs">
                                        {{ getDeliveryStatus(date)?.status === 'delivered' ? 'Delivered' :
                                        getDeliveryStatus(date)?.status === 'skipped' ? 'Skipped' :
                                            getDeliveryStatus(date)?.status === 'cancelled' ? 'Cancelled' :
                                                'Scheduled' }}
                                    </span>
                                </div>
                            </button>
                        </template>
                    </div>
                </CardContent>
            </Card>
        </div>

        <!-- Delivery Management Modal -->
        <Dialog v-model:open="isModalOpen">
            <DialogContent class="sm:max-w-md">
                <DialogHeader>
                    <DialogTitle>Manage Delivery</DialogTitle>
                    <DialogDescription>
                        {{ selectedDate ? formatDate(selectedDate) : '' }}
                    </DialogDescription>
                </DialogHeader>

                <div class="space-y-4">
                    <div class="rounded-lg border p-4">
                        <h4 class="font-medium mb-2">Delivery Options</h4>
                        <p class="text-sm text-muted-foreground mb-4">
                            Choose how you'd like to handle this delivery date.
                        </p>

                        <div class="space-y-3">
                            <Button
                                variant="outline"
                                class="w-full justify-start"
                                @click="skipWeek"
                            >
                                <Calendar class="h-4 w-4 mr-2" />
                                Skip This Week
                            </Button>

                            <Button
                                variant="destructive"
                                class="w-full justify-start"
                                @click="cancelService"
                            >
                                <Calendar class="h-4 w-4 mr-2" />
                                Cancel Service
                            </Button>
                        </div>
                    </div>
                </div>

                <DialogFooter>
                    <Button variant="outline" @click="isModalOpen = false">
                        Close
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>