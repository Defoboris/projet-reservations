<template>
    <footer class="py-16 mt-16 text-white bg-gray-900">
      <div class="container px-4 mx-auto">
        <div class="grid gap-8 mb-8 md:grid-cols-4">
          <div>
            <div class="flex items-center mb-6 space-x-2">
              <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-r from-purple-600 to-pink-600">
                <Theater class="w-5 h-5 text-white" />
              </div>
              <span class="text-xl font-bold">TheaterHub</span>
            </div>
            <p class="mb-6 text-gray-400">Your premier destination for discovering and booking the finest theatrical experiences.</p>
            <div class="flex space-x-4">
              <Facebook class="w-5 h-5 text-gray-400 cursor-pointer hover:text-white" />
              <Twitter class="w-5 h-5 text-gray-400 cursor-pointer hover:text-white" />
              <Instagram class="w-5 h-5 text-gray-400 cursor-pointer hover:text-white" />
            </div>
          </div>
          <div>
            <h3 class="mb-6 font-semibold">Shows</h3>
            <ul class="space-y-3 text-gray-400">
              <li><a href="#" class="hover:text-white">Browse All Shows</a></li>
              <li><a href="#" class="hover:text-white">Featured Shows</a></li>
              <li><a href="#" class="hover:text-white">New Releases</a></li>
              <li><a href="#" class="hover:text-white">Top Rated</a></li>
            </ul>
          </div>
          <div>
            <h3 class="mb-6 font-semibold">Venues</h3>
            <ul class="space-y-3 text-gray-400">
              <li><a href="#" class="hover:text-white">Royal Opera House</a></li>
              <li><a href="#" class="hover:text-white">The Globe Theatre</a></li>
              <li><a href="#" class="hover:text-white">National Theatre</a></li>
              <li><a href="#" class="hover:text-white">Broadway Theaters</a></li>
            </ul>
          </div>
          <div>
            <h3 class="mb-6 font-semibold">Support</h3>
            <ul class="space-y-3 text-gray-400">
              <li><a href="#" class="hover:text-white">Help Center</a></li>
              <li><a href="#" class="hover:text-white">Contact Us</a></li>
              <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
              <li><a href="#" class="hover:text-white">Terms of Service</a></li>
            </ul>
          </div>
        </div>
        
        <div class="flex flex-col items-center justify-between pt-8 border-t border-gray-800 md:flex-row">
          <p class="text-gray-400">© 2024 TheaterHub. All rights reserved.</p>
          <div class="flex items-center mt-4 space-x-4 md:mt-0">
            <span class="text-gray-400">Follow us:</span>
            <div class="flex space-x-3">
              <Facebook class="w-4 h-4 text-gray-400 cursor-pointer hover:text-white" />
              <Twitter class="w-4 h-4 text-gray-400 cursor-pointer hover:text-white" />
              <Instagram class="w-4 h-4 text-gray-400 cursor-pointer hover:text-white" />
            </div>
          </div>
        </div>
      </div>
    </footer>
</template>
<script>
import { 
  Search, User, Theater, Play, Calendar, Star, MapPin, ArrowLeft, 
  Users, Ticket, Heart, Settings, Phone, Mail, Facebook, Twitter, Instagram
} from 'lucide-vue-next'

</script>
<style scoped>

</style>