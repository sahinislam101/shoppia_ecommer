<template>
    <Header />
  <section class="bg-white py-12 px-4">
    <div class="max-w-7xl mx-auto space-y-16">

      <!-- Breadcrumb -->
      <div class="text-sm text-gray-500">
        <span class="text-gray-400">/</span>
        <Link :href="route('home')" class="hover:underline">Home</Link>
        <span class="text-gray-400">/</span>
        <span class="font-semibold text-gray-800">About</span>
      </div>

      <!-- Story Section -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <div>
          <h2 class="text-3xl font-bold mb-4">Our Story</h2>
          <p class="text-gray-600 mb-4">
            Founded in 2019, Shoppia is South Asia’s premier online shopping marketplace with an active presence in multiple countries.
            We offer a convenient and seamless shopping experience, strong payment methods, and a range of quality products.
          </p>
          <p class="text-gray-600">
            With more than 1 million products in stock, Shoppia is a trusted name in online commerce.
          </p>
        </div>
        <img
          src="https://via.placeholder.com/500x400"
          alt="Our Team"
          class="rounded-lg w-full object-cover"
        />
      </div>

      <!-- Stats Section -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div class="p-6 bg-white border rounded shadow-sm">
          <h3 class="text-2xl font-bold text-black">10.5k</h3>
          <p class="text-sm text-gray-500">Satisfied Sellers on our site</p>
        </div>
        <div class="p-6 bg-red-500 text-white border rounded shadow-sm">
          <h3 class="text-2xl font-bold">33k</h3>
          <p class="text-sm">Monthly Product Sale</p>
        </div>
        <div class="p-6 bg-white border rounded shadow-sm">
          <h3 class="text-2xl font-bold text-black">45.5k</h3>
          <p class="text-sm text-gray-500">Customers active on our site</p>
        </div>
        <div class="p-6 bg-white border rounded shadow-sm">
          <h3 class="text-2xl font-bold text-black">25k</h3>
          <p class="text-sm text-gray-500">Annual gross sale on our site</p>
        </div>
      </div>

      <!-- Team Section -->
      <div class="text-center">
        <h2 class="text-2xl font-bold mb-6">Meet Our Team</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
          <div v-for="member in team" :key="member.name" class="text-center space-y-3">
            <img :src="member.image" class="w-32 h-32 rounded-full mx-auto object-cover" />
            <h4 class="font-semibold">{{ member.name }}</h4>
            <p class="text-sm text-gray-500">{{ member.position }}</p>
            <div class="flex justify-center gap-3 text-gray-500 text-lg">
              <i class="ri-facebook-line"></i>
              <i class="ri-twitter-line"></i>
              <i class="ri-linkedin-line"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Feature Section -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center mt-10">
        <div class="space-y-2">
          <img src="https://img.icons8.com/ios-filled/50/000000/delivery.png" class="mx-auto h-10" />
          <h4 class="font-semibold">FREE AND FAST DELIVERY</h4>
          <p class="text-sm text-gray-600">Free delivery for all orders over ৳1000</p>
        </div>
        <div class="space-y-2">
          <img src="https://img.icons8.com/ios-filled/50/000000/headset.png" class="mx-auto h-10" />
          <h4 class="font-semibold">24/7 CUSTOMER SERVICE</h4>
          <p class="text-sm text-gray-600">Friendly 24/7 customer support</p>
        </div>
        <div class="space-y-2">
          <img src="https://img.icons8.com/ios-filled/50/000000/money.png" class="mx-auto h-10" />
          <h4 class="font-semibold">MONEY BACK GUARANTEE</h4>
          <p class="text-sm text-gray-600">We return money within 7 days</p>
        </div>
      </div>
    </div>
  </section>
  <Footer />
</template>

<script setup>
import Header from '@/components/client_side/layout/Header.vue'
import Footer from '@/components/client_side/layout/Footer.vue'
import { Link } from '@inertiajs/vue3'

const team = [
  {
    name: 'Tom Cruise',
    position: 'Founder & Chairman',
    image: 'https://via.placeholder.com/150x150',
  },
  {
    name: 'Emma Watson',
    position: 'Managing Director',
    image: 'https://via.placeholder.com/150x150',
  },
  {
    name: 'Will Smith',
    position: 'Product Designer',
    image: 'https://via.placeholder.com/150x150',
  },
]
</script>


<style scoped>
/* icon style if needed */
</style>
