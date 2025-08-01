<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Sidebar -->
     <Sidebar :sidebar-open="sidebarOpen" :sidebar-items="sidebarItems" :current-page="currentPage" />

     <!-- Main Content -->
      <div class="lg:ml-64">
        <Header page-title="Dashboard" :sidebar-open="sidebarOpen" />

        <!-- Dashboard Overview -->
         <div class="p-6">
             <slot />
         </div>
      </div>

  </div>
</template>
<script setup>
import Sidebar from '@/Components/AuthComponents/Sidebar.vue';
import Header from '@/Components/AuthComponents/Header.vue';

defineProps({
    sidebarOpen: {
        type: Boolean,
        required: true,
    },
    sidebarItems: {
        type: Array,
        required: true,
    },
    currentPage: {
        type: String,
        required: true,
    },
})
</script>
<style>
</style>