<template>
    <app-layout :current="'dashboard'">
        <center-layout>
            <h1 class="2xl:text-lg md:text-base mb-1 mt-4 text-gray-300">Welcome back, <b class="text-white">{{ authUser.name }}</b></h1>
            <h2 class="2xl:text-sm md:text-xs text-gray-300">Hello, {{ authUser.name }}! Check out what’s new!</h2>
            <content-layout class="flex 2xl:mt-3 md:mt-0 max-w-full flex-wrap">
                <div class="flex 2xl:mt-5 md:mt-1 h-1/4 w-1/4 rounded-md sm:pt-0 bg">
                <div>
                      <h1 class="m-3">Users</h1>
                      
                    <div>
                        <h1 class="ml-3 mr-0 2xl:text-6xl md:text-4xl">{{users}}</h1>
                    </div>
                </div>
                <div class="flex 2xl:mt-3 md:mt-10">
                    <UserChart/>
                </div>
                </div>
                <div class="flex 2xl:mt-5 md:mt-1 ml-16 h-1/4 w-1/4 rounded-md sm:pt-0 bg">
                <div>
                      <h1 class="m-3">Activities</h1>
                      
                    <div>
                        <h1 class="ml-3 2xl:text-6xl md:text-4xl">{{activities}}</h1>
                    </div>
                </div>
                <div class="flex 2xl:mt-3 md:mt-10">
                    <ActivityChart/>
                </div>
                </div>

                <div class="flex 2xl:mt-5 md:mt-1 ml-16 h-1/4 w-1/4 rounded-md sm:pt-0 bg">
                <div>
                      <h1 class="m-3 md:mb-0">Daily Challenges</h1>
                      
                    <div>
                        <h1 class="ml-3 2xl:text-6xl md:text-4xl">{{dailyChallenges}}</h1>
                    </div>
                </div>
                <div class="flex 2xl:mt-3 md:mt-10">
                    <ChallengesChart/>
                </div>
                </div>

                <div class="flex 2xl:mt-5 md:mt-4 h-1/4 w-1/4 rounded-md sm:pt-0 bg">
                <div>
                      <h1 class="m-2 mr-0">Females</h1>
                    <div>
                        <h1 class="ml-3 2xl:text-6xl md:text-4xl">{{females}}</h1>
                    </div>
                </div>
                <div class="flex mt-2">
                    <gender-female-chart/> 
                </div>
                </div>

                <div class="flex 2xl:mt-5 md:mt-4 ml-16 h-1/4 w-1/4 rounded-md sm:pt-0 bg">
                <div>
                      <h1 class="m-3">Males</h1>
                    <div>
                        <h1 class="ml-3 2xl:text-6xl md:text-4xl">{{males}}</h1>
                    </div>
                </div>
                <div class="flex mt-2">
                    <GenderChart/>
                </div>
                </div>

                <div class="flex card 2xl:mt-4 md:mt-2 mr-5 rounded-md sm:pt-0 bg"> 
                <div class="w-5">
                    <h1 class="m-3">Reactions</h1>
                </div>
                <div class="mt-3 w-screen">
                <ReactionChart/>
                </div>
                </div>
            </content-layout>
        </center-layout>
    </app-layout>
</template>
<style scoped>
.bg {
  background-color: #2e475e;
  /* box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
}
.card{
    height: 60%;
    width: 90%;
}
</style>
<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CenterLayout from "../Layouts/CenterLayout.vue";
    import ContentLayout from "../Layouts/ContentLayout.vue";
    import Welcome from '@/Jetstream/Welcome';
    import { computed } from "vue";
    import { usePage } from "@inertiajs/inertia-vue3";
    import genderChartData from '../gender-data.js';
    import activityChartData from '../activity-data.js';
    import userChartData from '../user-data.js';
    import reactionChartData from '../reaction-data.js';
    import PlanetChart from '../Layouts/PlanetChart.vue';
    import GenderChart from '../Layouts/GenderChart.vue';
    import GenderFemaleChart from '../Layouts/GenderFemaleChart.vue';
    import ActivityChart from '../Layouts/ActivityChart.vue';
    import UserChart from '../Layouts/UserChart.vue';
    import ReactionChart from '../Layouts/ReactionChart.vue';
    import ChallengesChart from '../Layouts/ChallengesChart.vue';

    export default {
     setup() {
        const authUser = computed(() => usePage().props.value.authUser);
        return { authUser };
    },
    data() {
    return {
      genderChartData: genderChartData,
      activityChartData: activityChartData,
      userChartData: userChartData,
      reactionChartData: reactionChartData,
    }
    },
    mounted() {
    const females = document.getElementById('female-chart');
    const femaleArray = [this.females, this.males];
    this.genderChartData.data.datasets[0].data = femaleArray;
    this.genderChartData.data.labels = ["Female", "Male"];
    this.genderChartData.data.datasets[0].backgroundColor = ['rgba(181, 109,42)', 'rgba(27, 130, 223, 1)'];
    new Chart(females, this.genderChartData);

    const males = document.getElementById('gender-chart');
    const array = [this.males, this.females];
    this.genderChartData.data.labels = ["Male", "Female"];
    this.genderChartData.data.datasets[0].backgroundColor = ['rgba(27, 130, 223, 1)', 'rgba(181, 109,42)'];
    this.genderChartData.data.datasets[0].data = array;
    new Chart(males, this.genderChartData);

    const activities = document.getElementById('activity-chart');  
    this.activityChartData.data.labels = this.date;
    this.activityChartData.data.datasets[0].data = this.count;
    new Chart(activities, this.activityChartData);

    const userChart = document.getElementById('user-chart');  
    this.userChartData.data.labels = this.userDate;
    this.userChartData.data.datasets[0].data = this.userCount;
    new Chart(userChart, this.userChartData);

    const challengeChart = document.getElementById('challenge-chart');  
    this.userChartData.data.labels = this.challengeDate;
    this.userChartData.data.datasets[0].data = this.challengeCount;
    new Chart(challengeChart, this.userChartData);
    
    const reactionChart = document.getElementById('reaction-chart');  
    this.reactionChartData.data.labels = this.UserActivitesDate;
    this.reactionChartData.data.datasets[0].data = this.maleCount;
    this.reactionChartData.data.datasets[1].data = this.femaleCount;
    new Chart(reactionChart, this.reactionChartData);

    },
    props: ["users", "activities", "dailyChallenges", "males", "females", "date", "count", 
    "userDate", "userCount", "UserActivitesDate", "maleCount", "femaleCount", "challengeCount", "challengeDate"],
        components: {
            AppLayout,
            Welcome,
            CenterLayout,
            ContentLayout,
            PlanetChart,
            GenderChart,
            GenderFemaleChart,
            ActivityChart,
            UserChart,
            ReactionChart,
            ChallengesChart,
        },
    }
</script>
