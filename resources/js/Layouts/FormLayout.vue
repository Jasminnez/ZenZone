<template>
  <div class="flex w-full h-full mx-auto my-auto rounded-md">
    <form
      @submit.prevent="submit"
      enctype="multipart/form-data"
      class="mx-auto md:w-3/4 2xl:w-3/5 my-auto pb-2 rounded-md bg"
    >
      <jet-validation-errors class="block mb-4 my-auto" />
      <div class="flex">
        <div
          class="
            relative
            inline-block
            overflow-hidden
            my-auto
            ml-2
            h-32
            ml-5
            mt-5
            mb-5
            w-32
            md:mt-2
            md:mb-2
            md:w-24
            md:h-24
            rounded-full
            hover:bg-black hover:bg-opacity-25
            focus:outline-none
            text-white
            transition
            duration-200
          "
        >
          <img
            :src="imagepreview"
            v-if="imagepreview"
            class="rounded-full h-32 w-32"
          />
          <input
            type="file"
            @change="imageSelected"
            @input="form.avatar = $event.target.files[0]"
            class="ml-10 h-10 input"
            id="fileUpload"
            hidden
          />
          <div
            class="
              absolute
              top-0
              h-full
              w-full
              rounded-full
              bg-black bg-opacity-25
              flex
              items-center
              justify-center
            "
          >
          <!-- v-if="!user?.profile_photo_path" -->
            <button @click="chooseFiles"  class="hover:bg-black hover:bg-opacity-25 rounded-full">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-9 w-10"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                />
              </svg>
            </button>
            <!-- v-else -->
            <button @click="removeImage(), form.removed = true" class="hover:bg-black hover:bg-opacity-25 rounded-full">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-9 w-10"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
        <div v-if="profile === true" class="flex-row mx-auto my-auto">
          <h1 class="mx-auto my-auto font-bold 2xl:text-5xl md:text-4xl md:pt-2">
            {{ user?.name }}
          </h1>
          <h2 class="mt-5 ml-5 mx-auto my-auto text-lg">
            {{ user?.email }}
          </h2>
        </div>
      </div>
      <h1 class="ml-5 mb-3">Account</h1>
      <hr class="mx-5" />
      <div class="ml-3 2xl:mt-3 md:mt-2">
        <div class="flex 2xl:mt-2 md:mt-1">
          <jet-input id="id" type="hidden" v-model="form.id" />
          <jet-label
            for="fullname"
            value="Full Name"
            class="text-white my-auto w-1/4"
          />
          <jet-input
            id="fullname"
            type="fullname"
            v-model="form.fullname"
            placeholder="Full Name"
            required
            autofocus
            class="ml-3 mr-10 mt-1 w-3/4 h-10 input"
          />
        </div>
        <div class="flex mt-2">
          <jet-label
            for="username"
            value="Username"
            class="text-white my-auto w-1/4"
          />
          <jet-input
            id="username"
            type="username"
            v-model="form.username"
            placeholder="Username"
            required
            autofocus
            class="ml-3 mr-10 mt-1 w-3/4 h-10 input"
          />
        </div>

        <div class="flex mt-2">
          <jet-label
            for="email"
            value="Email"
            class="text-white my-auto w-1/4"
          />
          <jet-input
            id="email"
            v-model="form.email"
            placeholder="Email"
            required
            autofocus
            class="ml-3 mr-10 mt-1 w-3/4 h-10 input"
          />
        </div>

        <div class="flex mt-2">
          <jet-label
            for="phone"
            value="Phone"
            class="text-white my-auto w-1/4"
          />
          <jet-input
            id="phone"
            type="phone"
            v-model="form.phone"
            placeholder="Phone"
            class="ml-3 mr-10 mt-1 w-3/4 h-10 input"
          />
        </div>
        <div class="flex mt-2">
          <jet-label
            for="gender"
            value="Gender"
            class="text-white my-auto w-1/4"
          />
          <select
            name="gender_id"
            v-model="form.gender_id"
            class="mt-1 w-1/3 h-10 input"
          >
            <option></option>
            <option value="1">Male</option>
            <option value="2">Female</option>
          </select>
          <jet-button
            v-if="profile === true"
            class="ml-auto mr-10 bg-blue-400 hover:bg-blue-500"
            :class="'p-2 rounded-sm'"
            @click="updatePassword()"
          >
            <span class="m-auto">Change Password</span>
          </jet-button>
          <update-password-form :show="modalShow" />
        </div>
        <div class="mt-2 flex">
          <jet-label for="role" value="Role" class="text-white my-auto w-1/4" />
          <select
            name="role_id"
            v-model="form.role_id"
            class="mt-1 w-1/3 h-10 input"
          >
            <option value="1">Administrator</option>
            <option value="2">Rođo</option>
            <option value="3">User</option>
          </select>
        </div>
      </div>
      <div class="ml-auto mr-5 mt-2 flex">
        <jet-button
          @click="submit1()"
          v-if="user?.id == null"
          class="addbtn ml-auto mr-1"
          :class="'p-2 rounded-sm'"
        >
          <span class="m-auto">Add New</span>
        </jet-button>
        <jet-button
          v-if="user?.id >= 0"
          @click="update1()"
          class="addbtn ml-auto mr-1"
          :class="'p-2 rounded-sm'"
        >
          <span class="m-auto">Edit</span>
        </jet-button>
        <jet-button
          v-if="profile === true"
          @click="cancel()"
          class="closebtn mr-1"
          :class="'p-2 rounded-sm'"
        >
          <span class="m-auto">Cancel</span>
        </jet-button>
        <jet-button
          v-else
          @click="cancel1()"
          class="closebtn mr-1"
          :class="'p-2 rounded-sm'"
        >
          <span class="m-auto">Cancel</span>
        </jet-button>
      </div>
    </form>
  </div>
