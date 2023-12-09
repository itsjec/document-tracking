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
              <h2 class="mb-0">5000</h2>
              <p class="text-danger ml-2 mb-0 font-weight-medium">+9</p>
            </div>
            <h6 class="text-muted font-weight-normal">2.5% Since last month</h6>
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
              <h2 class="mb-0">7500</h2>
              <p class="text-success ml-2 mb-0 font-weight-medium">+9</p>
            </div>
            <h6 class="text-muted font-weight-normal">8.2% Since last month</h6>
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
              <h2 class="mb-0">12000</h2>
              <p class="text-success ml-2 mb-0 font-weight-medium">+9</p>
            </div>
            <h6 class="text-muted font-weight-normal">15.3% Since last month</h6>
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
                <th>Purpose</th>
                <th>Date Registered</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Location</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="document in documentList" :key="document.document_id">
                <td>{{ document.TrackingNumber }}</td>
                <td>{{ document.Title }}</td>
                <td>{{ document.Author }}</td>
                <td>{{ document.Purpose }}</td>
                <td>{{ document.DateReceived }}</td>
                <td>
                  <span :class="getStatusBadgeClass(document.status)">
                    {{ document.Status }}
                  </span>
                </td>
                <td>{{ document.Progress }}</td>
                <td>{{ document.Location }}</td>
                <td>
                  <button @click="viewDocument(document)" class="btn btn-primary" data-toggle="modal" data-target="#viewDocumentModal">
                    View
                  </button>
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
  data() {
    return {
      documentList: [],
    };
  },
  created() {
    this.getDocumentList();
  },
  methods: {
    async getDocumentList() {
      try {
        const response = await axios.get('/getDocu');
        this.documentList = response.data;
      } catch (error) {
        console.error('Error fetching documents:', error);
      }
    },
    getStatusBadgeClass(status) {
      const badgeClasses = {
        'pending': 'badge badge-danger',
        'checked': 'badge badge-warning',
        'under reviewed': 'badge badge-info',
        'approved': 'badge badge-success',
      };
      return badgeClasses[status] || 'badge badge-secondary';
    },
    viewDocument(document) {
      // Implement logic to handle the view button click, e.g., show a modal or navigate to a new page
      console.log('View button clicked for document:', document);
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
