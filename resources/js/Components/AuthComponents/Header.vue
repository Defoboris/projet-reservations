<template>
    <header class="bg-white border-b border-gray-200 shadow-sm">
            <div class="flex items-center justify-between px-6 py-4">
          <div class="flex items-center">
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-600 rounded-md lg:hidden hover:bg-gray-100">
              <Menu class="w-6 h-6" />
            </button>
            <h1 class="ml-4 text-2xl font-bold text-gray-800">{{ pageTitle }}</h1>
          </div>
          
          <div class="flex items-center space-x-4">
            <div class="relative">
              <Bell class="w-6 h-6 text-gray-600 cursor-pointer hover:text-gray-800" />
              <span class="absolute flex items-center justify-center w-4 h-4 text-xs text-white bg-red-500 rounded-full -top-1 -right-1">3</span>
            </div>
            <div class="flex items-center space-x-2">
              <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-purple-600 to-pink-600">
                <User class="w-4 h-4 text-white" />
              </div>
              <DropdownLink :href="route('logout')" method="post" as="button" class="text-sm font-medium text-gray-700">Admin User</DropdownLink>
            </div>
          </div>
        </div>
        </header>
</template>
<script setup>
import DropdownLink from '@/Components/DropdownLink.vue';

    defineProps({
        sidebarOpen: {
            type: Boolean,
            required: true,
        },
        pageTitle: {
            type: String,
            required: true,
        },
        currentPage: {
            type: String,
            required: true,
        },
    });
</script>