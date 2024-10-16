<template>
  <v-text-field
    v-model="inputValue"
    label="Search something..."
    :loading="isLoading"
    v-on:input="debounceInput"
    color="#f36d62"
  >
    <template v-slot:append-outer v-if="!isDisclaimerShowing">
      <v-tooltip
        top
      >
        <template v-slot:activator="{ on }">
          <v-icon @click="showDisclaimer" v-on="on" color="#f36d62">
            {{
              mdiHelpCircleOutline()
            }}
          </v-icon>
        </template>
        Get Help!
      </v-tooltip>
    </template>
  </v-text-field>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon';
import { mdiHelpCircleOutline } from '@mdi/js';

export default {
  name: "SearchTextBar",
  emits: ['searched-value', 'show-disclaimer'],
  components: {
    SvgIcon
  },
  props: {
    isLoading: {
      type: Boolean,
      default: false,
      required: false
    },
    isDisclaimerShowing: {
      type: Boolean,
      default: false,
      required: true
    }
  },
  data: () => {
    return {
      inputValue: '',
      path: mdiHelpCircleOutline,
    }
  },
  methods: {
    mdiHelpCircleOutline() {
      return mdiHelpCircleOutline
    },

    debounceInput: _.debounce(function () {
      //e.preventDefault()
      this.$emit('searched-value', this.inputValue)
    }, 500),

    showDisclaimer(e) {
      e.stopPropagation();
      this.$emit('show-disclaimer', true)
    }
  }
}
</script>



<style scoped>

</style>
