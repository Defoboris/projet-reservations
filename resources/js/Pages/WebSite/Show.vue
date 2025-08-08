<template>
  <AppLayout>
    <div class="container h-full px-4 py-8 mx-auto">
      <div class="mb-8">
        <h1 class="mb-4 text-4xl font-bold text-gray-800">All Shows</h1>
        <div class="flex flex-wrap gap-4 mb-6">
          <button
            v-for="category in categories"
            :key="category"
            @click="selectedCategory = category"
            :class="
              selectedCategory === category
                ? 'bg-purple-600 text-white'
                : 'bg-white text-gray-600 hover:bg-purple-50'
            "
            class="px-4 py-2 transition-all border border-purple-200 rounded-full"
          >
            {{ category }}
          </button>
        </div>
      </div>
      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <Link
          v-for="show in filteredShows"
          :key="show.id"
          class="transition-shadow bg-white shadow-md cursor-pointer rounded-xl hover:shadow-lg"
          :href="route('show.details', show.id)"
        >
          <div :style="{ backgroundImage: `url('${show.poster_url}')` }" class="relative h-48 bg-center bg-cover rounded-t-xl">
            <div
              class="absolute px-2 py-1 text-xs font-semibold bg-white rounded-full top-4 left-4 bg-opacity-90"
            >
              {{ show.category }}
            </div>
          </div>
          <div class="p-6">
            <h3 class="mb-2 text-xl font-bold">{{ show.title }}</h3>
            <p class="mb-4 text-gray-600">{{ show.description }}</p>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <MapPin class="w-4 h-4 mr-1 text-gray-400" />
                <span class="text-sm text-gray-600">{{ show.venue }}</span>
              </div>
              <span class="font-semibold text-purple-600"
                >Locality: {{ show.locality.name }}</span 
              >
            </div>
          </div>
        </Link>
      </div>
    </div>
  </AppLayout>
</template>
<script setup>
import { ref, computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const categories = ["All", "Musical", "Drama", "Comedy", "Opera", "Ballet"];
const selectedCategory = ref('All')

const props = defineProps({
  allShows: {
    type: Array,
    required: true,
  },
});

const filteredShows = computed(() => {
  if (selectedCategory.value === "All") {
    return props.allShows;
  }
  return props.allShows.filter((show) => show.category === selectedCategory.value);
});

</script>
<style>
</style>