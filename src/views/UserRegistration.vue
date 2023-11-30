<template>
  <div class="container-scroller" :style="{ backgroundColor: '#343541' }">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Register</h3>
              <form @submit.prevent="register">
                <div class="form-group">
                  <label>Username</label>
                  <input v-model="username" type="text" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input v-model="password" type="password" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input v-model="confirmPassword" type="password" class="form-control p_input">
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input"> Remember me </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">Register</button>
                </div>
                <div v-if="message" class="mt-3 text-center text-success">
                  {{ message }}
                </div>
                <div v-if="error" class="mt-3 text-center text-danger">
                  {{ error }}
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: '',
      password: '',
      confirmPassword: '',
      message: '',
      error: '',
    };
  },
  methods: {
    async register() {
      const apiUrl = 'http://document-tracking.test/api/register';

      // Check if passwords match
      if (this.password !== this.confirmPassword) {
        this.error = 'Passwords do not match';
        return;
      }

      const formData = new FormData();
      formData.append('username', this.username);
      formData.append('password', this.password);

      try {
        const response = await fetch(apiUrl, {
          method: 'POST',
          body: formData,
        });

        if (response.ok) {
          // Registration successful
          this.message = 'Registration successful';
          this.error = ''; // Clear previous error message
        } else {
          // Registration failed
          this.error = 'Registration failed: ' + response.statusText;
          this.message = ''; // Clear previous success message
        }
      } catch (error) {
        console.error('Error during registration:', error);
        this.error = 'Error during registration';
        this.message = ''; // Clear previous success message
      }
    },
  },
};
</script>

<style scoped>
@import '@/assets/vendors/mdi/css/materialdesignicons.min.css';
@import '@/assets/vendors/css/vendor.bundle.base.css';
@import '@/assets/css/style.css';
</style>
