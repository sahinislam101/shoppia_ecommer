<template>
  <section class="py-10">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
      <!-- Title + Arrows -->
      <div class="flex justify-between items-center mb-2">
        <h2 class="text-2xl font-bold flex items-center gap-2">🔥 Flash Sales</h2>
        <div class="flex gap-2">
          <button @click="scrollLeft" class="p-2 rounded-full bg-gray-200 hover:bg-gray-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <button @click="scrollRight" class="p-2 rounded-full bg-gray-200 hover:bg-gray-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Timer -->
      <!-- <div class="flex gap-2 mb-6">
        <span class="bg-black text-white px-3 py-1 rounded text-sm">03</span>
        <span class="bg-black text-white px-3 py-1 rounded text-sm">23</span>
        <span class="bg-black text-white px-3 py-1 rounded text-sm">19</span>
        <span class="bg-black text-white px-3 py-1 rounded text-sm">56</span>
      </div> -->

      <!-- Scrollable Cards -->
      <div
        ref="scrollContainer"
        class="flex gap-6 overflow-x-auto scrollbar-hide scroll-smooth pb-2"
      >
        <div
          v-for="item in flash_sales"
          :key="item.id"
          class="min-w-[250px] bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition"
        >
          <div class="p-6 flex justify-center items-center">
            <img :src="item.image" alt="Product" class="h-32 object-contain" />
          </div>

          <div class="px-4 py-3 text-gray-800">
            <h3 class="font-semibold text-sm truncate">{{ item.name }}</h3>
            <p class="text-red-600 font-bold mt-1">${{ item.original_price }}</p>
            <p class="text-xs text-gray-500">Sold: {{ item.selling_price }}</p>
          </div>

          <div class="flex justify-between items-center gap-2 px-4 pb-4">
            <button
              class="w-1/2 bg-gray-100 hover:bg-gray-200 text-sm font-medium text-gray-800 py-2 rounded"
            >
              Add to Cart
            </button>
            <button
              class="w-1/2 bg-red-500 hover:bg-red-600 text-sm font-medium text-white py-2 rounded"
            >
              Buy Now
            </button>
          </div>
        </div>
      </div>

      <!-- View All -->
      <div class="text-center mt-8">
        <Link href="/allproducts" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-full font-medium" >View All Products</Link>
        
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

// Props from parent
const props = defineProps({
  flash_sales: {
    type: Array,
    required: true,
  },
})

// Scroll logic
const scrollContainer = ref(null)

const scrollLeft = () => {
  scrollContainer.value.scrollBy({ left: -300, behavior: 'smooth' })
}
const scrollRight = () => {
  scrollContainer.value.scrollBy({ left: 300, behavior: 'smooth' })
}
// add all new code 

</script>

<style scoped>
/* Hide scrollbar */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

</style>
