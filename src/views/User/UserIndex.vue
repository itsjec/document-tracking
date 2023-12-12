<template>
  <div>
    <div class="top-bar">
      <div class="logo">
        <img :src="require('@/assets/images/logocalapan2.png')" alt="Your Logo">
      </div>
      <div class="title">
        <h1>City Hall Document Tracking</h1>
      </div>
      <div class="navigation">
        <router-link to="/user" style="color: #674188; margin-right: 60px;">Home</router-link>
        <router-link to="/useradd" style="color: #674188;  margin-right: 40px;">Add Document</router-link>
        <router-link to="/" style="color: #674188; margin-right: 20px;">Log In</router-link>
      </div>
    </div>

    <div class="centered-search" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh;">
    <!-- Welcome Section -->
      <div>
        <h1 style="font-size: 50px; color: #2c2e2c; margin-bottom: 20px;">
          Welcome to City Hall Document Tracking Website!
        </h1>
        <h3 style="font-size: 24px; color: #2c2e2c; margin-bottom: 20px;">
          Please enter your document tracking number to proceed...
        </h3>
      </div>

      <!-- Search Bar -->
      <div class="search-bar" style="display: flex; align-items: center; justify-content: center; margin-top: 20px;">
        <input
          type="text"
          v-model="searchQuery"
          placeholder="Enter Document Tracking Number.."
          style="background-color: #fff; color: #674188; padding: 15px; font-size: 18px; width: 600px; border: 2px solid #674188; border-radius: 8px;"
        />
        <button
          @click="searchAndDisplay"
          style="background-color: #674188; color: #fff; padding: 15px; font-size: 18px; margin-left: 10px; border: none; border-radius: 8px; cursor: pointer;"
        >
          Track Now
        </button>
      </div>
    </div>

      <div v-if="document" class="card mb-3">
        <div class="p-4 text-center text-white text-lg bg-dark rounded-top">
          <span class="text-uppercase">{{ document.TrackingNumber }}</span>
        </div>
        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
          <div class="w-100 text-center py-1 px-2">
            <span class="text-medium">Current Office:</span> {{ document.Location || 'N/A' }}
          </div>
          <div class="w-100 text-center py-1 px-2">
            <span class="text-medium">Status:</span> {{ document.Status || 'N/A' }}
          </div>
          <div class="w-100 text-center py-1 px-2">
            <span class="text-medium">Date Received:</span> {{ formatDate(document.DateReceived) }}
          </div>
        </div>

        <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
          <div v-for="(step, index) in dynamicSteps" :key="index" :class="{ 'step': true, 'completed': index < currentStep }">
            <div class="step-icon-wrap">
              <!-- Include icons based on the step title -->
              <div class="step-icon" v-if="step.title === 'Document Registered'"><i class="pe-7s-check"></i></div>
              <div class="step-icon" v-if="step.title === 'Approved'"><i class="pe-7s-check-circle"></i></div>
              <div class="step-icon" v-if="step.title === 'Processing Document'"><i class="pe-7s-tools"></i></div>
              <div class="step-icon" v-if="step.title === 'Document Confirmation'"><i class="pe-7s-news-paper"></i></div>
              <div class="step-icon" v-if="step.title === 'Document Completed'"><i class="pe-7s-check"></i></div>
            </div>
            <h4 class="step-title">{{ step.title }}</h4>
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
      searchQuery: '',
      document: null,
      dynamicSteps: [],
      currentStep: 0,
    };
  },
  methods: {
    async searchAndDisplay() {
      try {
        const response = await axios.get(`/api/searchDocumentByTrackingNumber/${this.searchQuery}`);
        if (response.data) {
          this.document = response.data;
          this.updateDynamicSteps(this.document);
        } else {
          // Handle case when document is not found
          console.log('Document not found');
          this.document = null;
          this.dynamicSteps = [];
          this.currentStep = 0;
        }
      } catch (error) {
        console.error('Error fetching document:', error);
      }
    },
    updateDynamicSteps(document) {
      // Clear dynamic steps
      this.dynamicSteps = [];

      // Define steps based on the document status
      switch (document.Status) {
        case 'Pending':
          this.dynamicSteps = [
            { title: 'Document Registered' },
            { title: 'Approved' },
            { title: 'Processing Document' },
            { title: 'Document Completed' },
          ];
          this.currentStep = 2; // Set the current step index
          break;
        case 'In Progress':
          this.dynamicSteps = [
            { title: 'Document Registered' },
            { title: 'Approved' },
            { title: 'Processing Document' },
            { title: 'Document Completed' },
          ];
          this.currentStep = 3; // Set the current step index
          break;
        case 'Completed':
          this.dynamicSteps = [
            { title: 'Document Registered' },
            { title: 'Approved' },
            { title: 'Document Completed' },
          ];
          this.currentStep = 2; // Set the current step index
          break;
        default:
          // Handle other cases if needed
          this.dynamicSteps = [];
          this.currentStep = 0;
          break;
      }
    },
    formatDate(date) {
      // Implement the date formatting logic here if needed
      return date;
    },
  },
};
</script>

