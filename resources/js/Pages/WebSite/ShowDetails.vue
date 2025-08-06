<template>
  <AppLayout>
    <div class="flex items-center justify-center h-screen">
      <div class="w-full max-w-4xl p-6 bg-white rounded-lg shadow-xl md:p-8">
      <!-- Back to Shows / Back to Details Link -->
      <Link
       v-if="currentPage === 'details' && selectedShowId"
        :href="route('shows')"
        class="flex items-center mb-6 text-purple-600 transition-colors duration-200 hover:text-purple-700"
      >
        <ArrowLeft class="w-4 h-4 mr-2" />
        Back to Show Selection
      </Link>
      <button
        v-if="currentPage === 'booking'"
        @click="currentPage = 'details'"
        class="flex items-center mb-6 text-purple-600 transition-colors duration-200 hover:text-purple-700"
      >
        <ArrowLeft class="w-4 h-4 mr-2" />
        Back to Show Details
      </button>
      
      <!-- Show Details View -->
      <div v-if="currentPage === 'details' && selectedShow" class="grid gap-12 lg:grid-cols-2">
        <div>
          <img :src="show.poster_url" class="w-96 h-96" alt="">
          <div class="grid grid-cols-3 gap-4">
            <div :class="selectedShow.gradient" class="h-24 rounded-lg opacity-70"></div>
            <div :class="selectedShow.gradient" class="h-24 rounded-lg opacity-50"></div>
            <div :class="selectedShow.gradient" class="h-24 rounded-lg opacity-30"></div>
          </div>
        </div>
        <div>
          <div class="mb-6">
            <span
              class="px-3 py-1 text-sm font-semibold text-purple-800 bg-purple-100 rounded-full"
              >{{ show.category }}</span
            >
          </div>
          <h1 class="mb-4 text-4xl font-bold text-gray-800">
            {{ show.title }}
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
              >{{ selectedShow.rating }}/5 ({{ selectedShow.reviews }} reviews)</span
            >
          </div>
          <p class="mb-8 text-lg text-gray-600">
            {{ show.description }}
          </p>
          <div class="p-6 mb-8 bg-gray-50 rounded-xl">
            <h3 class="mb-4 text-lg font-semibold">Show Details</h3>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <div class="text-sm text-gray-500">Duration</div>
                <div class="font-semibold">{{ show.duration }}min</div>
              </div>
              <div>
                <div class="text-sm text-gray-500">Language</div>
                <div class="font-semibold">FRENCH</div>
              </div>
              <div>
                <div class="text-sm text-gray-500">Age Rating</div>
                <div class="font-semibold">{{ selectedShow.ageRating }}</div>
              </div>
            </div>
          </div>
          <div class="flex items-center justify-between mb-8">
            <div>
              <div class="text-sm text-gray-500">Starting from</div>
              <div class="text-3xl font-bold text-purple-600">
                ${{ selectedShow.price.toFixed(2) }}
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

      <!-- Booking View -->
      <div v-if="currentPage === 'booking' && selectedShow" class="mt-8">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">Select Your Tickets</h2>

        <!-- Representations List -->
        <div class="mb-6">
          <h3 class="mb-4 text-xl font-semibold text-gray-800">Available Representations:</h3>
          <div v-if="isLoadingRepresentations" class="text-center text-gray-500">Loading representations...</div>
          <div v-else-if="representations.length === 0" class="text-center text-gray-500">
            No representations found for this show.
          </div>
          <ul v-else class="space-y-4">
            <li
              v-for="rep in representations"
              :key="rep.id"
              @click="selectedRepresentationId = rep.id"
              :class="[
                'p-4 border rounded-lg cursor-pointer transition-all duration-200',
                selectedRepresentationId === rep.id
                  ? 'border-purple-600 bg-purple-50 shadow-md'
                  : 'border-gray-200 hover:border-purple-100 hover:shadow-sm',
              ]"
            >
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                  <CalendarDays class="w-5 h-5 text-gray-600" />
                  <span class="font-medium text-gray-800">{{ formatDate(rep.date) }}</span>
                </div>
                <div class="flex items-center space-x-3">
                  <Clock class="w-5 h-5 text-gray-600" />
                  <span class="text-gray-700">{{ formatTime(rep.date) }}</span>
                </div>
              </div>
              <div class="flex items-center mt-2 space-x-3 text-gray-600">
                <MapPin class="w-5 h-5" />
                <span>{{ rep.location }}</span>
              </div>
              <div class="flex items-center mt-2 space-x-3 text-gray-600">
                <Ticket class="w-5 h-5" />
                <span>Price: ${{ rep.price.toFixed(2) }}</span>
              </div>
            </li>
          </ul>
        </div>

        <!-- Quantity and Booking -->
        <div v-if="selectedRepresentationId" class="mb-6">
          <h3 class="mb-4 text-xl font-semibold text-gray-800">Confirm Quantity:</h3>
          <div class="flex items-center mb-6 space-x-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity:</label>
            <input
              type="number"
              id="quantity"
              v-model.number="quantity"
              min="1"
              class="w-24 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
            />
          </div>

          <button
            @click="bookRepresentation"
            :disabled="isLoading || !selectedRepresentationId || quantity < 1"
            class="w-full px-4 py-3 text-lg font-semibold text-white transition-colors duration-200 rounded-md bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            <span v-if="isLoading">Booking...</span>
            <span v-else>Confirm Booking</span>
          </button>
        </div>

        <!-- Status Messages -->
        <div v-if="error" class="p-4 mt-6 text-red-700 bg-red-100 rounded-md">
          <p class="font-medium">Error:</p>
          <p>{{ error }}</p>
        </div>

        <div v-if="isBookingConfirmed" class="p-4 mt-6 text-green-700 bg-green-100 rounded-md">
          <p class="font-medium">Booking Confirmed!</p>
          <p>Your reservation for {{ quantity }} ticket(s) has been successfully placed.</p>
          <p>A confirmation email has been sent to your registered email address.</p>
        </div>
      </div>
    </div>
    </div>
  </AppLayout>
