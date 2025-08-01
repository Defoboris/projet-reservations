<template>
  <AuthLayout>
    <div>
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Bookings Management</h2>
        <div class="flex space-x-4">
          <select
            v-model="bookingsFilter"
            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
          >
            <option value="all">All Bookings</option>
            <option value="confirmed">Confirmed</option>
            <option value="pending">Pending</option>
            <option value="cancelled">Cancelled</option>
          </select>
          <button
            class="px-4 py-2 text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700"
          >
            <Download class="inline w-4 h-4 mr-2" />
            Export
          </button>
        </div>
      </div>

      <div class="bg-white border border-gray-100 shadow-sm rounded-xl">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Booking ID
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Customer
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Show
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Date & Time
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Seats
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Amount
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Status
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="booking in filteredBookings"
                :key="booking.id"
                class="border-b border-gray-100 hover:bg-gray-50"
              >
                <td class="px-6 py-4 font-mono text-sm">#{{ booking.id }}</td>
                <td class="px-6 py-4">
                  <div>
                    <p class="font-semibold text-gray-800">
                      {{ booking.customerName }}
                    </p>
                    <p class="text-sm text-gray-600">
                      {{ booking.customerEmail }}
                    </p>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div>
                    <p class="font-semibold text-gray-800">
                      {{ booking.showTitle }}
                    </p>
                    <p class="text-sm text-gray-600">{{ booking.venue }}</p>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div>
                    <p class="font-semibold text-gray-800">
                      {{ booking.showDate }}
                    </p>
                    <p class="text-sm text-gray-600">{{ booking.showTime }}</p>
                  </div>
                </td>
                <td class="px-6 py-4 text-gray-600">
                  {{ booking.seats.join(", ") }}
                </td>
                <td class="px-6 py-4 font-semibold text-green-600">
                  ${{ booking.totalAmount }}
                </td>
                <td class="px-6 py-4">
                  <span
                    :class="getStatusColor(booking.status)"
                    class="px-3 py-1 text-sm font-medium rounded-full"
                  >
                    {{ booking.status }}
                  </span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex space-x-2">
                    <button
                      @click="viewBooking(booking)"
                      class="p-2 text-blue-600 rounded-lg hover:bg-blue-50"
                    >
                      <Eye class="w-4 h-4" />
                    </button>
                    <button
                      @click="editBooking(booking)"
                      class="p-2 text-green-600 rounded-lg hover:bg-green-50"
                    >
                      <Edit class="w-4 h-4" />
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

const bookingsFilter = ref("all");
const showsSearch = ref("");

const bookings = [
  {
    id: "BK001",
    customerName: "John Doe",
    customerEmail: "john@email.com",
    showTitle: "Hamilton",
    venue: "Broadway Theater",
    showDate: "Jan 15, 2024",
    showTime: "7:30 PM",
    seats: ["A12", "A13"],
    totalAmount: 240,
    status: "Confirmed",
  },
  {
    id: "BK002",
    customerName: "Jane Smith",
    customerEmail: "jane@email.com",
    showTitle: "The Lion King",
    venue: "Minskoff Theatre",
    showDate: "Jan 16, 2024",
    showTime: "8:00 PM",
    seats: ["B8", "B9"],
    totalAmount: 190,
    status: "Pending",
  },
  {
    id: "BK003",
    customerName: "Mike Johnson",
    customerEmail: "mike@email.com",
    showTitle: "Phantom of Opera",
    venue: "Royal Opera House",
    showDate: "Jan 18, 2024",
    showTime: "7:00 PM",
    seats: ["C15"],
    totalAmount: 85,
    status: "Confirmed",
  },
  {
    id: "BK004",
    customerName: "Sarah Wilson",
    customerEmail: "sarah@email.com",
    showTitle: "Chicago",
    venue: "Ambassador Theatre",
    showDate: "Jan 20, 2024",
    showTime: "8:30 PM",
    seats: ["D5", "D6"],
    totalAmount: 150,
    status: "Cancelled",
  },
];

const filteredBookings = computed(() => {
  let filtered = bookings;
  if (bookingsFilter.value !== "all") {
    filtered = filtered.filter(
      (booking) => booking.status.toLowerCase() === bookingsFilter.value
    );
  }
  return filtered;
});

const getStatusColor = (status) => {
  switch (status.toLowerCase()) {
    case 'confirmed': return 'bg-green-100 text-green-800'
    case 'pending': return 'bg-yellow-100 text-yellow-800'
    case 'cancelled': return 'bg-red-100 text-red-800'
    default: return 'bg-gray-100 text-gray-800'
  }
}

const viewBooking = (booking) => {
  console.log('View booking:', booking)
}

const editBooking = (booking) => {
  console.log('Edit booking:', booking)
}
</script>
<style>
</style>