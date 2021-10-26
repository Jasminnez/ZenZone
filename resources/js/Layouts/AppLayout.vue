<template>
    <div>
        <div class="min-h-screen master">
            <search-box :domain="domain"/>
            <left-menu :current="current"/>
            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>
<style scoped>
.master {
    background: linear-gradient(to right, rgba(72, 116, 155), rgba(40, 63, 82));
}
</style>
<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetBanner from "@/Jetstream/Banner";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetNavLink from "@/Jetstream/NavLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import LeftMenu from "@/Layouts/LeftMenu";
import SearchBox from "@/Layouts/SearchBox";

export default {
    components: {
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        LeftMenu,
        SearchBox,
    },
    data() {
        return {
            showingNavigationDropdown: false,
             term: ''
        };
    },
    props: ["domain", "current"],
    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        },

        logout() {
            this.$inertia.post(route("logout"));
        },
    },
};
</script>
