<template>
  <section class="py-16 px-4 sm:px-6 lg:px-24 bg-white">
    <div class="max-w-7xl mx-auto">
      <!-- Section Header -->
      <div class="flex justify-between items-center mb-6">
        <div>
          <p class="text-red-500 font-semibold mb-1">Our Products</p>
          <h2 class="text-3xl font-bold">Explore Our Products</h2>
        </div>
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

      <!-- Product Grid -->
      <div ref="scrollContainer" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
        <div
          v-for="product in products"
          :key="product.id"
          class="bg-white rounded-lg overflow-hidden shadow hover:shadow-xl transition"
        >
          <!-- Product Image -->
          <div class="p-6 flex justify-center items-center">
            <img :src="product.image" :alt="product.name" class="h-32 object-contain" />
          </div>

          <!-- Product Info -->
          <div class="px-4 py-3 text-gray-800">
            <h3 class="font-semibold text-sm truncate">{{ product.name }}</h3>
            <p class="text-red-600 font-bold mt-1">${{ product.original_price }}</p>
          </div>

          <!-- Buttons -->
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

      <!-- View All Button -->
      <div class="mt-10 text-center">
        <Link href="/allproducts" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-full font-medium">
          View All Products
        </Link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3';

// Props from parent
const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
})


const scrollContainer = ref(null)

const scrollLeft = () => {
  scrollContainer.value?.scrollBy({ left: -300, behavior: 'smooth' })
}
const scrollRight = () => {
  scrollContainer.value?.scrollBy({ left: 300, behavior: 'smooth' })
}
</script>

<style scoped>
/* Optional: Hide Scrollbar */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
