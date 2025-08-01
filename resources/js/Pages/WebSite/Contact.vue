<template>
  <AppLayout>
    <div class="container px-4 py-8 mx-auto">
      <div class="max-w-4xl mx-auto">
        <h1 class="mb-8 text-4xl font-bold text-center text-gray-800">
          Contact Us
        </h1>

        <div class="grid gap-12 lg:grid-cols-2">
          <div class="p-8 bg-white shadow-lg rounded-2xl">
            <h2 class="mb-6 text-2xl font-bold">Get in Touch</h2>
            <form class="space-y-6">
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-700"
                  >Name</label
                >
                <input
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                />
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-700"
                  >Email</label
                >
                <input
                  type="email"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                />
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-700"
                  >Message</label
                >
                <textarea
                  rows="5"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                ></textarea>
              </div>
              <button
                type="submit"
                class="w-full py-3 font-semibold text-white transition-all rounded-lg bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700"
              >
                Send Message
              </button>
            </form>
          </div>

          <div class="space-y-8">
            <div class="p-8 bg-white shadow-lg rounded-2xl">
              <h3 class="mb-6 text-xl font-bold">Contact Information</h3>
              <div class="space-y-4">
                <div class="flex items-center">
                  <Phone class="w-5 h-5 mr-3 text-purple-600" />
                  <span>+1 (555) 123-4567</span>
                </div>
                <div class="flex items-center">
                  <Mail class="w-5 h-5 mr-3 text-purple-600" />
                  <span>info@theaterhub.com</span>
                </div>
                <div class="flex items-center">
                  <MapPin class="w-5 h-5 mr-3 text-purple-600" />
                  <span>123 Theater District, New York, NY 10001</span>
                </div>
              </div>
            </div>

            <div class="p-8 bg-white shadow-lg rounded-2xl">
              <h3 class="mb-6 text-xl font-bold">Office Hours</h3>
              <div class="space-y-2">
                <div class="flex justify-between">
                  <span>Monday - Friday</span>
                  <span>9:00 AM - 8:00 PM</span>
                </div>
                <div class="flex justify-between">
                  <span>Saturday</span>
                  <span>10:00 AM - 6:00 PM</span>
                </div>
                <div class="flex justify-between">
                  <span>Sunday</span>
                  <span>12:00 PM - 5:00 PM</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>
<style>
</style>