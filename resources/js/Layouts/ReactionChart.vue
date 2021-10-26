<template>
  <div class="chart">
    <canvas id="reaction-chart"></canvas>
  </div>
</template>
<style scoped>
.chart{
  width: 100%;
  height: 100%;
}
</style>
<script>
import Chart from 'chart.js'

export default {
  name: 'ReactionChart'
}
</script>