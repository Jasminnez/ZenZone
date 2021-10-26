<template>
    <app-layout :domain="domain" :current="domain">
        <center-layout>
            <h1 class="2xl:text-2xl md:text-lg mb-1 mt-3">Daily Challenge Management</h1>
            <main-filter :domain="domain"/>
            <content-layout>
                <template
                    v-for="challenge in challenges.data"
                    v-bind:key="challenge"
                >
                    <div class="flex 2xl:mt-8 md:mt-2 max-w-full">
                        <daily-challenge-card
                            :categories="categories"
                            v-if="layout === 'simple'"
                            v-bind="{ challenge }"
                            class="ml-5 w-full"
                        >
                        </daily-challenge-card>
                    </div>
                </template>
                <pagination class="mt-6 ml-auto mr-1 table" :links="challenges.links" />
            </content-layout>
            <add-button @click="AddChallenge" />
        </center-layout>
    </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import CenterLayout from "../Layouts/CenterLayout.vue";
import ContentLayout from "../Layouts/ContentLayout.vue";
import AddButton from "../Layouts/AddButton.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import ActivityForm from "@/Layouts/ActivityForm";
import DailyChallengeCard from "../Layouts/DailyChallengeCard.vue";
import Pagination from '@/Jetstream/Pagination';
import MainFilter from "../Layouts/MainFilter.vue";

export default {
    data() {
        return {
            layout: "simple",
            modalShow: false,
            domain: "daily-challenges",
        };
    },

    props: ["challenges", "categories"],
    methods: {
        openModal() {
            this.modalShow = true;
        },
        close() {
            this.modalShow = false;
        },
        AddChallenge() {
            this.$inertia.get("/daily-challenges/create");
        },
    },
    components: {
        AppLayout,
        DailyChallengeCard,
        CenterLayout,
        ContentLayout,
        AddButton,
        DialogModal,
        ActivityForm,
        DailyChallengeCard,
        Pagination,
        MainFilter
    },
};
</script>
