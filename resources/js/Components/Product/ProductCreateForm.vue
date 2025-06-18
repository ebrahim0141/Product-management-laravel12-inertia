<template>
  <div class="bg-gray-100 flex items-center justify-center">
    <div class="w-full max-w-xl bg-white rounded shadow p-6">
      <form @submit.prevent="submit" class="space-y-4">
        <h4 class="text-xl font-semibold mb-4">Save Product</h4>

        <input
          v-model="form.id"
          placeholder="Product ID"
          type="text"
          class="w-full border rounded px-3 py-2 text-gray-600 bg-gray-100 cursor-not-allowed"
          disabled
        />

        <input
          v-model="form.name"
          placeholder="Product Name"
          type="text"
          class="mt-2 w-full border rounded px-3 py-2"
        />

        <input
          v-model="form.price"
          placeholder="Product Price"
          type="number"
          class="mt-2 w-full border rounded px-3 py-2"
        />

        <input
          v-model="form.unit"
          placeholder="Product Unit"
          type="number"
          class="mt-2 w-full border rounded px-3 py-2"
        />

        <label class="block font-medium">Select Categories</label>
        <div class="flex flex-wrap">
          <button
            v-for="cat in page.props.category_list"
            :key="cat.id"
            type="button"
            :class="[
              'px-3 py-1 rounded border transition text-sm',
              form.categories.includes(cat.id)
                ? 'bg-blue-600 text-white border-blue-600'
                : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'
            ]"
            @click="toggleCategory(cat.id)"
          >
            {{ cat.name }}
          </button>
        </div>

        <div v-if="form.categories.length" class="mt-3 text-sm text-gray-700">
          <strong>Selected Categories:</strong>
          <span class="ml-1">
            {{ selectedCategoryNames.join(', ') }}
          </span>
        </div>

        <button
          type="submit"
          class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded"
        >
          Save Change
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

const urlParams = new URLSearchParams(window.location.search)
let id = ref(parseInt(urlParams.get('id')))

const page = usePage()

const form = useForm({
  id: id.value,
  name: '',
  price: '',
  unit: '',
  categories: [],
})

let URL = '/create-product'
let list = page.props.list

if (id.value !== 0 && list !== null) {
  URL = '/update-product'
  form.name = list.name
  form.price = list.price
  form.unit = list.unit
  form.id = list.id
  form.categories = list.categories.map(cat => cat.id)
}

// Toggle category on click
function toggleCategory(catId) {
  const index = form.categories.indexOf(catId)
  if (index > -1) {
    form.categories.splice(index, 1) // remove
  } else {
    form.categories.push(catId) // add
  }
}

// Show selected category names
const selectedCategoryNames = computed(() => {
  return page.props.category_list
    .filter(cat => form.categories.includes(cat.id))
    .map(cat => cat.name)
})

// Submit form
function submit() {
  if (!form.name) {
    alert('Product name Required')
  } else if (!form.price) {
    alert('Product price Required')
  } else if (!form.unit) {
    alert('Product unit Required')
  } else if (!form.categories.length) {
    alert('At least one category must be selected')
  } else {
    form.post(URL, {
      onSuccess: () => {
        if (page.props.flash.status === true) {
          router.get('/ProductPage')
        } else {
          alert(page.props.flash.message)
        }
      },
    })
  }
}
</script>
