<template>
  <v-select
    v-model="selectedTags"
    :items="list"
    item-text="name"
    item-value="term_id"
    color="#f36d62"
    item-color="#f36d62"
    :label="placeholder"
    clearable
    flat
    small-chips
    outlined
    rounded
    multiple
    chips
    :menu-props="{ top: false, offsetY: true }"
  >
    <template #selection="{ item }">
      <v-chip color="#f36d62" class="white--text">{{ item.name }}</v-chip>
    </template>
  </v-select>
</template>
<script>
export default {
  name: "SelectTags",
  props: {
    list: {
      type: Array,
      required: true,
      default: []
    },
    placeholder: {
      type: String,
      required: true,
      default: 'Title'
    },
    tagType: {
      type: String,
      required: true,
      default: 'tag'
    }
  },
  data: () => {
    return {
      selectedTags: []
    }
  },
  watch: {
    selectedTags: function (newValue) {
      this.$emit('selected-tags', {"selectedTags": newValue, "tagType": this.tagType })
    }
  }
}
</script>


<style scoped>

</style>
