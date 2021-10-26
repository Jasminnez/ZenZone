<template>
    <app-layout :domain="domain" :current="domain">
        <center-layout>
            <h1 class="2xl:text-2xl md:text-lg mb-1 mt-3">Category Management</h1>
            <main-filter :domain="domain"/>
            <content-layout>
                <template v-for="category in categories.data" v-bind:key="category">
                    <div class="flex 2xl:mt-14 md:mt-7 max-w-full">
                        <category-card
                            v-if="layout === 'simple'"
                            v-bind="{ category }"
                            class="ml-5"
                        >
                        </category-card>
                    </div>
                </template>
                 <pagination class="mt-6 ml-auto mr-1 table" :links="categories.links" />
            </content-layout>
            <add-button @click="openModal" />
            <category-form :category="null" :show="modalShow"/>
        </center-layout>
    </app-layout>
</template>
<style scoped>
.btn {
    color: white;
}
.add-btn {
    background: #b56d2a;
}
.cancel-btn {
    background: #878686;
}
.input {
    background: rgb(69, 111, 147, 0.3);
    color: white;
    border: none;
    border-radius: 5%;
}
.add-title {
    font-size: 22px;
    color: wheat;
}
</style>
<script>
import AppLayout from "@/Layouts/AppLayout";
import CategoryCard from "@/Layouts/Categories/CategoryCard";
import CategoryForm from "@/Layouts/Categories/CategoryForm";
import CenterLayout from "../Layouts/CenterLayout.vue";
import ContentLayout from "../Layouts/ContentLayout.vue";
import AddButton from "../Layouts/AddButton.vue";
import MainFilter from "../Layouts/MainFilter.vue";
import DialogModal from "@/Jetstream/DialogModal.vue";
import Button from "../Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import Pagination from '@/Jetstream/Pagination'

export default {
    data() {
        return {
            layout: "simple",
            modalShow: false,
            domain: "categories"
        };
    },

    props: ["categories"],
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
        CategoryCard,
        CategoryForm,
        CenterLayout,
        ContentLayout,
        AddButton,
        MainFilter,
        DialogModal,
        Button,
        JetLabel,
        JetInput,
        Pagination
    },
};
</script>
