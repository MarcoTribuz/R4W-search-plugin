<template>
  <v-container fluid>
    <v-row>
      <v-col class="text-center">
        <h2>Wholebeing Library</h2>
      </v-col>
    </v-row>
    <v-row>
      <v-col class="text-center">
        <h5>Explore our collection of recipes to craft personalised individual and collective wholebeing learning
          journeys.</h5>
      </v-col>
    </v-row>
    <v-row justify="center" v-if="disclaimer">
      <v-col class="text-center vc_color-turquoise" style="border: 2px solid #8cbeb2; border-radius: 5px">
        <p>Our online wholebeing library offers a <b>freely accessible resource kit</b> to accompany you and your team in your
          wholebeing journey. It is rooted in our <a href="https://www.recipesforwellbeing.org/framework/"><b>Wholebeing
            Framework</b></a>, consisting of <b>150+ Wholebeing Skills</b> mapped across <b>12 Wholebeing Domains</b> to learn to thrive
          together. A Wholebeing Domain is a <b>core area of focus</b> encompassing related skills essential for wholebeing and changemaking.
          A Wholebeing Skill is a <b>learnable capability</b> that empowers individuals and communities to thrive while creative positive change.
          We invite you to <b>explore our wholebeing recipes using the dedicated search and filtering boxes</b>,
          which allow you to find recipes around a specific domain, skill, group size, duration, and/or level of
          difficulty.</p>
        <p>⚠️ <b>DISCLAIMER</b>: Whilst we do our best to prove the effectiveness of each recipe before we publish it on
          our website, we cannot guarantee it will work with everyone. Each of us is on a unique journey, meaning that
          the impact of our recipes will differ from person to person, from organisation to organisation, and from
          community to community. We also attempt to acknowledge the sources for all our recipes, but this may not
          always be possible. If you come across a recipe and know of its original source, please don’t hesitate to
          reach out to us so we can add the relevant acknowledgements.</p>
        <v-btn rounded @click="hideDesclaimer()" color="#f36d62" class="white--text">Gotcha!</v-btn>
      </v-col>
    </v-row>
    <v-row justify="center">
      <v-col xl="6" lg="6" md="12" sm="12" xs="12">
        <SearchTextBar @searched-value="handleSearchedValue" @show-disclaimer="showDesclaimer"
                       :is-disclaimer-showing="disclaimer"/>
      </v-col>
    </v-row>
    <v-row justify="center">
      <v-col xl="4" lg="4" md="12" sm="12" xs="12">
        <selectTagsAutocomplete :list="domainsList" placeholder="Domain" :tag-type="tagType.domain"
                                @selected-tags="handleSelectedTagsTest"/>
      </v-col>
      <v-col xl="4" lg="4" md="12" sm="12" xs="12">
        <selectTagsAutocomplete :list="skillsList" placeholder="Skill" :tag-type="tagType.skill"
                                @selected-tags="handleSelectedTagsTest"/>
      </v-col>
    </v-row>
    <v-row justify="center">
      <v-col xl="4" lg="4" md="12" sm="12" xs="12">
        <selectTags :list="servingsList" placeholder="Group size" :tag-type="tagType.serving"
                    @selected-tags="handleSelectedTagsTest"/>
      </v-col>
      <v-col xl="4" lg="4" md="12" sm="12">
        <selectTags :list="durationsList" placeholder="Duration" :tag-type="tagType.duration"
                    @selected-tags="handleSelectedTagsTest"/>
      </v-col>
      <v-col xl="4" lg="4" md="12" sm="12">
        <selectTags :list="difficultiesList" placeholder="Difficulty" :tag-type="tagType.difficulty"
                    @selected-tags="handleSelectedTagsTest"/>
      </v-col>
    </v-row>
    <v-layout row wrap>
      <v-flex md4 class="lg5-custom" v-for="(post, index) in postListFiltered" :key="index">
        <RecipeCard :title="post.post_title" :img-src="post.imgSrc" :excerpt="post.post_excerpt" :id="post.ID" :test="post"
                    :post-date="post.post_date"/>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import SearchTextBar from "../components/SearchTextBar.vue";
import RecipeCard from "../components/RecipeCard.vue";
import {difficultyList, durationList, servingList, tagType, timeTs} from "../libs/consts";
import SelectTags from "../components/SelectTags.vue";
import SelectTagsAutocomplete from "../components/SelectTagsAutocomplete.vue";

