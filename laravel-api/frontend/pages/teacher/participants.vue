<template>
  <v-container>
    <v-card>
      <v-card-title>Participants by Course</v-card-title>
      <v-card-text>
        <v-select v-model="selectedCourse" :items="courses" label="Select Course" @change="fetchParticipants"></v-select>
        <v-data-table
          :headers="headers"
          :items="participants"
          :loading="loading"
        ></v-data-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      selectedCourse: null,
      courses: [], // Fetch from API
      headers: [
        { text: 'Student Name', value: 'student.name' },
        { text: 'Email', value: 'student.email' },
        { text: 'Status', value: 'status' },
      ],
      participants: [],
      loading: true,
    };
  },
  async fetch() {
    const response = await this.$axios.get('/courses');
    this.courses = response.data.map(c => ({ text: c.title, value: c.id }));
  },
  methods: {
    async fetchParticipants() {
      this.loading = true;
      const response = await this.$axios.get(`/participants/${this.selectedCourse}`);
      this.participants = response.data;
      this.loading = false;
    },
  },
};
</script>
