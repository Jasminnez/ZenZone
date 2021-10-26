<template>
  <div>
    <canvas class="chart" id="planet-chart"></canvas>
  </div>
</template>
<style scoped>
.chart{
  width: 100%;
}
</style>
<script>
import Chart from 'chart.js'

export default {
  name: 'PlanetChart'
}
</script>