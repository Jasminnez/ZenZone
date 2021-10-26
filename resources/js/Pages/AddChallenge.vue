<template>
    <app-layout :current="'add-challenge'">
        <center-layout>
            <h1 class="2xl:text-2xl md:text-lg mb-8 mt-3">Add Daily Challenge</h1>
            <content-layout>
                <div class="bg p-4 rounded-md">
                    <challenge-activity-form
                        :challenge="true"
                        v-bind="{ activity, categories }"
                    ></challenge-activity-form>
                </div>
            </content-layout>
        </center-layout>
    </app-layout>
</template>
<style scoped>
.bg{
  background: #2e475e;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<script>
import AppLayout from "@/Layouts/AppLayout";
import CenterLayout from "../Layouts/CenterLayout.vue";
import ContentLayout from "../Layouts/ContentLayout.vue";
import ChallengeActivityForm from "@/Layouts/ChallengeActivityForm";
export default {
    data() {
        return {
            current: "add-challenge"
        };
    },
    props: ["activity", "categories"],
    components: {
        AppLayout,
        CenterLayout,
        ContentLayout,
        ChallengeActivityForm,
    },
};
</script>
