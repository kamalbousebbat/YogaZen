<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-card-title>
            Course Catalog
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="3">
                <v-select
                  v-model="levelFilter"
                  :items="['beginner', 'intermediate', 'advanced']"
                  label="Level"
                  clearable
                ></v-select>
                <v-slider
                  v-model="durationFilter"
                  label="Duration (min)"
                  min="10"
                  max="100"
                  thumb-label
                  clearable
                ></v-slider>
              </v-col>
              <v-col cols="9">
                <v-data-table
                  :headers="headers"
                  :items="courses"
                  :search="search"
                  :items-per-page="5"
                  :loading="loading"
                  @update:options="fetchCourses"
                >
                  <template v-slot:item.actions="{ item }">
                    <v-btn :to="`/courses/${item.id}`" small color="primary">View</v-btn>
                  </template>
                </v-data-table>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      search: '',
      levelFilter: null,
      durationFilter: null,
      headers: [
        { text: 'Title', value: 'title' },
        { text: 'Level', value: 'level' },
        { text: 'Duration', value: 'duration' },
        { text: 'Price', value: 'price' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      courses: [],
      loading: true,
      page: 1,
      itemsPerPage: 5,
    };
  },
  async fetch() {
    await this.fetchCourses();
  },
  methods: {
    async fetchCourses({ page, itemsPerPage } = {}) {
      this.loading = true;
      const params = {
        page: page || this.page,
        per_page: itemsPerPage || this.itemsPerPage,
        level: this.levelFilter,
        duration: this.durationFilter,
      };
      const response = await this.$axios.get('/courses', { params });
      this.courses = response.data.data; // Adjust based on Laravel API response
      this.loading = false;
    },
  },
  watch: {
    levelFilter() {
      this.fetchCourses();
    },
    durationFilter() {
      this.fetchCourses();
    },
  },
};
</script>
