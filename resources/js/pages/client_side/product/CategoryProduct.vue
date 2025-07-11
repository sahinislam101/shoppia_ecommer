<template>
    <Header />
 <div class="bg-white py-10 px-4 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <div
        v-for="product in products.data"
        :key="product.id"
        class="bg-white border rounded shadow hover:shadow-md"
      >
        <img
          :src="product.image"
          alt="Product Image"
          class="w-full h-64 object-contain p-4"
        />
        <div class="p-4">
          <h3 class="text-sm font-semibold truncate">{{ product.name }}</h3>
          <p class="text-red-600 font-bold mt-1">৳ {{ product.original_price }}</p>
          <p class="text-xs text-gray-500">Sold: {{ product.selling_price }}</p>

          <div class="flex gap-2 mt-3">
            <button class="w-1/2 bg-gray-100 hover:bg-gray-200 text-sm py-2 rounded">Add to Cart</button>
            <button class="w-1/2 bg-red-500 hover:bg-red-600 text-sm text-white py-2 rounded">Buy Now</button>
          </div>
        </div>
      </div>
    </div>
 </div>
 <Footer />
</template>

<script setup>
import Header from '@/components/client_side/layout/Header.vue'
import Footer from '@/components/client_side/layout/Footer.vue'
const props = defineProps({
  category: {
    type: Object,
    required: true
  },
  products: {
    type: Object,
    required: true
  }
})
</script>
