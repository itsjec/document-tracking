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
        <router-link to="/useradd" style="color: #674188;  margin-right: 50px;">Add Document</router-link>
        <router-link to="/" style="color: #674188; margin-right: 25px;">Log In</router-link>
      </div>
    </div>
      <!-- Centered Form -->
      <div class="centered-form">
        <div class="centered-search" style="background-color: #772ba3;"></div>
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card" style="background-image: url('@/assets/images/hoo.png');">
            <div class="card-body">
              <h4 class="card-title">REGISTER YOUR DOCUMENTS</h4>
              <p class="card-description">Enter document details below</p>
              <form @submit.prevent="submitDocument">
              
                <!-- Title -->
                <div class="form-group row">
                  <label for="exampleInputTitle" class="col-sm-3 col-form-label">Title</label>
                  <div class="col-sm-9">
                    <input v-model="formData.title" type="text" class="form-control" id="exampleInputTitle" placeholder="Title" required>
                  </div>
                </div>
                <!-- Author -->
                <div class="form-group row">
                  <label for="exampleInputAuthor" class="col-sm-3 col-form-label">Author</label>
                  <div class="col-sm-9">
                    <input v-model="formData.author" type="text" class="form-control" id="exampleInputAuthor" placeholder="Author" required>
                  </div>
                </div>
                <!-- Purpose -->
                <div class="form-group row">
                  <label for="exampleInputPurpose" class="col-sm-3 col-form-label">Purpose</label>
                  <div class="col-sm-9">
                    <textarea v-model="formData.purpose" class="form-control" id="exampleInputPurpose" placeholder="Purpose" required></textarea>
                  </div>
                </div>
                <!-- Date Received -->
                <div class="form-group row">
                  <label for="exampleInputDateReceived" class="col-sm-3 col-form-label">Date Received</label>
                  <div class="col-sm-9">
                    <input v-model="formData.dateReceived" type="date" class="form-control" id="exampleInputDateReceived" required>
                  </div>
                </div>
                <!-- Receiving Office -->
                <div class="form-group row">
                  <label for="exampleInputReceivingOffice" class="col-sm-3 col-form-label">Receiving Office</label>
                    <select v-model="formData.Location" class="form-control" id="newLocation">
                      <option v-for="office in offices" :key="office.OfficeID" :value="office">{{ office.OfficeName }}</option>
                    </select>
                  </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-dark">Cancel</button>
              </form>
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
      offices: [],
      formData: {
        title: '',
        author: '',
        purpose: '',
        dateReceived: '',
        Location: null,
      },
      trackingNumber: '',
    };
  },
  created() {
    this.getOffices();
  },
  methods: {
    async getOffices() {
      try {
        const response = await axios.get('/getData');
        this.offices = response.data;
      } catch (error) {
        console.error('Error fetching offices:', error);
      }
    },
    async submitDocument() {
      try {
        const response = await axios.post('/api/documents/insert', this.formData);
        console.log(response.data); // Log the API response

        if (response.data.success) {
          console.log(response.data.message);
          this.$router.push('/usertracking');
        } else {
          console.error('Document insertion failed');
        }
      } catch (error) {
        console.error('Error during document insertion:', error);
      }
    },
  },
};
</script>

  <style scoped>
  /* Your existing styles */
  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #ffffff;
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
  
  .centered-form {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .centered-form {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-image: url('@/assets/images/calap.png');
  background-size: cover;
  }
  </style>
  