<template>
  <div class="flex items-center px-4 bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
      <form @submit.prevent="submit">
        <h4 class="text-xl font-semibold text-gray-700 mb-4">Save Category</h4>

        <input
          id="id"
          name="id"
          v-model="form.id"
          placeholder="Category ID"
          type="text"
          class="w-full mb-4 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300 text-sm"
          disabled
        />

        <input
          id="name"
          name="name"
          v-model="form.name"
          placeholder="Category Name"
          type="text"
          class="w-full mb-4 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300 text-sm"
        />

        <button
          type="submit"
          class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md text-sm font-medium"
        >
          Save Change
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'

const urlParams = new URLSearchParams(window.location.search)
let id = ref(parseInt(urlParams.get('id')))

const form = useForm({ name: '', id: id })
const page = usePage()

let URL = "/create-category"
let list = page.props.list

if (id.value !== 0 && list !== null) {
  URL = "/update-category"
  form.name = list['name']
  form.id = list['id']
}

function submit() {
  if (form.name.length === 0) {
    alert("Category name is required")
  } else {
    form.post(URL, {
      onSuccess: () => {
        if (page.props.flash.status === true) {
          router.get("/CategoryPage")
        } else {
          alert(page.props.flash.message)
        }
      }
    })
  }
}
</script>
