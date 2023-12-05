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
                  <input v-model="formData.username" type="text" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input v-model="formData.password" type="password" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input v-model="formData.confirmPassword" type="password" class="form-control p_input">
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
import axios from 'axios';

export default {
  name: 'Register',
  data() {
    return {
      formData: {
        username: '',
        password: '',
        confirmPassword: '',
      },
      message: '',
      error: '',
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post('http://localhost:8080/api/main/register', {
          username: this.formData.username,
          password: this.formData.password,
          confirm_password: this.formData.confirmPassword,
        });

        console.log(response); // Log the entire response for debugging

        if (response.status === 201) {
          console.log(response.data.message);
          this.message = response.data.message;
          // Redirect to login page or any other page
          this.$router.push('/');
        } else {
          console.error(response.data);
          this.error = 'Unexpected response format';
        }
      } catch (error) {
        console.error('Error during registration:', error);

        if (error.response && error.response.data) {
          console.error('Server responded with:', error.response.data);
          this.error = error.response.data.error || 'Unexpected server error';
        } else {
          console.error('Unexpected error format:', error);
          this.error = 'Unexpected error format';
        }
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