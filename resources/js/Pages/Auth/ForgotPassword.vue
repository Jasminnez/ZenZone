<template>
    <jet-authentication-card class="bg">
        <template #logo>
            <jet-authentication-card-logo />
        </template>
        <h1 class="mt-2">Forgot password?</h1>
        <div class="mt-4 mb-4 text-sm text-gray-300">
            Please enter your registered email address. We’ll send instuctions to help reset your password.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
            <div class="flex bgemail mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-2 ml-2" viewBox="0 0 20 20" fill="white">
  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
</svg>
                <jet-input id="email" type="email" placeholder="Email" class="block w-full emaillabel" v-model="form.email" required autofocus/>
            </div>
            </div>

            <div class="flex items-center justify-end mt-4 mb-1">
                <jet-button class="m-auto forgotbtn" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <span class="m-auto">Send reset instructions</span>
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>
<style scoped>
.bg{
    background: linear-gradient(to right, rgba(72,116,155), rgba(40,63,82));
}
.emaillabel{
    background:none;
    color: white;
    border: none;     
}
.bgemail{
    background:rgb(69,111,147,0.30);
    border-radius: 5px;
}
h1{
    color:#fff;
    font-size: 1.4rem;
}
.forgotbtn{
    background: #B56D2A;
    width: 90%;
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
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    }
</script>
