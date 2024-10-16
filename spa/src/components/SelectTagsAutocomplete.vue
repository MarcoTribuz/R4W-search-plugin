<template>
  <v-autocomplete
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
    @click:clear.prevent="clearSelection"
  >
    <template #selection="{ item }">
      <v-chip color="#f36d62" class="white--text">{{ item.name }}</v-chip>
    </template>
    <template #item="{ item }">
      <v-list-item
                   ripple
                   @mousedown.prevent
                   @click.prevent="toggle(item)">
        <v-list-item-action>
          <v-checkbox
            color="#f36d62"
            :input-value="item.selected"></v-checkbox>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>
            <v-row no-gutters align="center">
              <span>{{ item.name }}</span>
              <v-spacer></v-spacer>
              <v-tooltip
                top
              >
                <template v-slot:activator="{ on }">
                  <v-icon v-on="on" color="#f36d62">
                    {{
                      mdiInformationOutline()
                    }}
                  </v-icon>
                </template>
                {{ item.description }}
              </v-tooltip>
            </v-row>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </template>
  </v-autocomplete>
</template>
<script>
import SvgIcon from '@jamescoyle/vue-icon';
import {mdiInformationOutline} from "@mdi/js";


export default {
  name: "SelectTags",
  components: {
    SvgIcon
  },
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
      selectedTags: [],
      path: mdiInformationOutline
    }
  },
  watch: {
    selectedTags: function (newValue) {
      this.$emit('selected-tags', {"selectedTags": newValue, "tagType": this.tagType})
    }
  },
  methods: {
    mdiInformationOutline() {
      return mdiInformationOutline
    },
    toggle(selectedTag) {
      const selectedTags = this.selectedTags
      this.$nextTick(() => {
        const foundTermId = selectedTags.find((t) => t === selectedTag.term_id)
        if (!foundTermId) {
          selectedTags.push(selectedTag.term_id)
          selectedTag.selected = true
        } else {
          const index = selectedTags.findIndex((t) => t === selectedTag.term_id)
          selectedTags.splice(index, 1)
          selectedTag.selected = false
        }
      })
    },
    clearSelection(){
      for (let tag of this.list){
        tag.selected = false
      }
    }
  }
}
</script>


<style scoped>

</style>
