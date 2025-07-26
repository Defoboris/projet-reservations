<template>
  <AppLayout>
    <div class="container px-4 py-8 mx-auto">
      <h1 class="mb-8 text-4xl font-bold text-gray-800">Our Venues</h1>

      <div class="grid gap-8 md:grid-cols-2">
        <div
          v-for="venue in venues"
          :key="venue.id"
          class="overflow-hidden transition-shadow bg-white shadow-lg cursor-pointer rounded-2xl hover:shadow-xl"
          @click="viewVenueDetails(venue)"
        >
          <div :class="venue.gradient" class="relative h-64">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="absolute text-white bottom-4 left-4">
              <h3 class="mb-2 text-2xl font-bold">{{ venue.name }}</h3>
              <div class="flex items-center">
                <MapPin class="w-4 h-4 mr-1" />
                <span>{{ venue.location }}</span>
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
                >{{ venue.showCount }} shows</span
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

const venues = [
  {
    id: 1,
    name: "Royal Opera House",
    location: "Covent Garden, London",
    description:
      "Historic venue with world-class acoustics and elegant Victorian architecture.",
    capacity: 2256,
    showCount: 45,
    gradient: "bg-gradient-to-br from-red-600 to-pink-600",
  },
  {
    id: 2,
    name: "Broadway Theater",
    location: "Times Square, New York",
    description:
      "Iconic Broadway venue hosting the biggest musical productions.",
    capacity: 1761,
    showCount: 32,
    gradient: "bg-gradient-to-br from-blue-600 to-purple-600",
  },
  {
    id: 3,
    name: "Globe Theatre",
    location: "Southwark, London",
    description: "Authentic recreation of Shakespeare's original theatre.",
    capacity: 1570,
    showCount: 28,
    gradient: "bg-gradient-to-br from-amber-600 to-orange-600",
  },
  {
    id: 4,
    name: "Lincoln Center",
    location: "Upper West Side, New York",
    description: "Premier venue for opera, ballet, and classical music.",
    capacity: 3800,
    showCount: 52,
    gradient: "bg-gradient-to-br from-teal-600 to-blue-600",
  },
];
</script>
<style>
</style>