<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md bg-white rounded shadow p-6 animate-fadeIn">
      <form @submit.prevent="submit" class="space-y-6">
        <h4 class="text-2xl font-semibold text-center">SIGN IN</h4>

        <input
          id="email"
          v-model="form.email"
          type="email"
          placeholder="User Email"
          class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
        />

        <input
          id="password"
          v-model="form.password"
          type="password"
          placeholder="User Password"
          class="mt-2 w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
        />

        <button
          type="submit"
          class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded transition"
        >
          Login
        </button>

        <hr class="border-gray-300" />

        <div class="flex justify-end space-x-4 text-sm">
          <Link
            href="/RegistrationPage"
            class="text-green-600 hover:underline font-medium"
          >
            Sign Up
          </Link>
          <span class="text-gray-400">|</span>
          <Link
            href="/SendOtpPage"
            class="text-green-600 hover:underline font-medium"
          >
            Forget Password
          </Link>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Link, router, useForm, usePage } from '@inertiajs/vue3';

const form = useForm({ email: '', password: '' });
const page = usePage();

function submit() {
  if (form.email.length === 0) {
    alert('Email Required');
  } else if (form.password.length === 0) {
    alert('Password Required');
  } else {
    form.post('/user-login', {
      onSuccess: () => {
        if (page.props.flash.status === true) {
          router.get('/DashboardPage');
        } else {
          alert(page.props.flash.message);
        }
      },
    });
  }
}
</script>

<style>
/* Optional: simple fadeIn animation */
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
