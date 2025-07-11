<script setup lang="ts">
import Category from '@/components/client_side/home/Category.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { Undo2 } from 'lucide-vue-next';

const props = defineProps({
  sub: {
    type: Object,
    required: true,
  },
  categories: {
    type: Array,
    required: true,
  },
});



const form = useForm({
    name: props.sub.name,
    description: props.sub.description,
    status: props.sub.status,
    category_id: props.sub.category_id,
})

// Submit Handler
const submit = () => {
  form.put(route('subs.update', props.sub.slug));
};

// Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Sub Categories', href: '/sub-categories' },
  { title: 'Edit Sub Category', href: `/sub-categories/${props.sub.id}/edit` },
];
</script>

<template>
  <Head title="Edit Sub Category" />
  <AppLayout :breadcrumbs="breadcrumbs">
    
    <div class="flex flex-col gap-6 p-6">
      <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Edit Sub Category</h1>

      <form @submit.prevent="submit" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl">

        <!-- Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
          <input v-model="form.name" type="text"
            class="w-full p-3 rounded border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300" />
          <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
          <textarea v-model="form.description" rows="3"
            class="w-full p-3 rounded border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300"></textarea>
          <p v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</p>
        </div>

       <!-- Category -->
<div>
  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Select Category</label>
  <select v-model="form.category_id"
    class="w-full p-3 rounded border border-gray-300 bg-gray-50 dark:bg-gray-700 dark:text-white">
    <option disabled value="">-- Choose Category --</option>
    <option v-for="cat in props.categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
  </select>
  <p v-if="form.errors.category_id" class="text-red-500 text-sm mt-1">{{ form.errors.category_id }}</p>
</div>


        <!-- Status -->
        <div class="flex items-center gap-2">
          <input v-model="form.status" type="checkbox" :true-value="1" :false-value="0" />
            class="w-4 h-4 rounded border-gray-300 text-blue-600 bg-gray-100 dark:bg-gray-700 dark:border-gray-600" />
          <label class="text-sm font-medium text-gray-800 dark:text-gray-200">Active</label>
        </div>

        <!-- Buttons -->
        <div class="flex items-center gap-3">
          <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded transition duration-200"
            :disabled="form.processing">
            Update
          </button>
          <Link href="/sub-categories"
            class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 hover:bg-gray-200 rounded transition">
            <Undo2 class="w-4 h-4 mr-1" /> Back
          </Link>
        </div>

      </form>
    </div>
  </AppLayout>
</template>