export default {
  name: "SearchaPage",
  components: {SelectTags, RecipeCard, SearchTextBar, SelectTagsAutocomplete},
  data() {
    return {
      tagType: tagType,
      postsList: [],
      wpData: wpData,
      postListFiltered: [],

      disclaimer: true,

      // Fetched by the server
      categoriesList: [],
      tagsList: [],
      difficultiesList: [],
      durationsList: [],
      servingsList: [],
      domainsList: [],
      skillsList: [],
      intersectionsList: [],
      dishesList: [],
      recipesList: [],

      // Selected by the user
      selectedCategories: [],
      selectedTags: [],
      selectedDifficulties: [],
      selectedDurations: [],
      selectedServings: [],
      selectedDomains: [],
      selectedSkills: [],
      selectedIntersections: [],
      selectedDishes: [],
      selectedRecipes: [],

      searchedText: ''
    }
  },
  mounted() {
    console.log(this.wpData)
    const arrayNewBadge = this.wpData.postsList.filter(post => post.post_date > (Math.floor(Date.now() / 1000) - timeTs.oneYear)).sort((a, b) => a.post_name.localeCompare(b.post_name))
    const arrayWithoutBadge = this.wpData.postsList.filter(post => post.post_date <= (Math.floor(Date.now() / 1000) - timeTs.oneYear)).sort((a, b) => a.post_name.localeCompare(b.post_name))
    const postListMerged = arrayNewBadge.concat(arrayWithoutBadge)
    this.postsList = postListMerged
    this.postListFiltered = postListMerged

    this.difficultiesList = this.wpData.difficultiesList.map((difficulty) => {
      switch (difficulty.slug) {
        case difficultyList['easy']:
          difficulty.order = 1
          break;
        case difficultyList['medium']:
          difficulty.order = 2
          break;
        case difficultyList['hard']:
          difficulty.order = 3
          break;
      }
      return difficulty

    }).sort((a, b) => a.order - b.order)

    this.durationsList = this.wpData.durationsList.map((duration) => {
      switch (duration.slug) {
        case durationList['1-10-minutes']:
          duration.order = 1
          break;
        case durationList['11-30-minutes']:
          duration.order = 2
          break;
        case durationList['31-60-minutes']:
          duration.order = 3
          break;
        case durationList['61-120-minutes']:
          duration.order = 4
          break;
        case durationList['121-240-minutes']:
          duration.order = 5
          break;
        case durationList['half-a-day']:
          duration.order = 6
          break;
        case durationList['1-day']:
          duration.order = 7
          break;
        case durationList['1-week']:
          duration.order = 8
          break;
        case durationList['ongoing']:
          duration.order = 9
          break;
      }
      return duration
    }).sort((a, b) => a.order - b.order)

    this.servingsList = this.wpData.servingsList.map((serving) => {
      switch (serving.slug) {
        case servingList['1-person']:
          serving.order = 1
          break;
        case servingList['2-10-people']:
          serving.order = 2
          break;
        case servingList['11-25-people']:
          serving.order = 3
          break;
        case servingList['26-40-people']:
          serving.order = 4
          break;
        case servingList['41-people']:
          serving.order = 5
          break;
      }
      return serving
    }).sort((a, b) => a.order - b.order)
    this.domainsList = this.wpData.domainsList
    this.skillsList = this.wpData.skillsList
    this.extrasList = this.wpData.extrasList
    this.intersectionsList = this.wpData.intersectionsList
    this.dishesList = this.wpData.dishesList
    this.recipesList = this.wpData.recipesList

    this.categoriesList = this.wpData.categoriesList
    this.tagsList = this.wpData.tagsList
    this.domainsList = this.wpData.domainsList
  },
  watch: {
    selectedCategories: function (newValue) {
      this.search()
    },
    selectedTags: function (newValue) {
      this.search()
    },
    selectedDifficulties: function (newValue) {
      this.search()
    },
    selectedDurations: function (newValue) {
      this.search()
    },
    selectedServings: function (newValue) {
      this.search()
    },
    selectedDomains: function (newValue) {
      this.search()
    },
    selectedSkills: function (newValue) {
      this.search()
    },
    selectedIntersections: function (newValue) {
      this.search()
    },
    selectedDishes: function (newValue) {
      this.search()
    },
    selectedRecipes: function (newValue) {
      this.search()
    }
  },
  methods: {
    handleSearchedValue(searchedText) {
      this.searchedText = searchedText
      this.search()
    },
    handleSelectedCategory(payload) {
      const {action, categoryId} = payload
      const self = this
      switch (action) {
        case actions.add: {
          self.selectedCategories.push(categoryId)
          break;
        }
        case actions.remove: {
          const foundIndex = self.selectedCategories.indexOf(categoryId)
          self.selectedCategories.splice(foundIndex, 1)
          break;
        }
      }
    },

    handleSelectedTagsTest(payload) {
      const {selectedTags, tagType} = payload
      const self = this

      switch (tagType) {
        case self.tagType.tag: {
          self.selectedTags = selectedTags
          break;
        }
        case self.tagType.difficulty: {
          self.selectedDifficulties = selectedTags
          break;
        }
        case self.tagType.duration: {
          self.selectedDurations = selectedTags
          break;
        }
        case self.tagType.serving: {
          self.selectedServings = selectedTags
          break;
        }
        case self.tagType.domain: {
          self.selectedDomains = selectedTags
          break;
        }
        case self.tagType.skill: {
          self.selectedSkills = selectedTags
          break;
        }
        case self.tagType.intersection: {
          self.selectedIntersections = selectedTags
          break;
        }
        case self.tagType.dish: {
          self.selectedDishes = selectedTags
          break;
        }
        case self.tagType.recipe: {
          self.selectedRecipes = selectedTags
          break;
        }
      }
    },

    checkIfSearchIsEmpty() {
      return this.selectedDifficulties.length === 0 &&
        this.selectedDurations.length === 0 &&
        this.selectedServings.length === 0 &&
        this.selectedDomains.length === 0 &&
        this.selectedSkills.length === 0 &&
        this.selectedIntersections.length === 0 &&
        this.selectedDishes.length === 0 &&
        this.selectedRecipes.length === 0 &&
        this.selectedTags.length === 0 &&
        this.selectedCategories.length === 0 &&
        this.searchedText === ''
    },

    search() {
      const self = this
      const result = this.postsList.filter(function (post) {
        let checkDifficulties = true
        let checkDuration = true
        let checkServings = true
        let checkDomains = true
        let checkSkills = true
        let checkIntersections = true
        let checkDishes = true
        let checkRecipes = true

        let checkTitle = true
        let checkExcerpt = true

        if (self.selectedDifficulties.length > 0 && post.difficulties.length > 0) checkDifficulties = post.difficulties.some((difficulty) => self.selectedDifficulties.includes(difficulty))
        if (self.selectedDurations.length > 0 && post.durations.length > 0) checkDuration = post.durations.some((duration) => self.selectedDurations.includes(duration))
        if (self.selectedServings.length > 0 && post.servings.length > 0) checkServings = post.servings.some((serving) => self.selectedServings.includes(serving))
        if (self.selectedDomains.length > 0 && post.domains.length > 0) checkDomains = post.domains.some((domain) => self.selectedDomains.includes(domain))
        if (self.selectedSkills.length > 0 && post.skills.length > 0) checkSkills = post.skills.some((skill) => self.selectedSkills.includes(skill))
        if (self.selectedIntersections.length > 0 && post.intersections.length > 0) checkIntersections = post.intersections.some((intersection) => self.selectedIntersections.includes(intersection))
        if (self.selectedDishes.length > 0 && post.dishes.length > 0) checkDishes = post.dishes.some((dish) => self.selectedDishes.includes(dish))
        if (self.selectedRecipes.length > 0 && post.recipes.length > 0) checkRecipes = post.recipes.some((recipe) => self.selectedRecipes.includes(recipe))

        if (self.searchedText !== '') {
          checkTitle = post.post_title.toLowerCase().includes(self.searchedText.toLowerCase())
          checkExcerpt = post.post_excerpt.toLowerCase().includes(self.searchedText.toLowerCase())
        }

        return checkDifficulties &&
          checkDuration &&
          checkServings &&
          checkDomains &&
          checkSkills &&
          checkIntersections &&
          checkDishes &&
          checkRecipes &&
          (checkTitle || checkExcerpt)
      })

      const isSearchEmpty = this.checkIfSearchIsEmpty()
      if (isSearchEmpty) {
        self.postListFiltered = this.postsList
      } else {
        const arrayNewBadge = result.filter(post => post.post_date > (Math.floor(Date.now() / 1000) - timeTs.oneYear)).sort((a, b) => a.post_name.localeCompare(b.post_name))
        const arrayWithoutNewBadge = result.filter(post => post.post_date < (Math.floor(Date.now() / 1000) - timeTs.oneYear)).sort((a, b) => a.post_name.localeCompare(b.post_name))
        self.postListFiltered = arrayNewBadge.concat(arrayWithoutNewBadge)
      }
    },

    hideDesclaimer() {
      this.disclaimer = false
    },
    showDesclaimer() {
      this.disclaimer = true
    }
  }
}
</script>

<style scoped>

</style>
