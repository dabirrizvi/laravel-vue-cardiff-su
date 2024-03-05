<template>
  <div>
    <h2>Task List</h2>
    <ul>
      <li v-for="task in tasks" :key="task.id">
        {{ task.task_description }} - Priority: {{ task.priority }} - Due Date: {{ task.due_date }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      tasks: []
    };
  },
  mounted() {
    this.fetchTasks();
  },
  methods: {
    async fetchTasks() {
      try {
        const response = await axios.get('/api/tasks');
        this.tasks = response.data;
        console.log(this.tasks); // Log tasks array to the console
      } catch (error) {
        console.error('Error fetching tasks:', error);
      }
    }
  }
};
</script>
