<template>
  <div
    v-if="isOpen"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
  >
    <div
      class="bg-white rounded-xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto"
    >
      <div class="p-6">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-xl font-bold text-gray-800">
            {{ mode === "add" ? "Add New Show" : "Edit Show" }}
          </h3>
          <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
            <X class="w-6 h-6" />
          </button>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-4">
          <!-- Title -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Title</label>
            <input
              v-model="formData.title"
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

          <!-- Category -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Category</label>
            <select
              v-model="formData.category"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            >
              <option value="">Select Category</option>
              <option value="Musical">Musical</option>
              <option value="Drama">Drama</option>
              <option value="Comedy">Comedy</option>
              <option value="Ballet">Ballet</option>
            </select>
          </div>

          <!-- Duration -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Duration (minutes)</label>
            <input
              v-model.number="formData.duration"
              type="number"
              required
              min="1"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

          <!-- Created In -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Created Date</label>
            <input
              v-model="formData.created_in"
              type="date"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

          <!-- Poster URL -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Poster URL</label>
            <input
              v-model="formData.poster_url"
              type="url"
              placeholder="https://example.com/poster.jpg"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            />
          </div>

          <!-- Locality -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Locality</label>
            <select
              v-model="formData.locality_id"
              required
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

          <!-- Bookable -->
          <div>
            <label class="inline-flex items-center space-x-2 text-sm font-medium text-gray-700">
              <input
                type="checkbox"
                v-model="formData.bookable"
                class="w-4 h-4 text-purple-600 form-checkbox"
              />
              <span>Bookable</span>
            </label>
          </div>

          <!-- Description -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Description</label>
            <textarea
              v-model="formData.description"
              rows="3"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            ></textarea>
          </div>

          <!-- Footer Buttons -->
          <div class="flex justify-end pt-4 space-x-4">
            <button
              type="button"
              @click="closeModal"
              class="px-4 py-2 text-gray-600 hover:text-gray-800"
            >
              Cancel
            </button>
            <button
              type="submit"
              class="px-6 py-2 text-white rounded-lg bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
            >
              {{ mode === "add" ? "Add Show" : "Save Changes" }}
            </button>
          </div>
        </form>
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
      title: "",
      slug: "",
      category: "",
      duration: 0,
      created_in: "",
      poster_url: "",
      locality_id: "",
      bookable: false,
      description: "",
    }),
  },
  localities: Array,
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


<style scoped></style>
