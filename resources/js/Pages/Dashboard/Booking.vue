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
            <option value="booked">Confirmed</option>
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
                      {{ booking.user.name }} {{ booking.user.lastname }}
                    </p>
                    <p class="text-sm text-gray-600">
                      {{ booking.user.email }}
                    </p>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div>
                    <p class="font-semibold text-gray-800">
                      {{ booking.representation.show.title }}
                    </p>
                    <p class="text-sm text-gray-600">
                      {{ booking.representation.location.designation }}
                    </p>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <div>
                    <p class="font-semibold text-gray-800">
                      {{ booking.representation.show.date }}
                    </p>
                    <p class="text-sm text-gray-600">
                      {{ booking.representation.show.time || "TBD" }}
                    </p>
                  </div>
                </td>
                <td class="px-6 py-4 font-semibold text-green-600">
                  ${{ booking.price.price * booking.quantity }}
                </td>
                <td class="px-6 py-4">
                  <span
                    :class="getStatusColor(booking.reservation.status)"
                    class="px-3 py-1 text-sm font-medium rounded-full"
                  >
                    {{
                      booking.reservation.status === "booked" ? "Confirmed" :
                      booking.reservation.status.charAt(0).toUpperCase() +
                      booking.reservation.status.slice(1)
                    }}
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

const bookingsFilter = ref("all");
const showsSearch = ref("");

const props = defineProps({
  bookings: {
    type: Array,
    required: true,
  },
});

const filteredBookings = computed(() => {
  let filtered = props.bookings;
  if (bookingsFilter.value !== "all") {
    filtered = filtered.filter(
      booking => booking.reservation.status.toLowerCase() === bookingsFilter.value
    );
  }
  return filtered;
});

const getStatusColor = (status) => {
  switch (status.toLowerCase()) {
    case "booked":
      return "bg-green-100 text-green-800";
    case "pending":
      return "bg-yellow-100 text-yellow-800";
    case "cancelled":
      return "bg-red-100 text-red-800";
    default:
      return "bg-gray-100 text-gray-800";
  }
};

const viewBooking = (booking) => {
  console.log("View booking:", booking);
};

const editBooking = (booking) => {
  console.log("Edit booking:", booking);
};
</script>
<style>
</style>