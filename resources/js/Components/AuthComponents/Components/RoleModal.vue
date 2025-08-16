<template>
  <div
    v-if="isOpen"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
  >
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full max-h-[90vh] flex flex-col">
      <!-- Header -->
      <div class="sticky top-0 z-10 flex items-center justify-between px-6 py-4 bg-white border-b">
        <h3 class="text-xl font-bold text-gray-800">
          {{ mode === "add" ? "Add New User" : "Edit User Role" }}
        </h3>
        <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
          <X class="w-6 h-6" />
        </button>
      </div>

      <!-- Body -->
      <div class="flex-1 px-6 py-4 space-y-4 overflow-y-auto">
        <form @submit.prevent="handleSubmit" class="space-y-4">
          <!-- Shows -->
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">User Role</label>
            <select
              v-model="formData.role"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"
            >
              <option value="">Select Role</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
              <option value="affiliate">Affiliate</option>
              <option value="critic">Critic</option>
              <option value="producer">Producer</option>
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
import { ref, watch } from "vue";
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
      role: ""
    }),
  },
});

const formData = ref({
  role: ""
});

// When modal opens, initialize formData with initialData
watch(
  () => props.isOpen,
  (newVal) => {
    if (newVal) {
      formData.value = { ...props.initialData };
    }
  }
);

function closeModal() {
  emit("close");
}

function handleSubmit() {
  emit("save", formData.value);
}
</script>
