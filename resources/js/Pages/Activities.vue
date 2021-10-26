<template>
    <app-layout :domain="domain" :current="domain">
        <center-layout>
            <h1 class="2xl:text-2xl md:text-lg mb-1 mt-3">Activity Management</h1>
            <main-filter :domain="domain"/>
            <content-layout>
                <div class="flex flex-wrap">
                    <template
                        class="flex-wrap"
                        v-for="activity in activities.data"
                        v-bind:key="activity"
                    >
                        <div class="flex-wrap 2xl:mt-14 md:mt-7">
                            <div v-if="activity.is_challenge == 0">
                                <activity-card
                                    :categories="categories"
                                    v-if="layout === 'simple'"
                                    v-bind="{ activity }"
                                    class="ml-5"
                                >
                                </activity-card>
                            </div>
                        </div>
                    </template>
                </div>
                <pagination class="mt-6 ml-auto mr-1 table" :links="activities.links" /> 
            </content-layout>
            <add-button @click="openModal" />
            <activity-form
                :activity="null"
                :show="modalShow"
                :categories="categories"
            />
        </center-layout>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import ActivityCard from "@/Layouts/ActivityCard";
import CenterLayout from "../Layouts/CenterLayout.vue";
import ContentLayout from "../Layouts/ContentLayout.vue";
import AddButton from "../Layouts/AddButton.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import ActivityForm from "@/Layouts/ActivityForm";
import Pagination from '@/Jetstream/Pagination';
import MainFilter from "../Layouts/MainFilter.vue";

export default {
    data() {
        return {
            layout: "simple",
            modalShow: false,
            domain: "activities"
        };
    },
    props: ["activities", "categories"],
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
        ActivityCard,
        CenterLayout,
        ContentLayout,
        AddButton,
        DialogModal,
        ActivityForm,
        Pagination,
        MainFilter
    },
};
</script>
