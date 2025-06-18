<template>
  <div class="min-h-screen bg-gray-100">
    <div class="max-w-md mx-auto bg-white rounded shadow p-6">
      <form @submit.prevent="submit" class="space-y-4">
        <h4 class="text-xl font-semibold mb-4">Save Product</h4>

        <input
          id="id"
          name="id"
          v-model="form.id"
          placeholder="Product ID"
          type="text"
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        <input
          id="name"
          name="name"
          v-model="form.name"
          placeholder="Product Name"
          type="text"
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        <input
          id="price"
          name="price"
          v-model="form.price"
          placeholder="Product Price"
          type="number"
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        <input
          id="unit"
          name="unit"
          v-model="form.unit"
          placeholder="Product Unit"
          type="number"
          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        />

        <label class="block mb-1 font-medium">Select Categories</label>
        <select
          multiple
          v-model="form.categories"
          class="w-full border border-gray-300 rounded px-3 py-2 h-32 overflow-auto focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option
            v-for="cat in page.props.category_list"
            :key="cat.id"
            :value="cat.id"
          >
            {{ cat.name }}
          </option>
        </select>

        <button
          type="submit"
          class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded transition"
        >
          Save Change
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const urlParams = new URLSearchParams(window.location.search);
let id = ref(parseInt(urlParams.get('id')));

const form = useForm({
  id: id,
  name: '',
  price: '',
  unit: '',
  categories: [],
});

const page = usePage();

let URL = '/create-product';
let list = page.props.list;

if (id.value !== 0 && list !== null) {
  URL = '/update-product';
  form.name = list['name'];
  form.price = list['price'];
  form.unit = list['unit'];
  form.id = list['id'];
  form.categories = list.categories.map(cat => cat.id);
}

function submit() {
  if (form.name.length === 0) {
    alert('Product name Required');
  } else if (form.price.length === 0) {
    alert('Product price Required');
  } else if (form.unit.length === 0) {
    alert('Product unit Required');
  }else if (!form.categories || form.categories.length === 0) {
    alert('At least one category must be selected');
  }
   else {
    console.log(form);
    form.post(URL, {
      onSuccess: () => {
        if (page.props.flash.status === true) {
          router.get('/ProductPage');
        } else {
          alert(page.props.flash.message);
        }
      },
    });
  }
}
</script>
