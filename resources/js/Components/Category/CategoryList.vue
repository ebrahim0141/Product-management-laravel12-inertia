<template>
  <div class="w-full">
    <div class="bg-white shadow rounded-md p-4">
      <div class="mb-4">
        <input
          type="text"
          v-model="searchValue"
          placeholder="Search..."
          class="w-full max-w-xs px-3 py-2 text-sm border rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300"
        />
      </div>

      <EasyDataTable
        buttons-pagination
        alternating
        :headers="Header"
        :items="Item"
        :rows-per-page="10"
        :search-field="searchField"
        :search-value="searchValue"
      >
        <template #item-number="{ id }">
          <Link
            :href="`/CategorySavePage?id=${id}`"
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
      </EasyDataTable>

      <div class="mt-4">
        <Link
          href="/CategorySavePage?id=0"
          class="bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700"
        >
          Create New
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, router, usePage } from '@inertiajs/vue3'
import { createToaster } from "@meforma/vue-toaster"
import { ref } from "vue"

const toaster = createToaster()
const page = usePage()

const Header = [
  { text: "No", value: "id" },
  { text: "Name", value: "name" },
  { text: "Action", value: "number" },
]

const Item = ref(page.props.list)
const searchValue = ref("")
const searchField = "name"

if (page.props.flash.status === true) {
  toaster.success(page.props.flash.message)
} else if (page.props.flash.status === false) {
  toaster.warning(page.props.flash.message)
}

const DeleteClick = (id) => {
  if (confirm("Do you want to delete?")) {
    router.get(`/delete-category/${id}`)
  }
}
</script>
