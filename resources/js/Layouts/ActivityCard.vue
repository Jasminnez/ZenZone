<template>
    <div class="card 2xl:w-60 md:w-52 ml-2">
        <div class="h-60">
        <div class="first-line mt-2">
            <div class="text-left w-3/4">
                <h2 class="ml-3 text-base">{{ activity?.category.name }}</h2>
            </div>
            <div class="pl-8 w-1/4 mr-1">
                <a
                    v-if="layout == 'simple'"
                    @click="layout = 'detailed'"
                    href="#"
                    class="my-auto"
                    ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        /></svg
                ></a>
                <a v-else @click="layout = 'simple'" href="#" class="my-auto"
                    ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                            clip-rule="evenodd"
                        /></svg
                ></a>
            </div>
        </div>
        <h1 class="ml-3 mt-1 mb-4 text-lg">{{ activity?.name }}</h1>

        <div
            v-if="activity?.photo != null"
            class="rounded-md mx-auto 2xl:h-32 2xl:w-56  md:w-28 2xl:pt-4 md:pt-2 overflow-hidden"
        >
            <img
                :src="activity?.photo"
                class="rounded-md mx-auto h-32 w-56"
            />
        </div>
        <div v-else class="rounded-md mx-auto h-32 w-56 pt-4">
            <img
                v-bind:src="avatarUrl"
                class="rounded-md mx-auto h-32 w-56"
            />
        </div>
    </div>
        
            <p v-if="layout == 'simple'" class="m-3 line-clamp-3">
                {{ activity?.description }}
            </p>
            <p v-if="layout == 'detailed'" class="m-3 text-left">
                {{ activity?.description }}
            </p>

        <div v-if="layout == 'detailed'" class="flex ml-1 mb-1">
            <a class="flex ml-2" href="#"
                >Related
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
            <button
                class="mx-auto mr-1 py-1.5"
                @click="updateActivity(activity)"
            >
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
            <activity-form
                :activity="activity"
                :show="modalShow"
                :categories="categories"
            />
            <button @click="deleteActivity(activity?.id)" class="mr-2 py-1">
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
.card {
    display: flex;
    flex-direction: column;
    /* width: 256px; */
    min-height: 320px;
    background: rgba(57, 91, 120, 0.9);
    border: 0.5px solid #2f4e6b;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 20px;
}
.first-line {
    display: flex;
    flex-direction: row;
}

p {
    font-size: 12px;
}
</style>
<script>
import JetButton from "@/Jetstream/Button";
import DialogModal from "@/Jetstream/DialogModal.vue";
import ActivityForm from "@/Layouts/ActivityForm";
import  Toast  from '@/Mixins/Toast.js';
import { createToast } from 'mosha-vue-toastify'

export default {
    data() {
        return {
            layout: "simple",
            modalShow: false,
            activity: this.activity,
            avatarUrl: "//eu.ui-avatars.com/api/?name=" + this.activity.name,
        };
    },
    props: ["activity", "categories"],
    mixins: [Toast],
    components: {
        DialogModal,
        JetButton,
        ActivityForm,
        Toast
    },
    methods: {
        deleteActivity(id) {
            console.log(id);
            this.$inertia.post("/activities/" + id, {
                _method: "delete",
            },{
                 onSuccess: () => {
                          Toast.toast('Successfully Deleted');
                    },
            });
        },
        updateActivity(activity) {
            this.modalShow = true;
        },
    },
};
</script>
