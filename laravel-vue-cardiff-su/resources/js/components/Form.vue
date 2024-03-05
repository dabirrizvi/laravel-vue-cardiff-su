<template>
    <form @submit.prevent="submitForm">
      <input type="text" v-model="formData.user_name" placeholder="Your Name">
      <input type="text" v-model="formData.task_description" placeholder="Task Description">
      <input type="text" v-model="formData.priority" placeholder="Priority">
      <input type="date" v-model="formData.due_date" placeholder="Due Date">
      <button type="submit">Submit</button>
    </form>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        formData: {
          user_name: '',
          task_description: '',
          priority: '',
          due_date: ''
        }
      };
    },
    methods: {
      async submitForm() {
        try {
          const response = await axios.post('/api/tasks', this.formData);
          console.log(response.data); // Assuming the response contains the saved task data
          // Optionally, reset the form fields after successful submission
          this.formData = {
            user_name: '',
            task_description: '',
            priority: '',
            due_date: ''
          };
        } catch (error) {
          console.error('Error submitting form:', error);
        }
      }
    }
  };
  </script>
  