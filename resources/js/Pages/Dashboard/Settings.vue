<template>
  <AuthLayout>
    <div class="p-6">
        <h2 class="mb-6 text-2xl font-bold text-gray-800">Settings</h2>
        
        <div class="grid gap-6 lg:grid-cols-2">
          <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <h3 class="mb-4 text-lg font-semibold text-gray-800">General Settings</h3>
            <div class="space-y-4">
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Site Name</label>
                <input type="text" value="TheaterHub" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Contact Email</label>
                <input type="email" value="admin@theaterhub.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Default Currency</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                  <option>USD ($)</option>
                  <option>EUR (€)</option>
                  <option>GBP (£)</option>
                </select>
              </div>
            </div>
          </div>
          
          <div class="p-6 bg-white border border-gray-100 shadow-sm rounded-xl">
            <h3 class="mb-4 text-lg font-semibold text-gray-800">Notification Settings</h3>
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <span class="text-gray-700">Email Notifications</span>
                <button class="relative inline-flex items-center h-6 transition-colors bg-purple-600 rounded-full w-11">
                  <span class="inline-block w-4 h-4 transition-transform transform translate-x-6 bg-white rounded-full"></span>
                </button>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-700">SMS Notifications</span>
                <button class="relative inline-flex items-center h-6 transition-colors bg-gray-200 rounded-full w-11">
                  <span class="inline-block w-4 h-4 transition-transform transform translate-x-1 bg-white rounded-full"></span>
                </button>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-gray-700">Push Notifications</span>
                <button class="relative inline-flex items-center h-6 transition-colors bg-purple-600 rounded-full w-11">
                  <span class="inline-block w-4 h-4 transition-transform transform translate-x-6 bg-white rounded-full"></span>
                </button>
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

</script>
<style>
</style>