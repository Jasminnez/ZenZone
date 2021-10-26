<template>
    <jet-authentication-card class="bg">
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="Email" class="text-white"/>
                <jet-input id="email" type="email" class="mt-1 block w-full input" v-model="form.email" required autofocus />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" class="text-white"/>
                <jet-input id="password" type="password" placeholder="Password" class="mt-1 block w-full input" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" class="text-white" />
                <jet-input id="password_confirmation" type="password" placeholder="Confirm Password" class="mt-1 block w-full input" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-button class="resetbtn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <span class="m-auto">Reset Password</span>
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>
<style scoped>
.bg{
    background: linear-gradient(to right, rgba(72,116,155), rgba(40,63,82));
}
.resetbtn{
    background: #B56D2A;
    width: 90%;
    margin-left: 20px;
}
.input{
    background: rgb(69,111,147,0.30);;
    color: white;
    border: none;
}
</style>
<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors
        },

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
