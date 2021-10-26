<template>
  <app-layout>
    <center-layout>
      <content-layout>
        <form-layout :profile="false" v-bind="{user}"></form-layout>
      </content-layout>
    </center-layout>
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import CenterLayout from "@/Layouts/CenterLayout";
import ContentLayout from "@/Layouts/ContentLayout";
import FormLayout from "@/Layouts/FormLayout";
export default {
  props: ["user"],
  components: {
    AppLayout,
    CenterLayout,
    ContentLayout,
    FormLayout
  },
};
</script>