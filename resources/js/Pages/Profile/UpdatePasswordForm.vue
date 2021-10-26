<template>
    <dialog-modal :show="modalShow" @close="close">
        <template v-slot:content>
            <jet-form-section @submitted="updatePassword">
                <template #title class="text-white"> Update Password </template>

                <template #description>
                    Ensure your account is using a long, random password to stay
                    secure.
                </template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label
                            for="current_password"
                            value="Current Password"
                            class="text-white"
                        />
                        <jet-input
                            id="current_password"
                            type="password"
                            class="mt-1 block w-full input"
                            v-model="form.current_password"
                            ref="current_password"
                            autocomplete="current-password"
                        />
                        <jet-input-error
                            :message="form.errors.current_password"
                            class="mt-2"
                        />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label
                            for="password"
                            value="New Password"
                            class="text-white"
                        />
                        <jet-input
                            id="password"
                            type="password"
                            class="mt-1 block w-full input"
                            v-model="form.password"
                            ref="password"
                            autocomplete="new-password"
                        />
                        <jet-input-error
                            :message="form.errors.password"
                            class="mt-2"
                        />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label
                            for="password_confirmation"
                            value="Confirm Password"
                            class="text-white"
                        />
                        <jet-input
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full input"
                            v-model="form.password_confirmation"
                            autocomplete="new-password"
                        />
                        <jet-input-error
                            :message="form.errors.password_confirmation"
                            class="mt-2"
                        />
                    </div>
                </template>

                <template #actions>
                    <jet-action-message
                        :on="form.recentlySuccessful"
                        class="mr-3 text-green-400"
                    >
                        Saved.
                    </jet-action-message>

                    <jet-button
                        style="background-color: #5e7ed9"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Save
                    </jet-button>
                </template>
            </jet-form-section>
        </template>
    </dialog-modal>
</template>
<style scoped>
.input {
    background-color: rgb(69, 111, 147, 0.3);
    border: none;
}
</style>
<script>
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import DialogModal from "@/Jetstream/DialogModal.vue";

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        DialogModal,
    },

    data() {
        return {
            form: this.$inertia.form({
                current_password: "",
                password: "",
                password_confirmation: "",
            }),
        };
    },

    methods: {
        close() {
            this.$inertia.get("/profile", {});
        },
        updatePassword() {
            this.form.put(route("user-password.update"), {
                errorBag: "updatePassword",
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.password) {
                        this.form.reset("password", "password_confirmation");
                        this.$refs.password.focus();
                    }

                    if (this.form.errors.current_password) {
                        this.form.reset("current_password");
                        this.$refs.current_password.focus();
                    }
                },
            });
        },
    },
    props: ["modalShow"],
};
</script>
