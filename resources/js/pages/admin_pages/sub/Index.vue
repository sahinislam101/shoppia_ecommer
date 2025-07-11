<script setup lang="ts">
import { ref, watch } from 'vue';
import { router, Link, Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Trash2, PenLine } from 'lucide-vue-next';
import { type BreadcrumbItem } from '@/types';

interface Sub {
  id: string;
  name: string;
  slug: string;
  description: string;
  status: boolean;
}

const props = defineProps<{
  subs: {
    data: Sub[];
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

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Sub-Categories', href: '/subs' },
];

const search = ref(props.filters.search || '');
const status = ref(props.filters.status || '');
const isLoading = ref(false);

// Watch search & status
watch([search, status], ([newSearch, newStatus]) => {
  isLoading.value = true;
  router.get('/subs', {
    search: newSearch,
    status: newStatus,
  }, {
    preserveState: true,
    replace: true,
    onFinish: () => isLoading.value = false,
  });
});

// Pagination handler
function handlePaginate(page: number) {
  isLoading.value = true;
  router.get('/subs', {
    search: search.value,
    status: status.value,
    page,
  }, {
    preserveState: true,
    replace: true,
    onFinish: () => isLoading.value = false,
  });
}
</script>

<template>
  <Head title="Sub Categories" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4 sm:p-6 space-y-6 bg-gray-100 min-h-screen">

      <!-- Header + Filters -->
      <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Sub Categories</h1>
        <div class="flex flex-wrap items-center gap-3">
          <input
            v-model="search"
            placeholder="Search..."
            class="px-4 py-2 border rounded-md shadow-sm text-sm focus:ring-blue-500"
          />
          <select v-model="status" class="px-3 py-2 border rounded-md text-sm focus:ring-blue-500">
            <option value="">All</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
          <Link href="/subs/create"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium">
            + Create
          </Link>
        </div>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
          <thead class="bg-blue-100 text-gray-600">
            <tr>
              <th class="px-4 py-3">Name</th>
              <th class="px-4 py-3">Description</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <tr v-for="sub in props.subs.data" :key="sub.slug" class="hover:bg-gray-50">
              <td class="px-4 py-3">{{ sub.name }}</td>
              <td class="px-4 py-3">{{ sub.description }}</td>
              <td class="px-4 py-3">
                <span :class="sub.status ? 'text-green-600' : 'text-red-500'" class="font-medium">
                  {{ sub.status ? 'Active' : 'Inactive' }}
                </span>
              </td>
              <td class="px-4 py-3 text-right">
                <div class="flex justify-end gap-2">
                  <Link :href="`/subs/${sub.slug}/edit`"
                        class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-md">
                    <PenLine class="w-4 h-4" /> <span class="hidden sm:inline">Edit</span>
                  </Link>
                  <Link :href="`/subs/${sub.slug}`" method="delete" as="button"
                        class="inline-flex items-center gap-1 px-2 py-1 bg-red-100 text-red-700 hover:bg-red-200 rounded-md">
                    <Trash2 class="w-4 h-4" /> <span class="hidden sm:inline">Delete</span>
                  </Link>
                </div>
              </td>
            </tr>
            <tr v-if="props.subs.data.length === 0">
              <td colspan="4" class="text-center py-6 text-gray-500">No sub-categories found.</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div v-if="props.subs.last_page > 1" class="flex justify-between items-center pt-4 text-sm text-gray-600">
        <div>Showing {{ props.subs.from }} to {{ props.subs.to }} of {{ props.subs.total }} results</div>
        <div class="flex flex-wrap gap-1">
          <button
            v-if="props.subs.current_page > 1"
            @click="handlePaginate(props.subs.current_page - 1)"
            class="px-3 py-1 border rounded hover:bg-gray-100 transition"
          >
            Prev
          </button>
          <button
            v-for="page in props.subs.last_page"
            :key="page"
            @click="handlePaginate(page)"
            :class="[ 'px-3 py-1 border rounded',
              page === props.subs.current_page ? 'bg-blue-600 text-white' : 'hover:bg-gray-100 text-gray-700'
            ]"
          >
            {{ page }}
          </button>
          <button
            v-if="props.subs.current_page < props.subs.last_page"
            @click="handlePaginate(props.subs.current_page + 1)"
            class="px-3 py-1 border rounded hover:bg-gray-100 transition"
          >
            Next
          </button>
        </div>
      </div>

      <!-- Loading -->
      <div v-if="isLoading" class="text-center text-gray-500">Loading...</div>
    </div>
  </AppLayout>
</template>
