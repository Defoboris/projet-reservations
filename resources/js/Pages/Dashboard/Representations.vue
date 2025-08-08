<template>
  <AuthLayout>
    <div class="p-6">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Representations Management</h2>
        <button
          @click="openAddRepresentationModal"
          class="px-6 py-3 font-semibold text-white transition-all rounded-lg bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
        >
          <Plus class="inline w-4 h-4 mr-2" />
          Add New Representation
        </button>
      </div>
      <div class="bg-white border border-gray-100 shadow-sm rounded-xl">
        <div class="p-6 border-b border-gray-200">
          <div class="flex flex-col gap-4 sm:flex-row">
            <div class="relative flex-1">
              <Search class="absolute w-4 h-4 text-gray-400 left-3 top-3" />
              <input
                v-model="representationSearch"
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
                  Show
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Location
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Date
                </th>
                <th class="px-6 py-4 font-medium text-left text-gray-600">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="representation in filteredRepresentations"
                :key="representation.id"
                class="border-b border-gray-100 hover:bg-gray-50"
              >
                <td class="px-6 py-4">
                  <div class="flex items-center space-x-3">
                    <img
                      :src="representation.show.poster_url"
                      alt="Poster"
                      class="object-cover w-12 h-12 rounded"
                      v-if="representation.show.poster_url"
                    />
                    <div>
                      <p class="font-semibold text-gray-800">
                        {{ representation.show.title }}
                      </p>
                      <p class="text-sm text-gray-500 lowercase">
                        /{{ representation.location.address }}
                      </p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 text-gray-600">
                  {{ representation.location.designation }}
                </td>
                <td class="px-6 py-4 text-gray-500">
                  {{ new Date(representation.date).toLocaleDateString() }}
                </td>
                <td class="px-6 py-4">
                  <div class="flex space-x-2">
                    <button
                      @click="editrRpresentation(representation)"
                      class="p-2 text-blue-600 rounded-lg hover:bg-blue-50"
                    >
                      <Edit class="w-4 h-4" />
                    </button>
                    <button
                      @click="deleteRepresentation(representation.id)"
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
    <RepresentationModal
      v-if="showRepresentationModal"
      :is-open="showRepresentationModal"
      :mode="modalMode"
      :initial-data="selectedRepresentation"
      :shows="shows"
      :locations="props.locations"
      @close="showRepresentationModal = false"
      @save="handleSave"
    />
  </AuthLayout>
</template>
<script setup>
import { computed, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import RepresentationModal from "@/Components/AuthComponents/Components/RepresentationModal.vue";

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

const representationsFilter = ref("all");
const representationSearch = ref("");
const showRepresentationModal = ref(false); // control modal visibility

const modalMode = ref("add"); // either 'add' or 'edit'
const selectedRepresentation = ref({
  show_id: "",
  location_id: "",
  date: "",
});


const props = defineProps({
  shows: Array,
  representations: Array,
  locations: Array
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

const filteredRepresentations = computed(() => {
  let filtered = props.representations;
  if (representationsFilter.value !== "all") {
    filtered = filtered.filter(
      (show) => show.category.toLowerCase() === representationsFilter.value
    );
  }
  if (representationSearch.value) {
    filtered = filtered.filter(
      (show) =>
        show.title.toLowerCase().includes(representationSearch.value.toLowerCase()) ||
        getLocalityName(show.location_id)
          .toLowerCase()
          .includes(representationSearch.value.toLowerCase())
    );
  }
  return filtered;
});

function openAddRepresentationModal() {
  modalMode.value = "add";
  selectedRepresentation.value = {
    show_id: "",
    location_id: "",
    date: "",
  };
  showRepresentationModal.value = true;
}

function editrRpresentation(show) {
  modalMode.value = "edit";
  selectedRepresentation.value = { ...show };
  showRepresentationModal.value = true;
}

function handleSave(data) {
  console.log(data);
  if (modalMode.value === "add") {
    router.post(route("admin.representations.store"), data, {
      preserveScroll: true,
      onSuccess: () => {
        showRepresentationModal.value = false;
        toast.success("Represention created successfully.", {
          autoClose: 3000,
          position: "top-right",
        });
      },
    });
  } else {
    router.put(route("admin.representations.update", data.id), data, {
      preserveScroll: true,
      onSuccess: () => {
        showRepresentationModal.value = false;
        toast.success("Represention Updated successfully.", {
          autoClose: 3000,
          position: "top-right",
        });
      },
    });
  }
}

function deleteRepresentation(id) {
  if (confirm("Are you sure?")) {
    router.delete(route("admin.representations.destroy", id), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success("Represention deleted successfully.", {
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