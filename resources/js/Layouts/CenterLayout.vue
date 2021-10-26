<template>
        <div class="master fixed left-72 2xl:m-10 2xl:mt-2 md:m-3 overflow-y-scroll md:mt-0 md:mb-0 sm:rounded-xl drop-shadow-xl">
          <slot></slot>
        </div>
</template>
<style scoped>

.master {
    position: fixed;
    width: 75%;
    height: 90%;

    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
        Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    font-weight: 400;

    color: white;
}
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #fffdfe00;; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>

<script>

export default {
    components: {
    },
};
</script>
