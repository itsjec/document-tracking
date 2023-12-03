<template>
  <div class="container mt-5">
    <div class="row">
      <!-- Total Documents Card -->
      <div class="col-md-3">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title">Total Documents</h5>
            <p class="card-text">{{ totalDocuments }}</p>
          </div>
        </div>
      </div>

      <!-- Incoming Documents Card -->
      <div class="col-md-3">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title">Incoming Documents</h5>
            <p class="card-text">{{ incomingDocuments }}</p>
          </div>
        </div>
      </div>

      <!-- Outgoing Documents Card -->
      <div class="col-md-3">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title">Outgoing Documents</h5>
            <p class="card-text">{{ outgoingDocuments }}</p>
          </div>
        </div>
      </div>

      <!-- Pending Documents Card -->
      <div class="col-md-3">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title">Pending Documents</h5>
            <p class="card-text">{{ pendingDocuments }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Document Details Table -->
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title">Document Details</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Purpose</th>
                    <th>Location</th>
                    <th>Received From</th>
                    <th>Date Received</th>
                    <th>Required Action</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="document in documentList" :key="document.document_id">
                    <td>{{ document.title }}</td>
                    <td>{{ document.purpose }}</td>
                    <td>{{ document.location }}</td>
                    <td>{{ document.received_from }}</td>
                    <td>{{ document.date_received }}</td>
                    <td>{{ document.required_action }}</td>
                    <td>
                      <span :class="getStatusBadgeClass(document.status)">
                        {{ document.status }}
                      </span>
                    </td>
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
        const response = await axios.get('http://localhost:8080/getDocu');
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
