<template>
  <AppLayout>
    <div class="container px-4 py-8 mx-auto">
      <h1 class="mb-8 text-4xl font-bold text-gray-800">Book Your Tickets</h1>

      <div class="grid gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2">
          <div class="p-8 mb-8 bg-white shadow-lg rounded-2xl">
            <h2 class="mb-6 text-2xl font-bold">Select Date & Time</h2>
            <div class="grid grid-cols-3 gap-4 mb-6">
              <button
                v-for="date in availableDates"
                :key="date"
                class="p-4 transition-all border border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50"
              >
                <div class="font-semibold">{{ date.day }}</div>
                <div class="text-sm text-gray-500">{{ date.date }}</div>
              </button>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <button
                v-for="time in availableTimes"
                :key="time"
                class="p-3 transition-all border border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50"
              >
                {{ time }}
              </button>
            </div>
          </div>

          <div class="p-8 bg-white shadow-lg rounded-2xl">
            <h2 class="mb-6 text-2xl font-bold">Select Seats</h2>
            <div class="mb-6 text-center">
              <div
                class="inline-block px-8 py-2 text-white bg-gray-800 rounded-lg"
              >
                STAGE
              </div>
            </div>
            <div class="grid max-w-md grid-cols-10 gap-2 mx-auto">
              <div
                v-for="seat in 100"
                :key="seat"
                :class="seatStatus(seat)"
                @click="toggleSeat(seat)"
                class="w-8 h-8 transition-all rounded cursor-pointer"
              ></div>
            </div>
            <div class="flex justify-center mt-6 space-x-6 text-sm">
              <div class="flex items-center">
                <div class="w-4 h-4 mr-2 bg-gray-300 rounded"></div>
                Available
              </div>
              <div class="flex items-center">
                <div class="w-4 h-4 mr-2 bg-purple-600 rounded"></div>
                Selected
              </div>
              <div class="flex items-center">
                <div class="w-4 h-4 mr-2 bg-red-500 rounded"></div>
                Taken
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="sticky p-8 bg-white shadow-lg rounded-2xl top-24">
            <h3 class="mb-6 text-xl font-bold">Booking Summary</h3>
            <div class="mb-6 space-y-4">
              <div class="flex justify-between">
                <span>Show</span>
                <span class="font-semibold">{{
                  selectedShow?.title || "Hamilton"
                }}</span>
              </div>
              <div class="flex justify-between">
                <span>Date</span>
                <span>Jan 15, 2024</span>
              </div>
              <div class="flex justify-between">
                <span>Time</span>
                <span>7:30 PM</span>
              </div>
              <div class="flex justify-between">
                <span>Seats</span>
                <span>{{ selectedSeats.length }} selected</span>
              </div>
              <hr />
              <div class="flex justify-between text-lg font-bold">
                <span>Total</span>
                <span>${{ selectedSeats.length * 85 }}</span>
              </div>
            </div>
            <button
              class="w-full py-4 text-lg font-semibold text-white transition-all rounded-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
            >
              Proceed to Payment
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

const availableTimes = ['2:00 PM', '7:30 PM', '8:00 PM']

const availableDates = [
  { day: 'Today', date: 'Jan 15' },
  { day: 'Tomorrow', date: 'Jan 16' },
  { day: 'Wed', date: 'Jan 17' },
  { day: 'Thu', date: 'Jan 18' },
  { day: 'Fri', date: 'Jan 19' },
  { day: 'Sat', date: 'Jan 20' }
]

</script>
<style>
</style>