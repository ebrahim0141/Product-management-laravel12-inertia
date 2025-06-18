<template>
  <div class="w-full px-4 py-6">
    <div class="max-w-7xl mx-auto bg-white rounded-md shadow p-6">
      <!-- Search and Button Wrapper -->
      <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <input
          v-model="searchValue"
          type="text"
          placeholder="Search..."
          class="border rounded px-3 py-2 w-full max-w-xs text-sm focus:outline-none focus:ring focus:border-blue-300"
        />
        <Link
          href="/ProductSavePage?id=0"
          class="bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700 whitespace-nowrap text-center"
        >
          Create New
        </Link>
      </div>

      <!-- Data Table -->
      <EasyDataTable
        buttons-pagination
        alternating
        :headers="Header"
        :items="Item"
        :rows-per-page="10"
        :search-field="searchField"
        :search-value="searchValue"
      >
        <!-- Action Buttons -->
        <template #item-number="{ id }">
          <Link
            :href="`/ProductSavePage?id=${id}`"
            class="inline-block bg-green-600 text-white text-xs px-3 py-1 rounded hover:bg-green-700 mr-2"
          >
            Edit
          </Link>
          <button
            @click="DeleteClick(id)"
            class="inline-block bg-red-600 text-white text-xs px-3 py-1 rounded hover:bg-red-700"
          >
            Delete
          </button>
        </template>

        <!-- Category Display -->
        <template #item-categories="{ categories }">
          <span v-if="categories && categories.length">
            {{ categories.map(c => c.name).join(', ') }}
          </span>
        </template>
      </EasyDataTable>
    </div>
  </div>
</template>


<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import { createToaster } from "@meforma/vue-toaster";
import { ref } from "vue";

const toaster = createToaster();
const page = usePage();

const Header = [
  { text: "No", value: "id" },
  { text: "Name", value: "name" },
  { text: "Price", value: "price" },
  { text: "Unit", value: "unit" },
  { text: "Categories", value: "categories" },
  { text: "Action", value: "number" },
];

const Item = ref(page.props.list);
const searchValue = ref("");
const searchField = "name"; // if searchable only by name

if (page.props.flash?.status === true) {
  toaster.success(page.props.flash.message);
} else if (page.props.flash?.status === false) {
  toaster.warning(page.props.flash.message);
}

const DeleteClick = (id) => {
  if (confirm("Do you want to delete?")) {
    router.get(`/delete-product/${id}`);
  }
};
</script>
