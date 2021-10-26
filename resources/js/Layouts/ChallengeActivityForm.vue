<template>
    <div class="flex w-full h-full mx-auto my-auto rounded-md">
        <jet-validation-errors class="mb-4" />
        <form
          @submit.prevent="submit"
          enctype="multipart/form-data"
          class="mx-auto w-full my-auto pb-2 rounded-md bg"
        >
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
              rounded-full
              hover:bg-white hover:bg-opacity-25
              focus:outline-none
              text-white
              transition
              duration-200
            "
          >
            <img
              :src="form.imagePreview"
              v-if="form.imagePreview"
              class="rounded-full h-32 w-36"
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
              <button @click="chooseFiles" class="removeImage hover:bg-black hover:bg-opacity-25 rounded-full">
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
                <button
            class="removeImage hover:bg-black hover:bg-opacity-25 rounded-full"
            @click="[removeImage(true), (form.removed = true)]"
          >
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
          <hr class="mx-5" />
          <div class="ml-3 mt-3">
            <div class="flex mt-2">
              <jet-input id="id" type="hidden" v-model="form.id" />
              <jet-label
                for="name"
                value="Activity Name:"
                class="text-white my-auto w-1/4"
              />
              <jet-input
                id="name"
                type="name"
                v-model="form.name"
                required
                autofocus
                placeholder=""
                class="ml-3 mr-10 mt-1 w-3/4 h-10 input"
              />
            </div>
            <div class="flex mt-2">
              <jet-label
                for="description"
                value="Activity Description:"
                class="text-white my-auto w-1/4"
              />
              <textarea
                id="description"
                type="description"
                v-model="form.description"
                placeholder=""
                class="ml-3 mr-10 mt-1 w-3/4 h-16 input"
              />
            </div>

            <div class="flex mt-2">
              <jet-label
                for="category"
                value="Category:"
                class="text-white my-auto w-1/4"
              />

              <select
                name="category_id"
                required
                v-model="form.category_id"
                class="mt-1 w-1/3 h-10 input"
              >
                <option
                  class="uppercase text-gray-500 cursor-pointer"
                  v-for="category in categories"
                  :key="category.id"
                  :value="category.id"
                >
                  {{ category?.name }}
                </option>
              </select>
            </div>
            <div v-if="challenge" class="flex mt-2">
              <jet-label
                for="date"
                value="Date:"
                class="text-white my-auto w-1/4"
              />
              <jet-input
                id="date"
                type="date"
                v-model="form.date"
                required
                autofocus
                placeholder=""
                class="mt-1 w-1/3 h-10 input"
              />
            </div>
          </div>
           <div v-if="challenge" class="ml-auto mr-5 mt-2 table">
              <jet-button
                v-if="activity === null"
                class="btn add-btn"
                @click="addNewChallenge()"
                >Add New</jet-button
              >
              <jet-button
                v-if="activity !== null"
                class="btn edit-btn"
                @click="editChallenge(activity.id)"
                >Save Changes</jet-button
              >
              <jet-button class="btn cancel-btn ml-3" @click="closeChallenge"
                >Cancel</jet-button
              >
            </div>
            <div v-if="!challenge" class="ml-auto mr-5 mt-2 table">
              <jet-button
                v-if="activity === null"
                class="btn add-btn"
                @click="addNewActivity()"
                >Add New</jet-button
              >
              <jet-button
                v-if="activity !== null"
                class="btn edit-btn"
                @click="editActivity(activity.id)"
                >Save Changes</jet-button
              >
              <jet-button class="btn cancel-btn ml-3" @click="closeActivity"
                >Cancel</jet-button
              >
            </div>
        </form>
        </div>
</template>
<style scoped>
.bg {
  background: #2e475e;
}
.btn {
  color: white;
}
.add-btn {
  background: #b56d2a;
}
.edit-btn {
  background: #5e7ed9;
}
.cancel-btn {
  background: #878686;
}
.input {
  background: rgb(69, 111, 147, 0.3);
  color: white;
  border: none;
  border-radius: 5%;
}
.removeImage {
  top: 150px;
  left: 20%;
}
.remove {
  color: rgb(61, 96, 128);
}
</style>
<script>
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import { useForm } from "@inertiajs/inertia-vue3";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import  Toast  from '../Mixins/Toast.js';
import { createToast } from 'mosha-vue-toastify';

export default {
  setup() {
    const form = useForm({
      id: 0,
      name: null,
      avatar: null,
      description: null,
      category_id: null,
      imagePreview: null,
      removed: null,
      date:null,
    });

    return { form };
  },
  data() {
    return {
    };
  },
  methods: {
    closeChallenge() {
      this.$inertia.get("/daily-challenges", {});
    },
    addNewChallenge() {
      this.$inertia.post("/daily-challenges", this.form, {
        forceFormData: true,
        avatar: this.form.avatar,
        onSuccess: () =>{
             Toast.toast('Successfully Added');
             this.$inertia.get("/daily-challenges", {});
             }
      });
    },
    editChallenge(id) {
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
                    this.$inertia.put("/daily-challenges/" + id, this.form, {
                      onSuccess: () => {
                      Toast.toast('Successfully Modified');
                    },
                  });
                }).catch((error) => {
                    alert(error);
                });
                }
                else{
                  console.log("else");
                   this.$inertia.put("/daily-challenges/" + id, this.form, {
                     onSuccess: () => {
                       Toast.toast('Successfully Modified');
                     },
                   });
                   }
    },
    closeActivity() {
      this.$inertia.get("/activities", {});
    },
    addNewActivity() {
      this.$inertia.post("/activities", this.form, {
        forceFormData: true,
        avatar: this.form.avatar,
          onSuccess: () =>{
             Toast.toast('Successfully Added');
             this.$inertia.get("/activities", {});
             }
      });
    },
    editActivity(id) {
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
                    this.$inertia.put("/activities/" + id, this.form, {
                      onSuccess: () => {
                        Toast.toast('Successfully Modified');
                    },
                  });
                }).catch((error) => {
                    alert(error);
                });
                }
                else{
                   this.$inertia.put("/activities/" + id, this.form, {
                     onSuccess: () => {
                       Toast.toast('Successfully Modified');
                     },
                   });
       }
    },
    chooseFiles() {
      document.getElementById("fileUpload").click();
    },
    imageSelected(e) {
      this.image = e.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.image);
      reader.onload = (e) => {
        this.form.imagePreview = e.target.result;
      };
    },
    removeImage() {
      this.form.imagePreview = null;
      this.form.imagePreview = "removed";
    },
  },
  mounted() {
    //console.log(activity);
    if (this.activity !== null) {
      this.form.id = this.activity.id;
      this.form.name = this.activity.name;
      this.form.description = this.activity.description;
      this.form.category_id = this.activity.category_id;
      this.form.imagePreview = this.activity.photo;
      this.form.date = this.activity.date;
    }
  },
  props: ["activity", "categories", "challenge"],
  mixins: [Toast],
  components: {
    JetLabel,
    JetButton,
    JetInput,
    JetInputError,
    JetValidationErrors,
  },
};
</script>