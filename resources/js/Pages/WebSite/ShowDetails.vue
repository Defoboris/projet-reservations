<template>
  <AppLayout>
    <div class="container px-4 py-8 mx-auto">
      <Link
        :href="route('shows')"
        class="flex items-center mb-6 text-purple-600 hover:text-purple-700"
      >
        <ArrowLeft class="w-4 h-4 mr-2" />
        Back to Shows
      </Link>

      <div class="grid gap-12 lg:grid-cols-2">
        <div>
          <div
            :class="selectedShow.gradient"
            class="mb-6 h-96 rounded-2xl"
          ></div>
          <div class="grid grid-cols-3 gap-4">
            <div
              :class="selectedShow.gradient"
              class="h-24 rounded-lg opacity-70"
            ></div>
            <div
              :class="selectedShow.gradient"
              class="h-24 rounded-lg opacity-50"
            ></div>
            <div
              :class="selectedShow.gradient"
              class="h-24 rounded-lg opacity-30"
            ></div>
          </div>
        </div>

        <div>
          <div class="mb-6">
            <span
              class="px-3 py-1 text-sm font-semibold text-purple-800 bg-purple-100 rounded-full"
              >{{ selectedShow.category }}</span
            >
          </div>
          <h1 class="mb-4 text-4xl font-bold text-gray-800">
            {{ selectedShow.title }}
          </h1>
          <div class="flex items-center mb-6">
            <div class="flex mr-3 text-yellow-400">
              <Star
                v-for="i in 5"
                :key="i"
                :class="i <= selectedShow.rating ? 'fill-current' : ''"
                class="w-5 h-5"
              />
            </div>
            <span class="text-gray-600"
              >{{ selectedShow.rating }}/5 (234 reviews)</span
            >
          </div>

          <p class="mb-8 text-lg text-gray-600">
            {{ selectedShow.fullDescription || selectedShow.description }}
          </p>

          <div class="p-6 mb-8 bg-gray-50 rounded-xl">
            <h3 class="mb-4 text-lg font-semibold">Show Details</h3>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <div class="text-sm text-gray-500">Venue</div>
                <div class="font-semibold">{{ selectedShow.venue }}</div>
              </div>
              <div>
                <div class="text-sm text-gray-500">Duration</div>
                <div class="font-semibold">2h 30min</div>
              </div>
              <div>
                <div class="text-sm text-gray-500">Language</div>
                <div class="font-semibold">English</div>
              </div>
              <div>
                <div class="text-sm text-gray-500">Age Rating</div>
                <div class="font-semibold">PG-13</div>
              </div>
            </div>
          </div>

          <div class="flex items-center justify-between mb-8">
            <div>
              <div class="text-sm text-gray-500">Starting from</div>
              <div class="text-3xl font-bold text-purple-600">
                ${{ selectedShow.price }}
              </div>
            </div>
            <button
              @click="currentPage = 'booking'"
              class="px-8 py-4 text-lg font-semibold text-white transition-all rounded-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
            >
              Book Tickets
            </button>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";

const selectedShow = ref({
  id: 4,
  title: "Romeo and Juliet",
  category: "Drama",
  description: "Shakespeare's timeless tragedy of star-crossed lovers.",
  venue: "Globe Theatre",
  price: 65,
  rating: 4.6,
  gradient: "bg-gradient-to-br from-pink-500 to-red-600",
});
</script>