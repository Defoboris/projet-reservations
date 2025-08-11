<template>
  <AppLayout>
    <main class="container mx-auto min-h-[calc(100vh-16rem)] px-4 py-8">
      <div class="w-full bg-white rounded-lg shadow-lg">
        <!-- CardHeader -->
        <div class="p-6">
          <h2 class="text-3xl font-bold text-gray-800">My Reservations</h2>
          <p class="text-gray-600">
            View and manage your upcoming and past theater bookings.
          </p>
        </div>
        <!-- CardContent -->
        <div class="p-6 pt-0">
          <div
            v-if="props.mockReservations.length === 0"
            class="flex flex-col items-center justify-center py-12 text-gray-500"
          >
            <Ticket class="w-12 h-12 mb-4" />
            <p class="text-lg">No reservations found.</p>
            <p class="text-sm">
              Start exploring shows to book your first experience!
            </p>
            <button
              class="px-4 py-2 mt-6 text-white rounded-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
            >
              Browse Shows
            </button>
          </div>
          <div v-else class="overflow-x-auto">
            <table class="w-full table-auto">
              <thead>
                <tr
                  class="text-sm font-medium text-left text-gray-500 border-b"
                >
                  <th class="px-4 py-2">Show</th>
                  <th class="px-4 py-2">Venue</th>
                  <th class="px-4 py-2">Date & Time</th>
                  <th class="px-4 py-2">Tickets</th>
                  <th class="px-4 py-2">Total Price</th>
                  <th class="px-4 py-2">Status</th>
                  <th class="px-4 py-2 text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="reservation in props.mockReservations"
                  :key="reservation.id"
                  class="border-b hover:bg-gray-50"
                >
                  <td class="px-4 py-3 font-medium">
                    {{ reservation.representation.show.title }}
                  </td>
                  <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                      <MapPin class="w-4 h-4 text-gray-500" />
                      {{ reservation.representation.location.designation }}
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                      <Calendar class="w-4 h-4 text-gray-500" />
                      {{ formatDateTime(reservation.reservation.booking_date) }}
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                      <Ticket class="w-4 h-4 text-gray-500" />
                      {{ reservation.quantity }}
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                      <DollarSign class="w-4 h-4 text-gray-500" />
                      {{ totalPrice(reservation) }}
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <span
                      :class="[
                        'inline-flex items-center rounded-full px-2 py-1 text-xs font-semibold',
                        reservation.reservation.status === 'booked'
                          ? 'bg-green-100 text-green-800'
                          : 'bg-red-100 text-red-800',
                      ]"
                    >
                      <CheckCircle
                        v-if="reservation.reservation.status === 'booked'"
                        class="inline-block w-3 h-3 mr-1"
                      />
                      <XCircle v-else class="inline-block w-3 h-3 mr-1" />
                      {{
                        reservation.reservation.status.charAt(0).toUpperCase() +
                        reservation.reservation.status.slice(1)
                      }}
                    </span>
                  </td>
                  <td class="px-4 py-3 text-right">
                    <button
                      v-if="reservation.reservation.status === 'booked'"
                      @click="handleCancelReservation(reservation.id)"
                      class="inline-flex items-center justify-center px-3 text-sm font-medium text-white transition-colors bg-pink-600 rounded-md whitespace-nowrap ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-pink-700 h-9"
                    >
                      <Trash2 class="w-4 h-4 mr-2" />
                      Cancel
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Custom AlertDialog (Modal) -->
      <div
        v-if="showCancelDialog"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
      >
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
          <h3 class="mb-2 text-lg font-semibold">Are you absolutely sure?</h3>
          <p class="text-sm text-gray-500">
            This action cannot be undone. This will permanently cancel your
            reservation.
          </p>
          <div class="flex justify-end mt-6 space-x-2">
            <button
              @click="showCancelDialog = false"
              class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors border rounded-md whitespace-nowrap ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border-input bg-background hover:bg-accent hover:text-accent-foreground h-9"
            >
              Dismiss
            </button>
            <button
              @click="confirmCancel"
              class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white transition-colors bg-pink-600 rounded-md whitespace-nowrap ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-pink-700 h-9"
            >
              Confirm Cancellation
            </button>
          </div>
        </div>
      </div>
    </main>
  </AppLayout>
</template>
<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import {
  Calendar,
  CheckCircle,
  DollarSign,
  MapPin,
  Ticket,
  Trash2,
  XCircle,
} from "lucide-vue-next";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
  mockReservations: Array
});

const showCancelDialog = ref(false);
const selectedReservationId = ref(null);

const handleCancelReservation = (id) => {
  selectedReservationId.value = id;
  showCancelDialog.value = true;
};

const confirmCancel = () => {
  if (selectedReservationId.value) {
    router.put(route("bookings.update", selectedReservationId.value), { status: "cancelled"}, {
      preserveScroll: true,
      onSuccess: () => {
        showCancelDialog.value = false;
        selectedReservationId.value = null;
      },
    });
  }
};

const formatDateTime = (isoString) => {
  const date = new Date(isoString);
  return date.toLocaleString("en-US", {
    year: "numeric",
    month: "long",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  });
};

const totalPrice = (reservation) => {
  return reservation.price.price * reservation.quantity;
};
</script>
