<template>
<div class="flex w-full h-full mx-auto rounded-md">
    <form @submit.prevent="submit" class="bg">
            <div>
                <jet-label for="name" value="Name" class="text-white"/>
                <jet-input id="name" type="name" class="mt-1 block w-full h-10 input"/>
            </div>
    </form>
</div>
</template>
<style scoped>
.bg{
    background:var(--bg);
}
.input{
    background: rgb(69,111,147,0.30);;
    color: white;
    border: none;
}
</style>
<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetInput from '@/Jetstream/Input';
import JetLabel from '@/Jetstream/Label';

export default {
  data() {
    return {
      layout: "simple",
    };
  },
  props: ["categories"],
  components: {
   JetAuthenticationCard,
   JetInput,
   JetLabel
  },
};
</script>