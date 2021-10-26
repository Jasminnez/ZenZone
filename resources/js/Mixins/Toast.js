import { createToast, withProps } from 'mosha-vue-toastify';
//import CustomizedContent from "./CustomizedContent.vue";
import 'mosha-vue-toastify/dist/style.css';
import { defineComponent } from 'vue';

  export default{ 
        toast (message) {
                createToast(message,
                {
                  position: 'top-center',
                  type: 'success',
                  transition: 'zoom',
                  showIcon: 'true',
                  toastBackgroundColor: '#345370',
                });
            return { createToast }
         },
    }
   