<template>
    <dialog-modal :show="modalShow" @close="close" class="px-0 pb-0">
        <template v-slot:content>
            <challenge-activity-form
                :challenge="false"
                v-bind="{ activity, categories }"
                class="w-full"
            ></challenge-activity-form>
        </template>
    </dialog-modal>
</template>
<script>
import DialogModal from "@/Jetstream/DialogModal.vue";
import ChallengeActivityForm from "@/Layouts/ChallengeActivityForm";

export default {
    methods: {
        openModal() {
            this.modalShow = true;
        },
    },
    props: ["activity", "modalShow", "categories"],
    components: {
        DialogModal,
        ChallengeActivityForm,
    },
};
</script>