</template>
<script setup>
import { ref,onMounted, watch } from "vue";
import { ArrowLeft, CalendarDays, Clock, MapPin, Ticket, Star } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
  show: {
    type: Array,
    required: true,
  },
});

// Reactive state
const shows = ref([]);
const selectedShowId = ref('');
const selectedShow = ref(null); // Holds the full details of the selected show
const representations = ref([]);
const selectedRepresentationId = ref('');
const quantity = ref(1);
const isBookingConfirmed = ref(false);
const isLoading = ref(false);
const isLoadingRepresentations = ref(false);
const error = ref(null);
const currentPage = ref('details'); // 'details' or 'booking'

// Mock Data (replace with actual API calls)
const mockShows = [
  {
    id: 'show-1',
    title: 'The Phantom of the Opera',
    category: 'Musical',
    description: 'A timeless story of a mysterious masked figure who haunts the Paris Opera House.',
    fullDescription: 'Deep in the catacombs of the Paris Opera House, a masked musical genius, the Phantom, falls in love with the innocent soprano Christine. His obsession leads to a dramatic and tragic tale of love, jealousy, and murder. Experience the magic and mystery live!',
    rating: 4.8,
    reviews: 234,
    venue: 'Majestic Theatre',
    duration: '2h 30min',
    language: 'English',
    ageRating: 'PG-13',
    price: 85.00,
    gradient: 'bg-gradient-to-br from-purple-500 to-pink-500',
  },
  {
    id: 'show-2',
    title: 'Hamilton',
    category: 'Hip-Hop Musical',
    description: 'The story of America\'s founding father Alexander Hamilton, an immigrant from the West Indies who became George Washington\'s right-hand man.',
    fullDescription: 'Hamilton is a groundbreaking musical that tells the story of American Founding Father Alexander Hamilton through a blend of hip-hop, jazz, R&B, and Broadway. It explores his life, political career, and rivalries, offering a fresh perspective on American history and a truly unique theatrical experience.',
    rating: 4.9,
    reviews: 567,
    venue: 'Richard Rodgers Theatre',
    duration: '2h 45min',
    language: 'English',
    ageRating: 'PG',
    price: 120.00,
    gradient: 'bg-gradient-to-br from-blue-500 to-cyan-500',
  },
  {
    id: 'show-3',
    title: 'Les Misérables',
    category: 'Musical Drama',
    description: 'An epic and uplifting story about the survival of the human spirit.',
    fullDescription: 'Set in 19th-century France, Les Misérables tells the enthralling story of Jean Valjean, a former convict who spends nineteen years in jail for stealing a loaf of bread. Relentlessly pursued by the ruthless Inspector Javert, Valjean seeks redemption while caring for Cosette, the daughter of a dying factory worker. A powerful and emotional journey.',
    rating: 4.7,
    reviews: 189,
    venue: 'Imperial Theatre',
    duration: '3h 00min',
    language: 'English',
    ageRating: 'PG-13',
    price: 95.00,
    gradient: 'bg-gradient-to-br from-red-500 to-orange-500',
  },
];

