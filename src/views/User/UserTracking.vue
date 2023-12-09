<template>
    <div class="tracking-number-container">
      <h1 class="tracking-number">{{ trackingNumber }}</h1>
      <p>Your Document Tracking Number</p>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        trackingNumber: '129832947829891', // Replace with your actual tracking number
      };
    },
  };
  </script>
  
  <style scoped>
  .tracking-number-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh; /* Make the container full height of the viewport */
  }
  
  .tracking-number {
    font-size: 4em; /* Adjust the font size as needed */
    margin-bottom: 10px;
  }
  </style>
  