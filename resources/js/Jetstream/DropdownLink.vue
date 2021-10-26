<template>
    <div>
        <button type="submit" class=" text-white text-left" v-if="as == 'button'">
            <slot></slot>
        </button>
        
        <a :href="href" class="text-white" v-else-if="as =='a'">
            <slot></slot>
        </a>

        <inertia-link :href="href" class="text-white " v-else>
            <slot></slot>
        </inertia-link>
    </div>
</template>

<script>
    export default {
        props: ['href', 'as']
    }
</script>
