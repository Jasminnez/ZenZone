<template>
    <div class="masterdiv flex justify-between 2xl:h-14 md:h-12 drop-shadow-xl">
        <div class="logo w-1/6 flex">
        <div class="mx-auto flex">
        <!-- <img
        :src="'logo/logo.png'" class="h-10 pt-1 my-auto"
        /> -->
        <h1 class="text-2xl font-bold flex my-auto">Zen<h1 class="text-2xl font-normal">Zone</h1></h1>
        </div>
        </div>
        <div class="w-5/6 flex items-center">
            <div class="search-box flex flex-row w-full">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 ml-2 mx-auto my-auto"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"
                    />
                </svg>
                <input
                    id="search"
                    type="text"
                    v-model="term"
                    class="
                        w-full
                        h-full
                        bg-transparent
                        border-transparent border-0
                        ml-3
                    "
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
.masterdiv {
    color: white;
    background-color: #345370;
    border: 0.5px solid #2f4e6b;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    /* height: 60px; */
}

.search-box {
    height: 100%;
    /* margin-left: 300px; */
    border-left: 0.1px solid #64669c;
}

.search-box svg {
    /* margin: 20px 0 0 15px; */
    opacity: 70%;
}
</style>

<script>
export default {
    components: {},

    data() {
        return {
            term: this.term ? term : "",
        };
    },

    props: ["domain"],

    methods: {
        search() {
            if (this.domain != null) {
                this.$inertia.get(
                    this.domain,
                    {
                        term: this.term,
                    },
                    { preserveState: true, replace: true }
                );
            }
        },
    },
    watch: {
        term: function () {
            this.search();
        },
    },
};
</script>
