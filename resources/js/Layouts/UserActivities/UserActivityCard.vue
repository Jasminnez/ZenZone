<template>
    <div
        v-if="layout === 'simple'"
        class="simple flex 2xl:mt-5 md:mt-3 w-full 2xl:h-16 md:h-12 rounded-md sm:pt-0 bg"
    >
        <div class="2xl:pt-4 md:pt-2 ml-3">
            <div
                v-if="user_activity.user?.profile_photo_path"
                class="picturebox h-8 w-8 my-auto rounded-full"
            >
                <img
                    :src="'/storage'+user_activity.user?.profile_photo_path"
                    class="h-8 w-8 my-auto object-cover rounded-full"
                />
            </div>
            <div v-else class="picturebox h-8 w-8 my-auto rounded-full">
                <img
                    :src="user_activity.user.profile_photo_url"
                    class="h-8 w-8 my-auto object-cover rounded-full"
                />
            </div>
        </div>
        <div class="w-1/6 2xl:pt-5 md:pt-2.5">
            <p class="my-auto text-white pl-3">
                {{ user_activity.user.name }}
            </p>
        </div>
        <div class="w-1/4 2xl:pt-5 md:pt-2.5">
            <p class="my-auto mx-auto text-white text-center">
                {{ user_activity.activity.name }}
            </p>
        </div>
        <div class="w-1/4 2xl:pt-5 md:pt-2.5 truncate">
            <p class="my-auto text-white">
                {{ user_activity.description }}
            </p>
        </div>
        <div class="w-1/4 2xl:pt-5 md:pt-2.5">
            <p class="my-auto mx-auto text-white">
                {{ user_activity.created_at?.date }}
            </p>
        </div>
        <div class="2xl:pt-5 md:pt-3">
            <a @click="layout = 'detailed'" href="#" class="my-auto mx-auto">
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
        class="detailed w-full 2xl:pt-5 md:pt-3 max-h-full rounded-md sm:pt-0 bg"
    >
        <div class="first-line">
            <div class="flex py-1 px-3">
                <div
                    v-if="user_activity.user?.profile_photo_path"
                    class="picturebox h-8 w-8 my-auto rounded-full"
                >
                    <img
                        :src="'/storage'+user_activity.user?.profile_photo_path"
                        class="h-8 w-8 my-auto rounded-full object-cover"
                    />
                </div>
                <div v-else class="picturebox h-8 w-8 my-auto rounded-full">
                    <img
                        :src="user_activity.user.profile_photo_url"
                        class="h-8 w-8 my-auto rounded-full object-cover"
                    />
                </div>
                <p class="my-auto text-white pl-4">
                    {{ user_activity.user.name }}
                </p>
                <!-- <div class="container w-10/12"></div> 
                <p class="my-auto mx-auto text-white">
                    {{ user_activity.created_at?.date }}
                </p>-->
                <a
                    @click="layout = 'simple'"
                    href="#"
                    class="my-auto mx-auto mr-2 text-right"
                >
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
        <div class="second-line">
            <div class="left">
                <div
                    v-if="user_activity.photo != null"
                    class="picturebox rounded-md ml-2 h-32 w-56 my-auto"
                >
                    <img
                        :src="user_activity.photo"
                        class="rounded-md ml-2 h-32 w-56 my-auto"
                    />
                </div>
                <div v-else-if="user_activity.activity.photo!=null">
                    <img
                        :src="user_activity.activity.photo"
                        class="rounded-md ml-2 h-32 w-56 my-auto"
                    />
                </div>
                <div
                    v-if="user_activity.activity.photo == null"
                    class="
                        picturebox
                        rounded-md
                        ml-20
                        h-32
                        w-56
                        my-auto
                        bg-gray-500
                    "
                ></div>
            </div>
            <div class="details-content pl-8 pr-20">
                <p class="text-sm" style="color: #5e7ed9">{{ user_activity.activity.category.name }}</p>
                <p class="text-xl pb-3">{{ user_activity.activity.name }}</p>
                <p class="text-sm pb-4">{{ user_activity.description }}</p>
                <p class="text-xs">{{ user_activity.likes_count }} likes</p>
                <p class="text-xs">{{ user_activity.comments_count }} comments</p>
            </div>
        </div>
        <div class="third-line text-right mb-3">
            <div class="flex mr-5 pb-2">
                <div class="container w-w-11/12"></div>
                <button
                    class="mx-auto mr-1 py-1.5"
                    @click="updateUserActivity(user_activity)"
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
                <user-activity-form
                    :user_activity="user_activity"
                    :show="modalShow"
                    :users="users"
                    :activities="activities"
                />
                <button
                    @click="deleteUserActivity(user_activity.id)"
                    class=""
                >
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
    </div>
</template>
<style scoped>
.bg {
    background-color: #2f4152;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.second-line {
    display: flex;
    flex-direction: row;
}
.details-content {
    display: flex;
    flex-direction: column;
}
</style>
<script>
import UserActivityForm from "@/Layouts/UserActivities/UserActivityForm";
import  Toast  from '@/Mixins/Toast.js';
import { createToast } from 'mosha-vue-toastify';

export default {
    mixins: [Toast],
    data() {
        return {
            layout: "simple",
            modalShow: false,
            user_activity: this.user_activity,
        };
    },
    props: ["user_activity", "users", "activities"],
    components: {
        UserActivityForm,
        Toast
    },
    methods: {
        deleteUserActivity(id) {
            this.$inertia.post("/user-activities/" + id, {
                _method: "delete",
            },{
                 onSuccess: () => {
                          Toast.toast('Successfully Deleted');
                    },
            });
        },
        updateUserActivity(user_activity) {
            this.modalShow = true;
        },
    },
};
</script>
