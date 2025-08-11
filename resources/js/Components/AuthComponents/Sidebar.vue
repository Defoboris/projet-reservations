<template>
  <div
    class="fixed inset-y-0 left-0 z-50 w-64 min-h-screen transition-transform duration-300 ease-in-out transform bg-white shadow-lg"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
  >
    <div
      class="flex items-center justify-center h-16 bg-gradient-to-r from-purple-600 to-pink-600"
    >
      <Link :href="route('home')" class="flex items-center space-x-2">
        <div
          class="flex items-center justify-center w-8 h-8 bg-white rounded-lg bg-opacity-20"
        >
          <Theater class="w-5 h-5 text-white" />
        </div>
        <span class="text-xl font-bold text-white">Admin Panel</span>
      </Link>
    </div>

    <nav class="mt-8">
      <div class="px-4 space-y-2">
        <Link
          v-for="item in sidebarItems"
          :key="item.id"
          :href="route(item.id)"
          :class="[
            'flex items-center w-full px-4 py-3 text-left transition-colors rounded-lg',
            isActive(item.id)
              ? 'bg-purple-50 text-purple-700 border-r-2 border-purple-600'
              : 'text-gray-600 hover:bg-gray-50'
          ]"
        >
          <component :is="item.icon" class="w-5 h-5 mr-3" />
          {{ item.name }}
        </Link>
      </div>
    </nav>
  </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import {
  Theater,
  Play,
  CalendarPlus,
  Ticket,
  MapPin,
  Users,
  TrendingUp,
  Settings,
  BarChart3,
} from "lucide-vue-next";

const props = defineProps({
  sidebarOpen: Boolean,
  sidebarItems: Array,
});

const page = usePage();

const sidebarItems = [
  { id: "admin.dashboard", name: "Dashboard", icon: BarChart3 },
  { id: "admin.shows", name: "Shows", icon: Play },
  { id: "admin.representations", name: "Representations", icon: CalendarPlus },
  { id: "admin.bookings", name: "Bookings", icon: Ticket },
  { id: "admin.venues", name: "Venues", icon: MapPin },
  { id: "admin.users", name: "Users", icon: Users },
  { id: "admin.analytics", name: "Analytics", icon: TrendingUp },
  { id: "admin.settings", name: "Settings", icon: Settings },
];

// Function to check if route is active
function isActive(routeName) {
  return route().current(routeName);
}
</script>
