<template>
  <jet-authentication-card class="bg">
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <jet-validation-errors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>
    <h1 class="mt-3 mb-1">Sign in</h1>
    <h3 class="mb-4 text-gray-400">Login to manage your account</h3>
    <form @submit.prevent="submit">
      <div>
        <div class="flex bgemail">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 mt-3 ml-2"
            viewBox="0 0 20 20"
            fill="white"
          >
            <path
              d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"
            />
            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
          </svg>
          <jet-input
            id="email"
            type="email"
            placeholder="Email"
            class="mt-1 block w-full logininput"
            v-model="form.email"
            required
            autofocus
          />
        </div>
      </div>

      <div class="mt-4">
        <div class="flex bgpassword">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5 mt-3 ml-2"
            viewBox="0 0 20 20"
            fill="white"
          >
            <path
              fill-rule="evenodd"
              d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z"
              clip-rule="evenodd"
            />
          </svg>
          <jet-input
            id="password"
            type="password"
            placeholder="Password"
            class="mt-1 block w-full logininput"
            v-model="form.password"
            required
            autocomplete="current-password"
          />
        </div>
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <jet-checkbox name="remember" v-model:checked="form.remember" />
          <span class="ml-2 text-sm text-white">Remember me</span>
        </label>
      </div>

      <div class="justify-center mt-4">
        <jet-button
          class="loginbtn"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          <span class="m-auto">Log in</span>
        </jet-button>
      </div>
      <inertia-link
        v-if="canResetPassword"
        :href="route('password.request')"
        class="underline text-sm text-gray-300 hover:text-white"
      >
        <span class="frgtext">Forgot your password? </span>
      </inertia-link>
    </form>
  </jet-authentication-card>
</template>

<style scoped>
.bg {
  background: linear-gradient(to right, rgba(72, 116, 155), rgba(40, 63, 82));
}
.logininput {
  background: none;
  color: white;
  border: none;
}
.bgemail,
.bgpassword {
  background: rgb(69, 111, 147, 0.3);
  border-radius: 5px;
}
.loginbtn {
  background: #b56d2a;
  width: 90%;
  margin-left: 20px;
}
.logintext {
  color: white;
}
.frgtext {
  margin-left: 125px;
}
h1 {
  font-size: 1.4em;
  color: #fff;
}
h3 {
  font-size: 0.8em;
}
input:focus,
textarea:focus,
select:focus {
  outline: none;
}
</style>
<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => this.form.reset("password"),
        });
    },
  },
};
</script>
