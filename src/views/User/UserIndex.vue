<template>
	<div>
	  <!-- Top Bar -->
	  <div class="top-bar">
		<!-- Logo -->
		<div class="logo">
		  <!-- Replace the image source with your logo -->
		  <img :src="require('@/assets/images/logocalapan2.png')" alt="Your Logo">
		</div>
  
		<!-- Title -->
		<div class="title">
		  <h1>City Hall Document Tracking</h1>
		</div>
  
		<!-- Navigation -->
		<div class="navigation">
		  <router-link to="/user">Home</router-link>
		  <router-link to="/useradd">Add Document</router-link>
		  <router-link to="/">Log In</router-link>
		</div>
	  </div>
  
	  <!-- Centered Search Bar -->
	  <div class="centered-search">
		<div class="search-bar">
		  <input type="text" v-model="searchQuery" placeholder="Search...">
		  <button @click="search">Search</button>
		</div>
	  </div>
	</div>
  </template>
  
  <script>
  export default {
	data() {
	  return {
		searchQuery: '',
	  };
	},
	methods: {
	  search() {
		// Implement your search logic here
		console.log('Searching for:', this.searchQuery);
	  },
	},
  };
  </script>
  
  <style scoped>
  .top-bar {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 10px 20px;
	background-color: #333;
	color: #fff;
  }
  
  .logo img {
	max-height: 40px;
  }
  
  .title h1 {
	margin: 0;
	font-size: 1.5em;
	color: #fff;
  }
  
  .navigation {
	display: flex;
  }
  
  .navigation router-link {
	margin-right: 20px;
	color: #fff;
	text-decoration: none;
	font-size: 1em;
  }
  
  .navigation router-link:hover {
	text-decoration: underline;
  }
  
  .centered-search {
	display: flex;
	align-items: center;
	justify-content: center;
	height: 100vh; /* Full height of the viewport */
  }
  
  .search-bar {
	display: flex;
	align-items: center;
  }
  
  .search-bar input {
	padding: 8px;
	font-size: 1em;
	margin-right: 8px;
  }
  
  .search-bar button {
	padding: 8px 16px;
	font-size: 1em;
	background-color: #380b55; /* Green color, change as needed */
	color: #fff;
	border: none;
	cursor: pointer;
  }
  
  .search-bar button:hover {
	background-color: #380b55; /* Darker green color, change as needed */
  }
  </style>
  