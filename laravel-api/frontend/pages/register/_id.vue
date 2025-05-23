<template>
  <v-container>
    <v-card>
      <v-card-title>Register for Course {{ courseId }}</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="submitForm">
          <v-text-field v-model="form.name" label="Name" required></v-text-field>
          <v-text-field v-model="form.email" label="Email" type="email" required></v-text-field>
          <v-select
            v-model="form.subscriptionType"
            :items="['basic', 'premium']"
            label="Subscription Type"
            required
          ></v-select>
          <v-btn type="submit" color="primary" :disabled="loading">Submit</v-btn>
        </v-form>
        <p v-if="error" class="error--text">{{ error }}</p>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      courseId: this.$route.params.id,
      form: {
        name: '',
        email: '',
        subscriptionType: '',
      },
      loading: false,
      error: '',
    };
  },
  methods: {
    async submitForm() {
      this.loading = true;
      try {
        const response = await this.$axios.post('/subscriptions', {
          student_id: null, // Fetch or create student dynamically
          type: this.form.subscriptionType,
          started_at: new Date().toISOString(),
          expires_at: new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toISOString(), // 30 days
        });
        await this.$axios.post(`/students`, {
          name: this.form.name,
          email: this.form.email,
          subscription_expires_at: response.data.expires_at,
        });
        this.$router.push('/dashboard');
      } catch (error) {
        this.error = error.response?.data?.message || 'Registration failed';
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>
