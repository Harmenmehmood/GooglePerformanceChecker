<template>
  <div>
    <!-- Google Sign-In Section -->
    <div v-if="!isLoggedIn" class="w-full max-w-md mx-auto bg-white shadow-lg rounded-lg p-8">
      <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">
        Welcome to Google Lighthouse Performance Checker
      </h2>
      <p class="text-center text-gray-600 mb-4">Sign in with your Google account to get started.</p>

      <!-- Google Sign-In Button -->
      <button
        @click="signInWithGoogle"
        class="w-full py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-600 transition duration-300"
        :disabled="isLoading"
      >
        {{ isLoading ? "Signing in..." : "Sign in with Google" }}
      </button>

      <!-- Error Message -->
      <p v-if="errorMessage" class="text-red-500 text-center mt-4">{{ errorMessage }}</p>

      <!-- Loading Indicator -->
      <div v-if="isLoading" class="flex justify-center mt-4">
        <svg
          class="animate-spin h-5 w-5 border-t-2 border-blue-600 rounded-full"
          viewBox="0 0 24 24"
        >
          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" />
        </svg>
      </div>
    </div>

    <!-- Lighthouse Check Component -->
    <div v-else class="w-full max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-8">
      <lighthouse-check></lighthouse-check>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      isLoggedIn: false, // Tracks the user's login state
      isLoading: false, // Indicates whether a login process is ongoing
      errorMessage: "", // Holds error messages if login fails
    };
  },
  methods: {
    // Initiates Google login
    signInWithGoogle() {
      this.isLoading = true;
      this.errorMessage = ""; // Reset previous errors

      try {
        // Redirects user to the backend's Google login endpoint
        window.location.href = "/login/google"; // Make sure this URL matches the backend route
      } catch (error) {
        this.isLoading = false;
        this.errorMessage = "An error occurred during Google login. Please try again.";
      }
    },

    // Handle the callback from Google login
    async handleGoogleCallback() {

      this.isLoading = true;
      this.errorMessage = ""; // Reset previous errors

      try {
        // Extract the token from query params
        const queryParams = new URLSearchParams(window.location.search);
        const token = queryParams.get("token");

        if (!token) {
          this.errorMessage = "Invalid Google login response. Please try again.";
          this.isLoading = false;
          return;
        }

        // Verify the token with the backend
        const response = await axios.post("/auth/google/callback", { token });

        if (response.data && response.data.token) {
          // Save user and token details in localStorage
          localStorage.setItem("user", JSON.stringify(response.data.user));
          localStorage.setItem("token", response.data.token);

          // Set login state
          this.isLoggedIn = true;

          // Redirect to LighthouseCheck component
          this.$router.push({ name: "LighthouseCheck" });
        } else {
          this.errorMessage = "Failed to authenticate with Google. Please try again.";
        }
      } catch (error) {
        console.error("Login error:", error);
        this.errorMessage = "An error occurred during login. Please try again.";
      } finally {
        this.isLoading = false;
      }
    },
  },
  beforeRouteEnter(to, from, next) {
    console.log(to);
    console.log(from);
    console.log(next);
    console.log(to.path);
    // Check if we're on the Google login callback route
    if (to.path === "/login/google/callback") {
      next(vm => {
        // Log the route object to debug
        console.log("Route during beforeRouteEnter:", to);
        vm.handleGoogleCallback(); // Trigger the callback handling
      });
    } else {
      next();
    }
  },
};
</script>

<style scoped>
body {
  background-color: #f8fafc;
}
</style>
