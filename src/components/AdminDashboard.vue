<template>
  <div class="container mt-5">
<div class="row">
  <!-- Pending Section -->
  <div class="col-sm-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h5>Pending</h5>
        <div class="row">
          <div class="col-8 col-sm-12 col-xl-8 my-auto">
            <div class="d-flex d-sm-block d-md-flex align-items-center">
              <h2 class="mb-0">3</h2>
              <p class="text-danger ml-2 mb-0 font-weight-medium">+9</p>
            </div>
            <h6 class="text-muted font-weight-normal">Approve New Documents</h6>
          </div>
          <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
            <i class="icon-lg mdi mdi-clock text-warning ml-auto"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- In Progress Section -->
  <div class="col-sm-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h5>In Progress</h5>
        <div class="row">
          <div class="col-8 col-sm-12 col-xl-8 my-auto">
            <div class="d-flex d-sm-block d-md-flex align-items-center">
              <h2 class="mb-0">15</h2>
              <p class="text-success ml-2 mb-0 font-weight-medium">+9</p>
            </div>
            <h6 class="text-muted font-weight-normal">Work on these documents !</h6>
          </div>
          <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
            <i class="icon-lg mdi mdi-refresh text-info ml-auto"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Completed Section -->
  <div class="col-sm-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h5>Completed</h5>
        <div class="row">
          <div class="col-8 col-sm-12 col-xl-8 my-auto">
            <div class="d-flex d-sm-block d-md-flex align-items-center">
              <h2 class="mb-0">26</h2>
              <p class="text-success ml-2 mb-0 font-weight-medium">+9</p>
            </div>
            <h6 class="text-muted font-weight-normal">Good Job !!</h6>
          </div>
          <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
            <i class="icon-lg mdi mdi-check text-success ml-auto"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <!-- Document Details Table -->
 <div class="row mt-4">
      <div class="col-md-12">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title">All Documents</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Tracking Number</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date Registered</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="document in documents" :key="document.DocumentID">
                    <td>{{ document.TrackingNumber }}</td>
                    <td>{{ document.Title }}</td>
                    <td>{{ document.Author }}</td>
                    <td>{{ document.DateReceived }}</td>
                    <td>
                      <span :class="getStatusBadgeClass(document.Status)">
                        {{ document.Status }}
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['officeID'],

  data() {
    return {
      documents: [],
      errorMessage: null,
      isConfirmationModalOpen: false,
      selectedDocument: null,
    };
  },

  mounted() {
    this.fetchDocuments();
  },

  methods: {
      async fetchDocuments() {
        try {
          const officeID = localStorage.getItem('office_id');
          console.log('OfficeID:', officeID);


          if (!officeID) {
            console.error('OfficeID not found in localStorage');
            return;
          }

          console.log('OfficeID:', officeID);

          const response = await axios.get(`/api/getDocumentsByOfficeID/${officeID}`);
          
          // Log response details for debugging
          console.log('Response Status:', response.status);
          console.log('Response Headers:', response.headers);
          console.log('Response Data:', response.data);

          // Check if the data is present
          if (response.data && response.data.length > 0) {
            this.documents = response.data;
          } else {
            console.warn('No documents found in the response.');
            this.errorMessage = 'No documents found.';
          }

          // Log the documents array to verify the data
          console.log('Documents:', this.documents);
        } catch (error) {
          console.error('Error fetching documents:', error);
          this.errorMessage = 'Error fetching documents. Please try again.';
        }
      },


    getStatusBadgeClass(status) {
      const badgeClasses = {
              'Pending': 'badge badge-danger',
              'In Progress': 'badge badge-info',
              'Completed': 'badge badge-success',
              'Deleted': 'badge badge-warning', // Add style for Deleted status
              'Sent Out of Office': 'badge badge-primary', // Add style for Sent Out of Office status
            };
      return badgeClasses[status] || 'badge badge-secondary';
    },
    viewDocument(document) {
      console.log('View button clicked for document:', document);
      // Implement your view document logic here
    },
  },
};
</script>




<style scoped>
.custom-card {
  background-color: #191c24 !important;
  color: #ffffff !important;
}
</style>
