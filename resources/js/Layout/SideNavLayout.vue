<template>
  <div class="flex h-screen">
    <!-- Sidebar -->
    <div
      id="sideNav"
      :class="[
        'bg-white shadow-lg z-20 flex flex-col w-64 space-y-4 p-4 fixed top-0 left-0 h-full transition-transform duration-300 ease-in-out',
        sidebarOpen ? 'translate-x-0' : '-translate-x-full',
        'md:translate-x-0 md:static'
      ]"
    >
      <div class="text-center mb-4">
        <img alt="Logo" class="mx-auto h-12" src="../Assets/img/logo.svg" />
      </div>

      <Link
        href="/DashboardPage"
        class="flex items-center space-x-2 text-gray-700 hover:bg-green-100 px-4 py-2 rounded"
      >
        <i class="fa fa-tachometer-alt text-green-600"></i>
        <span>Dashboard</span>
      </Link>

      <Link
        href="/CategoryPage"
        class="flex items-center space-x-2 text-gray-700 hover:bg-green-100 px-4 py-2 rounded"
      >
        <i class="fa fa-th-list text-green-600"></i>
        <span>Category</span>
      </Link>

      <Link
        href="/ProductPage"
        class="flex items-center space-x-2 text-gray-700 hover:bg-green-100 px-4 py-2 rounded"
      >
        <i class="fa fa-box text-green-600"></i>
        <span>Product</span>
      </Link>

      <Link
        href="/ProfilePage"
        class="flex items-center space-x-2 text-gray-700 hover:bg-green-100 px-4 py-2 rounded"
      >
        <i class="fa fa-user-circle text-green-600"></i>
        <span>Profile</span>
      </Link>

      <Link
        href="/logout"
        class="flex items-center space-x-2 text-gray-700 hover:bg-green-100 px-4 py-2 rounded"
      >
        <i class="fa fa-sign-out-alt text-green-600"></i>
        <span>Logout</span>
      </Link>
    </div>

    <!-- Main content -->
    <div class="flex-1 ml-0 md:ml-64 transition-all duration-300">
      <!-- Top Navbar -->
      <nav class="fixed top-0 left-0 right-0 bg-green-600 text-white z-30 shadow-md px-4 py-2 flex items-center justify-between md:ml-64">
        <button @click="toggleSidebar" class="md:hidden text-white">
          <i class="fa fa-bars text-xl"></i>
        </button>
        <div class="text-lg font-semibold">My App</div>
      </nav>

      <!-- Page Content -->
      <div class="pt-16 px-4">
        <main>
          <slot></slot>
        </main>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'

const sidebarOpen = ref(false)

function toggleSidebar() {
  sidebarOpen.value = !sidebarOpen.value
}
</script>
