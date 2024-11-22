import "/resources/js/bootstrap.js";
import axios from "/node_modules/.vite/deps/axios.js?v=5795dcd8";
import { createApp } from "/node_modules/.vite/deps/vue.js?v=5795dcd8";
import LighthouseCheck from "/resources/js/components/LighthouseCheck.vue";
import GoogleLogin from "/resources/js/components/GoogleLogin.vue";

const app = createApp({});

// Register the LighthouseCheck component globally
app.component("lighthouse-check", LighthouseCheck);
app.component("google-login", GoogleLogin);

// Mount the app
app.mount("#app");

// Set CSRF token for axios requests
axios.defaults.headers.common["X-CSRF-TOKEN"] = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

// Function to handle Google Login response (optional, for client-side)
const handleGoogleLogin = async (token) => {
    try {
        // Send the token to backend for verification
        const response = await axios.post("/api/auth/google", { token });

        // Handle response (e.g., store the user and token)
        localStorage.setItem("user", JSON.stringify(response.data.user));
        localStorage.setItem("token", response.data.token);

        console.log("Google Login Success:", response.data);

        // Hide Google login button after success
        document.getElementById("google-login-btn").style.display = "none";
    } catch (error) {
        console.error("Google Login Failed:", error);
    }
};

// Optionally, use the Google API client to handle OAuth flow (client-side)
// Note: Ensure you have the Google API client loaded in your Blade template
const initGoogleSignIn = () => {
    gapi.load("auth2", function () {
        gapi.auth2
            .init({
                client_id:
                    "357761183191-rltouh2uf30hjmfr4jfe3i5snsmp72jn.apps.googleusercontent.com", // Replace with your Google OAuth client ID
            })
            .then(() => {
                // Once gapi is initialized, check the sign-in status
                checkGoogleSignInStatus();
            });
    });
};

// Check if the user is already signed in and handle
const checkGoogleSignInStatus = async () => {
    const googleAuth = gapi.auth2.getAuthInstance();
    if (googleAuth.isSignedIn.get()) {
        const googleUser = googleAuth.currentUser.get();
        const idToken = googleUser.getAuthResponse().id_token;

        // Send the ID token to your backend to validate
        handleGoogleLogin(idToken);
    }
};

// Initialize Google Sign-In
window.onload = () => {
    initGoogleSignIn();
};
