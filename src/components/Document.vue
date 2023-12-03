<template>
  <div>
  <h1>hello</h1>
    <div>
        <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Add New Document</h4>
            <form @submit.prevent="submitForm" class="form-sample">
                <!-- Document Details -->
                <p class="card-description">Enter Document Details</p>

                <!-- Title Input -->
                <div class="form-group row">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-9">
                    <input v-model="formData.title" type="text" class="form-control" />
                </div>
                </div>

                <!-- Purpose Input -->
                <div class="form-group row">
                <label class="col-sm-3 col-form-label">Purpose</label>
                <div class="col-sm-9">
                    <input v-model="formData.purpose" type="text" class="form-control" />
                </div>
                </div>

                <!-- Location Dropdown -->
                <div class="form-group row">
                <label class="col-sm-3 col-form-label">Location</label>
                <div class="col-sm-9">
                    <select v-model="formData.location" class="form-control">
                    <option v-for="office in offices" :key="office.id">{{ office.office_name }}</option>
                    </select>
                </div>
                </div>

                <!-- Received From Input -->
                <div class="form-group row">
                <label class="col-sm-3 col-form-label">Received From</label>
                <div class="col-sm-9">
                    <input v-model="formData.received_from" type="text" class="form-control" />
                </div>
                </div>

                <!-- Date Received Input -->
                <div class="form-group row">
                <label class="col-sm-3 col-form-label">Date Received</label>
                <div class="col-sm-9">
                    <input v-model="formData.date_received" type="date" class="form-control" placeholder="dd/mm/yyyy" />
                </div>
                </div>

                <!-- Required Action Input -->
                <div class="form-group row">
                <label class="col-sm-3 col-form-label">Required Action</label>
                <div class="col-sm-9">
                    <input v-model="formData.required_action" type="text" class="form-control" />
                </div>
                </div>

                <!-- Status Dropdown -->
                <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select v-model="formData.status" class="form-control">
                    <option>pending</option>
                    <option>checked</option>
                    <option>under reviewed</option>
                    <option>approved</option>
                    <option>rejected</option>
                    </select>
                </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
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
      formData: {
        title: '',
        purpose: '',
        location: '',
        received_from: '',
        date_received: '',
        required_action: '',
        status: '',
      },
      offices: [],
    };
  },
  methods: {
    submitForm() {
    console.log('Form data:', this.formData);
        axios.post('/saveDocument', this.formData)
            .then(response => {
            console.log('Form data saved successfully:', response.data);
            this.$router.push('/admin');
            this.resetForm();
            })
            .catch(error => {
            console.error('Error saving form data:', error);
            });
    },
    fetchOffices() {
      axios.get('/getOffice')
        .then(response => {
          this.offices = response.data;
        })
        .catch(error => {
          console.error('Error fetching offices:', error);
        });
    },
    resetForm() {
      this.formData = {
        title: '',
        purpose: '',
        location: '',
        received_from: '',
        date_received: '',
        required_action: '',
        status: '',
      };
    },
  },
  created() {
    this.fetchOffices();
  },
};
</script>


<style scoped>
/* Add your custom styles here */
</style>
