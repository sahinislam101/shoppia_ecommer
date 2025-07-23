<script setup lang="ts">
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Trash2, PenLine } from 'lucide-vue-next';

interface Product {
  id: string;
  slug: string;
  name: string;
  description: string;
  image: string;
  status: boolean;
  selling_price: string;
  original_price: string;
}

const props = defineProps<{
  products: {
    data: Product[];
    current_page: number;
    last_page: number;
    total: number;
    from: number;
    to: number;
  };
  filters: {
    search?: string;
    status?: string;
  };
}>();

const search = ref(props.filters?.search || '');
const status = ref(props.filters?.status || '');
const isLoading = ref(false);

watch([search, status], ([newSearch, newStatus]) => {
  isLoading.value = true;
  router.get('/products', { search: newSearch, status: newStatus }, {
    preserveState: true,
    replace: true,
    onFinish: () => isLoading.value = false,
  });
});

const handlePaginate = (page: number) => {
  isLoading.value = true;
  router.get('/products', { search: search.value, status: status.value, page }, {
    preserveState: true,
    replace: true,
    onFinish: () => isLoading.value = false,
  });
};

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Products', href: '/products' },
];

function confirmDelete(slug: string){
  if (confirm('Are you sure you want to deleted this product ?')) {
    router.delete(`/product/$(slug)`);
  }
}
</script>
<template>
  <Head title="Products" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4 sm:p-6 space-y-6 bg-gray-50 min-h-screen">

      <!-- Header with Search & Filter -->
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Product List</h1>

        <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto items-center">
          <input
            v-model="search"
            type="text"
            placeholder="Search by name..."
            class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 text-sm"
          />
          <select v-model="status" class="px-3 py-2 border border-gray-300 rounded text-sm">
            <option value="">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          <Link href="/products/create"
            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium">
            + Add Product
          </Link>
        </div>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left">
          <thead class="bg-blue-100 text-gray-700 uppercase text-xs">
            <tr>
              <th class="px-4 py-3">Image</th>
              <th class="px-4 py-3">Name</th>
              <th class="px-4 py-3">Description</th>
              <th class="px-4 py-3">Price</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <tr v-for="product in props.products.data" :key="product.id" class="hover:bg-gray-50">
              <td class="px-4 py-3">
                <img :src="product.image" :alt="product.name" class="w-20 h-14 object-cover rounded border" />
              </td>
              <td class="px-4 py-3 font-medium text-gray-900">{{ product.name }}</td>
              <td class="px-4 py-3 text-gray-600 truncate max-w-xs">{{ product.description }}</td>
              <td class="px-4 py-3 text-gray-800 font-semibold">৳ {{ product.original_price }}</td>
              <td class="px-4 py-3">
                <span :class="product.status ? 'text-green-600' : 'text-red-600'" class="font-semibold">
                  {{ product.status ? 'Active' : 'Inactive' }}
                </span>
              </td>
              <td class="px-4 py-3 text-right">
                <div class="flex justify-end gap-2">
                  <Link :href="`/products/${product.slug}/edit`"
                    class="flex items-center gap-1 px-2 py-1 text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-md transition">
                    <PenLine class="w-4 h-4" />
                    <span class="hidden sm:inline">Edit</span>
                  </Link>
                  <Link @click="confirmDelete('Are You Sure')" :href="`/products/${product.slug}`" method="delete" as="button"
                    class="flex items-center gap-1 px-2 py-1 text-red-700 bg-red-100 hover:bg-red-200 rounded-md transition">
                    <Trash2  class="w-4 h-4" />
                    <span class="hidden sm:inline">Delete</span>
                  </Link>
                </div>
              </td>
            </tr>
            <tr v-if="props.products.data.length === 0">
              <td colspan="6" class="text-center py-6 text-gray-500">No products found.</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div v-if="props.products.last_page > 1"
        class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4">
        <div class="text-sm text-gray-600">
          Showing {{ props.products.from }} to {{ props.products.to }} of {{ props.products.total }} results
        </div>
        <div class="flex flex-wrap gap-1">
          <button v-if="props.products.current_page > 1"
            @click="handlePaginate(props.products.current_page - 1)"
            class="px-3 py-1 border rounded text-sm hover:bg-gray-200 transition">
            Prev
          </button>

          <button v-for="page in props.products.last_page" :key="page" @click="handlePaginate(page)"
            :class="[
              'px-3 py-1 border rounded text-sm',
              page === props.products.current_page ? 'bg-blue-600 text-white' : 'hover:bg-gray-100 text-gray-700'
            ]">
            {{ page }}
          </button>

          <button v-if="props.products.current_page < props.products.last_page"
            @click="handlePaginate(props.products.current_page + 1)"
            class="px-3 py-1 border rounded text-sm hover:bg-gray-200 transition">
            Next
          </button>
        </div>
      </div>

      <!-- Loading Spinner -->
      <div v-if="isLoading" class="flex justify-center items-center py-6 text-gray-500">
        Loading...
      </div>
    </div>
  </AppLayout>
</template>
