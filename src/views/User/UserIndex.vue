<template>
  <div>
    <!-- Top Bar -->
    <div class="top-bar" style="background-color: #ffffff; color: #674188;">
      <!-- Logo -->
      <div class="logo">
        <!-- Replace the image source with your logo -->
        <img :src="require('@/assets/images/logocalapan2.png')" alt="Your Logo">
      </div>

      <!-- Title -->
      <div class="title">
        <h1 style="color: #674188;">City Hall Document Tracking</h1>
      </div>

      <!-- Navigation -->
      <div class="navigation">
        <router-link to="/user" style="color: #674188; margin-right: 60px;">Home</router-link>
        <router-link to="/useradd" style="color: #674188;  margin-right: 40px;">Add Document</router-link>
        <router-link to="/" style="color: #674188; margin-right: 20px;">Log In</router-link>
      </div>
    </div>

    <!-- Centered Search Bar -->
    <div class="centered-search" style="background-color: #C3ACD0;">
      <div class="search-bar">
        <input type="text" v-model="searchQuery" placeholder="Search..." style="background-color: #fff; color: #674188;">
        <button @click="search" style="background-color: #674188; color: #fff;">Search</button>
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
body {
  margin: 0;
}

.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
}

.logo img {
  max-height: 40px;
}

.title h1 {
  margin: 0;
  font-size: 1.5em;
}

.navigation {
  display: flex;
}

.navigation router-link {
  margin-right: 20px;
  text-decoration: none;
  font-size: 1em;
}

.centered-search {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background: url('@/assets/images/calafun.png') center center fixed;
  background-size: cover;
}

.search-bar {
  display: flex;
  align-items: center;
  margin-bottom: -100px;
}

.search-bar input {
  padding: 7px;
  font-size: 1em;
  margin-right: 8px;
  border: none;
  padding-left: 100px;
  padding-right: 100px;
}

.search-bar button {
  padding: 8px 16px;
  font-size: 1em;
  border: none;
  cursor: pointer;
}
</style>
