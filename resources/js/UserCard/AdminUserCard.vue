<template>
  <div class="block mt-2 max-h-full rounded-md mr-6 bg">
    <div class="flex p-2 2xl:h-16 md:h-12">
      <div class="w-1/6 flex">
        <div
          v-if="layout === 'simple'"
          class="picturebox mx-auto my-auto 2xl:h-10 2xl:w-10 md:h-8 md:w-8 rounded-full"
        >
          <img
            :src="'/storage'+user.profile_photo_path"
            v-if="user?.profile_photo_path"
            class="2xl:h-10 2xl:w-10 md:h-8 md:w-8 object-cover rounded-full"
          />
          <img
            :src="user.profile_photo_url"
            v-else
            class="2xl:h-10 2xl:w-10 md:h-8 md:w-8 object-cover rounded-full"
          />
        </div>
        <div
          v-if="layout === 'detailed'"
          class="picturebox mx-auto my-auto 2xl:h-24 2xl:w-24 md:h-10 md:w-10 rounded-full"
        >
          <img
            :src="'/storage'+user.profile_photo_path"
            v-if="user?.profile_photo_path"
            class="2xl:h-16 2xl:w-16 md:h-10 md:w-10 object-cover rounded-full"
          />
          <img
            :src="user.profile_photo_url"
            v-else
            class="2xl:h-16 2xl:w-16 md:h-10 md:w-10 object-cover rounded-full"
          />
        </div>
      </div>
      <div class="flex w-1/6 overflow-hidden">
        <p class="my-auto mx-auto text-white md:text-xs 2xl:text-base">{{ user.name }}</p>
      </div>
      <div class="flex w-1/6 overflow-hidden">
        <p class="my-auto mx-auto text-white md:text-xs 2xl:text-base">{{ user.email }}</p>
      </div>
      <div class="flex w-1/6 overflow-hidden">
        <p class="my-auto mx-auto text-white md:text-xs 2xl:text-base">{{ user.phone }}</p>
      </div>
      <div class="flex w-1/6 overflow-hidden">
        <p class="my-auto mx-auto text-white md:text-xs 2xl:text-base">{{ user.role.name }}</p>
      </div>
      <div class="flex w-1/6">
        <a
          v-if="layout === 'simple'"
          @click="layout = 'detailed'"
          href="#"
          class="my-auto mx-auto"
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
        <a
          v-if="layout === 'detailed'"
          @click="layout = 'simple'"
          href="#"
          class="my-auto mx-auto"
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
        </a>
      </div>
    </div>
    <div v-if="layout === 'detailed'" class="flex ml-5 pb-2">
      <a class="flex mt-2 ml-8 md:text-xs 2xl:text-base" 
      :href="route('user-activities.index', { user: user.id })"
      :active="route().current('user-activities.active')"
        >Related Activities
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="arrow 2xl:mt-1 h-5 w-5"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
            clip-rule="evenodd"
          /></svg
      ></a>
      <button @click="delete1(user.id)" class="mx-auto mr-24">
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
</template>
<style scoped>
.bg {
  background-color: #2e475e;
  /* width: 97%; */
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<script>
import  Toast  from '@/Mixins/Toast.js';
import { createToast } from 'mosha-vue-toastify';
export default {
  mixins: [Toast],
  data() {
    return {
      layout: "simple",
    };
  },
  props: ["user"],
  components: {
    Toast
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