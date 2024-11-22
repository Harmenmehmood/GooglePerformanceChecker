<template>
  <div class="container mt-5">
    <!-- Header Section -->
    <div class="text-center">
      <h1 class="mb-4">🌟 Website Performance Checker 🌟</h1>
      <p class="text-muted">
        Measure the performance of your website for <strong>Desktop</strong> or <strong>Mobile</strong> platforms.
      </p>
    </div>

    <!-- Input Form Section -->
    <div class="card shadow-lg p-4">
      <h5 class="mb-3 text-primary">Enter Details</h5>
      <form @submit.prevent="checkPerformance">
        <!-- URL Input -->
        <div class="mb-3">
          <label for="url" class="form-label">Website URL</label>
          <input 
            id="url" 
            v-model="url" 
            type="url" 
            class="form-control" 
            placeholder="https://example.com" 
            required 
          />
        </div>

        <!-- Platform Selector -->
        <div class="mb-3">
          <label for="platform" class="form-label">Select Platform</label>
          <select id="platform" v-model="platform" class="form-select">
            <option value="desktop">Desktop</option>
            <option value="mobile">Mobile</option>
          </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100" :disabled="loading">
          {{ loading ? 'Checking...' : 'Check Performance' }}
        </button>
      </form>
    </div>

    <!-- Results Section -->
    <div v-if="performanceScore !== null" class="mt-4 alert alert-success text-center">
      <h4 class="mb-3">Performance Score</h4>
      <p class="display-4 text-success">{{ performanceScore }}</p>
    </div>

    <!-- Error Section -->
    <div v-if="errorMessage" class="mt-4 alert alert-danger text-center">
      <h4>Error</h4>
      <p>{{ errorMessage }}</p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      url: "", // URL to be analyzed
      platform: "desktop", // Platform for analysis (desktop or mobile)
      performanceScore: null, // Performance score result
      errorMessage: null, // Error message (if any)
      loading: false, // Loading state
    };
  },
  methods: {
    async checkPerformance() {
      // Reset previous state
      this.performanceScore = null;
      this.errorMessage = null;
      this.loading = true;

      try {
        // Send request to the backend
        const response = await axios.post("/lighthouse/check", {
          url: this.url,
          platform: this.platform,
        });

        // Handle success response
        if (response.data && response.data.performanceScore !== undefined) {
          this.performanceScore = response.data.performanceScore;
        } else {
          throw new Error("Invalid response from the server.");
        }
      } catch (error) {
        // Handle error response
        console.error("Performance check error:", error);
        this.errorMessage = error.response?.data?.message || "An error occurred while checking performance. Please try again.";
      } finally {
        // Reset loading state
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: auto;
}

.card {
  border: none;
  border-radius: 12px;
}

button:disabled {
  background-color: #6c757d;
  cursor: not-allowed;
}

.alert {
  border-radius: 12px;
}

.display-4 {
  font-size: 3rem;
  font-weight: bold;
}
</style>
