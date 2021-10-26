<template>
    <div
        v-if="layout === 'simple'"
        class="simple flex w-full 2xl:h-16 md:h-14 rounded-md sm:pt-0 bg"
    >
        <div class="row-part flex">
            <p class="my-auto ml-5">{{ category.id }}</p>
            <p class="my-auto ml-6 2xl:text-xl md:text-base">{{ category.name }}</p>
        </div>

        <div class="row-part flex ml-auto mr-1">
            <p class="my-auto mr-4">
                {{ category.activities_count }} activities
            </p>
            <a @click="layout = 'detailed'" href="#" class="my-auto mr-5">
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
    </div>
    <div
        v-if="layout === 'detailed'"
        class="detailed w-full max-h-full rounded-md sm:pt-0 bg"
    >
        <div class="flex p-5">
            <div class="row-part flex">
                <p class="my-auto ml-5">{{ category.id }}</p>
                <p class="my-auto ml-6 2xl:text-xl md:text-base">{{ category.name }}</p>
            </div>

            <div class="row-part flex ml-auto mr-1">
                <p class="my-auto mr-4">
                    {{ category.activities_count }} activities
                </p>
                <a @click="layout = 'simple'" href="#" class="my-auto mr-5">
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
        <div class="flex ml-5 my-3 pb-2">
            <a
                class="flex ml-8"
                :href="route('activities.index', { category: category.id })"
                :active="route().current('activities.active')"
                >Check Out Related Activities
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="arrow mt-1 h-5 w-5"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                    /></svg
            ></a>
            <button class="mx-auto mr-2" @click="updateCategory(category)">
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
            <category-form :category="category" :show="modalShow" />
            <button @click="deleteCategory(category.id)" class="mr-20">
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
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
/* .row-part {
    width: 50%;
} */
</style>
<script>
import JetButton from "@/Jetstream/Button";
import DialogModal from "@/Jetstream/DialogModal.vue";
import CategoryForm from "@/Layouts/Categories/CategoryForm";
import  Toast  from '@/Mixins/Toast.js';
import { createToast } from 'mosha-vue-toastify';


export default {
    mixins: [Toast],
    data() {
        return {
            layout: "simple",
            modalShow: false,
            category: this.category,
        };
    },
    props: ["category"],
    
    components: {
        JetButton,
        DialogModal,
        CategoryForm,
        Toast,
    },
    methods: {
        deleteCategory(id) {
            this.$inertia.post("/categories/" + id, {
                _method: "delete",
            },{
                 onSuccess: () => {
                          Toast.toast('Successfully Deleted');
                    },
            });
        },
        updateCategory(category) {
            this.modalShow = true;
        },
        edit(category) {
            this.openModal();
            this.$emit("edit", category);
        },
    },
};
</script>
