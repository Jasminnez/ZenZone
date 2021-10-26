<template>
    <dialog-modal :show="modalShow" @close="close">
        <template v-slot:content>
            <form
                @submit.prevent="submit"
                enctype="multipart/form-data"
                class="mx-auto w-full h-full my-auto rounded-md bg"
            >
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
                        :src="form.imagePreview"
                        v-if="form.imagePreview"
                        class="rounded-full h-32 w-36"
                    />
                    <input
                        type="file"
                        @change="imageSelected"
                        @input="form.avatar = $event.target.files[0]"
                        class="ml-10 h-10 input"
                        id="fileUpload"
                        hidden
                    />
                    <div
                        class="
                            absolute
                            top-0
                            h-full
                            w-full
                            rounded-full
                            bg-black bg-opacity-25
                            flex
                            items-center
                            justify-center
                        "
                    >
                        <button @click="chooseFiles">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-9 w-10"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                <button
                    class="removeImage rounded-full h-6 w-6 absolute"
                    @click="removeImage()"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 remove"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </button>
                <hr class="mx-5" />
                <div class="ml-3 mt-3">
                    <div class="flex mt-2">
                        <jet-input id="id" type="hidden" v-model="form.id" />
                        <jet-label
                            for="user"
                            value="User:"
                            class="text-white my-auto w-1/4"
                        />
                        <select
                            name="user_id"
                            required
                            v-model="form.user_id"
                            class="mt-1 w-1/3 h-10 input"
                        >
                            <option
                                class="uppercase text-gray-500 cursor-pointer"
                                v-for="user in users"
                                :key="user.id"
                                :value="user.id"
                            >
                                {{ user?.name }}
                            </option>
                        </select>
                    </div>
                    <div class="flex mt-2">
                        <jet-label
                            for="activity"
                            value="Activity:"
                            class="text-white my-auto w-1/4"
                        />
                        <select
                            name="activity_id"
                            required
                            v-model="form.activity_id"
                            class="mt-1 w-1/3 h-10 input"
                        >
                            <option
                                class="uppercase text-gray-500 cursor-pointer"
                                v-for="activity in activities"
                                :key="activity.id"
                                :value="activity.id"
                            >
                                {{ activity?.name }}
                            </option>
                        </select>
                    </div>

                    <div class="flex mt-2">
                        <jet-label
                            for="description"
                            value="Description:"
                            class="text-white my-auto w-1/4"
                        />
                        <textarea
                            id="description"
                            type="description"
                            v-model="form.description"
                            placeholder=""
                            class="ml-3 mr-10 mt-1 w-3/4 h-16 input"
                        />
                    </div>
                </div>
            </form>
        </template>
        <template v-slot:footer>
            <jet-button
                class="btn edit-btn"
                @click="editUserActivity(user_activity.id)"
                >Save Changes</jet-button
            >
            <jet-button class="btn cancel-btn ml-3" @click="close"
                >Cancel</jet-button
            >
        </template>
    </dialog-modal>
</template>
<style scoped>
.btn {
    color: white;
}
.edit-btn {
    background: #5e7ed9;
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
.removeImage {
    top: 150px;
    left: 20%;
}
.remove {
    color: rgb(61, 96, 128);
}
</style>
<script>
import DialogModal from "@/Jetstream/DialogModal.vue";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import { useForm } from "@inertiajs/inertia-vue3";
import  Toast  from '@/Mixins/Toast.js';
import { createToast } from 'mosha-vue-toastify';

export default {
    mixins: [Toast],
    setup() {
        const form = useForm({
            id: 0,
            user_id: null,
            activity_id: null,
            description: null,
            avatar: null,
            imagePreview: null,
        });

        return { form };
    },
    data() {
        return {
            modalShow: true,
        };
    },
    methods: {
        close() {
            this.$inertia.get("/user-activities", {});
        },
        editUserActivity(id) {
            this.$inertia.put("/user-activities/" + id, this.form, {
                 onSuccess: () => {
                          Toast.toast('Successfully Edited');
                    },
            });
        },
        openModal() {
            this.modalShow = true;
        },
        chooseFiles() {
            document.getElementById("fileUpload").click();
        },
        imageSelected(e) {
            this.image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = (e) => {
                this.form.imagePreview = e.target.result;
            };
        },
        removeImage() {
            this.form.imagePreview = null;
        }
    },
    mounted() {
        if (this.user_activity != null) {
            this.form.id = this.user_activity.id;
            this.form.user_id = this.user_activity.user.id;
            this.form.activity_id = this.user_activity.activity_id;
            this.form.description = this.user_activity.description;

            if (this.user_activity.photo != null) {
                this.form.imagePreview = this.user_activity.photo;
            } else {
                if (this.user_activity.activity.photo != null) {
                    this.form.imagePreview = this.user_activity.activity.photo;
                }
            }
        }
    },
    props: ["user_activity", "modalShow", "users", "activities"],
    components: {
        DialogModal,
        JetLabel,
        JetButton,
        JetInput,
        Toast
    },
};
</script>
