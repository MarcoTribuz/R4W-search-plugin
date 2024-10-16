<template>
  <v-card
    max-width="374"
    @click="goTo"
    elevation="0"
    class="mx-auto"
  >
    <div>
      <v-img v-if="imgSrc !== '' && imgSrc"
             height="180"
             width="180"
             :src="imgSrc"
             class="ma-auto"
      >

        <div v-if="postDate > (Math.floor(Date.now() / 1000) - timeTs.oneYear) ">
          <img alt="new" decoding="async" style="position: absolute; width: 30%;"
               src="https://recipesforwellbeing.org/wp-content/uploads/2022/03/New-Badge.png">
        </div>
      </v-img>
    </div>
    <v-card-title style="word-break: break-word" class="justify-center text-center py-0"><h4>{{ title }}</h4></v-card-title>
    <v-card-text style="word-break: break-word" class="justify-center text-center py-0"><p>{{ excerpt }}</p></v-card-text>
  </v-card>
</template>

<script>
import {timeTs} from "../libs/consts";
export default {
  name: "RecipeCard",
  computed: {
    timeTs() {
      return timeTs
    },
  },
  props: {
    test: {
      type: Object,
    },
    imgSrc: {
      type: [String, Boolean],
      required: false
    },
    id: {
      type: Number,
      default: '',
      required: true
    },
    title: {
      type: String,
      default: '',
      required: true
    },
    excerpt: {
      type: String,
      default: '',
      required: false
    },
    postDate: {
      type: Number,
      default: 0,
      required: true
    }
  },
  methods: {
    goTo(e) {
      e.preventDefault();
      // PROD
      window.open('https://recipesforwellbeing.org/?p=' + this.id.toString())
      // STAGING
      // window.open('https://stating.recipesforwellbeing.org/?p=' + this.id.toString())
      // DEV
      //window.open('http://127.0.0.1:8085/?p=' + this.id.toString())
    }
  }
}
</script>


<style scoped>

</style>
