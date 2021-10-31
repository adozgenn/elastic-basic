<template>
  <v-app>
    <navbar />
    <drawer></drawer>
    <v-main>
      <v-container>
        <slot/>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import Navbar from "../components/layouts/Navbar.vue";
import Drawer from "../components/layouts/Drawer.vue";
export default {
    components:{
        Navbar,
       Drawer,
    }
}
</script>
<style></style>
