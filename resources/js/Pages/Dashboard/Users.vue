<template>
  <AuthLayout>
   <div class="p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-800">Users Management</h2>
          <div class="flex space-x-4">
            <div class="relative">
              <Search class="absolute w-4 h-4 text-gray-400 left-3 top-3" />
              <input 
                v-model="usersSearch"
                type="text" 
                placeholder="Search users..." 
                class="py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
              >
            </div>
            <select v-model="usersFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
              <option value="all">All Users</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-xl">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">User</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Email</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Join Date</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Total Bookings</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Total Spent</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Status</th>
                  <th class="px-6 py-4 font-medium text-left text-gray-600">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in filteredUsers" :key="user.id" class="border-b border-gray-100 hover:bg-gray-50">
                  <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                      <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-purple-600 to-pink-600">
                        <User class="w-5 h-5 text-white" />
                      </div>
                      <div>
                        <p class="font-semibold text-gray-800">{{ user.name }} {{ user.lastname }}</p>
                        <p class="text-sm text-gray-600">ID: U00{{ user.id }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-gray-600">{{ user.email }}</td>
                  <td class="px-6 py-4 text-gray-600">{{ formatDateTime(user.created_at) }}</td>
                  <td class="px-6 py-4 text-gray-600">{{ totalBookings(user.representation_reservations) }}</td>
                  <td class="px-6 py-4 font-semibold text-green-600">${{ getTotalPrice(user.representation_reservations) }}</td>
                  <td class="px-6 py-4">
                    <span :class="defineStatus(user.representation_reservations) === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'" class="px-3 py-1 text-sm font-medium rounded-full">
                     {{ defineStatus(user.representation_reservations) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex space-x-2">
                      <button @click="viewUser(user)" class="p-2 text-blue-600 rounded-lg hover:bg-blue-50">
                        <Eye class="w-4 h-4" />
                      </button>
                      <button @click="editUser(user)" class="p-2 text-green-600 rounded-lg hover:bg-green-50">
                        <Edit class="w-4 h-4" />
                      </button>
                      <button @click="toggleUserStatus(user)" class="p-2 text-orange-600 rounded-lg hover:bg-orange-50">
                        <Shield class="w-4 h-4" />
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

const usersSearch = ref('')
const usersFilter = ref('all')

const props = defineProps({
  users: {
    type: Array,
    required: true,
  },
});


const filteredUsers = computed(() => {
  const statusFilter = usersFilter.value?.toLowerCase();
  const searchQuery = usersSearch.value?.toLowerCase();

  return props.users.filter(user => {
    const matchesStatus = statusFilter === 'all' || defineStatus(user.representation_reservations)?.toLowerCase() === statusFilter;
    const matchesSearch = !searchQuery || 
      [user.name, user.email, user.lastname]
        .filter(Boolean) // ignore undefined/null values
        .some(field => field.toLowerCase().includes(searchQuery));

    return matchesStatus && matchesSearch;
  });
});

const viewUser = (user) => {
  console.log('View user:', user)
}

const editUser = (user) => {
  console.log('Edit user:', user)
}

const toggleUserStatus = (user) => {
  const currentStatus = defineStatus(user.representation_reservations);
  const newStatus = currentStatus === 'Active' ? 'Inactive' : 'Active';
  
  // If you need to update the user object:
  user.status = newStatus;

  return newStatus;
};

function totalBookings(bookings) {
  return bookings.length;
}

const formatDateTime = (dateString) => {
  const date = new Date(dateString);
  return `${date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })} ${date.toLocaleTimeString('en-US', {
    hour: '2-digit',
    minute: '2-digit',
    hour12: true
  })}`;
};
const  defineStatus = (bookings) => {
  if (bookings.length > 3) {
    return 'Active';
  } else {
    return 'Inactive';
  }
}

function getTotalPrice(bookings) {
  let totalPrice = 0;
  bookings.forEach((booking) => {
    if (booking.price && booking.price.price) {
      totalPrice += parseFloat(booking.price.price);
    }
  });
  return totalPrice.toFixed(2);
}
</script>
<style>
</style>