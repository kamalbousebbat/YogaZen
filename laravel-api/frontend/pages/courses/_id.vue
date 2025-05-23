<template>
  <v-container>
    <v-card>
      <v-card-title>{{ course.title }}</v-card-title>
      <v-card-text>
        <p>{{ course.description }}</p>
        <p><strong>Level:</strong> {{ course.level }}</p>
        <p><strong>Duration:</strong> {{ course.duration }} min</p>
        <p><strong>Price:</strong> ${{ course.price }}</p>
        <p><strong>Teacher:</strong> {{ course.teacher?.name }}</p>
        <p><strong>Available Dates:</strong> {{ availableDates }}</p>
        <v-btn :to="`/register/${course.id}`" color="success">Enroll</v-btn>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      course: {},
      availableDates: ['2025-05-25', '2025-05-26'], // Mock data; fetch from API
    };
  },
  async asyncData({ params, $axios }) {
    const response = await $axios.get(`/courses/${params.id}`);
    return { course: response.data };
  },
};
</script>
