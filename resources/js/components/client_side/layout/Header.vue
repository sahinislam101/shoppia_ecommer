<template>
  <header class="bg-white shadow-sm py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4">

      <!-- Logo -->
      <div class="text-2xl font-bold text-gray-800"><a :href="route('home')">Shoppia</a></div>

      <!-- Nav Links -->
      <nav class="space-x-6 hidden md:flex">
        <Link :href="route('home')" :class="{
          'text-black border-b-2 border-black pb-1': route().current('home'),
          'text-gray-600 hover:text-black': !route().current('home')
        }">Home</Link>

        <Link :href="route('contact')" :class="{
          'text-black border-b-2 border-black pb-1': route().current('contact'),
          'text-gray-600 hover:text-black': !route().current('contact')
        }">Contact</Link>

        <Link :href="route('about')" :class="{
          'text-black border-b-2 border-black pb-1': route().current('about'),
          'text-gray-600 hover:text-black': !route().current('about')
        }">About</Link>

        <Link :href="route('login')" :class="{
          'text-black border-b-2 border-black pb-1': route().current('login'),
          'text-gray-600 hover:text-black': !route().current('login')
        }">Sign Up</Link>
      </nav>


      <!-- Search + Icons -->
      <div class="flex items-center space-x-4">
        <div class="relative">
          <input type="text" placeholder="What are you looking for?"
            class="pl-4 pr-10 py-2 border rounded-full bg-gray-100 text-sm w-64" />
          <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
            🔍
          </span>
        </div>
        <button title="Wishlist">🤍</button>
        <button title="Cart">🛒</button>
      </div>

    </div>
  </header>
</template>

<script setup>

// কোনো অতিরিক্ত logic এখন নেই
import { Head, Link } from '@inertiajs/vue3';
</script>
