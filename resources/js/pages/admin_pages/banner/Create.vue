<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, Link, router } from '@inertiajs/vue3';
import { Undo2 } from 'lucide-vue-next';

const form = useForm({
    title: '',
    subtitle: '',
    image: '',
    link: '',
    position: 'top',
    order: 0,
    status: true,
    meta: null, // Optional: for countdown JSON
});

const submit = () => {
    form.post(route('banners.store'));
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create-Banner',
        href: '/banners/create',
    },
];
</script>

<template>
    <Head title="Banner – Create" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h1>Create A New Banner</h1>

            <form @submit.prevent="submit" class="space-y-5 bg-white p-4 shadow-xl rounded-2xl">
                <!-- Title -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                    <input v-model="form.title" type="text"
                        class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <p v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</p>
                </div>

                <!-- Subtitle -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subtitle</label>
                    <input v-model="form.subtitle" type="text"
                        class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <p v-if="form.errors.subtitle" class="text-red-500 text-sm mt-1">{{ form.errors.subtitle }}</p>
                </div>

                <!-- Image -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image URL</label>
                    <input v-model="form.image" type="text" placeholder="https://example.com/banner.jpg"
                        class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <p v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</p>
                </div>

                <!-- Link -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link (Optional)</label>
                    <input v-model="form.link" type="text" placeholder="https://example.com"
                        class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <p v-if="form.errors.link" class="text-red-500 text-sm mt-1">{{ form.errors.link }}</p>
                </div>

                <!-- Position -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                    <select v-model="form.position"
                        class="block w-full p-3 border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:text-white">
                        <option value="top">Top</option>
                        <option value="middle">Middle</option>
                        <option value="countdown">Countdown</option>
                    </select>
                    <p v-if="form.errors.position" class="text-red-500 text-sm mt-1">{{ form.errors.position }}</p>
                </div>

                <!-- Order -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Display Order</label>
                    <input v-model="form.order" type="number"
                        class="block w-full p-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    <p v-if="form.errors.order" class="text-red-500 text-sm mt-1">{{ form.errors.order }}</p>
                </div>

                <!-- Status -->
                <div class="flex items-center gap-2">
                    <input v-model="form.status" type="checkbox" id="status" />
                    <label for="status" class="text-sm text-gray-700 dark:text-white">Active</label>
                </div>

                <!-- Submit -->
                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition"
                        :disabled="form.processing">
                        Save
                    </button>
                    <Link href="/banners"
                        class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-md transition">
                        <Undo2 class="w-4 h-4 mr-1" /> Back
                    </Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
