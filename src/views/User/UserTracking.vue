<template>
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
  </style>
  
  