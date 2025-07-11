<script setup lang="ts">
import Header from '@/components/client_side/layout/Header.vue'
import Footer from '@/components/client_side/layout/Footer.vue'
import CategorySlider from '@/components/client_side/layout/CategorySlider.vue'
import MainSlider from '@/components/client_side/layout/MainSlider.vue'
import Flash from '@/components/client_side/flash/Flash.vue'
import Category from '@/components/client_side/category/Category.vue'
import Best from '@/components/client_side/best_selling/Best.vue'
import Top from '@/components/client_side/banner/Top.vue'
import Explore from '@/components/client_side/Explore_Our_Product/Explore.vue'

const props = defineProps({
  sliders: {
    type: Array,
    required: true,
  },
  categories: {
    type: Array,
    required: true,
  },
  flash_sales: {
    type: Array,
    required: true,
  },
  best_sell: {
    type: Array,
    required: true,
  },
  explore: {
    type: Array,
    required: true,
  },
  top: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <Head title="Home" />
  <Header />

  <div class="max-w-7xl mx-auto mt-8 px-4 flex flex-col md:flex-row gap-4">
    <CategorySlider :categories="categories" />
    <MainSlider :sliders="sliders" />
  </div>

  <Flash :flash_sales="flash_sales" />
  <Category :categories="categories" />
  <Best :best_sell="best_sell" />
  
  <!-- এখানে top props বাইন্ড করে পাঠানো হয়েছে -->
  <Top :banner="top" />

  <Explore :products="explore" />

  <Footer />
</template>
