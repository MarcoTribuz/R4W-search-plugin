<template>
    <v-app>
      <v-main>
        <SearchPage/>
      </v-main>
    </v-app>
</template>

<script>
import SearchPage from "./pages/SearchPage.vue";

export default {
  name: 'app',
  components: {SearchPage},

}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap');

#app {
  max-width: 100% !important;
  font-family: "Quicksand", sans-serif;
  font-optical-sizing: auto;
  font-weight: 400;
  font-style: normal;
}

input[type="text"]{
    border: none !important;
    border-color: transparent;
    margin-bottom:0;
}

/* vuetify lg min breakpoint: 1280 - 16     = 1264px */
/* vuetify lg max breakpoint: 1920 - 16 - 1 = 1903px */

@media (min-width: 1264px) and (max-width: 1903px) {
  .flex.lg5-custom {
    width: 20%;
    max-width: 20%;
    flex-basis: 20%;
  }
}

@media (min-width: 1903px) and (max-width: 4096px) {
  .flex.lg5-custom {
    width: 20%;
    max-width: 20%;
    flex-basis: 20%;
  }
}
</style>
