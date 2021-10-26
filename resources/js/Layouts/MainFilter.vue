<template>
    <div class="btn flex flex-row absolute">
        <svg
            style="width: 24px; height: 24px"
            class="my-auto"
            viewBox="0 0 24 24"
        >
            <path
                fill="currentColor"
                d="M6,13H18V11H6M3,6V8H21V6M10,18H14V16H10V18Z"
            />
        </svg>
        <select class="bg-transparent" v-model="sort" v-on:change="sortData()">
            <option value="desc">Newest</option>
            <option value="asc">Oldest</option>
            <option value="top">Most Popular</option>
        </select>
    </div>
</template>
<style scoped>
.btn {
    top: 5px;
    right: 2%;
}
select {
    border: none;
}
select option { 
    background-color:#345370 !important;
}
</style>
<script>
export default {
    components: {},

    data() {
        return {
            sort: 'desc',
        };
    },
    props: ["domain"],
    methods: {
        sortData() {
            if (this.domain != null) {
                this.$inertia.get(
                    this.domain,
                    {
                        sort: this.sort,
                    },
                    { preserveState: true, replace: true }
                );
            }
        },
    },
};
</script>
