<script setup lang="ts">
import { onMounted, ref } from 'vue'

// টাইপ ডিফিনিশন
interface Countdown {
  days: number;
  hours: number;
  minutes: number;
  seconds: number;
}

interface Meta {
  countdown?: Countdown;
}

interface BannerItem {
  id: string;
  title?: string;
  subtitle?: string;
  image: string;
  link?: string;
  meta?: Meta;
}

const props = defineProps<{ banner: BannerItem[] }>();
// all time add
// Props

// Timer for each banner (store with banner.id as key)
const countdowns = ref<Record<string, Countdown>>({})

function calculateRemainingTime(endDate: Date): Countdown {
  const now = new Date()
  const diff = endDate.getTime() - now.getTime()

  const totalSeconds = Math.max(0, Math.floor(diff / 1000))
  const days = Math.floor(totalSeconds / (3600 * 24))
  const hours = Math.floor((totalSeconds % (3600 * 24)) / 3600)
  const minutes = Math.floor((totalSeconds % 3600) / 60)
  const seconds = totalSeconds % 60

  return { days, hours, minutes, seconds }
}

// Simulate that each banner has a `meta.countdownEnd` (you can later pull from backend)
onMounted(() => {
  props.banner.forEach((item) => {
    // Example: 5 days from now
    const targetDate = new Date()
    targetDate.setDate(targetDate.getDate() + 1)

    countdowns.value[item.id] = calculateRemainingTime(targetDate)

    setInterval(() => {
      countdowns.value[item.id] = calculateRemainingTime(targetDate)
    }, 1000)
  })
})
</script>

<template>
  <section class="py-12 bg-white">
    <div v-if="banner.length === 0" class="text-center text-white py-12">
      No Banners Available
    </div>

    <div v-for="item in banner" :key="item.id"
      class="max-w-7xl mx-auto bg-gradient-to-r from-zinc-900 to-black rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl">
      <!-- Left Side: Text & Countdown -->
      <div class="text-white flex-1 space-y-4 max-w-xl">
        <p class="text-green-500 font-semibold text-sm">Categories</p>
        <h2 class="text-4xl font-bold leading-tight">
          {{ item.title }}
        </h2>
        <p class="text-lg text-gray-300">{{ item.subtitle }}</p>

        <!-- Countdown -->
        <div v-if="item.meta?.countdown" class="flex gap-4 pt-6 flex-wrap">
          <div class="flex flex-col items-center justify-center bg-white text-black rounded-full w-20 h-20 shadow">
            <span class="text-xl font-bold">{{ item.meta.countdown.days }}</span>
            <span class="text-xs font-semibold">Days</span>
          </div>
          <div class="flex flex-col items-center justify-center bg-white text-black rounded-full w-20 h-20 shadow">
            <span class="text-xl font-bold">{{ item.meta.countdown.hours }}</span>
            <span class="text-xs font-semibold">Hours</span>
          </div>
          <div class="flex flex-col items-center justify-center bg-white text-black rounded-full w-20 h-20 shadow">
            <span class="text-xl font-bold">{{ item.meta.countdown.minutes }}</span>
            <span class="text-xs font-semibold">Min</span>
          </div>
          <div class="flex flex-col items-center justify-center bg-white text-black rounded-full w-20 h-20 shadow">
            <span class="text-xl font-bold">{{ item.meta.countdown.seconds }}</span>
            <span class="text-xs font-semibold">Sec</span>
          </div>
        </div>

        <!-- Countdown -->
        <div v-if="countdowns[item.id]" class="flex gap-4 pt-6 flex-wrap">
          <div class="count-box">
            <span class="text-xl font-bold">{{ countdowns[item.id].days }}</span>
            <span class="text-xs font-semibold">Days</span>
          </div>
          <div class="count-box">
            <span class="text-xl font-bold">{{ countdowns[item.id].hours }}</span>
            <span class="text-xs font-semibold">Hours</span>
          </div>
          <div class="count-box">
            <span class="text-xl font-bold">{{ countdowns[item.id].minutes }}</span>
            <span class="text-xs font-semibold">Min</span>
          </div>
          <div class="count-box">
            <span class="text-xl font-bold">{{ countdowns[item.id].seconds }}</span>
            <span class="text-xs font-semibold">Sec</span>
          </div>
        </div>

        <!-- Button -->
        <a :href="item.link || '#'"
          class="inline-block mt-6 bg-green-500 text-white px-6 py-3 rounded-lg text-sm font-semibold hover:bg-green-600 transition"
          target="_blank" rel="noopener noreferrer">
          Buy Now!
        </a>
      </div>

      <!-- Right Side: Image -->
      <div class="flex-1">
        <img :src="item.image" :alt="item.title || 'Banner Image'" class="w-full h-auto max-h-[350px] object-contain" />
      </div>
    </div>
  </section>
</template>

<style></style>
