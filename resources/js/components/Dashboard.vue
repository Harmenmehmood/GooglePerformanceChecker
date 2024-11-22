<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <!-- Dashboard Container -->
    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl p-8">
      <!-- Heading -->
      <div class="text-center mb-6">
        <h1 class="text-4xl font-semibold text-gray-800">Welcome to the Dashboard</h1>
        <p class="text-gray-600 mt-2">Start using the Lighthouse Performance Checker</p>
      </div>

      <!-- Lighthouse Check Section -->
      <div class="bg-gray-50 p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold text-gray-800">Lighthouse Performance Checker</h2>
          <p class="text-sm text-gray-500">Analyze your website's performance</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
          <lighthouse-check></lighthouse-check>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LighthouseCheck from './LighthouseCheck.vue';

export default {
  components: {
    LighthouseCheck
  }
};
</script>

<style scoped>
/* General Styling */
body {
  background-color: #f3f4f6; /* Soft background color */
}

h1 {
  color: #2d3748; /* Dark text for titles */
}

h2 {
  color: #4a5568; /* Subdued secondary text color */
}

.text-sm {
  font-size: 0.875rem;
}

.text-xl {
  font-size: 1.25rem;
}

/* Button Styling for Future Use */
button {
  background-color: #4c51bf; /* Elegant blue */
  color: white;
  padding: 12px 24px;
  border-radius: 8px;
  font-weight: 600;
  transition: all 0.3s ease;
}

button:hover {
  background-color: #434190; /* Slightly darker blue on hover */
  cursor: pointer;
}
</style>
