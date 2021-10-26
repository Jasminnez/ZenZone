<template>
    <jet-authentication-card class="bg">
        <template #logo>
            <jet-authentication-card-logo />
        </template>
            <h1 class="my-auto text-white">Password Reset</h1>
        <div class="mb-4 font-medium text-sm text-green-600">
            Password Successfully Reset. Please return to Login Screen!
        </div>

        
    </jet-authentication-card>
</template>
<style scoped>
.bg{
    background: linear-gradient(to right, rgba(72,116,155), rgba(40,63,82));
}
</style>
<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },
    }
</script>