<style scoped>
/* ... (previous styles) ... */

.stepper-container {
  margin-top: 20px;
}

.stepper {
  display: flex;
  justify-content: space-between;
}

.step {
  flex: 1;
  text-align: center;
}

.completed .step-title {
  color: #674188; /* Color for completed steps */
}

.step-icon {
  font-size: 24px;
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
  background: url('@/assets/images/Mindoro.png') center center fixed;
  background-size: cover;
}

body{margin-top:20px;
    background-color: #ffffff !important;}

.steps .step {
    display: block;
    width: 100%;
    margin-bottom: 35px;
    text-align: center
}

.container {
    padding-top: 100px;
    max-width: 1000px; /* Adjust as needed */
}

.steps .step .step-icon-wrap {
    display: block;
    position: relative;
    width: 100%;
    height: 80px;
    text-align: center
}

.steps .step .step-icon-wrap::before,
.steps .step .step-icon-wrap::after {
    display: block;
    position: absolute;
    top: 50%;
    width: 50%;
    height: 3px;
    margin-top: -1px;
    background-color: #e1e7ec;
    content: '';
    z-index: 1
}

.steps .step .step-icon-wrap::before {
    left: 0
}

.steps .step .step-icon-wrap::after {
    right: 0
}

.steps .step .step-icon {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    border: 1px solid #e1e7ec;
    border-radius: 50%;
    background-color: #f5f5f5;
    color: #374250;
    font-size: 38px;
    line-height: 81px;
    z-index: 5
}

.steps .step .step-title {
    margin-top: 16px;
    margin-bottom: 0;
    color: #606975;
    font-size: 14px;
    font-weight: 500
}

.steps .step:first-child .step-icon-wrap::before {
    display: none
}

.steps .step:last-child .step-icon-wrap::after {
    display: none
}

.steps .step.completed .step-icon-wrap::before,
.steps .step.completed .step-icon-wrap::after {
    background-color: #0da9ef
}

.steps .step.completed .step-icon {
    border-color: #0da9ef;
    background-color: #0da9ef;
    color: #fff
}

@media (max-width: 576px) {
    .flex-sm-nowrap .step .step-icon-wrap::before,
    .flex-sm-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 768px) {
    .flex-md-nowrap .step .step-icon-wrap::before,
    .flex-md-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 991px) {
    .flex-lg-nowrap .step .step-icon-wrap::before,
    .flex-lg-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

@media (max-width: 1200px) {
    .flex-xl-nowrap .step .step-icon-wrap::before,
    .flex-xl-nowrap .step .step-icon-wrap::after {
        display: none
    }
}

.bg-faded, .bg-secondary {
    background-color: #f5f5f5 !important;
}

/* ... (additional styles if needed) ... */
</style>
