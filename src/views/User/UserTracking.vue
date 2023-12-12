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
        <router-link to="/user" style="color: #674188; margin-right: 60px;">Home</router-link>
        <router-link to="/useradd" style="color: #674188;  margin-right: 40px;">Add Document</router-link>
        <router-link to="/" style="color: #674188; margin-right: 20px;">Log In</router-link>
      </div>
    </div>
    
    </div> 
    <div class="success-page">
      <h1>Your Document is already Registered!</h1>
  
      <!-- Display tracking number if available -->
      <div v-if="trackingNumber" class="tracking-section">
        <p class="tracking-number">{{ trackingNumber }}</p>
        <p class="note">Take a note of your document tracking number</p>
      </div>
  
      <router-link to="/user">Go Back to Home</router-link>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        trackingNumber: null,
      };
    },
    mounted() {
      // Fetch the last inserted tracking number
      this.fetchLastInsertedTrackingNumber();
    },
    methods: {
      async fetchLastInsertedTrackingNumber() {
        try {
          const response = await axios.get('/api/documents/last-inserted-tracking-number');
          console.log('Response:', response);
  
          // Assuming the API response has a 'TrackingNumber' property
          this.trackingNumber = response.data.TrackingNumber;
  
        } catch (error) {
          console.error('Error fetching last inserted tracking number:', error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .success-page {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh; /* Use 100% of the viewport height */
  }
  
  .tracking-section {
    margin-top: 20px;
    text-align: center; /* Center text within tracking-section */
  }
  
  .tracking-number {
    font-size: 65px; /* Adjust the font size as needed */
  }
  
  .note {
    font-size: 25px; /* Adjust the font size as needed */
  }
  body {
  margin: 0;
}

.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  background-color: white;
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
  
  