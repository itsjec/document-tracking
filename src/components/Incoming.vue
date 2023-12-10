<template>
  <div>
    <div class="page-header">
      <nav aria-label="breadcrumb">
      </nav>
    </div>

    <!-- Document Details Table -->
    <div class="row mt-2">
      <div class="col-md-12">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title">Document Details</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Tracking Number</th>
                    <th>Title</th>
                    <th>Purpose</th>
                    <th>Received From</th>
                    <th>Date Received</th>
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
                    <td>{{ document.Purpose }}</td>
                    <td>{{ document.Author }}</td>
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
                        Done
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
        const response = await axios.get('http://document-tracking.test/getDocu');
        this.documentList = response.data;
      } catch (error) {
        console.error('Error fetching documents:', error);
      }
    },
    getStatusBadgeClass(status) {
      const badgeClasses = {
        'Pending': 'badge badge-danger',
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
