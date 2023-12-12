<template>
  <div class="container mt-5">
    <!-- Document Details Table -->
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title">Recent Completed Documents</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Tracking Number</th>
                    <th>Status</th>
                    <th>Date Started</th>
                    <th>Date Completed</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="document in documents" :key="document.DocumentID">
                    <td>{{ document.TrackingNumber }}</td>
                    <td>
                     <span :class="getStatusBadgeClass(document.Status)">
                       {{ document.Status }}
                     </span>
                   </td>
                    <td>{{ document.DateReceived }}</td>
                    <td>{{ document.DateCompleted }}</td>
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
        };
      },

      mounted() {
        this.fetchDocuments();
      },

      methods: {
        async fetchDocuments() {
          try {
            const officeID = this.officeID || localStorage.getItem('office_id');
            
            if (!officeID) {
              console.error('OfficeID not found in localStorage');
              return;
            }

            const response = await axios.get(`/api/getHistoryDocumentsByOfficeID/${officeID}`);
            
            console.log('Response Status:', response.status);
            console.log('Response Headers:', response.headers);
            console.log('Response Data:', response.data);

            if (response.data && response.data.length > 0) {
              this.documents = response.data.filter(
                  doc => doc.Status === 'Deleted' || doc.Status === 'Sent Out of Office'
                );
            } else {
              console.warn('No pending documents found in the response.');
              this.errorMessage = 'No pending documents found.';
            }

            console.log('Pending Documents:', this.documents);
          } catch (error) {
            console.error('Error fetching pending documents:', error);
            this.errorMessage = 'Error fetching pending documents. Please try again.';
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
  },
};
</script>

<style scoped>
.custom-card {
  background-color: #191c24 !important;
  color: #ffffff !important;
}
</style>
