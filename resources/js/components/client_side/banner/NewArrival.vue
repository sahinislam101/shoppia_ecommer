<template>
  <section class="py-16 px-4 sm:px-6 lg:px-24 bg-white">
    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="mb-8">
        <p class="text-red-500 font-semibold mb-1">Featured</p>
        <h2 class="text-3xl font-bold">New Arrival</h2>
      </div>

      <!-- Grid Layout -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Large Left Image -->
        <div class="md:col-span-2 relative group">
          <img src="/images/banners/ps5.jpg" alt="PlayStation 5" class="w-full h-full object-cover rounded-xl" />
          <div class="absolute bottom-6 left-6 text-white">
            <h3 class="text-xl font-semibold">PlayStation 5</h3>
            <p class="text-sm mt-1 max-w-xs">Black and White version of the PS5 coming out on sale.</p>
            <button class="mt-3 px-4 py-2 text-sm font-medium bg-white text-black rounded hover:bg-gray-200">
              Shop Now
            </button>
          </div>
        </div>

        <!-- Right Column -->
        <div class="flex flex-col gap-6">
          <!-- Top Right Banner -->
          <div class="relative group">
            <img src="/images/banners/women.jpg" alt="Women's Collections" class="w-full h-full object-cover rounded-xl" />
            <div class="absolute bottom-6 left-6 text-white">
              <h3 class="text-lg font-semibold">Women’s Collections</h3>
              <p class="text-sm mt-1">Featured woman collections that give you another vibe.</p>
              <button class="mt-3 px-4 py-2 text-sm font-medium bg-white text-black rounded hover:bg-gray-200">
                Shop Now
              </button>
            </div>
          </div>

          <!-- Bottom Right Small Banners -->
          <div class="grid grid-cols-2 gap-6">
            <!-- Speaker -->
            <div class="relative group">
              <img src="/images/banners/speaker.jpg" alt="Speakers" class="w-full h-full object-cover rounded-xl" />
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-sm font-semibold">Speakers</h3>
                <p class="text-xs">Amazon wireless speakers</p>
                <button class="mt-2 px-3 py-1 text-xs font-medium bg-white text-black rounded hover:bg-gray-200">
                  Shop Now
                </button>
              </div>
            </div>

            <!-- Perfume -->
            <div class="relative group">
              <img src="/images/banners/perfume.jpg" alt="Perfume" class="w-full h-full object-cover rounded-xl" />
              <div class="absolute bottom-4 left-4 text-white">
                <h3 class="text-sm font-semibold">Perfume</h3>
                <p class="text-xs">GUCCI INTENSE OUD EDP</p>
                <button class="mt-2 px-3 py-1 text-xs font-medium bg-white text-black rounded hover:bg-gray-200">
                  Shop Now
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { ref } from 'vue'

const props = defineProps({
    new_arrival:{
        type: Array,
        required: true,
    },
})

</script>