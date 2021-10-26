<template>
  <app-layout :domain="domain" :current="domain">
    <center-layout>
      <h1 class="2xl:text-2xl md:text-lg mb-1 mt-3">User Management</h1>
      <content-layout>
        <template v-for="user in users.data" v-bind:key="user">
          <template v-if="user.role_id == 1">
            <admin-user-card
              v-if="layout === 'simple'"
              v-bind="{ user }"
              class="2xl:mt-7 md:mt-4"
            >
            </admin-user-card>
          </template> 
          </template>
          <div class="flex 2xl:mt-14 md:mt-3 max-w-full flex-wrap">
          <template v-for="user in users.data" v-bind:key="user">
            <template v-if="user.role_id == 2 || user.role_id == 3">
              <user-card
                v-if="layout === 'simple'"
                v-bind="{ user }"
                class="mr-5"
              >
              </user-card>
            </template>
            </template>
          </div>
        <form-layout :profile="false" v-if="layout === 'form'"> </form-layout>
        <pagination class="mt-6 ml-auto mr-1 table" :links="users.links" />
      </content-layout>
      <add-button v-if="layout !== 'form'" @click="layout = 'form'"/>
    </center-layout>
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import CenterLayout from "@/Layouts/CenterLayout";
import Welcome from "@/Jetstream/Welcome";
import AdminUserCard from "@/UserCard/AdminUserCard";
import UserCard from "@/UserCard/UserCard";
import UserForm from "@/Pages/UserForm";
import ContentLayout from "@/Layouts/ContentLayout";
import AddButton from "../Layouts/AddButton.vue";
import FormLayout from "@/Layouts/FormLayout";
import Pagination from '@/Jetstream/Pagination';
export default {
  data() {
    return {
      layout: "simple",
      domain: "users",
      errors: []
    };
  },
  props: ["users"],
  mounted() {
  },
  components: {
    AppLayout,
    Welcome,
    ContentLayout,
    CenterLayout,
    AdminUserCard,
    UserCard,
    AddButton,
    UserForm,
    FormLayout,
    Pagination
  },
  methods: {
    createUser() {
      this.$inertia.get("/users/create");
    },
  },
};
</script>