<template>
  <AuthLayout>
    <div class="p-6">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Venues Management</h2>
        <button
          @click="openAddVenueModal"
          class="px-6 py-3 font-semibold text-white transition-all rounded-lg bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
        >
          <Plus class="inline w-4 h-4 mr-2" />
          Add New Venue
        </button>
      </div>

      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="venue in props.venues"
          :key="venue.id"
          class="overflow-hidden transition-shadow bg-white border border-gray-100 shadow-sm rounded-xl hover:shadow-md"
        >
          <div :class="venue.gradient" class="relative h-48">
            <div
              class="absolute inset-0 bg-center bg-cover"
              :style="{ backgroundImage: `url('${venue.image}')` }"
            ></div>
            <div class="absolute top-4 right-4">
              <div class="flex space-x-2">
                <button
                  @click="editVenue(venue)"
                  class="p-2 text-white bg-white rounded-lg bg-opacity-20 hover:bg-opacity-30"
                >
                  <Edit class="w-4 h-4" />
                </button>
                <button
                  @click="deleteVenue(venue.id)"
                  class="p-2 text-white bg-white rounded-lg bg-opacity-20 hover:bg-opacity-30"
                >
                  <Trash2 class="w-4 h-4" />
                </button>
              </div>
            </div>
            <div class="absolute text-white bottom-4 left-4">
              <h3 class="text-xl font-bold">{{ venue.designation }}</h3>
              <p class="text-sm ">{{ venue.address }}</p>
            </div>
          </div>
          <div class="p-6">
            <p class="mb-4 text-gray-600">{{ venue.description }}</p>
            <div class="grid grid-cols-2 gap-4 text-sm">
              <div>
                <span class="text-gray-500">Capacity:</span>
                <span class="ml-2 font-semibold">{{ venue.capacity }}</span>
              </div>
              <div>
                <span class="text-gray-500">Locality:</span>
                <span class="ml-2 font-semibold">{{
                  venue.locality.name
                }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <VenuesModal
      v-if="showModal"
      :is-open="showModal"
      :mode="modalMode"
      :initial-data="selectedVenue"
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
import VenuesModal from "@/Components/AuthComponents/Components/VenuesModal.vue";

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

const modalMode = ref("add"); // either 'add' or 'edit'
const showModal = ref(false);
const showsSearch = ref("");
const selectedVenue = ref({
  slug: "",
  image: "",
  capacity: "",
  designation: "",
  address: "",
  locality_id: "",
  website: "",
  phone: "",
});

const props = defineProps({
  venues: Array,
  localities: Array,
});

// const venues = [
//   {
//     slug: "opera-de-paris",
//     image: "https://example.com/images/opera.jpg",
//     capacity: "2000",
//     designation: "Opéra de Paris",
//     address: "Place de l'Opéra, 75009 Paris, France",
//     locality_id: 1,
//     website: "https://www.operadeparis.fr",
//     phone: "+33 1 71 25 24 23",
//   },
//   {
//     slug: "broadway-theatre",
//     image: "https://example.com/images/broadway.jpg",
//     capacity: "1761",
//     designation: "Broadway Theatre",
//     address: "1681 Broadway, New York, NY 10019, USA",
//     locality_id: 2,
//     website: "https://broadway.com",
//     phone: "+1 212-239-6200",
//   },
//   {
//     slug: "yaounde-arts-center",
//     image: "https://example.com/images/yaounde.jpg",
//     capacity: "500",
//     designation: "Yaoundé Arts Center",
//     address: "Quartier Bastos, Yaoundé, Cameroon",
//     locality_id: 3,
//     website: null,
//     phone: "+237 6 99 99 99 99",
//   },
//   {
//     slug: "royal-albert-hall",
//     image: "https://example.com/images/royal.jpg",
//     capacity: "5272",
//     designation: "Royal Albert Hall",
//     address: "Kensington Gore, South Kensington, London SW7 2AP, UK",
//     locality_id: 4,
//     website: "https://www.royalalberthall.com",
//     phone: "+44 20 7589 8212",
//   },
// ];

function openAddVenueModal() {
  modalMode.value = "add";
  selectedVenue.value = {
    slug: "",
    image: "",
    capacity: "",
    designation: "",
    address: "",
    locality_id: "",
    website: "",
    phone: "",
  };
  showModal.value = true;
}

const editVenue = (venue) => {
  modalMode.value = "edit";
  selectedVenue.value = { ...venue };
  showModal.value = true;
};

function handleSave(data) {
  if (modalMode.value === "add") {
    router.post(route("admin.venues.store"), data, {
      preserveScroll: true,
      onSuccess: () => {
        showModal.value = false;
        toast.success("Venue created successfully.", {
          autoClose: 3000,
          position: "top-right",
        });
      },
    });
  } else {
    router.put(route("admin.venues.update", data.id), data, {
      preserveScroll: true,
      onSuccess: () => {
        showModal.value = false;
        toast.success("Venue Updated successfully.", {
          autoClose: 3000,
          position: "top-right",
        });
      },
    });
  }
}

const deleteVenue = (venueId) => {
  if (confirm("Are you sure?")) {
    router.delete(route("admin.venues.destroy", venueId), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success("Venue deleted successfully.", {
          autoClose: 3000,
          position: "top-right",
        });
      },
    });
  }
};
</script>
<style>
</style>