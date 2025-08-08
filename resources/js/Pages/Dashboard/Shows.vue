<template>
  <AuthLayout>
    <div class="p-6">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Shows Management</h2>
        <button
          @click="openAddShowModal"
          class="px-6 py-3 font-semibold text-white transition-all rounded-lg bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
        >
          <Plus class="inline w-4 h-4 mr-2" />
          Add New Show
        </button>
      </div>
      <div class="bg-white border border-gray-100 shadow-sm rounded-xl">
        <div class="p-6 border-b border-gray-200">
          <div class="flex flex-col gap-4 sm:flex-row">
            <div class="relative flex-1">
              <Search class="absolute w-4 h-4 text-gray-400 left-3 top-3" />
              <input
                v-model="showsSearch"
                type="text"
                placeholder="Search shows..."
                class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
              />
            </div>
            <select
              v-model="showsFilter"
              class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
            >
              <option value="all">All Categories</option>
              <option value="musical">Musical</option>
              <option value="drama">Drama</option>
              <option value="comedy">Comedy</option>
              <option value="ballet">Ballet</option>
            </select>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Image
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Show
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Category
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Venue
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Status
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Price Range
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="show in filteredShows"
                :key="show.id"
                class="border-b border-gray-100 hover:bg-gray-50"
              >
                <td class="px-6 py-4">
                  <div class="flex items-center space-x-3">
                    <img
                      :src="show.poster_url"
                      alt="Poster"
                      class="object-cover w-12 h-12 rounded"
                      v-if="show.poster_url"
                    />
                    <div>
                      <p class="font-semibold text-gray-800">
                        {{ show.title }}
                      </p>
                      <p class="text-sm text-gray-500 lowercase">
                        /{{ show.slug }}
                      </p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 text-gray-700">
                  <span
                    class="px-3 py-1 text-sm font-medium text-purple-800 bg-purple-100 rounded-full"
                  >
                    {{ show.category }}
                  </span>
                </td>
                <td class="px-6 py-4 text-gray-600">
                  {{ show.locality.name }}
                </td>
                <td class="px-6 py-4">
                  <span
                    :class="
                      show.bookable
                        ? 'bg-green-100 text-green-800'
                        : 'bg-gray-200 text-gray-700'
                    "
                    class="px-3 py-1 text-sm font-medium rounded-full"
                  >
                    {{ show.bookable ? "Bookable" : "Not Bookable" }}
                  </span>
                </td>
                <td class="px-6 py-4 text-gray-600">
                  {{ show.duration }} mins
                </td>
                <td class="px-6 py-4 text-gray-500">
                  {{ new Date(show.created_in).toLocaleDateString() }}
                </td>
                <td class="px-6 py-4">
                  <div class="flex space-x-2">
                    <button
                      @click="editShow(show)"
                      class="p-2 text-blue-600 rounded-lg hover:bg-blue-50"
                    >
                      <Edit class="w-4 h-4" />
                    </button>
                    <button
                      @click="deleteShow(show.id)"
                      class="p-2 text-red-600 rounded-lg hover:bg-red-50"
                    >
                      <Trash2 class="w-4 h-4" />
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <ShowModal
      v-if="showModal"
      :is-open="showModal"
      :mode="modalMode"
      :initial-data="selectedShow"
      :venues="venues"
      :localities="props.localities"
      @close="showModal = false"
      @save="handleSave"
    />
  </AuthLayout>
</template>
<script setup>
import { computed, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import ShowModal from "@/Components/AuthComponents/Components/ShowModal.vue";

import {
  Theater,
  Menu,
  Bell,
  User,
  DollarSign,
  Ticket,
  Play,
  Users,
  BarChart3,
  Star,
  Plus,
  Search,
  Edit,
  Trash2,
  Eye,
  Download,
  Shield,
  TrendingUp,
  PieChart,
  X,
  Calendar,
  MapPin,
  Settings,
} from "lucide-vue-next";

const showsFilter = ref("all");
const showsSearch = ref("");
const showModal = ref(false); // control modal visibility

const modalMode = ref("add"); // either 'add' or 'edit'
const selectedShow = ref({
  title: "",
  slug: "",
  category: "",
  duration: 90,
  created_in: new Date().toISOString().split("T")[0],
  poster_url: "",
  locality_id: "",
  bookable: false,
  description: "",
});


const props = defineProps({
  shows: Array,
  venues: Object,
  localities: Array
});


const venues = [
  {
    id: 1,
    name: "Royal Opera House",
    location: "Covent Garden, London",
    description: "Historic venue with world-class acoustics",
    capacity: 2256,
    activeShows: 8,
    gradient: "bg-gradient-to-br from-red-600 to-pink-600",
  },
  {
    id: 2,
    name: "Broadway Theater",
    location: "Times Square, New York",
    description: "Iconic Broadway venue",
    capacity: 1761,
    activeShows: 6,
    gradient: "bg-gradient-to-br from-blue-600 to-purple-600",
  },
  {
    id: 3,
    name: "Globe Theatre",
    location: "Southwark, London",
    description: "Authentic Shakespearean theatre",
    capacity: 1570,
    activeShows: 4,
    gradient: "bg-gradient-to-br from-amber-600 to-orange-600",
  },
  {
    id: 4,
    name: "Minskoff Theatre",
    location: "Times Square, New York",
    description: "Modern Broadway venue",
    capacity: 1710,
    activeShows: 3,
    gradient: "bg-gradient-to-br from-green-600 to-teal-600",
  },
];

function getLocalityName(id) {
  const locality = props.localities.find((loc) => loc.id === id);
  return locality ? locality.name : "Unknown";
}

const filteredShows = computed(() => {
  let filtered = props.shows;
  if (showsFilter.value !== "all") {
    filtered = filtered.filter(
      (show) => show.category.toLowerCase() === showsFilter.value
    );
  }
  if (showsSearch.value) {
    filtered = filtered.filter(
      (show) =>
        show.title.toLowerCase().includes(showsSearch.value.toLowerCase()) ||
        getLocalityName(show.locality_id)
          .toLowerCase()
          .includes(showsSearch.value.toLowerCase())
    );
  }
  return filtered;
});

function openAddShowModal() {
  modalMode.value = "add";
  selectedShow.value = {
    title: "",
    slug: "",
    category: "",
    duration: 90,
    created_in: new Date().toISOString().split("T")[0],
    poster_url: "",
    locality_id: "",
    bookable: false,
    description: "",
  };
  showModal.value = true;
}

function editShow(show) {
  modalMode.value = "edit";
  selectedShow.value = { ...show };
  showModal.value = true;
}

function handleSave(data) {
  if (modalMode.value === "add") {
    router.post(route("admin.shows.store"), data, {
      preserveScroll: true,
      onSuccess: () => {
        showModal.value = false;
        toast.success("Show created successfully.", {
          autoClose: 3000,
          position: "top-right",
        });
      },
    });
  } else {
    router.put(route("admin.shows.update", data.id), data, {
      preserveScroll: true,
      onSuccess: () => {
        showModal.value = false;
        toast.success("Show Updated successfully.", {
          autoClose: 3000,
          position: "top-right",
        });
      },
    });
  }
}

function deleteShow(id) {
  if (confirm("Are you sure?")) {
    router.delete(route("admin.shows.destroy", id), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success("Show deleted successfully.", {
          autoClose: 3000,
          position: "top-right",
        });
      },
    });
  }
}
</script>
<style>
</style>