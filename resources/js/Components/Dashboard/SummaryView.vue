<script setup>
import { usePage } from '@inertiajs/vue3'

const page = usePage()

function formatLabel(key) {
  const map = {
    product: 'Product',
    category: 'Category'
  }
  return map[key] || key
}
</script>

<template>
  <div class="w-full px-4 py-6">
    <div class="flex flex-wrap -mx-2">
      <!-- Dynamic Card Component -->
      <div
        v-for="(value, key) in page.props.list"
        :key="key"
        class="w-full sm:w-1/2 lg:w-1/4 px-2 mb-4"
      >
        <div class="bg-white shadow-md rounded-lg h-full p-4 transition-all duration-300 hover:shadow-lg">
          <div class="flex justify-between items-center">
            <div>
              <h5 class="text-lg font-semibold capitalize">
                <span v-if="['total', 'vat', 'payable'].includes(key)">$</span>
                {{ value }}
              </h5>
              <p class="text-sm text-gray-500 capitalize">
                {{ formatLabel(key) }}
              </p>
            </div>
            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center shadow">
              <img alt="" class="w-6 h-6" src="../../Assets/img/icon.svg" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
