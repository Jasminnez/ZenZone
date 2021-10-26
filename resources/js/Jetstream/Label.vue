<template>
    <label class="block font-medium text-sm text-gray-700">
        <span v-if="value" class="mx-auto">{{ value }}</span>
        <span v-else class="mx-auto"><slot></slot></span>
    </label>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
