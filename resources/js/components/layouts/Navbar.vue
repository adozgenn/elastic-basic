<template>
  <v-app-bar app color="primary" absolute clipped-left dark>
    <v-toolbar-title text>
      <v-app-bar-nav-icon
      ></v-app-bar-nav-icon>
      <router-link to="/">
        <v-btn text> Elastic <v-icon>mdi-head-heart-outline</v-icon> </v-btn>
      </router-link>
    </v-toolbar-title>
    <v-spacer></v-spacer>
  </v-app-bar>
</template>

<script>
export default {
  components: {
    // "app-drawer" : Drawer
  },
  data() {
    return {
      drawer: false,
    };
  },
  methods: {
    
  },
}
</script>
