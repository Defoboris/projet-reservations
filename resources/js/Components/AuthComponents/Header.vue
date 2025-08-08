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
              <h3 class="text-sm font-medium text-gray-700">Admin User</h3>
               <div class="relative ms-3">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink> -->
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
            </div>
          </div>
        </div>
        </header>
</template>
<script setup>
import DropdownLink from '@/Components/DropdownLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import NavLink from '@/Components/NavLink.vue';

import { 
  Theater, Menu, Bell, User, DollarSign, Ticket, Play, Users, BarChart3, Star,
  Plus, Search, Edit, Trash2, Eye, Download, Shield, TrendingUp, PieChart, X,
  Calendar, MapPin, Settings,
  CalendarPlus
} from 'lucide-vue-next';

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