<template>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">Login</h3>
              <form @submit.prevent="login">
                <div class="form-group">
                  <label>Username or email *</label>
                  <input v-model="usernameOrEmail" type="text" class="form-control p_input">
                </div>
                <div class="form-group">
                  <label>Password *</label>
                  <input v-model="password" type="password" class="form-control p_input">
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input"> Remember me </label>
                  </div>
                  <a href="#" class="forgot-pass">Forgot password</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                </div>
                <div class="d-flex">
                  <button class="btn btn-facebook mr-2 col">
                    <i class="mdi mdi-facebook"></i> Facebook
                  </button>
                  <button class="btn btn-google col">
                    <i class="mdi mdi-google-plus"></i> Google plus
                  </button>
                </div>
                <p class="sign-up">Don't have an Account?<router-link to="/register"> Sign Up</router-link></p>
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
  data() {
    return {
      usernameOrEmail: '',
      password: '',
    };
  },
  methods: {
    async login() {
      try {
        // Validate input
        if (!this.usernameOrEmail || !this.password) {
          console.error('Invalid input');
          return;
        }

        const response = await axios.post('http://localhost:8080/api/main/login', {
          usernameOrEmail: this.usernameOrEmail,
          password: this.password,
        });

        if (response.status === 200) {
          const userRole = response.data.role;

          switch (userRole) {
            case 'admin':
              this.$router.push('/admin');
              break;
            case 'office':
              this.$router.push('/internal');
              break;
            case 'client':
              this.$router.push('/user');
              break;
            default:
              console.error('Unknown user role:', userRole);
          }
        } else {
          console.error('Login failed:', response.data.message);
        }
      } catch (error) {
        console.error('Error during login:', error);
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
