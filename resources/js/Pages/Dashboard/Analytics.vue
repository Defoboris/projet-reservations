<template>
  <AuthLayout>
    <div class="p-6">
        <h2 class="mb-6 text-2xl font-bold text-gray-800">Analytics & Reports</h2>
        
        <div class="grid gap-6 mb-8 lg:grid-cols-2">
          <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <h3 class="mb-4 text-lg font-semibold text-gray-800">Revenue Trends</h3>
            <div class="flex items-center justify-center h-64 rounded-lg bg-gradient-to-br from-green-50 to-blue-50">
              <div class="text-center">
                <TrendingUp class="w-16 h-16 mx-auto mb-4 text-green-400" />
                <p class="text-gray-500">Revenue trend chart would go here</p>
              </div>
            </div>
          </div>
          
          <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <h3 class="mb-4 text-lg font-semibold text-gray-800">Show Performance</h3>
            <div class="flex items-center justify-center h-64 rounded-lg bg-gradient-to-br from-purple-50 to-pink-50">
              <div class="text-center">
                <PieChart class="w-16 h-16 mx-auto mb-4 text-purple-400" />
                <p class="text-gray-500">Performance pie chart would go here</p>
              </div>
            </div>
          </div>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
          <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <h4 class="mb-4 font-semibold text-gray-800">Top Categories</h4>
            <div class="space-y-3">
              <div v-for="category in topCategories" :key="category.name" class="flex items-center justify-between">
                <span class="text-gray-600">{{ category.name }}</span>
                <div class="flex items-center space-x-2">
                  <div class="w-16 h-2 bg-gray-200 rounded-full">
                    <div :class="category.color" class="h-2 rounded-full" :style="{ width: category.percentage + '%' }"></div>
                  </div>
                  <span class="text-sm font-medium">{{ category.percentage }}%</span>
                </div>
              </div>
            </div>
          </div>
          
          <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <h4 class="mb-4 font-semibold text-gray-800">Peak Hours</h4>
            <div class="space-y-3">
              <div v-for="hour in peakHours" :key="hour.time" class="flex items-center justify-between">
                <span class="text-gray-600">{{ hour.time }}</span>
                <div class="flex items-center space-x-2">
                  <div class="w-16 h-2 bg-gray-200 rounded-full">
                    <div class="h-2 bg-blue-500 rounded-full" :style="{ width: hour.percentage + '%' }"></div>
                  </div>
                  <span class="text-sm font-medium">{{ hour.bookings }}</span>
                </div>
              </div>
            </div>
          </div>
          
          <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <h4 class="mb-4 font-semibold text-gray-800">Customer Segments</h4>
            <div class="space-y-3">
              <div v-for="segment in customerSegments" :key="segment.name" class="flex items-center justify-between">
                <span class="text-gray-600">{{ segment.name }}</span>
                <div class="flex items-center space-x-2">
                  <div class="w-16 h-2 bg-gray-200 rounded-full">
                    <div :class="segment.color" class="h-2 rounded-full" :style="{ width: segment.percentage + '%' }"></div>
                  </div>
                  <span class="text-sm font-medium">{{ segment.count }}</span>
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


const topCategories = [
  { name: 'Musical', percentage: 65, color: 'bg-purple-500' },
  { name: 'Drama', percentage: 20, color: 'bg-blue-500' },
  { name: 'Comedy', percentage: 10, color: 'bg-green-500' },
  { name: 'Ballet', percentage: 5, color: 'bg-pink-500' }
]

const peakHours = [
  { time: '7:00 PM', bookings: 245, percentage: 85 },
  { time: '8:00 PM', bookings: 198, percentage: 68 },
  { time: '2:00 PM', bookings: 156, percentage: 54 },
  { time: '3:00 PM', bookings: 134, percentage: 46 }
]

const customerSegments = [
  { name: 'Regular', count: 8456, percentage: 68, color: 'bg-green-500' },
  { name: 'Premium', count: 2341, percentage: 19, color: 'bg-purple-500' },
  { name: 'VIP', count: 1234, percentage: 10, color: 'bg-yellow-500' },
  { name: 'New', count: 428, percentage: 3, color: 'bg-blue-500' }
]

const filteredBookings = computed(() => {
  let filtered = bookings;
  if (bookingsFilter.value !== "all") {
    filtered = filtered.filter(
      (booking) => booking.status.toLowerCase() === bookingsFilter.value
    );
  }
  return filtered;
});

</script>
<style>
</style>