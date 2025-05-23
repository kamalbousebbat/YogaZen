<template>
  <v-container>
    <v-card>
      <v-card-title>Dashboard</v-card-title>
      <v-card-text>
        <v-row>
          <v-col>
            <h3>Subscription Status</h3>
            <p>Expires: {{ subscriptionExpiresAt }}</p>
            <p>Status: {{ subscriptionStatus }}</p>
          </v-col>
          <v-col>
            <h3>Reservation History</h3>
            <v-data-table
              :headers="headers"
              :items="reservations"
              :loading="loading"
            ></v-data-table>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      subscriptionExpiresAt: '2025-06-21',
      subscriptionStatus: 'Active',
      headers: [
        { text: 'Course', value: 'course.title' },
        { text: 'Date', value: 'date' },
        { text: 'Status', value: 'status' },
      ],
      reservations: [],
      loading: true,
    };
  },
  async fetch() {
    this.loading = true;
    const response = await this.$axios.get('/reservations'); // Adjust endpoint
    this.reservations = response.data;
    this.loading = false;
  },
};
</script>
