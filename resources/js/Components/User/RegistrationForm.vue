<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-4xl bg-white rounded shadow p-6 animate-fadeIn">
      <form @submit.prevent="submit" class="space-y-6">
        <h4 class="text-2xl font-semibold text-center">Sign Up</h4>
        <hr class="border-gray-300" />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label for="firstName" class="block mb-1 font-medium">First Name</label>
            <input
              id="firstName"
              v-model="form.firstName"
              type="text"
              placeholder="First Name"
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
            />
          </div>

          <div>
            <label for="lastName" class="block mb-1 font-medium">Last Name</label>
            <input
              id="lastName"
              v-model="form.lastName"
              type="text"
              placeholder="Last Name"
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
            />
          </div>

          <div>
            <label for="email" class="block mb-1 font-medium">Email Address</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              placeholder="User Email"
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
            />
          </div>

          <div>
            <label for="mobile" class="block mb-1 font-medium">Mobile Number</label>
            <input
              id="mobile"
              v-model="form.mobile"
              type="tel"
              placeholder="Mobile"
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
            />
          </div>

          <div>
            <label for="password" class="block mb-1 font-medium">Password</label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              placeholder="User Password"
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
            />
          </div>
        </div>

        <div class="pt-4">
          <button
            type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded transition"
          >
            Complete
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { router, useForm, usePage } from '@inertiajs/vue3';

const form = useForm({
  firstName: '',
  lastName: '',
  email: '',
  mobile: '',
  password: '',
});
const page = usePage();

function submit() {
  if (form.email.length === 0) {
    alert('Email Required');
  } else if (form.firstName.length === 0) {
    alert('First Name Required');
  } else if (form.lastName.length === 0) {
    alert('Last Name Required');
  } else if (form.mobile.length === 0) {
    alert('Mobile Required');
  } else if (form.password.length === 0) {
    alert('Password Required');
  } else {
    form.post('/user-registration', {
      onSuccess: () => {
        if (page.props.flash.status === true) {
          router.get('/LoginPage');
        } else {
          alert(page.props.flash.message);
        }
      },
    });
  }
}
</script>

<style>
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.animate-fadeIn {
  animation: fadeIn 0.5s ease forwards;
}
</style>
