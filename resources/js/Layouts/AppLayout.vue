<template>
  <div class="min-h-screen bg-gray-50">
    <Header />
    <slot />
    <Footer />
  </div>
</template>
<script setup>
import Footer from '@/Share/Footer.vue';
import Header from '@/Share/Header.vue';

</script>
<style>
</style>