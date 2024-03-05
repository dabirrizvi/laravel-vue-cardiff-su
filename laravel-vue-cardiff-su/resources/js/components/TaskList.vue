<template>
  <div class="task-list card p-4">
    <!-- Task List Header -->
    <h2 class="mb-4">Task List</h2>
    <ul class="list-group">
      <!-- Loop through sorted tasks -->
      <li v-for="task in sortedTasks" :key="task.id" class="list-group-item mb-3 card">
        <!-- Display task details when not in edit mode -->
        <template v-if="!task.editMode">
          <!-- Task Header -->
          <div class="task-header row">
            <h3 class="card-text col-xl-5 col-md-12"><strong>Task:</strong> {{ task.user_name }}</h3>
            <p class="card-text col-xl-2 col-md-12"><strong>Assigned To:</strong> {{ task.assignee }}</p>
            <p class="card-text col-xl-2 col-md-12"><strong>Due Date:</strong> {{ task.due_date }}</p>
            <p class="card-text priority-text col-xl-3 col-md-12"><strong>Priority:</strong> {{ task.priority }}</p>
          </div>
          <!-- Task Description -->
          <div class="task-description">
            <h5 class="card-text"><strong>Description:</strong></h5>
            <ul class="task-description-list">
              <!-- Display task description lines as list items -->
              <li v-for="(line, index) in task.task_description.split('\n')" :key="index">{{ line }}</li>
            </ul>
          </div>
          <!-- Task Actions -->
          <div class="task-actions">
            <button class="btn btn-primary" @click="enableEditMode(task)">Edit</button>
            <button class="btn btn-danger" @click="removeTask(task)">Delete</button>
          </div>
        </template>
        <!-- Display edit form when in edit mode -->

        <template v-else>
          <form @submit.prevent="saveTask(task)">
            <!-- Task Name Input -->
            <div class="mb-3">
              <label for="user_name" class="form-label">Name:</label>
              <input type="text" id="user_name" v-model="task.user_name" class="form-control" required>
            </div>
            <!-- Task Description Textarea -->
            <div class="mb-3">
              <label for="task_description" class="form-label">Description:</label>
              <textarea id="task_description" v-model="task.task_description" class="form-control" required></textarea>
            </div>
            <!-- Assignee Input -->
            <div class="mb-3">
              <label for="assignee" class="form-label">Assignee:</label>
              <input type="text" id="assignee" v-model="task.assignee" class="form-control">
            </div>
            <!-- Priority Selection -->
            <div class="mb-3">
              <label for="priority" class="form-label">Priority:</label>
              <select id="priority" v-model="task.priority" class="form-select" required>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
              </select>
            </div>
            <!-- Due Date Input -->
            <div class="mb-3">
              <label for="due_date" class="form-label">Due Date:</label>
              <input type="date" id="due_date" v-model="task.due_date" class="form-control" required>
            </div>
            <!-- Save and Cancel Buttons -->
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-secondary" @click="disableEditMode(task)">Cancel</button>
          </form>
        </template>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      // Array to store tasks
      tasks: [],
      // Task currently being edited
      editedTask: null,
      // Store original tasks before editing
      originalTasks: []
    };
  },
  computed: {
    // Sort tasks by priority and then by due date within each priority
    sortedTasks() {
      return this.tasks.slice().sort((a, b) => {
        // Priority order map
        const priorityOrder = { 'low': 3, 'medium': 2, 'high': 1 };
        // Compare priorities
        const priorityComparison = priorityOrder[a.priority.toLowerCase()] - priorityOrder[b.priority.toLowerCase()];
        if (priorityComparison !== 0) {
          return priorityComparison;
        }
        // If priorities are the same, compare due dates
        return new Date(a.due_date) - new Date(b.due_date);
      });
    }
  },
  mounted() {
    // Fetch tasks when the component is mounted
    this.fetchTasks();
  },
  methods: {
    async fetchTasks() {
      try {
        // Fetch tasks from the API
        const response = await axios.get('/api/tasks');
        this.tasks = response.data;
        // Store original tasks
        this.originalTasks = [...this.tasks];
      } catch (error) {
        console.error('Error fetching tasks:', error);
      }
    },
    async saveTask(task) {
      try {
        // Send a PUT request to update the task
        await axios.put(`/api/tasks/${task.id}`, task);
        task.editMode = false; // Disable edit mode after saving
        this.editedTask = null; // Reset editedTask
        alert('Task saved successfully.');
      } catch (error) {
        console.error('Error saving task:', error);
      }
    },
    enableEditMode(task) {
      // Enable edit mode for the selected task
      task.editMode = true;
      this.editedTask = task; // Set editedTask
    },
    disableEditMode(task) {
      // Disable edit mode for the selected task
      task.editMode = false;
      this.editedTask = null; // Reset editedTask
      // If task was being edited but not saved, reset task to its original state
      if (this.originalTasks) {
        const originalTask = this.originalTasks.find(t => t.id === task.id);
        if (originalTask) {
          Object.assign(task, originalTask);
        }
      }
    },
    async removeTask(task) {
      try {
        // Send a DELETE request to the API to remove the task
        await axios.delete(`/api/tasks/${task.id}`);
        // If deletion is successful, update the tasks list
        this.tasks = this.tasks.filter(item => item.id !== task.id);
        // Display an alert message to notify the user of the deletion status
        alert('Task removed successfully.');
      } catch (error) {
        console.error('Error removing task:', error);
        // Display an alert message to notify the user of the error
        alert('Error removing task. Please try again later.');
      }
    }
  }
};
</script>


<style scoped>
.card {
  /* Custom styles for task card */
  background-color: aliceblue;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  padding: 1rem;
}

.list-group-item {
  /* Custom styles for list group item */
  background-color: #fff;
}

.task-description {
  /* Custom styles for task description */
  margin: 20px;
}

.task-description-list {
  /* Custom styles for task description list */
  list-style-type: disc;
}

button {
  /* Custom styles for buttons */
  margin: 10px;
}

.priority-text {
  /* Custom styles for priority text */
  text-align: end;
}
</style>
