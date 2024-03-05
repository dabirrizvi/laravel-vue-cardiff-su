<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <!-- Navigation Links -->
      <div class="container-fluid">
        <router-link to="/tasks" class="navbar-brand">Cardiff SU Tasks</router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link to="/tasks" class="nav-link" aria-current="page">View Tasks</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/form" class="nav-link">Add New Task</router-link>
            </li>
          </ul>
        </div>
        <!-- Accessibility Features -->
        <div class="navbar-text">
          <span>Accessibility Features: </span>
          <button @click="toggleFullScreen" class="btn btn-sm btn-outline-secondary">Toggle Full Screen</button>
          <button @click="increaseFontSize" class="btn btn-sm btn-outline-secondary">Increase Font Size</button>
          <button @click="decreaseFontSize" class="btn btn-sm btn-outline-secondary">Decrease Font Size</button>
          <button @click="toggleContrast" class="btn btn-sm btn-outline-secondary">Toggle High Contrast</button>
        </div>
      </div>
    </nav>
    <!-- Router View -->
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  methods: {
    // Toggles full screen mode
    toggleFullScreen() {
      if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        }
      }
    },
    // Increases the font size of the application
    increaseFontSize() {
      const currentSize = parseFloat(getComputedStyle(document.body).fontSize);
      document.body.style.fontSize = `${currentSize * 1.1}px`;
    },
    // Decreases the font size of the application
    decreaseFontSize() {
      const currentSize = parseFloat(getComputedStyle(document.body).fontSize);
      document.body.style.fontSize = `${currentSize * 0.9}px`;
    },
    // Toggles high contrast mode
    toggleContrast() {
      const body = document.body;
      body.classList.toggle('high-contrast');
    }
  }
}
</script>


<style>
/* styling to change screen contrast for accesssibility features */
.high-contrast {
  filter: invert(1) hue-rotate(180deg);
}

.btn-outline-secondary {
  margin: 10px;

}
</style>