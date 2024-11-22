<template>
  <div class="container mt-5">
    <!-- Header Section -->
    <div class="text-center">
      <h1 class="mb-4 fw-bold gradient-text">🌟 Website Performance Checker 🌟</h1>
      <p class="text-muted fs-5">
        Evaluate your website's performance for <strong>Desktop</strong> or <strong>Mobile</strong> platforms effortlessly.
      </p>
    </div>

    <!-- Input Form Section -->
    <div class="card shadow-lg p-5 rounded-4 border-0 form-card">
      <h5 class="mb-4 text-primary fw-bold">Enter Website Details</h5>
      <form @submit.prevent="checkPerformance">
        <!-- URL Input -->
        <div class="mb-4">
          <label for="url" class="form-label fw-semibold fs-5">Website URL</label>
          <input 
            id="url" 
            v-model="url" 
            type="url" 
            class="form-control form-control-lg" 
            placeholder="https://example.com" 
            required 
          />
        </div>

        <!-- Platform Selector -->
        <div class="mb-4">
          <label for="platform" class="form-label fw-semibold fs-5">Select Platform</label>
          <select id="platform" v-model="platform" class="form-select form-select-lg">
            <option value="desktop">Desktop</option>
            <option value="mobile">Mobile</option>
          </select>
        </div>

        <!-- Submit Button -->
        <button 
          type="submit" 
          class="btn btn-gradient w-100 btn-lg shadow-lg" 
          :disabled="loading"
        >
          {{ loading ? 'Analyzing...' : '🚀 Check Performance' }}
        </button>
      </form>
    </div>

    <!-- Results Section -->
    <div v-if="performanceScore !== null" class="mt-5 text-center score-section">
      <h4 class="mb-3 fw-bold text-primary">Performance Score</h4>
      <p 
        class="display-3 score-display" 
        :class="{ 'high-score': performanceScore > 80, 'medium-score': performanceScore > 50 && performanceScore <= 80, 'low-score': performanceScore <= 50 }"
      >
        {{ performanceScore }}
      </p>
    </div>

    <!-- Error Section -->
    <div v-if="errorMessage" class="mt-4 alert alert-danger text-center rounded-4">
      <h4 class="fw-bold">Error</h4>
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
        this.performanceScore = response.data.performance_score; // Update based on API key
      } catch (error) {
        // Handle error response
        this.errorMessage = "An error occurred while checking performance.";
        console.error(error);
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
  max-width: 700px;
  margin: auto;
}

/* Gradient Text */
.gradient-text {
  background: linear-gradient(to right, #ff7eb3, #ff758c, #ff6473);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Form Card Styling */
.form-card {
  background: #f9f9f9;
  border: 2px solid #e0e0e0;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

/* Gradient Button Styling */
.btn-gradient {
  background: linear-gradient(90deg, #ff758c, #ff7eb3);
  border: none;
  color: #fff;
  font-size: 1.2rem;
  font-weight: bold;
  transition: all 0.3s ease;
}

.btn-gradient:disabled {
  background: #adb5bd;
  cursor: not-allowed;
}

.btn-gradient:hover:not(:disabled) {
  background: linear-gradient(90deg, #ff6473, #ff758c);
  transform: scale(1.03);
}

/* Score Section */
.score-section {
  background: #fff;
  border: 2px solid #e0e0e0;
  padding: 20px;
  border-radius: 12px;
}

.score-display {
  font-weight: bold;
  padding: 10px 20px;
  border-radius: 50px;
}

.high-score {
  color: #28a745;
  background-color: #d4edda;
}

.medium-score {
  color: #ffc107;
  background-color: #fff3cd;
}

.low-score {
  color: #dc3545;
  background-color: #f8d7da;
}

/* Input Styling */
.form-control-lg,
.form-select-lg {
  font-size: 1.2rem;
  padding: 12px;
}

label {
  font-size: 1.1rem;
}

.alert {
  font-size: 1.2rem;
  border-radius: 12px;
}
</style>
