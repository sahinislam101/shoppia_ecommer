<template>
    <Header />
  <section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-8">
      
      <!-- Left Contact Info -->
      <div class="space-y-6">
        <div class="bg-white p-6 rounded-2xl shadow-md flex items-start gap-4">
          <div class="text-red-500 text-3xl">
            <i class="ri-phone-line"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold">Call To Us</h3>
            <p class="text-gray-600">We are available 24/7, 7 days a week.</p>
            <p class="text-gray-800 font-medium mt-1">Phone: +880123485124</p>
          </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-md flex items-start gap-4">
          <div class="text-red-500 text-3xl">
            <i class="ri-mail-send-line"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold">Write To Us</h3>
            <p class="text-gray-600">Fill out our form and we’ll get back to you within 24 hours.</p>
            <p class="text-gray-800 mt-2">Email: customer@exclusive.com</p>
            <p class="text-gray-800">Email: support@exclusive.com</p>
          </div>
        </div>
      </div>

      <!-- Right Contact Form -->
      <form @submit.prevent="submitForm" class="bg-white p-6 rounded-2xl shadow-md space-y-5">
        <div class="grid md:grid-cols-3 gap-4 ">
          <input
            v-model="form.name"
            type="text"
            placeholder="Your Name *"
            class="input w-full border border-[#f3f3f3]"
            required
          />
          <input
            v-model="form.email"
            type="email"
            placeholder="Your Email *"
            class="input w-full border border-[#f3f3f3]"
            required
          />
          <input
            v-model="form.phone"
            type="tel"
            placeholder="Your Phone *"
            class="input w-full border border-[#f3f3f3]"
            required
          />
        </div>
        <textarea
          v-model="form.message"
          placeholder="Your Message *"
          rows="6"
          class="input resize-none w-full border border-[#f3f3f3]"
          required
        ></textarea>
        <button
          type="submit"
          class="w-full bg-red-500 text-white font-medium px-6 py-3 rounded-md hover:bg-red-600 transition"
        >
          Send Message
        </button>
      </form>
    </div>
  </section>
  <Footer />
</template>

<script setup>
import Header from '@/components/client_side/layout/Header.vue'
import Footer from '@/components/client_side/layout/Footer.vue'
import { ref } from 'vue'

const form = ref({
  name: '',
  email: '',
  phone: '',
  message: ''
})

const submitForm = () => {
  console.log('Form Submitted:', form.value)
  alert('✅ Message sent successfully!')
  form.value = { name: '', email: '', phone: '', message: '' }
}
</script>

<style scoped>

</style>
