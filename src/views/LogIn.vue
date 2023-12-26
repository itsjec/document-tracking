<template>
  <body>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Top Bar -->
    <div class="top-bar" style="background-color: #ffffff; color: #674188;">
      <!-- Logo -->
      <div class="logo">
        <!-- Replace the image source with your logo -->
        <img :src="require('@/assets/images/logocalapan2.png')" alt="Your Logo">
      </div>

      <!-- Navigation -->
      <div class="navigation">
        <router-link to="/user" style="color: #674188; margin-right: 60px;">Home</router-link>
        <router-link to="/useradd" style="color: #674188; margin-right: 50px;">Add Document</router-link>
        <router-link to="/" style="color: #674188; margin-right: 25px;">Log In</router-link>
      </div>
    </div>

    <div class="login-container">
      <div class="login-form">
        <form @submit.prevent="login">
          <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
          <h4 class="modal-title">Admin Login</h4>
          <div class="form-group">
            <label for="username">Username:</label>
            <input v-model="formData.username" type="text" class="form-control" placeholder="Enter your username" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input v-model="formData.password" type="password" class="form-control" placeholder="Enter your password" required>
          </div>
          <div class="form-group small clearfix">
            <label class="form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="forgot-link">Forgot Password?</a>
          </div>
          <button type="submit" class="btn btn-primary btn-block btn-lg" @click ="login">Log In</button>
        </form>
        <div class="text-center small">Don't have an account? <a href="#">Sign up</a></div>
      </div>
    </div>
  </body>
</template>

<script>
  import axios from 'axios';
  
  export default {
	data() {
	  return {
		formData: {
		  username: '',
		  password: '',
		},
	  };
	},
	methods: {
		async login() {
      try {
        const response = await axios.post('api/login', this.formData);
        const token = response.data.token;
        const decodedToken = this.decodeToken(token);
        const officeId = decodedToken.office_id;

        if (!token || !officeId) {
          console.error('Token or Office ID not found in the response');
          return;
        }

        localStorage.setItem('token', token);
        localStorage.setItem('office_id', officeId);

        this.$router.push('/admin');
      } catch (error) {
        console.error('Login failed:', error);
      }
    },

    decodeToken(token) {
      const base64Url = token.split('.')[1];
      const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
      const decoded = JSON.parse(atob(base64));
      return decoded;
    },
  },
};
</script>

<style>
  .login-container {
    /* Adapted background image */
    background: url('@/assets/images/plain.png') center center fixed;
    height: 100vh;
  }

  /* Adapted styles for top bar and navigation */
  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
  }

  .logo img {
    max-height: 40px;
  }

  .navigation {
    display: flex;
  }

  .navigation router-link {
    margin-right: 20px;
    text-decoration: none;
    font-size: 1em;
  }

  /* Adapted styles for form elements */
  .form-control {
    box-shadow: none;
    border-color: #070707;
  }

  .form-control:focus {
    border-color: #674188;
  }

  .login-form {
    width: 350px;
    margin: 0 auto;
    padding: 30px 0;
  }

  .login-form form {
    color: #434343;
    border-radius: 1px;
    margin-bottom: 15px;
    background: #fff;
    border: 1px solid #f3f3f3;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
  }

  .login-form h4 {
    text-align: center;
    font-size: 22px;
    margin-bottom: 20px;
  }

  .login-form .avatar {
    color: #fff;
    margin: 0 auto 30px;
    text-align: center;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    z-index: 9;
    background: #674188;
    padding: 15px;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
  }

  .login-form .avatar i {
    font-size: 62px;
  }

  .login-form .form-group {
    margin-bottom: 20px;
  }

  .login-form .form-control,
  .login-form .btn {
    min-height: 40px;
    border-radius: 2px;
    transition: all 0.5s;
    background-color: transparent;
    color: black;
  }

  .login-form .btn,
  .login-form .btn:active {
    background: #674188 !important;
    border: none;
    line-height: normal;
  }

  .login-form .btn:hover,
  .login-form .btn:focus {
    background: rgba(178, 42, 180, 0.933) !important;
  }

  .login-form .checkbox-inline {
    float: left;
  }

  .login-form input[type="checkbox"] {
    position: relative;
    top: 2px;
  }

  .login-form .forgot-link {
    float: right;
  }

  .login-form .small {
    font-size: 13px;
    color: black;
  }

  .login-form a {
    color: black;
  }
</style>
