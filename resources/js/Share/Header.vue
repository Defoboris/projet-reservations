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
              :href="route('home')"
              :class="
                currentPage === 'home'
                  ? 'text-purple-600 border-b-2 border-purple-600'
                  : 'text-gray-600 hover:text-purple-600'
              "
              class="pb-4 transition-colors"
            >
              Home
            </Link>
            <Link
              :href="route('shows')"
              :class="
                currentPage === 'shows'
                  ? 'text-purple-600 border-b-2 border-purple-600'
                  : 'text-gray-600 hover:text-purple-600'
              "
              class="pb-4 transition-colors"
            >
              Shows
            </Link>
            <Link
              :href="route('venues')"
              :class="
                currentPage === 'venues'
                  ? 'text-purple-600 border-b-2 border-purple-600'
                  : 'text-gray-600 hover:text-purple-600'
              "
              class="pb-4 transition-colors"
            >
              Venues
            </Link>
            <Link
              :href="route('about')"
              :class="
                currentPage === 'about'
                  ? 'text-purple-600 border-b-2 border-purple-600'
                  : 'text-gray-600 hover:text-purple-600'
              "
              class="pb-4 transition-colors"
            >
              About
            </Link>
            <Link
              :href="route('contact')"
              :class="
                currentPage === 'contact'
                  ? 'text-purple-600 border-b-2 border-purple-600'
                  : 'text-gray-600 hover:text-purple-600'
              "
              class="pb-4 transition-colors"
            >
              Contact
            </Link>
          </nav>
        </div>
        <div class="flex items-center space-x-4">
          <div class="relative hidden md:block">
            <input
              v-model="searchQuery"
              type="search"
              placeholder="Search shows, venues..."
              class="w-64 py-2 pl-10 pr-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
            />
            <Search class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" />
          </div>
          <Link
            @click="currentPage = 'profile'"
            class="p-2 rounded-full hover:bg-gray-100"
          >
            <User class="w-5 h-5 text-gray-600" />
          </Link>
          <Link
            :href="route('register')"
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
const searchQuery = ref("");

const currentPage = ref("home");
</script>

<style scoped>
</style>
