<template>
	<div class="login-form">
	  <!-- Banner Image -->
	  <img src="@/assets/images/calapan.jpg" alt="Background Image" class="banner-image">
  
	  <h2 class="text-center"></h2>
	  <form @submit.prevent="login">
		<div class="form-group">
		  <label for="username">Admin Login</label>
		</div>
		<div class="form-group">
		  <label for="username">Username:</label>
		  <input v-model="formData.username" type="text" class="form-control input-lg" id="username" placeholder="Enter your username" required>
		</div>
		<div class="centered-form"></div>
		<div class="form-group">
		  <label for="password">Password:</label>
		  <input v-model="formData.password" type="password" class="form-control input-lg" id="password" placeholder="Enter your password" required>
		</div>
		<div class="form-group clearfix">
		  <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
		  <button type="submit" class="btn btn-primary btn-lg float-right">Sign in</button>
		</div>
	  </form>
	</div>
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
        const response = await axios.post('http://document-tracking.test/api/login', this.formData);
        const token = response.data.token;
        const officeId = response.data.office_id;

        if (!token || !officeId) {
          console.error('Token or Office ID not found in the response');
          return;
        }

        localStorage.setItem('token', token);
        localStorage.setItem('office_id', officeId);

        const decodedToken = this.decodeToken(token);

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
  body {
	color: #ffffff;
	background: #ffffff; /* Change this to white (#ffffff) */
	font-family: 'Roboto', sans-serif;
	margin: 0;
	overflow-x: hidden;
  }
  
  .banner-image {
	width: 100%;
	height: auto;
	position: absolute;
	top: 0;
	left: 0;
	z-index: -1;
  }
  
  .login-form form {
	position: relative;
	z-index: 1;
  }
  
  .login-form {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80%; /* Adjust the width as needed */
  max-width: 400px; /* Set a maximum width to prevent the form from becoming too wide */
  padding: 20px;
  background-color: rgba(255, 255, 255, 255); /* Semi-transparent background */
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}
  
  .login-form h2 {
	margin: 0;
	font-size: 34px;
	text-align: center;
	padding-bottom: 170px;
  }
  
  .form-group {
	margin-bottom: 15px;
  }
  
  /* Update font color for labels */
  .form-group label {
	color: #5e17eb; /* Change the font color to purple */
  }
  
  .form-control {
	font-size: 16px;
	border-color: transparent;
	box-shadow: none !important;
  }
  
  .form-control:focus {
	border-color: #91d5a8;
	background: #e9f5ee;
  }
  
  .btn {
	font-size: 16px;
	line-height: 26px;
	min-width: 120px;
	font-weight: bold;
  }
  
  .btn-primary {
	background: #683d99 !important;
	border: none;
  }
  
  .btn-primary:hover,
  .btn-primary:focus {
	background: #40aa65 !important;
  }
  
  .form-check-label {
	margin-top: 9px;
	color: #5e17eb;
  }
  
  .form-check-label input {
	margin-top: 10px;
  }
  
  </style>