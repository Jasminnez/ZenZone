<template>
    <app-layout :domain="domain" :current="domain">
        <center-layout>
            <h1 class="2xl:text-2xl md:text-lg mb-1 mt-3">User Activity Management</h1>
            <main-filter :domain="domain"/>
            <content-layout>
                <template v-for="user_activity in user_activities.data" v-bind:key="user_activity">
                    <div class="flex 2xl:mt-5 md:mt-2 max-w-full">
                        <user-activity-card
                            :users="users"
                            :activities="activities"
                            v-if="layout === 'simple'"
                            v-bind="{ user_activity }"
                            class="ml-5"
                        >
                        </user-activity-card>
                    </div>
                </template>
            <pagination class="mt-6 ml-auto mr-1 table" :links="user_activities.links" />
            </content-layout>
        </center-layout>
    </app-layout>
</template>
<style scoped>
</style>
<script>
import AppLayout from "@/Layouts/AppLayout";
import UserActivityCard from "@/Layouts/UserActivities/UserActivityCard";
import CenterLayout from "../Layouts/CenterLayout.vue";
import ContentLayout from "../Layouts/ContentLayout.vue";
import Pagination from '@/Jetstream/Pagination';
import MainFilter from "../Layouts/MainFilter.vue";

export default {
    data() {
        return {
            layout: "simple",
            modalShow: false,
            domain: "user-activities"
        };
    },

    props: ["user_activities", "users", "activities"],
    methods: {
        openModal() {
            this.modalShow = true;
        },
        close() {
            this.modalShow = false;
        },
    },
    components: {
        AppLayout,
        UserActivityCard,
        CenterLayout,
        ContentLayout,
        Pagination,
        MainFilter
    },
};
</script>
