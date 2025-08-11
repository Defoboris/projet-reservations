<template>
  <header class="sticky top-0 z-50 bg-white shadow-lg">
    <div class="container px-4 mx-auto">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center space-x-8 justify-content-center">
          <div class="flex items-center space-x-2">
            <div
              class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-purple-600 to-pink-600"
            >
              <Theater class="w-5 h-5 text-white" />
            </div>
            <span class="text-xl font-bold text-gray-800">TheaterHub</span>
          </div>
          <nav class="hidden space-x-6 md:flex">
            <Link
              v-for="link in navLinks"
              :key="link.routeName"
              :href="route(link.routeName)"
              :class="{
                'text-purple-600 border-b-2 border-purple-600': isLinkActive(link.routeName),
                'text-gray-600 hover:text-purple-600': !isLinkActive(link.routeName),
              }"
              class="pb-4 transition-colors"
            >
              {{ link.name }}
            </Link>
          </nav>
        </div>
        <div class="flex items-center space-x-4">
          <div class="relative hidden md:block">
            <input
              v-model="searchQuery"
              type="search"
              placeholder="Search shows, venues..."
              class="w-64 py-2 pl-10 pr-4 border border-gray-300 rounded-full focus:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-500"
            />
            <Search class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" />
          </div>
          <Link :href="route('profile.edit')" class="p-2 rounded-full hover:bg-gray-100">
            <User class="w-5 h-5 text-gray-600" />
          </Link>
          <Link
            :href="route('login')"
            class="px-4 py-2 text-white transition-all rounded-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
          >
            Sign In
          </Link>
        </div>
      </div>
    </div>
  </header>
</template>
<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import { route } from "ziggy-js";
import { Theater, Search, User } from "lucide-vue-next";

const page = usePage();
const searchQuery = ref("");

// Get authenticated user (null if guest)
const authUser = page.props.auth?.user || null;

const navLinks = [
  { name: "Home", routeName: "home" },
  { name: "Shows", routeName: "shows" },
  { name: "Venues", routeName: "venues" },
  { name: "About", routeName: "about" },
  { name: "Contact", routeName: "contact" },
  ...(authUser ? [{ name: "My Bookings", routeName: "bookings.my" }] : []),
];

// Function to check active route
function isLinkActive(routeName) {
  return route().current(routeName);
}
</script>

<style scoped></style>
