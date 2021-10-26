<template>
  <app-layout :current="'profile'">
    <center-layout>
      <div
        v-if="layout === 'preview'"
        class="mx-auto my-auto md:mt-5 2xl:mt-20 w-3/5 max-h-full mb-3 rounded-md pb-2 bg"
      >
        <div class="flex">
          <div
            class="
              relative
              inline-block
              overflow-hidden
              my-auto
              ml-2
              h-32
              ml-5
              mt-5
              mb-5
              w-32
              rounded-full
              hover:bg-white hover:bg-opacity-25
              focus:outline-none
              text-white
              transition
              duration-200
            "
          >
            <img
              :src="imagePreview"
              v-if="imagePreview"
              class="my-auto h-32 w-32 object-cover rounded-full"
            />
            <img
              :src="user.profile_photo_url"
              v-else
              class="my-auto h-32 w-32 object-cover rounded-full"
            />
          </div>
          <div class="flex-row mx-auto my-auto">
            <h1 class="mx-auto my-auto font-bold text-5xl">
              {{ user.name }}
            </h1>
            <h2 class="mt-5 ml-5 mx-auto my-auto text-lg">
              {{ user.email }}
            </h2>
          </div>
        </div>
        <hr class="mx-5 2xl:mt-5 md:mt-2" />
        <div class="ml-3 2xl:mt-7 md:mt-3">
          <div class="flex mt-2">
            <jet-input id="id" type="hidden" v-model="form.id" />
            <jet-label
              for="fullname"
              value="Full Name"
              class="text-white mt-5 my-auto ml-5 w-1/6"
            />
            <jet-label
              id="fullname"
              type="fullname"
              v-model="form.fullname"
              placeholder="Full Name"
              class="ml-3 mr-10 mt-5 w-3/4 h-5 input"
              ><span>{{ form.fullname }}</span></jet-label
            >
          </div>
          <div class="flex mt-2">
            <jet-label
              for="username"
              value="Username"
              class="text-white mt-5 my-auto ml-5 w-1/6"
            />
            <jet-label
              id="username"
              type="username"
              v-model="form.username"
              placeholder="Username"
              class="ml-3 mr-10 mt-5 w-3/4 h-5 input"
              ><span>{{ form.username }}</span></jet-label
            >
          </div>

          <div class="flex mt-2">
            <jet-label
              for="email"
              value="Email"
              class="text-white mt-5 my-auto ml-5 w-1/6"
            />
            <jet-label id="email" class="ml-3 mr-10 mt-5 w-3/4 h-5 input"
              ><span>{{ form.email }}</span></jet-label
            >
          </div>

          <div class="flex mt-2">
            <jet-label
              for="phone"
              value="Phone"
              class="text-white mt-5 my-auto ml-5 w-1/6"
            />
            <jet-label
              id="phone"
              type="phone"
              v-model="form.phone"
              placeholder="Phone"
              class="ml-3 mr-10 mt-5 w-3/4 h-5 input"
              ><span>{{ form.phone }}</span></jet-label
            >
          </div>
          <div class="flex mt-2">
            <jet-label
              for="gender"
              value="Gender"
              class="text-white mt-5 my-auto ml-5 w-1/6"
            />
            <jet-label id="gender" class="ml-3 mr-10 mt-5 w-3/4 h-5 input"
              ><span>{{ user.gender }}</span></jet-label
            >
          </div>
          <div class="mt-2 flex">
            <jet-label
              for="role"
              value="Role"
              class="text-white mt-5 my-auto ml-5 w-1/6"
            />
            <jet-label
              id="role"
              type="Role"
              class="ml-3 mr-10 mt-5 w-3/4 h-5 input"
              ><span>{{ user.role.name }}</span></jet-label
            >
          </div>
          <jet-button
            v-if="user?.id >= 0"
            @click="layout = 'form'"
            class="addbtn ml-auto mr-3 mb-2"
            :class="'p-2 rounded-sm bg-blue-400 hover:bg-blue-500'"
          >
            <span class="m-auto">Edit Profile</span>
          </jet-button>
        </div>
      </div>
      <form-layout
        :profile="true"
        v-if="layout === 'form'"
        v-bind="{ user }"
      ></form-layout>
    </center-layout>
  </app-layout>
</template>
<style scoped>
.bg {
  /* margin-top: 5rem; */
  background: #345370;
  border: 0.5px solid #2f4e6b;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.input {
  background: none;
  color: white;
  border: none;
  border-radius: 5%;
}
.addbtn {
  display: block;
}
.closebtn {
  background: #878686;
}
</style>
<script>
import AppLayout from "@/Layouts/AppLayout";
import CenterLayout from "../Layouts/CenterLayout.vue";
import Welcome from "@/Jetstream/Welcome";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import ContentLayout from "@/Layouts/ContentLayout";
import JetButton from "@/Jetstream/Button";
import FormLayout from "@/Layouts/FormLayout";
export default {
  props: ["user"],
  data() {
    return {
      user: this.user,
      layout: "preview",
      image: null,
      imagePreview: "storage/"+ this.user?.profile_photo_path,
      form: {
        id: this.user?.id,
        avatar: this.form?.avatar,
        fullname: this.user?.name,
        username: this.user?.username,
        email: this.user?.email,
        phone: this.user?.phone,
        gender_id: this.user?.gender,
        role: this.user?.role_id,
      },
    };
  },
  components: {
    AppLayout,
    Welcome,
    CenterLayout,
    JetAuthenticationCard,
    JetInput,
    JetLabel,
    JetDropdown,
    JetDropdownLink,
    AppLayout,
    ContentLayout,
    JetButton,
    FormLayout,
  },
};
</script>
