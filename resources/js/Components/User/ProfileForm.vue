<template>
  <div class="container mx-auto px-4">
    <div class="flex justify-center">
      <div class="w-full max-w-4xl">
        <div class="bg-white shadow-md rounded-md p-6 animate-fadeIn">
          <form @submit.prevent="submit">
            <div class="mb-6">
              <h4 class="text-2xl font-semibold mb-4">Profile Update</h4>
              <hr class="mb-6" />
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div>
                  <label for="firstName" class="block text-sm font-medium mb-1">First Name</label>
                  <input
                    id="firstName"
                    v-model="form.firstName"
                    type="text"
                    placeholder="First Name"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                </div>

                <div>
                  <label for="lastName" class="block text-sm font-medium mb-1">Last Name</label>
                  <input
                    id="lastName"
                    v-model="form.lastName"
                    type="text"
                    placeholder="Last Name"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                </div>

                <div>
                  <label for="email" class="block text-sm font-medium mb-1">Email Address</label>
                  <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    placeholder="User Email"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                </div>

                <div>
                  <label for="mobile" class="block text-sm font-medium mb-1">Mobile Number</label>
                  <input
                    id="mobile"
                    v-model="form.mobile"
                    type="tel"
                    placeholder="Mobile"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                </div>

                <div>
                  <label for="password" class="block text-sm font-medium mb-1">Password</label>
                  <input
                    id="password"
                    v-model="form.password"
                    type="password"
                    placeholder="User Password"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                </div>
              </div>
            </div>

            <div class="mt-6 w-full md:w-1/3">
              <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold transition"
              >
                Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
const page = usePage();
const form = useForm({
  firstName: page.props.list["firstName"],
  lastName: page.props.list["lastName"],
  email: page.props.list["email"],
  mobile: page.props.list["mobile"],
  password: page.props.list["password"],
});

function submit() {
  if (form.email.length === 0) {
    alert("Email Required");
  } else if (form.firstName.length === 0) {
    alert("First Name Required");
  } else if (form.lastName.length === 0) {
    alert("Last Name Required");
  } else if (form.mobile.length === 0) {
    alert("Mobile Required");
  } else {
    form.post("/user-update", {
      onSuccess: () => {
        alert(page.props.flash.message);
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
