<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import {Link, usePage} from '@inertiajs/vue3';
import {BellIcon, BookOpen, Folder, LayoutGrid, Calendar, Leaf} from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import AppSidebarHeader from './AppSidebarHeader.vue';
import {computed} from "vue";
import UserRoleIndicator from '@/components/UserRoleIndicator.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Admin Dashboard',
        href: '/admin/dashboard',
        icon: LayoutGrid, // Re-using LayoutGrid for now, can be changed later if a specific icon is needed
        adminOnly: true,
    },
    {
        title: 'Calendar',
        href: '/calendar',
        icon: Calendar,
    },
    {
        title: 'Notifications',
        href: '/notifications',
        icon: BellIcon,
    },
    {
        title: 'Brand Examples',
        href: '/brand-examples',
        icon: Leaf,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Contact Support',
        href: '/support',
        icon: Folder,
    },
    {
        title: 'FAQ',
        href: '/faq',
        icon: BookOpen,
    },
];

const page = usePage()
const user = computed(() => page.props.auth.user)
const userRoleIndicator = computed(() => {
    if (!user.value || !user.value.roles) {
        return null
    }
    if (user.value.roles.includes('admin')) {
        return 'Admin'
    }
    if (user.value.roles.includes('staff')) {
        return 'Staff'
    }
    return null
})
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
            <UserRoleIndicator :userRoleIndicator="userRoleIndicator" />
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems.filter(item => !item.adminOnly || (item.adminOnly && user.roles.includes('admin')))" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
