<template>
  <div id="app">
    <div v-if="!isAuthenticated">
      <login-page @loginSuccess="handleLoginSuccess" />
    </div>
    <div v-else>
      <lighthouse-check />
    </div>
  </div>
</template>

<script>
import LoginPage from './components/LoginPage.vue';
import LighthouseCheck from './components/LighthouseCheck.vue';

export default {
  components: {
    LoginPage,
    LighthouseCheck,
  },
  data() {
    return {
      isAuthenticated: false, // Track login state
    };
  },
  methods: {
    handleLoginSuccess(token) {
      // Set authenticated state
      this.isAuthenticated = true;
      // Optionally, store the token
      localStorage.setItem('auth_token', token);
    },
  },
};
</script>
