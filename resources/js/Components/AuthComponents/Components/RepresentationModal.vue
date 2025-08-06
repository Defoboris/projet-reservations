<template>
  <div
    v-if="isOpen"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
  >
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full max-h-[90vh] flex flex-col">
      <!-- Header -->
      <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 bg-white border-b">
        <h3 class="text-xl font-bold text-gray-800">
          {{ mode === "add" ? "Add New Location" : "Edit Location" }}
        </h3>
        <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
          <X class="w-6 h-6" />
        </button>
      </div>

      <!-- Body -->
      <div class="flex-1 px-6 py-4 space-y-4 overflow-y-auto">
        <form @submit.prevent="handleSubmit" class="space-y-4">
          <!-- Designation -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Designation</label>
            <input
              v-model="formData.designation"
              type="text"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

          <!-- Slug -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Slug</label>
            <input
              v-model="formData.slug"
              type="text"
              placeholder="Optional"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

           <!-- Image -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Image</label>
            <input
              v-model="formData.image"
              type="text"
              placeholder="Optional"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

          <!-- Capacity -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Capacity</label>
            <input
              v-model="formData.capacity"
              type="text"
              placeholder="Optional"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

          <!-- Address -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Address</label>
            <input
              v-model="formData.address"
              type="text"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

          <!-- Website -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Website</label>
            <input
              v-model="formData.website"
              type="url"
              placeholder="https://example.com"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

          <!-- Phone -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Phone</label>
            <input
              v-model="formData.phone"
              type="tel"
              placeholder="+34 XX XXX XXX"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

          <!-- Locality -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Locality</label>
            <select
              v-model="formData.locality_id"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            >
              <option value="">Select Locality</option>
              <option
                v-for="locality in localities"
                :key="locality.id"
                :value="locality.id"
              >
                {{ locality.name }}
              </option>
            </select>
          </div>
        </form>
      </div>

      <!-- Footer -->
      <div class="sticky bottom-0 z-10 flex justify-end px-6 py-4 space-x-4 bg-white border-t">
        <button
          type="button"
          @click="closeModal"
          class="px-4 py-2 text-gray-600 hover:text-gray-800"
        >
          Cancel
        </button>
        <button
          type="submit"
          form="form"
          @click="handleSubmit"
          class="px-6 py-2 text-white rounded-lg bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
        >
          {{ mode === "add" ? "Add Location" : "Save Changes" }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watchEffect } from "vue";
import { X } from "lucide-vue-next";

const emit = defineEmits(["close", "save"]);

const props = defineProps({
  isOpen: Boolean,
  mode: {
    type: String,
    default: "add",
  },
  initialData: {
    type: Object,
    default: () => ({
      slug: "",
      image: "",
      capcity: "",
      designation: "",
      address: "",
      locality_id: "",
      website: "",
      phone: "",
    }),
  },
  localities: {
    type: Array,
    default: () => [],
  },
});

const formData = ref({});

watchEffect(() => {
  formData.value = { ...props.initialData };
});

function closeModal() {
  emit("close");
}

function handleSubmit() {
  emit("save", formData.value);
}
</script>
