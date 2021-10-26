<template>
  <div class="simple 2xl:mt-5 md:mt-3 mr-5 rounded-md sm:pt-0 2xl:h-1/4 md:h-1/6 md:w-1/5 bg">
    <div class="flex">
    <div
      
      class="picturebox my-auto ml-1 h-20 w-24 rounded-full"
    >
      <img
        :src="'/storage'+user.profile_photo_path" v-if="user?.profile_photo_path"
        class="my-auto 2xl:h-20 2xl:w-24 md:h-16 md:w-16 md:mt-1 md:mr-0 object-cover rounded-full"
      />
      <img
        :src="user.profile_photo_url" v-else
        class="my-auto 2xl:h-20 2xl:w-24 md:h-16 md:w-16 md:mt-1 md:mr-0 object-cover rounded-full"
      />
    </div>
    <div class="name mt-2 2xl:ml-5 md:ml-0 w-3/4">
      <div class="flex w-full">
        <h1 class="ml-0 mr-auto my-auto md:text-xs 2xl:text-base">{{ user.name }}</h1>
        <button
          v-if="layout === 'detailed'"
          @click="layout = 'simple'"
          class="flex justify-end mr-1 2xl:mt-2 md:mt-0"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
        <a
          v-if="layout === 'simple'"
          @click="layout = 'detailed'"
          href="#"
          class="flex justify-end mr-2 2xl:mt-2 md:mt-1"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"
            />
          </svg>
        </a>
      </div>
      <div class="flex-row mt-3 md:mt-1 mb-1 max-w-full">
        <h2 class="md:text-xs 2xl:text-base">{{ user.email }}</h2>
        <h2 class="md:text-xs 2xl:text-base">{{ user.role.name }}</h2>
        <h2 class="md:text-xs 2xl:text-base" v-if="layout === 'detailed'">{{ user.phone }}</h2>
        <h2 class="md:text-xs 2xl:text-base" v-if="layout === 'detailed'">{{ user.gender }}</h2>
      </div>
    </div>
  </div>
  <div v-if="layout === 'detailed'" class="flex ml-2 mb-1">
    <a class="flex md:text-xs 2xl:text-base" 
    :href="route('user-activities.index', { user: user.id })"
                :active="route().current('user-activities.active')"
      >Related Activities
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="arrow 2xl:mt-1 md:mt-0 h-5 w-5"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          fill-rule="evenodd"
          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
          clip-rule="evenodd"
        /></svg
    ></a>
    <button @click="UserForm(user.id)" class="mx-auto mr-1">
      <!-- <button @click="layout = 'form'" class="mx-auto mr-1"> -->
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="pen h-5 w-5"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
        />
      </svg>
    </button>
    <button @click="delete1(user.id)" v-bind:id="user.id" class="mr-2">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="trash h-5 w-5"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          fill-rule="evenodd"
          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
          clip-rule="evenodd"
        />
      </svg>
    </button>
  </div>
  </div>
  <form-layout :profile="false" v-if="layout === 'form'" v-bind="{ user }">
  </form-layout>
</template>
<style scoped>
.bg {
  background-color: #2e475e;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.simple,
.detailed {
  width: 23%;
}
</style>
<script>
import JetButton from "@/Jetstream/Button";
import FormLayout from "@/Layouts/FormLayout";
import  Toast  from '@/Mixins/Toast.js';
import { createToast } from 'mosha-vue-toastify';
export default {
  data() {
    return {
      layout: "simple",
    };
  },
  props: ["user"],
  mixins: [Toast],
  components: {
    JetButton,
    FormLayout,
  },
  methods: {
    delete1(id) {
      this.$inertia.post("/users/" + id, {
        _method: "delete",
      },{
                 onSuccess: () => {
                          Toast.toast('Successfully Deleted');
                    },
            });
    },
    UserForm(id) {
      this.$inertia.get("/users/" + id + "/edit", {});
    },
  },
};
</script>