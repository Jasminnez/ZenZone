<template>
    <div
        v-if="layout === 'simple'"
        class="simple text-white flex mt-5 w-full h-16 rounded-md sm:pt-0 bg"
    >
        <div class="w-1/6 pt-5 ml-3" >
            <p class="my-auto blue pl-3">
                {{ challenge.category.name }}
            </p>
        </div>
        <div class="w-1/4 pt-5">
            <p class="my-auto mx-auto">
                {{ challenge.name }}
            </p>
        </div>
        <div class="w-1/4 pt-5 truncate">
            <p class="my-auto">
                {{ challenge.description }}
            </p>
        </div>
        <div class="w-1/6 pt-5">
            <p class="my-auto">
                {{ challenge.user_activities_count }} people
            </p>
        </div>
        <div class="w-1/5 pt-5">
            <p class="my-auto text-center">
                {{ challenge?.date }}
            </p>
        </div>
        <div class="pt-5 pr-3">
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
        class="detailed w-full mt-5 max-h-full rounded-md sm:pt-0 bg"
    >
        <div class="left pt-5 pl-12">
            <div
                v-if="challenge.photo != null"
                class="picturebox rounded-md h-32 w-56 my-auto"
            >
                <img
                    :src="challenge.photo"
                    class="rounded-md h-32 w-56 my-auto"
                />
            </div>
            <div
                v-if="challenge.photo == null"
                class="picturebox rounded-md h-32 w-56 my-auto bg-gray-500"
            ></div>
        </div>
        <div class="details-content text-white w-4/5 pl-8 pt-8">
            <div class="first-line">
                <p class="blue w-1/6">
                    {{ challenge.category.name }}
                </p>
                <div class="w-9/12"></div>
                <div class="w-1/5 flex flex-row">
                    <p class="text-xs mt-0.5">
                        {{ challenge?.date }}
                    </p>
                    <a @click="layout = 'simple'" href="#" class="mx-auto">
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

            <p class="text-xl pb-4">
                {{ challenge.name }}
            </p>
            <p class="text-sm pb-">
                {{ challenge.description }}
            </p>
            <p class="text-xs">
                {{ challenge.user_activities_count }} people
            </p>
            <div class="third-line text-right mb-3">
                <div class="flex mr-3 pb-2">
                    <div class="container w-11/12"></div>
                    <button
                        class="mx-auto mr-1 py-1.5"
                        @click="updateDailyChallenge(challenge.id)"
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
                    <acitvity-form
                        :activity="challenge"
                        :show="modalShow"
                        :categories="categories"
                    />
                    <button
                        @click="deleteDailyChallenge(challenge.id)"
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
    </div>
</template>
<style scoped>
.first-line {
    display: flex;
    flex-direction: row;
}
.bg {
    background-color: #2f4152;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.detailed {
    display: flex;
    flex-direction: row;
}
.details-content {
    display: flex;
    flex-direction: column;
}
.blue {
    color: #5e7ed9;
}
</style>
<script>
import JetButton from "@/Jetstream/Button";
import DialogModal from "@/Jetstream/DialogModal.vue";
import ActivityForm from "@/Layouts/ActivityForm";

export default {
    data() {
        return {
            layout: "simple",
            modalShow: false,
            challenge: this.challenge,
        };
    },
    props: ["challenge", "categories"],
    components: {
        DialogModal,
        JetButton,
        ActivityForm,
    },
    methods: {
        deleteDailyChallenge(id) {
            //console.log(id);
            this.$inertia.post("/daily-challenges/" + id, {
                _method: "delete",
            });
        },
        updateDailyChallenge(id) {
            this.$inertia.get("/daily-challenges/" + id + "/edit", {});
        },
    },
};
</script>
