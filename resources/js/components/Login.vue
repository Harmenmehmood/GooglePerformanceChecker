<template>
  <div class="login-page">
    <h1>Login with Google</h1>
    <button @click="loginWithGoogle" class="btn btn-primary">Login</button>
  </div>
</template>

<script>
export default {
  methods: {
    loginWithGoogle() {
      window.location.href = '/login/google'; // Redirect to Google login route
    },
  },
};
</script>

<style scoped>
/* Add any custom styling here */
</style>
