<template>
    <dialog-modal :show="modalShow" @close="close" :add="add">
        <template v-slot:content>
            <jet-validation-errors class="block mb-4 my-auto" />
            <form
                @submit.prevent="submit"
                enctype="multipart/form-data"
                class="mx-auto w-full h-full my-auto flex rounded-md bg"
            >
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
          </div>
          <div class="w-full mr-8">
                    <div class="category-name ml-7 mr-2 w-full">
                        <jet-label
                            for="name"
                            value="Category Name:"
                            class="text-white mt-4 ml-1 mb-2"
                        />
                        <jet-input
                            id="name"
                            type="name"
                            v-model="form.name"
                            placeholder=""
                            required autofocus
                            class="mt-1 ml-1 h-10 w-full input"
                        />
                    </div>
                </div>
            </form>
        </template>
        <template v-slot:footer>
            <jet-button
                v-if="category === null"
                class="btn add-btn"
                @click="addNewCategory()"
                >Add New</jet-button
            >
            <jet-button
                v-if="category !== null"
                class="btn edit-btn"
                @click="editCategory(category.id)"
                >Save Changes</jet-button
            >
            <jet-button class="btn cancel-btn ml-3" @click="close"
                >Cancel</jet-button
            >
        </template>
    </dialog-modal>
</template>
<style scoped>
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
    top: 47%;
    left: 10%;
}
.remove {
    color: rgb(61, 96, 128);
}
</style>
<script>
import DialogModal from "@/Jetstream/DialogModal.vue";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import { useForm } from "@inertiajs/inertia-vue3";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import  Toast  from '@/Mixins/Toast.js';
import { createToast } from 'mosha-vue-toastify';

export default {
   mixins: [Toast],
    setup() {
        const form = useForm({
            id: 0,
            name: null,
            icon: null,
            avatar: null,
            imagePreview: null,
        });

        return { form };
    },
    data() {
        return {
            modalShow: true,
        };
    },
    methods: {
        close() {
            this.$inertia.get("/categories", {});
        },
        addNewCategory() {
            this.$inertia.post("/categories", this.form, {
                onSuccess: () =>{
                  Toast.toast('Successfully Added');
                  this.$inertia.get("/categories", {})
                },
            });
        },
        editCategory(id) {
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
                    this.$inertia.put("/categories/" + id, this.form, {
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
                   this.$inertia.put("/categories/" + id, this.form, {
                     onSuccess: () => {
                       Toast.toast('Successfully Modified');
                     },
                   });
                   }
            //this.$inertia.put("/categories/" + id, this.form);
        },
        openModal() {
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
                this.form.imagePreview = e.target.result;
            };
        },
       removeImage() {
      this.form.imagePreview = null;
      this.form.imagePreview = "removed";
    },
    },
    mounted() {
        if (this.category != null) {
            this.form.name = this.category.name;
            this.form.imagePreview = this.category.icon;
        }
    },
    props: ["category", "modalShow"],
    components: {
        DialogModal,
        JetLabel,
        JetButton,
        JetInput,
        JetValidationErrors,
        Toast
    },
};
</script>
