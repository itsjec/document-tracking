<template>
	<div class="login-form">
	  <h2 class="text-center">Admin Login</h2>
	  <form @submit.prevent="login">
		<div class="avatar">
		  <img :src="require('@/assets/images/avatar.png')" alt="Avatar">
		</div>
		<div class="form-group">
		  <label for="username">Username:</label>
		  <input v-model="formData.username" type="text" class="form-control input-lg" id="username" placeholder="Enter your username" required>
		</div>
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
			console.log('Login method triggered');
			console.log('FormData:', this.formData);

			try {
			const response = await this.$axios.post('/api/login', {
				username: this.formData.username,
				password: this.formData.password,
			});

			console.log('Response:', response);

			if (response.data.success) {
				this.$router.push(`/admin/${response.data.officeId}`);
			} else {
				console.error('Login failed');
			}
			} catch (error) {
			console.error('Error during login:', error);
			}
		},
	}
  };
  </script>
  

<style>
body {
	color: #4e4e4e;
	background: #6c15a2;
	font-family: 'Roboto', sans-serif;
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
.form-control, .btn {        
	border-radius: 2px;
}
.login-form {
	width: 380px;
	margin: 0 auto;
}
.login-form h2 {
	margin: 0;
	padding: 30px 0;
	font-size: 34px;
}
.login-form .avatar {
	margin: 0 auto 30px;
	width: 100px;
	height: 100px;
	border-radius: 50%;
	z-index: 9;
	background: #683d99;
	padding: 15px;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar img {
	width: 100%;
}
.login-form form {
	color: #7a7a7a;
	border-radius: 4px;
	margin-bottom: 20px;
	background: #fff;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;		
}
.login-form .btn, .login-form .btn:active {
	font-size: 16px;
	line-height: 26px;
	min-width: 120px;
	font-weight: bold;
	background: #683d99 !important;
	border: none;		
}
.login-form .btn:hover, .login-form .btn:focus{
	background: #40aa65 !important;
}
.form-check-label {
	margin-top: 9px;
}
.form-check-label input {
	margin-top: 3px;
}
.login-form a {
	color: #683d99;
}	
.login-form a:hover {
	text-decoration: underline;
}
.hint-text {
	color: #999;
	text-align: center;
	padding-bottom: 15px;
}

</style>
