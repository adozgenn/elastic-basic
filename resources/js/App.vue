<template>
  <div id="app">
    <component :is="layout">
      <router-view/>
    </component>
  </div>
</template>

<script>
const default_layout = "main";


export default {
    computed:{
      layout(){
        return default_layout + '-layout';
      }
    }
}
</script>
<style></style>
