<template>
  <AuthLayout>
    <div>
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Shows Management</h2>
          <button  class="px-6 py-3 font-semibold text-white transition-all rounded-lg bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700">
            <Plus class="inline w-4 h-4 mr-2" />
            Add New Show
          </button>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-xl">
          <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col gap-4 sm:flex-row">
              <div class="relative flex-1">
                <Search class="absolute w-4 h-4 text-gray-400 left-3 top-3" />
                <input 
                  v-model="showsSearch"
                  type="text" 
                  placeholder="Search shows..." 
                  class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                >
              </div>
              <select v-model="showsFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="all">All Categories</option>
                <option value="musical">Musical</option>
                <option value="drama">Drama</option>
                <option value="comedy">Comedy</option>
                <option value="ballet">Ballet</option>
              </select>
            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Show</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Category</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Venue</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Status</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Price Range</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="show in filteredShows" :key="show.id" class="border-b border-gray-100 hover:bg-gray-50">
                  <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                      <div :class="show.gradient" class="w-12 h-12 rounded-lg"></div>
                      <div>
                        <p class="font-semibold text-gray-800">{{ show.title }}</p>
                        <p class="text-sm text-gray-600">{{ show.duration }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="px-3 py-1 text-sm font-medium text-purple-800 bg-purple-100 rounded-full">
                      {{ show.category }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-gray-600">{{ show.venue }}</td>
                  <td class="px-6 py-4">
                    <span :class="show.status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" class="px-3 py-1 text-sm font-medium rounded-full">
                      {{ show.status }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-gray-600">${{ show.minPrice }} - ${{ show.maxPrice }}</td>
                  <td class="px-6 py-4">
                    <div class="flex space-x-2">
                      <button @click="editShow(show)" class="p-2 text-blue-600 rounded-lg hover:bg-blue-50">
                        <Edit class="w-4 h-4" />
                      </button>
                      <button @click="deleteShow(show.id)" class="p-2 text-red-600 rounded-lg hover:bg-red-50">
                        <Trash2 class="w-4 h-4" />
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </AuthLayout>
</template>
<script setup>
import { computed, ref } from "vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";

import { 
  Theater, Menu, Bell, User, DollarSign, Ticket, Play, Users, BarChart3, Star,
  Plus, Search, Edit, Trash2, Eye, Download, Shield, TrendingUp, PieChart, X,
  Calendar, MapPin, Settings
} from 'lucide-vue-next'

const showsFilter = ref('all')
const showsSearch = ref('')

const topShows = [
  {
    id: 1,
    name: "Hamilton",
    venue: "Broadway Theater",
    ticketsSold: 1247,
    revenue: 149640,
    rating: 4.9,
    gradient: "bg-gradient-to-br from-blue-500 to-purple-600",
  },
  {
    id: 2,
    name: "The Lion King",
    venue: "Minskoff Theatre",
    ticketsSold: 1156,
    revenue: 109820,
    rating: 4.7,
    gradient: "bg-gradient-to-br from-yellow-500 to-orange-600",
  },
  {
    id: 3,
    name: "Phantom of Opera",
    venue: "Royal Opera House",
    ticketsSold: 987,
    revenue: 83895,
    rating: 4.8,
    gradient: "bg-gradient-to-br from-orange-500 to-red-600",
  },
  {
    id: 4,
    name: "Chicago",
    venue: "Ambassador Theatre",
    ticketsSold: 856,
    revenue: 64200,
    rating: 4.5,
    gradient: "bg-gradient-to-br from-gray-700 to-black",
  },
];

const shows = [
  { id: 1, title: 'Hamilton', category: 'Musical', venue: 'Broadway Theater', status: 'Active', minPrice: 85, maxPrice: 200, duration: '2h 45m', gradient: 'bg-gradient-to-br from-blue-500 to-purple-600' },
  { id: 2, title: 'The Lion King', category: 'Musical', venue: 'Minskoff Theatre', status: 'Active', minPrice: 65, maxPrice: 150, duration: '2h 30m', gradient: 'bg-gradient-to-br from-yellow-500 to-orange-600' },
  { id: 3, title: 'Phantom of Opera', category: 'Musical', venue: 'Royal Opera House', status: 'Active', minPrice: 75, maxPrice: 180, duration: '2h 40m', gradient: 'bg-gradient-to-br from-orange-500 to-red-600' },
  { id: 4, title: 'Romeo and Juliet', category: 'Drama', venue: 'Globe Theatre', status: 'Inactive', minPrice: 45, maxPrice: 120, duration: '2h 15m', gradient: 'bg-gradient-to-br from-pink-500 to-red-600' }
]

const filteredShows = computed(() => {
  let filtered = shows;
  if (showsFilter.value !== 'all') {
    filtered = filtered.filter(show => show.category.toLowerCase() === showsFilter.value)
  }
  if (showsSearch.value) {
    filtered = filtered.filter(show => 
      show.title.toLowerCase().includes(showsSearch.value.toLowerCase()) ||
      show.venue.toLowerCase().includes(showsSearch.value.toLowerCase())
    )
  }
  return filtered
})

</script>
<style>
</style>