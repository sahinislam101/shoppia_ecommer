<template>
  <Header />

  <div class="bg-white py-10 px-4 max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="text-sm text-gray-600 mb-4">
      <span class="text-gray-400">/</span>
      <Link :href="route('home')" class="text-gray-500 hover:underline">
        Home
      </Link>
      <span class="text-gray-400">/</span>
      <span class="font-semibold">All Products</span>
    </div>

    <!-- Filter Bar -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <!-- Price Filter -->
      <div>
        <h2 class="font-semibold mb-2">PRICE RANGE</h2>
        <div class="flex items-center gap-2 mb-4">
          <input v-model="filters.minPrice" type="number" class="w-full border px-2 py-1 rounded" placeholder="Min" />
          <input v-model="filters.maxPrice" type="number" class="w-full border px-2 py-1 rounded" placeholder="Max" />
        </div>
        <div class="flex gap-2">
          <button @click="clearFilters" class="bg-gray-300 px-3 py-1 rounded text-sm">Clear Filters</button>
          <button @click="applyFilters" class="bg-black text-white px-3 py-1 rounded text-sm">Filter Range</button>
        </div>
      </div>

      <!-- Availability (Placeholder) -->
      <div>
        <h2 class="font-semibold mb-2">AVAILABILITY</h2>
        <div class="space-y-2">
          <label class="flex items-center gap-2">
            <input type="radio" name="availability" class="accent-amber-400" /> In-Stock
          </label>
          <label class="flex items-center gap-2">
            <input type="radio" name="availability" class="accent-amber-400" /> Pre-Order
          </label>
        </div>
      </div>

      <!-- Sorting -->
      <div class="md:col-span-2 flex justify-between items-end">
        <div class="text-gray-700">All Products</div>
        <select v-model="filters.sort" @change="applyFilters" class="border px-2 py-1 rounded">
          <option value="default">Default</option>
          <option value="low">Price Low to High</option>
          <option value="high">Price High to Low</option>
        </select>
      </div>
    </div>

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
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import Header from '@/components/client_side/layout/Header.vue'
import Footer from '@/components/client_side/layout/Footer.vue'

const props = defineProps({
  products: Object,
})

const filters = ref({
  minPrice: '',
  maxPrice: '',
  sort: 'default',
})

const applyFilters = () => {
  router.get(route('products.all'), filters.value, {
    preserveState: true,
    preserveScroll: true,
  })
}

const clearFilters = () => {
  filters.value.minPrice = ''
  filters.value.maxPrice = ''
  filters.value.sort = 'default'
  applyFilters()
}
</script>

<style scoped>
/* Hide scrollbar example */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
