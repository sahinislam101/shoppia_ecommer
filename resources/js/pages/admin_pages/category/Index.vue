<script setup lang="ts">
import { ref, watch } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'

const props = defineProps<{
    categories: {
        data: Array<{
            id: string,
            slug: string;
            name: string,
            description: string,
            image: string,
            status: boolean,
        }>,
        current_page: number,
        last_page: number,
        total: number,
        from: number,
        to: number,
    },
    filters: {
        search: string,
        status: string
    }
}>()

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Category', href: '/categories' },
]

const search = ref(props.filters.search || '')
const status = ref(props.filters.status || '')
const isLoading = ref(false)

// Watch search and status filters, then reload categories with params
watch([search, status], ([newSearch, newStatus]) => {
    isLoading.value = true
    router.get('/categories', {
        search: newSearch,
        status: newStatus,
    }, {
        preserveState: true,
        replace: true,
        onFinish: () => {
            isLoading.value = false
        }
    })
})

// Pagination handler
function handlePaginate(page: number) {
    isLoading.value = true
    router.get('/categories', {
        search: search.value,
        status: status.value,
        page: page,
    }, {
        preserveState: true,
        replace: true,
        onFinish: () => {
            isLoading.value = false
        }
    })
}
</script>

<template>

    <Head title="Categories" />
    <AppLayout :breadcrumbs="breadcrumbs">

        <!-- ✅ Flash Success Message -->
        <div v-if="$page.props.flash?.success"
            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200 dark:bg-gray-800 dark:text-green-400 dark:border-green-600"
            role="alert">
            <span class="font-semibold">Success!</span> {{ $page.props.flash.success }}
        </div>

        <!-- Filters -->
        <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="relative w-full md:w-1/3">
                <input v-model="search" type="text" placeholder="Search category..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 dark:bg-gray-800 dark:border-gray-600 dark:text-white" />
            </div>
            <div class="flex items-center gap-4">
                <select v-model="status"
                    class="px-3 py-2 border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                    <option value="">All</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <Link href="/categories/create"
                    class="inline-block px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-medium">
                + Create New Category
                </Link>
            </div>
        </div>

        <!-- Table -->
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                <thead class="bg-blue-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3">Image</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in props.categories.data" :key="category.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            <img :src="category.image" alt="Category Image" class="w-16 h-16 object-cover rounded shadow" />
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ category.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ category.description }}
                        </td>
                        <td class="px-6 py-4">
                            <span :class="category.status
                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                                : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'"
                                class="inline-flex items-center px-2 py-0.5 rounded text-sm font-semibold">
                                {{ category.status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <Link :href="`/categories/${category.slug}/edit`"
                                class="font-medium text-blue-600 dark:text-blue-400 hover:underline">Edit</Link>
                            <Link :href="`/categories/${category.slug}`" method="delete" as="button"
                                class="font-medium text-red-600 dark:text-red-400 hover:underline">Delete</Link>
                        </td>
                    </tr>

                    <tr v-if="props.categories.data.length === 0">
                        <td colspan="5" class="text-center py-6 text-gray-500 dark:text-gray-400">No categories found.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div v-if="props.categories.last_page > 1"
            class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Showing {{ props.categories.from }} to {{ props.categories.to }} of {{ props.categories.total }} results
            </div>
            <div class="flex flex-wrap gap-2">
                <button v-if="props.categories.current_page > 1" @click="handlePaginate(props.categories.current_page - 1)"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-blue-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    Prev
                </button>

                <button v-for="page in props.categories.last_page" :key="page" @click="handlePaginate(page)" :class="[
                    'px-4 py-2 rounded-lg border text-sm font-semibold transition focus:outline-none focus:ring-2 focus:ring-blue-500',
                    page === props.categories.current_page
                        ? 'bg-blue-600 border-blue-600 text-white cursor-default'
                        : 'border-gray-300 text-gray-700 hover:bg-blue-100 hover:text-blue-700 cursor-pointer'
                ]">
                    {{ page }}
                </button>

                <button v-if="props.categories.current_page < props.categories.last_page"
                    @click="handlePaginate(props.categories.current_page + 1)"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-blue-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    Next
                </button>
            </div>
        </div>


        <!-- Loading Spinner -->
        <div v-if="isLoading" class="flex justify-center items-center py-4">
            <span class="text-gray-500 dark:text-gray-400">Loading...</span>
        </div>
    </AppLayout>
</template>
