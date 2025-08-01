<template>
  <AuthLayout>
   <div class="p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Venues Management</h2>
          <button class="px-6 py-3 font-semibold text-white transition-all rounded-lg bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700">
            <Plus class="inline w-4 h-4 mr-2" />
            Add New Venue
          </button>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          <div v-for="venue in venues" :key="venue.id" class="overflow-hidden transition-shadow bg-white border border-gray-100 shadow-sm rounded-xl hover:shadow-md">
            <div :class="venue.gradient" class="relative h-48">
              <div class="absolute inset-0 bg-black bg-opacity-20"></div>
              <div class="absolute top-4 right-4">
                <div class="flex space-x-2">
                  <button @click="editVenue(venue)" class="p-2 text-white bg-white rounded-lg bg-opacity-20 hover:bg-opacity-30">
                    <Edit class="w-4 h-4" />
                  </button>
                  <button @click="deleteVenue(venue.id)" class="p-2 text-white bg-white rounded-lg bg-opacity-20 hover:bg-opacity-30">
                    <Trash2 class="w-4 h-4" />
                  </button>
                </div>
              </div>
              <div class="absolute text-white bottom-4 left-4">
                <h3 class="text-xl font-bold">{{ venue.name }}</h3>
                <p class="text-sm opacity-90">{{ venue.location }}</p>
              </div>
            </div>
            <div class="p-6">
              <p class="mb-4 text-gray-600">{{ venue.description }}</p>
              <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <span class="text-gray-500">Capacity:</span>
                  <span class="ml-2 font-semibold">{{ venue.capacity }}</span>
                </div>
                <div>
                  <span class="text-gray-500">Active Shows:</span>
                  <span class="ml-2 font-semibold">{{ venue.activeShows }}</span>
                </div>
              </div>
            </div>
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

const showModal = ref(null)
const showsSearch = ref('')

const venues = [
  { id: 1, name: 'Royal Opera House', location: 'Covent Garden, London', description: 'Historic venue with world-class acoustics', capacity: 2256, activeShows: 8, gradient: 'bg-gradient-to-br from-red-600 to-pink-600' },
  { id: 2, name: 'Broadway Theater', location: 'Times Square, New York', description: 'Iconic Broadway venue', capacity: 1761, activeShows: 6, gradient: 'bg-gradient-to-br from-blue-600 to-purple-600' },
  { id: 3, name: 'Globe Theatre', location: 'Southwark, London', description: 'Authentic Shakespearean theatre', capacity: 1570, activeShows: 4, gradient: 'bg-gradient-to-br from-amber-600 to-orange-600' },
  { id: 4, name: 'Minskoff Theatre', location: 'Times Square, New York', description: 'Modern Broadway venue', capacity: 1710, activeShows: 3, gradient: 'bg-gradient-to-br from-green-600 to-teal-600' }
]

const editVenue = (venue) => {
  console.log('Edit venue:', venue)
}

const deleteVenue = (venueId) => {
  if (confirm('Are you sure you want to delete this venue?')) {
    const index = venues.findIndex(venue => venue.id === venueId)
    if (index > -1) {
      venues.splice(index, 1)
    }
  }
}
</script>
<style>
</style>