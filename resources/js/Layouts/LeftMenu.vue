<template>
    <div class="masterdiv 2xl:w-60 md:w-48 md:mt-5 md:ml-9 2xl:m-10 2xl:mt-5 sm:rounded-xl drop-shadow-xl">
        <div>
            <div class="2xl:w-24 2xl:h-24 md:w-20 md:h-20 mx-auto 2xl:mt-16 md:mt-4 rounded-full">
                <img
                    :src="'/storage'+authUser.profile_photo_path"
                    v-if="authUser?.profile_photo_path"
                    class="2xl:w-24 2xl:h-24 md:w-20 md:h-20 mx-auto 2xl:mt-16 md:mt-9 object-cover rounded-full"
                />
                <img
                    :src="authUser.profile_photo_url"
                    v-else
                    class="2xl:w-24 2xl:h-24 md:w-20 md:h-20 mx-auto 2xl:mt-16 md:mt-9  object-cover rounded-full"
                />
            </div>
            <h3 class="text-center mx-auto md:mb-4 md:text-sm 2xl:mb-12 mt-4">{{ authUser.name }}</h3>
            <ul v-if="authUser.role_id == 1">
                <li :class="{ active: current === 'dashboard' }" class="md:mt-7">
                    <button class="menu-item 2xl:ml-7 2xl:py-3.5 md:ml-6 md:py-2">
                        <svg class="h-5 w-5 md:h-4 md:w-4" viewBox="0 0 20 20">
                            <path
                                fill="currentColor"
                                d="M17.45,15.18L22,7.31V19L22,21H2V3H4V15.54L9.5,6L16,9.78L20.24,2.45L21.97,3.45L16.74,12.5L10.23,8.75L4.31,19H6.57L10.96,11.44L17.45,15.18Z"
                            />
                        </svg>

                        <a
                            :href="route('dashboard.index')"
                            :active="route().current('dashboard.active')"
                            class="md:text-sm"
                            >Dashboard</a
                        >
                    </button>
                </li>

                <li :class="{ active: current === 'users' }" class="md:mt-1">
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 md:h-4 md:w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                            />
                        </svg>

                        <a
                            :href="route('users.index')"
                            :active="route().current('users.active')"
                            class="md:text-sm"
                            >Users</a
                        >
                    </button>
                </li>

                <li :class="{ active: current === 'user-activities' }" class="md:mt-1">
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 md:h-4 md:w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z"
                                clip-rule="evenodd"
                            />
                        </svg>

                        <a
                            :href="route('user-activities.index')"
                            :active="route().current('user-activities.active')"
                            class="md:text-sm"
                            >User Activities</a
                        >
                    </button>
                </li>

                <li :class="{ active: current === 'activities' }" class="md:mt-1">
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 md:h-4 md:w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd"
                            />
                        </svg>

                        <a
                            :href="route('activities.index')"
                            :active="route().current('activities.active')"
                            class="md:text-sm"
                            >Activities</a
                        >
                    </button>
                </li>

                <li :class="{ active: current === 'categories' }" class="md:mt-1">
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 md:h-4 md:w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"
                            />
                        </svg>

                        <a
                            :href="route('categories.index')"
                            :active="route().current('categories.active')"
                            class="md:text-sm"
                            >Categories</a
                        >
                    </button>
                </li>
                <li :class="{ active: current === 'profile' }" class="md:mt-1">
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 md:h-4 md:w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <a
                            :href="route('profile.index')"
                            :active="route().current('profile.active')"
                            class="md:text-sm"
                            >My Profile</a
                        >
                    </button>
                </li>

                <li>
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5" id="sign-out">
                        <form @submit.prevent="logout">
                            <jet-dropdown-link as="button">
                                <svg
                                    viewBox="0 0 24 24"
                                    class=" h-5 w-5 md:h-4 md:w-4"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z"
                                    />
                                </svg>
                            </jet-dropdown-link>
                        </form>
                        <!-- <jet-dropdown-link
                            :href="route('api-tokens.index')"
                            v-if="$page.props.jetstream.hasApiFeatures"
                        >
                            API Tokens
                        </jet-dropdown-link> -->

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form @submit.prevent="logout">
                            <jet-dropdown-link as="button"
                            class="md:text-sm">
                                Sign Out
                            </jet-dropdown-link>
                        </form>
                    </button>
                </li>
            </ul>
            <ul v-if="authUser.role_id == 2">
                <li :class="{ active: current === 'daily-challenges' }" class="md:mt-7">
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5">
                        <svg class="h-5 w-5 md:h-4 md:w-4" viewBox="0 0 20 20">
                            <path
                                fill="currentColor"
                                d="M19,19H5V8H19M19,3H18V1H16V3H8V1H6V3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M16.53,11.06L15.47,10L10.59,14.88L8.47,12.76L7.41,13.82L10.59,17L16.53,11.06Z"
                            />
                        </svg>

                        <a
                            :href="route('daily-challenges.index')"
                            :active="route().current('daily-challenges.active')"
                            class="md:text-sm"
                            >Daily Challenges</a
                        >
                    </button>
                </li>

                <li :class="{ active: current === 'add-challenge' }" class="md:mt-1">
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5">
                        <svg class="h-5 w-5 md:h-4 md:w-4" viewBox="0 0 20 20">
                            <path
                                fill="currentColor"
                                d="M19 19V8H5V19H19M16 1H18V3H19C20.11 3 21 3.9 21 5V19C21 20.11 20.11 21 19 21H5C3.89 21 3 20.1 3 19V5C3 3.89 3.89 3 5 3H6V1H8V3H16V1M11 9.5H13V12.5H16V14.5H13V17.5H11V14.5H8V12.5H11V9.5Z"
                            />
                        </svg>

                        <a
                            :href="route('daily-challenges.create')"
                            :active="route().current('daily-challenges.active')"
                            class="md:text-sm"
                            >Add Challenge</a
                        >
                    </button>
                </li>

                <li :class="{ active: current === 'profile' }" class="md:mt-1">
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 md:h-4 md:w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <a
                            :href="route('profile.index')"
                            :active="route().current('profile.active')"
                            class="md:text-sm"
                            >My Profile</a
                        >
                    </button>
                </li>

                <li class="sign-out">
                    <button class="menu-item 2xl:ml-7 md:ml-6 md:py-2 2xl:py-3.5" id="sign-out">
                        <form @submit.prevent="logout">
                            <jet-dropdown-link as="button">
                                <svg
                                    viewBox="0 0 24 24"
                                    class=" h-5 w-5 md:h-4 md:w-4"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z"
                                    />
                                </svg>
                            </jet-dropdown-link>
                        </form>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form @submit.prevent="logout">
                            <jet-dropdown-link as="button"
                            class="md:text-sm">
                                Sign Out
                            </jet-dropdown-link>
                        </form>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
.masterdiv {
    position: fixed;
    height: 87%;

    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
        Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
    font-weight: 400;

    color: white;
    background: #345370;
    border: 0.5px solid #2f4e6b;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.picturebox {
    width: 100px;
    height: 100px;
}

.menu-item {
    display: flex;
    flex-direction: row;
    /* margin-left: 28px; */
    /* padding: 14px 0px; */
}
.active,
li:hover {
    background: #406687;
    -webkit-box-shadow: 0 8px 6px -6px #0a263f;
    -moz-box-shadow: 0 8px 6px -6px #0a263f;
    box-shadow: 0 8px 6px -6px #0a263f;
}
.menu-item svg {
    margin-right: 15px;
}

#sign-out {
    position: absolute;
    bottom: 0px;
}
</style>
<script>
import JetDropdownLink from "@/Jetstream/DropdownLink";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

export default {
    setup() {
        const authUser = computed(() => usePage().props.value.authUser);
        return { authUser };
    },
    components: {
        JetDropdownLink,
    },
    data() {
        return {};
    },
    props: ["current"],
    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },
    },
};
</script>
