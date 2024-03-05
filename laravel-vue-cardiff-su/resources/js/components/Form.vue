<template>
  <div class="task-form">
    <h2>Add Task</h2>
    <!-- Task Form -->
    <form @submit.prevent="submitForm" class="form" ref="taskForm">
      <!-- Task Name Input -->
      <div class="mb-3">
        <label for="user_name" class="form-label">Task Name:</label>
        <input type="text" id="user_name" v-model="formData.user_name" placeholder="Task Name" class="form-control"
          required>
      </div>

      <!-- Assignee Input -->
      <div class="mb-3">
        <label for="assignee" class="form-label">Assigned To:</label>
        <input type="text" id="assignee" v-model="formData.assignee" placeholder="Assignee Name" class="form-control"
          required>
      </div>

      <!-- Task Description Input -->
      <div class="mb-3">
        <label for="task_description" class="form-label">Task Description:</label>
        <!-- Task Description Lines -->
        <div v-for="(line, index) in taskDescriptionLines" :key="index" class="input-group">
          <textarea v-model="taskDescriptionLines[index]" rows="2" placeholder="Task Description" class="form-control"
            required></textarea>
          <button type="button" v-if="index !== 0" @click="removeLine(index)"
            class="btn btn-danger btn-remove">-</button>
        </div>
        <!-- Add New Line Button -->
        <button type="button" @click="addLine" class="btn btn-primary btn-add">Add New Line</button>
      </div>

      <!-- Priority Selection -->
      <div class="mb-3">
        <label class="form-label">Priority:</label>
        <!-- Priority Radio Buttons -->
        <div class="form-check">
          <input type="radio" id="priority_low" value="low" v-model="formData.priority" class="form-check-input"
            required>
          <label for="priority_low" class="form-check-label">Low</label>
        </div>
        <!-- Medium Priority -->
        <div class="form-check">
          <input type="radio" id="priority_medium" value="medium" v-model="formData.priority" class="form-check-input"
            required>
          <label for="priority_medium" class="form-check-label">Medium</label>
        </div>
        <!-- High Priority -->
        <div class="form-check">
          <input type="radio" id="priority_high" value="high" v-model="formData.priority" class="form-check-input"
            required>
          <label for="priority_high" class="form-check-label">High</label>
        </div>
      </div>

      <!-- Due Date Input -->
      <div class="mb-3">
        <label for="due_date" class="form-label">Due Date:</label>
        <input type="date" id="due_date" v-model="formData.due_date" class="form-control" required>
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!-- Success Message -->
    <div v-if="isSubmitted" class="alert alert-success mt-3" role="alert">
      Form submitted successfully!
    </div>
  </div>
</template>


<script>
import axios from 'axios';

export default {
  data() {
    return {
      // Form data object
      formData: {
        user_name: '',
        assignee: '',
        priority: '',
        due_date: ''
      },
      // Array to store task description lines
      taskDescriptionLines: [''],
      isSubmitted: false
    };
  },
  methods: {
    // Method to submit the form data
    async submitForm() {
      try {
        // Check if any task description line is empty
        if (this.taskDescriptionLines.some(line => line.trim() === '')) {
          alert('Please fill in all task description lines.');
          return;
        }

        // Check if priority is selected
        if (!this.formData.priority) {
          alert('Please select priority.');
          return;
        }

        // Check if assignee is provided
        if (!this.formData.assignee.trim()) {
          alert('Please provide assignee name.');
          return;
        }

        // Concatenate task description lines into a single string
        this.formData.task_description = this.taskDescriptionLines.join('\n');

        // Send a POST request to submit form data
        const response = await axios.post('/api/tasks', this.formData);
        console.log(response.data);
        // Reset the form fields after successful submission
        this.formData = {
          user_name: '',
          assignee: '',
          priority: '',
          due_date: ''
        };
        // Reset task description lines
        this.taskDescriptionLines = [''];
        // Set submitted flag to true
        this.isSubmitted = true;
        // Reset the form validation state
        this.$refs.taskForm.reset();
      } catch (error) {
        console.error('Error submitting form:', error);
      }
    },
    addLine() {
      // Add a new line to the task description
      this.taskDescriptionLines.push('');
    },
    removeLine(index) {
      // Remove the line at the given index
      this.taskDescriptionLines.splice(index, 1);
    }
  }
};
</script>

<style scoped>
/* styling for form */
.task-form {
  max-width: 600px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.input-group {
  margin-bottom: 10px;
}

.form-control {
  width: calc(100% - 90px);
}

.btn {
  min-width: 80px;
}

.btn-danger {
  margin-left: 10px;
}

.form-check-input {
  margin-right: 5px;
}

.form-check-label {
  margin-right: 10px;
}

.btn-add {
  margin-top: 10px;
}

.btn-remove {
  margin-left: 10px;
}
</style>
