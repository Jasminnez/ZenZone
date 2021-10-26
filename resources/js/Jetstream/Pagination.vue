<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-2 py-1 text-sm leading-4 text-gray-400"
                    v-html="link.label" />
                <inertia-link v-else
                    class="mr-1 mb-1 px-2 py-1 text-sm leading-4 hover:text-gray-400 focus:text-indigo-500"
                    :class="{ 'text-gray-400': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            links: Array
        },
    }

</script>