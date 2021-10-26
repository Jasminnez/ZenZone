<template>
        <div class="master left-5 sm:rounded-xl drop-shadow-xl">
          <slot></slot>
        </div>
</template>
<style scoped>

.master {
    position: fixed;
    width: 95%;
    height: 75%;
    /* left: 35px; */
    /* margin: 25px 0px; */

    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
        Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    font-weight: 400;


}

</style>

<script>

export default {
    components: {
    },
};
</script>
