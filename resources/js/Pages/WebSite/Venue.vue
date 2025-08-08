<template>
  <AppLayout>
    <div class="container h-full px-4 py-8 mx-auto">
      <h1 class="mb-8 text-4xl font-bold text-gray-800">Our Venues</h1>

      <div class="grid gap-8 md:grid-cols-2">
        <div
          v-for="venue in venues"
          :key="venue.id"
          class="overflow-hidden transition-shadow bg-white shadow-lg cursor-pointer rounded-2xl hover:shadow-xl"
          @click="viewVenueDetails(venue)"
        >
          <div :style="{ backgroundImage: `url('${venue.image}')` }" class="relative h-64 bg-center bg-cover">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="absolute text-white bottom-4 left-4">
              <h3 class="mb-2 text-2xl font-bold">{{ venue.designation }}</h3>
              <div class="flex items-center">
                <MapPin class="w-4 h-4 mr-1" />
                <span>{{ venue.address }}</span>
              </div>
            </div>
          </div>
          <div class="p-6">
            <p class="mb-4 text-gray-600">{{ venue.description }}</p>
            <div class="flex items-center justify-between">
              <div class="flex items-center text-sm text-gray-500">
                <Users class="w-4 h-4 mr-1" />
                {{ venue.capacity }} seats
              </div>
              <span class="font-semibold text-purple-600"
                >10 shows</span
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
defineProps({
  venues: {
    type: Array,
    required: true,
  },
})

function viewVenueDetails(venue) {
   window.open(venue.website, '_blank');
}
</script>
<style>
</style>