</template>
<style scoped>
.bg {
  background: #345370;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.input {
  background: rgb(69, 111, 147, 0.3);
  color: white;
  border: none;
  border-radius: 5%;
}
.addbtn {
  background: #b56d2a;
}
.closebtn {
  background: #878686;
}
.removeImage {
  top: 24%;
  left: 20%;
}
.remove {
  color: white;
}
</style>
<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetButton from "@/Jetstream/Button";
import UpdatePasswordForm from "../Pages/Profile/UpdatePasswordForm.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
// import { defineComponent } from 'vue'
// // import the library
// import { createToast } from 'mosha-vue-toastify';
// // import the styling for the toast
// import 'mosha-vue-toastify/dist/style.css';
import  Toast  from '../Mixins/Toast.js';
import { createToast } from 'mosha-vue-toastify';


export default {
  props: ["user", "profile", "path_message"],
  mixins: [Toast],

//     setup () {
//     const toast = () => {
//         createToast('Wow, easy')
//     }
//     return { toast }
//  },
  data() {
    return {
      modalShow: false,
      layout: "form",
      image: null,
      imagepreview: '/storage'+this.user?.profile_photo_path,
      form: {
        id: this.user?.id,
        avatar: this.form?.avatar,
        fullname: this.user?.name,
        username: this.user?.username,
        email: this.user?.email,
        phone: this.user?.phone,
        gender_id: this.user?.gender, //== "Male" ? '0' : '1',
        role_id: this.user?.role_id,
      },
    };
  },
  components: {
    JetAuthenticationCard,
    JetInput,
    JetLabel,
    JetDropdown,
    JetDropdownLink,
    JetButton,
    UpdatePasswordForm,
    JetValidationErrors,
    Toast
  },
  methods: {
    updatePassword() {
      this.modalShow = true;
    },
    chooseFiles() {
      document.getElementById("fileUpload").click();
    },
    imageSelected(e) {
      this.image = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.image);
      reader.onload = (e) => {
        this.imagepreview = e.target.result;
      };
    },
    removeImage() {
      this.imagepreview = null;
      //this.imagePreview = "removed";
    },
    submit1() {
      this.$inertia.post("/users", this.form, {
        forceFormData: true,
        avatar: this.form.avatar,
        onSuccess: () =>{
             Toast.toast('Successfully Added');
             this.$inertia.get("/users", {});
        }
    },);
    },
    update1() {
                if(this.form.avatar){
                let formData = new FormData();
                formData.append('file', this.form.avatar);
                axios.post('/uploadimage', formData,
                {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                }).then((res) => {
                    this.form.avatar = res.data;
                    this.$inertia.put("/users/" + this.user.id, this.form, {
                      onSuccess: () => {
                          Toast.toast('Successfully Modified');
                          this.$inertia.get("/users", {});
                    },
                  });
                }).catch((error) => {
                    alert(error);
                });
                }
                else{
                  //console.log("else");
                   this.$inertia.put("/users/" + this.user.id, this.form, {
                     onSuccess: () => {
                          Toast.toast('Successfully Modified!');
                          this.$inertia.get("/users", {});
                     },
                   });
                   }
    },
    cancel() {
      this.$inertia.get("/profile", {});
    },
    cancel1() {
      this.$inertia.get("/users", {});
    },
  },
};
</script>