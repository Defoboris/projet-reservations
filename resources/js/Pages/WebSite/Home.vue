<template>
  <AppLayout>
    <div class="transition-all duration-500">
      <!-- Hero Section -->
      <section
        class="relative overflow-hidden text-white bg-gradient-to-br from-purple-900 via-purple-800 to-pink-800"
      >
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="container relative px-4 py-24 mx-auto">
          <div class="max-w-4xl mx-auto text-center">
            <h1 class="mb-6 text-6xl font-bold leading-tight md:text-7xl">
              Experience the
              <span
                class="text-transparent bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text"
                >Magic</span
              >
              of Live Theater
               <span
                class="text-transparent bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text"
                >Kuate Joel Parfait </span
              >
            </h1>
            <p
              class="max-w-3xl mx-auto mb-8 text-xl text-purple-100 md:text-2xl"
            >
              Discover world-class performances, book premium seats, and create
              unforgettable memories at the finest theaters in the city.
            </p>
            <div class="flex flex-col justify-center gap-4 sm:flex-row">
              <Link
                :href="route('shows')"
                class="px-8 py-4 text-lg font-semibold text-purple-900 transition-all transform bg-white rounded-full hover:bg-gray-100 hover:scale-105"
              >
                <Play class="inline w-5 h-5 mr-2" />
                Explore Shows
              </Link>
              <Link
                :href="route('bookings.my')"
                class="px-8 py-4 text-lg font-semibold text-white transition-all border-2 border-white rounded-full hover:bg-white hover:text-purple-900"
              >
                <Calendar class="inline w-5 h-5 mr-2" />
                View Schedule
              </Link>
            </div>
          </div>
        </div>
        <div
          class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-gray-50 to-transparent"
        ></div>
      </section>

      <!-- Featured Shows -->
      <section class="container px-4 py-16 mx-auto">
        <div class="mb-12 text-center">
          <h2 class="mb-4 text-4xl font-bold text-gray-800">Featured Shows</h2>
          <p class="text-xl text-gray-600">
            Don't miss these spectacular performances
          </p>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
          <div
            v-for="show in featuredShows"
            :key="show.id"
            class="cursor-pointer group"
            @click="viewShowDetails(show)"
          >
            <div
              class="overflow-hidden transition-all duration-300 transform bg-white shadow-lg rounded-2xl group-hover:scale-105"
            >
              <div class="relative">
                <div
                  :class="show.gradient"
                  class="relative h-64 overflow-hidden"
                >
                  <div
                    class="absolute inset-0 transition-opacity bg-black opacity-20 group-hover:opacity-10"
                  ></div>
                  <div
                    class="absolute px-3 py-1 bg-white rounded-full top-4 right-4 bg-opacity-90"
                  >
                    <span class="text-sm font-semibold text-gray-800">{{
                      show.category
                    }}</span>
                  </div>
                </div>
                <div class="absolute -bottom-6 left-6 right-6">
                  <div class="p-4 bg-white shadow-lg rounded-xl">
                    <h3 class="mb-2 text-xl font-bold">{{ show.title }}</h3>
                    <div class="flex items-center justify-between">
                      <div class="flex items-center">
                        <div class="flex mr-2 text-yellow-400">
                          <Star
                            v-for="i in 5"
                            :key="i"
                            :class="i <= show.rating ? 'fill-current' : ''"
                            class="w-4 h-4"
                          />
                        </div>
                        <span class="text-sm text-gray-600"
                          >{{ show.rating }}/5</span
                        >
                      </div>
                      <span class="font-semibold text-purple-600"
                        >From ${{ show.price }}</span
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="px-6 pt-10 pb-6">
                <p class="mb-4 text-gray-600">{{ show.description }}</p>
                <div class="flex items-center justify-between">
                  <div class="flex items-center text-sm text-gray-500">
                    <MapPin class="w-4 h-4 mr-1" />
                    {{ show.venue }}
                  </div>
                  <button
                    class="px-6 py-2 text-white transition-all rounded-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
                  >
                    Book Now
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Stats Section -->
      <section
        class="py-16 text-white bg-gradient-to-r from-purple-600 to-pink-600"
      >
        <div class="container px-4 mx-auto">
          <div class="grid gap-8 text-center md:grid-cols-4">
            <div>
              <div class="mb-2 text-4xl font-bold">500+</div>
              <div class="text-purple-100">Shows Available</div>
            </div>
            <div>
              <div class="mb-2 text-4xl font-bold">50+</div>
              <div class="text-purple-100">Partner Venues</div>
            </div>
            <div>
              <div class="mb-2 text-4xl font-bold">1M+</div>
              <div class="text-purple-100">Happy Customers</div>
            </div>
            <div>
              <div class="mb-2 text-4xl font-bold">4.9</div>
              <div class="text-purple-100">Average Rating</div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </AppLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import {
  Search,
  User,
  Star,
  Calendar,
  Facebook,
  Twitter,
  Instagram,
} from "lucide-vue-next";

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
];
</script>
<style>
</style>
