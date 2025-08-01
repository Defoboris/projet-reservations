<template>
  <AppLayout>
    <div class="container px-4 py-8 mx-auto">
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
        <div
          v-for="show in filteredShows"
          :key="show.id"
          class="transition-shadow bg-white shadow-md cursor-pointer rounded-xl hover:shadow-lg"
          @click="viewShowDetails(show)"
        >
          <div :class="show.gradient" class="relative h-48 rounded-t-xl">
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
                >From ${{ show.price }}</span
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
import { ref } from "vue";
import { computed } from "vue";
const categories = ["All", "Musical", "Drama", "Comedy", "Opera", "Ballet"];
const selectedCategory = ref('All')

const filteredShows = computed(() => {
  if (selectedCategory.value === "All") {
    return allShows;
  }
  return allShows.filter((show) => show.category === selectedCategory.value);
});

const featuredShows = [
  {
    id: 1,
    title: "The Phantom of the Opera",
    category: "Musical",
    description:
      "A haunting tale of love and obsession in the Paris Opera House.",
    fullDescription:
      'Experience the timeless story of the mysterious Phantom who haunts the Paris Opera House and his obsession with the beautiful soprano Christine. This spectacular musical features stunning costumes, elaborate sets, and unforgettable music including "The Music of the Night" and "All I Ask of You".',
    venue: "Royal Opera House",
    price: 85,
    rating: 4.8,
    gradient: "bg-gradient-to-br from-orange-500 to-red-600",
  },
  {
    id: 2,
    title: "Hamilton",
    category: "Musical",
    description: "The revolutionary musical about Alexander Hamilton.",
    fullDescription:
      "Lin-Manuel Miranda's groundbreaking musical tells the story of Alexander Hamilton, one of America's founding fathers. With its innovative hip-hop score and diverse casting, Hamilton brings the 18th century to life in a completely new way.",
    venue: "Broadway Theater",
    price: 120,
    rating: 4.9,
    gradient: "bg-gradient-to-br from-blue-500 to-purple-600",
  },
  {
    id: 3,
    title: "The Lion King",
    category: "Musical",
    description: "Disney's beloved story comes to life on stage.",
    fullDescription:
      'Journey to the Pride Lands with Simba, Timon, and Pumbaa in this spectacular adaptation of Disney\'s beloved animated film. Featuring stunning puppetry, vibrant costumes, and unforgettable songs like "Circle of Life" and "Can You Feel the Love Tonight".',
    venue: "Minskoff Theatre",
    price: 95,
    rating: 4.7,
    gradient: "bg-gradient-to-br from-yellow-500 to-orange-600",
  },
  {
    id: 1,
    title: "The Phantom of the Opera",
    category: "Musical",
    description:
      "A haunting tale of love and obsession in the Paris Opera House.",
    fullDescription:
      'Experience the timeless story of the mysterious Phantom who haunts the Paris Opera House and his obsession with the beautiful soprano Christine. This spectacular musical features stunning costumes, elaborate sets, and unforgettable music including "The Music of the Night" and "All I Ask of You".',
    venue: "Royal Opera House",
    price: 85,
    rating: 4.8,
    gradient: "bg-gradient-to-br from-orange-500 to-red-600",
  },
  {
    id: 2,
    title: "Hamilton",
    category: "Musical",
    description: "The revolutionary musical about Alexander Hamilton.",
    fullDescription:
      "Lin-Manuel Miranda's groundbreaking musical tells the story of Alexander Hamilton, one of America's founding fathers. With its innovative hip-hop score and diverse casting, Hamilton brings the 18th century to life in a completely new way.",
    venue: "Broadway Theater",
    price: 120,
    rating: 4.9,
    gradient: "bg-gradient-to-br from-blue-500 to-purple-600",
  },
  {
    id: 3,
    title: "The Lion King",
    category: "Musical",
    description: "Disney's beloved story comes to life on stage.",
    fullDescription:
      'Journey to the Pride Lands with Simba, Timon, and Pumbaa in this spectacular adaptation of Disney\'s beloved animated film. Featuring stunning puppetry, vibrant costumes, and unforgettable songs like "Circle of Life" and "Can You Feel the Love Tonight".',
    venue: "Minskoff Theatre",
    price: 95,
    rating: 4.7,
    gradient: "bg-gradient-to-br from-yellow-500 to-orange-600",
  },
  {
    id: 1,
    title: "The Phantom of the Opera",
    category: "Musical",
    description:
      "A haunting tale of love and obsession in the Paris Opera House.",
    fullDescription:
      'Experience the timeless story of the mysterious Phantom who haunts the Paris Opera House and his obsession with the beautiful soprano Christine. This spectacular musical features stunning costumes, elaborate sets, and unforgettable music including "The Music of the Night" and "All I Ask of You".',
    venue: "Royal Opera House",
    price: 85,
    rating: 4.8,
    gradient: "bg-gradient-to-br from-orange-500 to-red-600",
  },
  {
    id: 2,
    title: "Hamilton",
    category: "Musical",
    description: "The revolutionary musical about Alexander Hamilton.",
    fullDescription:
      "Lin-Manuel Miranda's groundbreaking musical tells the story of Alexander Hamilton, one of America's founding fathers. With its innovative hip-hop score and diverse casting, Hamilton brings the 18th century to life in a completely new way.",
    venue: "Broadway Theater",
    price: 120,
    rating: 4.9,
    gradient: "bg-gradient-to-br from-blue-500 to-purple-600",
  },
  {
    id: 3,
    title: "The Lion King",
    category: "Musical",
    description: "Disney's beloved story comes to life on stage.",
    fullDescription:
      'Journey to the Pride Lands with Simba, Timon, and Pumbaa in this spectacular adaptation of Disney\'s beloved animated film. Featuring stunning puppetry, vibrant costumes, and unforgettable songs like "Circle of Life" and "Can You Feel the Love Tonight".',
    venue: "Minskoff Theatre",
    price: 95,
    rating: 4.7,
    gradient: "bg-gradient-to-br from-yellow-500 to-orange-600",
  },
];

const allShows = [
  ...featuredShows,
  {
    id: 4,
    title: "Romeo and Juliet",
    category: "Drama",
    description: "Shakespeare's timeless tragedy of star-crossed lovers.",
    venue: "Globe Theatre",
    price: 65,
    rating: 4.6,
    gradient: "bg-gradient-to-br from-pink-500 to-red-600",
  },
  {
    id: 5,
    title: "Chicago",
    category: "Musical",
    description: "A dazzling musical about fame, fortune, and murder.",
    venue: "Ambassador Theatre",
    price: 75,
    rating: 4.5,
    gradient: "bg-gradient-to-br from-gray-700 to-black",
  },
  {
    id: 6,
    title: "Swan Lake",
    category: "Ballet",
    description: "Tchaikovsky's masterpiece ballet.",
    venue: "Lincoln Center",
    price: 90,
    rating: 4.8,
    gradient: "bg-gradient-to-br from-blue-400 to-indigo-600",
  },
];
</script>
<style>
</style>