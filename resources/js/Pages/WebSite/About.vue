<template>
  <AppLayout>
    <div class="container h-screen px-4 py-8 mx-auto">
      <div class="max-w-4xl mx-auto">
        <h1 class="mb-8 text-4xl font-bold text-center text-gray-800">About TheaterHub</h1>
        
        <div class="p-12 mb-12 bg-white shadow-lg rounded-2xl">
          <p class="mb-8 text-xl leading-relaxed text-gray-600">
            TheaterHub is your premier destination for discovering and booking the finest theatrical experiences. 
            We connect theater enthusiasts with world-class performances across the city's most prestigious venues.
          </p>
          
          <div class="grid gap-8 mb-12 md:grid-cols-3">
            <div class="text-center">
              <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full">
                <Theater class="w-8 h-8 text-purple-600" />
              </div>
              <h3 class="mb-2 text-lg font-bold">Premium Shows</h3>
              <p class="text-gray-600">Curated selection of the finest theatrical performances</p>
            </div>
            <div class="text-center">
              <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full">
                <MapPin class="w-8 h-8 text-purple-600" />
              </div>
              <h3 class="mb-2 text-lg font-bold">Best Venues</h3>
              <p class="text-gray-600">Partnership with the city's most iconic theaters</p>
            </div>
            <div class="text-center">
              <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full">
                <Users class="w-8 h-8 text-purple-600" />
              </div>
              <h3 class="mb-2 text-lg font-bold">Easy Booking</h3>
              <p class="text-gray-600">Seamless ticket booking experience</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>
<style>
</style>