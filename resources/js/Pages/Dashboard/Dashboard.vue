<template>
  <AuthLayout>
    <div>
      <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Total Revenue</p>
              <p class="text-3xl font-bold text-gray-900">${{ totalPrice }}</p>
              <p class="mt-1 text-sm text-green-600">+12.5% from last month</p>
            </div>
            <div
              class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg"
            >
              <DollarSign class="w-6 h-6 text-green-600" />
            </div>
          </div>
        </div>

        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Tickets Sold</p>
              <p class="text-3xl font-bold text-gray-900">{{ totalTickets}}</p>
              <p class="mt-1 text-sm text-blue-600">+8.2% from last month</p>
            </div>
            <div
              class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg"
            >
              <Ticket class="w-6 h-6 text-blue-600" />
            </div>
          </div>
        </div>

        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Active Shows</p>
              <p class="text-3xl font-bold text-gray-900">{{ shows }}</p>
              <p class="mt-1 text-sm text-purple-600">3 new this week</p>
            </div>
            <div
              class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-lg"
            >
              <Play class="w-6 h-6 text-purple-600" />
            </div>
          </div>
        </div>

        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm font-medium text-gray-600">Total Users</p>
              <p class="text-3xl font-bold text-gray-900">{{ users }}</p>
              <p class="mt-1 text-sm text-orange-600">+15.3% from last month</p>
            </div>
            <div
              class="flex items-center justify-center w-12 h-12 bg-orange-100 rounded-lg"
            >
              <Users class="w-6 h-6 text-orange-600" />
            </div>
          </div>
        </div>
      </div>

      <!-- Charts and Recent Activity -->
      <div class="grid gap-6 mb-8 lg:grid-cols-2">
        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
          <h3 class="mb-4 text-lg font-semibold text-gray-800">
            Revenue Overview
          </h3>
          <div
            class="flex items-center justify-center h-64 rounded-lg bg-gradient-to-br from-purple-50 to-pink-50"
          >
            <div class="text-center">
              <BarChart3 class="w-16 h-16 mx-auto mb-4 text-purple-400" />
              <p class="text-gray-500">Revenue chart would go here</p>
            </div>
          </div>
        </div>

        <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
          <h3 class="mb-4 text-lg font-semibold text-gray-800">
            Recent Bookings
          </h3>
          <div class="space-y-4">
            <div
              v-for="booking in recentBookings"
              :key="booking.id"
              class="flex items-center justify-between p-3 rounded-lg bg-gray-50"
            >
              <div class="flex items-center space-x-3">
                <div
                  class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-purple-600 to-pink-600"
                >
                  <User class="w-5 h-5 text-white" />
                </div>
                <div>
                  <p class="font-medium text-gray-800">
                    {{ booking.user.name }} {{ booking.user.lastname }}
                  </p>
                  <p class="text-sm text-gray-600">{{ booking.representation.show.title }}</p>
                </div>
              </div>
              <div class="text-right">
                <p class="font-semibold text-gray-800">${{ totalPrices(booking) }}</p>
                <p class="text-sm text-gray-500">  {{ new Date(booking.updated_at).toLocaleDateString() }} {{ new Date(booking.updated_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Top Shows -->
      <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
        <h3 class="mb-4 text-lg font-semibold text-gray-800">
          Top Performing Shows
        </h3>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="border-b border-gray-200">
                <th class="px-4 py-3 font-medium text-left text-gray-600">
                  Show
                </th>
                <th class="px-4 py-3 font-medium text-left text-gray-600">
                  Venue
                </th>
                <th class="px-4 py-3 font-medium text-left text-gray-600">
                  Tickets Sold
                </th>
                <th class="px-4 py-3 font-medium text-left text-gray-600">
                  Revenue
                </th>
                <th class="px-4 py-3 font-medium text-left text-gray-600">
                  Rating
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="show in topShows"
                :key="show.id"
                class="border-b border-gray-100 hover:bg-gray-50"
              >
                <td class="px-4 py-3">
                  <div class="flex items-center space-x-3">
                    <div
                      :class="show.gradient"
                      class="w-10 h-10 rounded-lg"
                    ></div>
                    <span class="font-medium">{{ show.name }}</span>
                  </div>
                </td>
                <td class="px-4 py-3 text-gray-600">{{ show.venue }}</td>
                <td class="px-4 py-3 text-gray-600">{{ show.ticketsSold }}</td>
                <td class="px-4 py-3 font-semibold text-green-600">
                  ${{ show.revenue.toLocaleString() }}
                </td>
                <td class="px-4 py-3">
                  <div class="flex items-center">
                    <Star class="w-4 h-4 mr-1 text-yellow-400 fill-current" />
                    <span>{{ show.rating }}</span>
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
import AuthLayout from "@/Layouts/AuthLayout.vue";

import {
  Theater,
  Menu,
  Bell,
  User,
  DollarSign,
  Ticket,
  Play,
  Users,
  BarChart3,
  Star,
  Plus,
  Search,
  Edit,
  Trash2,
  Eye,
  Download,
  Shield,
  TrendingUp,
  PieChart,
  X,
  Calendar,
  MapPin,
  Settings,
} from "lucide-vue-next";

defineProps({
  totalPrice: Number,
  totalTickets: Number,
  shows: Number,
  users: Number,
  recentBookings: Array,
});



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

const totalPrices = (reservation) => {
  return reservation.price.price * reservation.quantity;
};
</script>
<style>
</style>