const mockRepresentations = {
  'show-1': [
    { id: 'rep-1-1', date: '2025-08-15T19:00:00Z', location: 'Majestic Theatre', price: 85.00 },
    { id: 'rep-1-2', date: '2025-08-16T14:00:00Z', location: 'Majestic Theatre', price: 75.00 },
    { id: 'rep-1-3', date: '2025-08-16T19:00:00Z', location: 'Majestic Theatre', price: 90.00 },
  ],
  'show-2': [
    { id: 'rep-2-1', date: '2025-09-01T20:00:00Z', location: 'Richard Rodgers Theatre', price: 120.00 },
    { id: 'rep-2-2', date: '2025-09-02T14:00:00Z', location: 'Richard Rodgers Theatre', price: 110.00 },
  ],
  'show-3': [
    { id: 'rep-3-1', date: '2025-10-05T19:30:00Z', location: 'Imperial Theatre', price: 95.00 },
  ],
};

// Functions
const fetchShows = async () => {
  isLoading.value = true;
  error.value = null;
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 500));
    shows.value = mockShows;
    // Automatically select the first show if available
    if (shows.value.length > 0) {
      selectedShowId.value = shows.value[0].id;
      selectedShow.value = shows.value[0];
      fetchRepresentations(); // Fetch representations for the initially selected show
    }
  } catch (err) {
    error.value = 'Failed to load shows. Please try again.';
  } finally {
    isLoading.value = false;
  }
};

const handleShowSelection = () => {
  selectedShow.value = shows.value.find(show => show.id === selectedShowId.value);
  currentPage.value = 'details'; // Always go to details page after selection
  fetchRepresentations();
};

const fetchRepresentations = async () => {
  if (!selectedShowId.value) {
    representations.value = [];
    selectedRepresentationId.value = '';
    return;
  }

  isLoadingRepresentations.value = true;
  error.value = null;
  selectedRepresentationId.value = ''; // Reset selected representation
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 500));
    representations.value = mockRepresentations[selectedShowId.value] || [];
  } catch (err) {
    error.value = 'Failed to load representations. Please try again.';
  } finally {
    isLoadingRepresentations.value = false;
  }
};

const bookRepresentation = async () => {
  isLoading.value = true;
  error.value = null;
  isBookingConfirmed.value = false;

  if (!selectedRepresentationId.value || quantity.value < 1) {
    error.value = 'Please select a representation and specify a valid quantity.';
    isLoading.value = false;
    return;
  }

  try {
    // Simulate API call to create a reservation and representation_reservation
    await new Promise(resolve => setTimeout(resolve, 1500)); // Simulate network delay

    // Assuming success
    isBookingConfirmed.value = true;
    // Optionally reset form or navigate
    // For this example, we'll keep the confirmation message visible
    // and allow the user to go back to show selection.
  } catch (err) {
    error.value = 'Booking failed. Please try again.';
    console.error('Booking error:', err);
  } finally {
    isLoading.value = false;
  }
};

const resetShowSelection = () => {
  selectedShowId.value = '';
  selectedShow.value = null;
  representations.value = [];
  selectedRepresentationId.value = '';
  quantity.value = 1;
  isBookingConfirmed.value = false;
  currentPage.value = 'details'; // Go back to the initial state with dropdown
};

// Utility functions for formatting
const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('en-US', {
    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
  });
};

const formatTime = (dateString) => {
  return new Date(dateString).toLocaleTimeString('en-US', {
    hour: '2-digit', minute: '2-digit', hour12: true
  });
};

// Lifecycle hook
onMounted(() => {
  fetchShows();
});

// Watch for changes in selectedShowId to update selectedShow
watch(selectedShowId, (newId) => {
  if (newId) {
    selectedShow.value = shows.value.find(show => show.id === newId);
  } else {
    selectedShow.value = null;
  }
});
</script>