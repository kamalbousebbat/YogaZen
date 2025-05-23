<template>
  <v-container>
    <v-card>
      <v-card-title>Manage Schedule</v-card-title>
      <v-card-text>
        <v-btn color="primary" @click="dialog = true">Add Slot</v-btn>
        <v-data-table
          :headers="headers"
          :items="slots"
          :loading="loading"
          @click:row="editSlot"
        >
          <template v-slot:top>
            <v-dialog v-model="dialog" max-width="500px">
              <v-card>
                <v-card-title>{{ editId ? 'Edit Slot' : 'Add Slot' }}</v-card-title>
                <v-card-text>
                  <v-form @submit.prevent="saveSlot">
                    <v-text-field v-model="slotForm.courseId" label="Course ID" required></v-text-field>
                    <v-text-field v-model="slotForm.date" type="date" label="Date" required></v-text-field>
                    <v-text-field v-model="slotForm.time" type="time" label="Time" required></v-text-field>
                    <v-btn type="submit" color="primary">Save</v-btn>
                    <v-btn @click="dialog = false" color="error">Cancel</v-btn>
                  </v-form>
                </v-card-text>
              </v-card>
            </v-dialog>
          </template>
        </v-data-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      headers: [
        { text: 'Course', value: 'courseId' },
        { text: 'Date', value: 'date' },
        { text: 'Time', value: 'time' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      slots: [],
      loading: true,
      dialog: false,
      editId: null,
      slotForm: { courseId: '', date: '', time: '' },
    };
  },
  async fetch() {
    this.loading = true;
    const response = await this.$axios.get('/schedules'); // Adjust endpoint
    this.slots = response.data;
    this.loading = false;
  },
  methods: {
    editSlot(item) {
      this.editId = item.id;
      this.slotForm = { ...item };
      this.dialog = true;
    },
    async saveSlot() {
      if (this.editId) {
        await this.$axios.put(`/schedules/${this.editId}`, this.slotForm);
      } else {
        await this.$axios.post('/schedules', this.slotForm);
      }
      this.dialog = false;
      this.fetch();
    },
  },
};
</script>
