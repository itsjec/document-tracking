<template>
    <div class="container mt-5">

<!-- Document Details Table -->
<div class="row mt-4">
     <div class="col-md-12">
       <div class="card custom-card">
         <div class="card-body">
           <h5 class="card-title">All Pending Documents</h5>
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
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                 <tr v-for="document in documents" :key="document.DocumentID">
                   <td>{{ document.TrackingNumber }}</td>
                   <td>{{ document.Title }}</td>
                   <td>{{ document.Author }}</td>
                   <td>{{ document.Purpose }}</td>
                   <td>{{ document.DateReceived }}</td>
                   <td>
                     <span :class="getStatusBadgeClass(document.Status)">
                       {{ document.Status }}
                     </span>
                   </td>
                   <td>
                     <button @click="openConfirmationModal(document)" class="btn btn-primary">
                       Approve
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

   <!-- Confirmation Modal -->
   <div v-if="isConfirmationModalOpen" class="modal-confirm" style="z-index: 1050; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title">Confirm Approval</h4>
           <button class="close" @click="closeConfirmationModal">&times;</button>
         </div>
         <div class="modal-body">
           <p>Are you sure you want to approve the document with Tracking Number {{ selectedDocument.TrackingNumber }}?</p>
         </div>
         <div class="modal-footer">
           <button class="btn btn-secondary" @click="closeConfirmationModal">Cancel</button>
           <button class="btn btn-danger" @click="approveDocument">Approve</button>
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
    openConfirmationModal(document) {
      this.selectedDocument = document;
      this.isConfirmationModalOpen = true;
    },

    closeConfirmationModal() {
      this.isConfirmationModalOpen = false;
    },

    async fetchDocuments() {
      try {
        const officeID = this.officeID || localStorage.getItem('office_id');

        if (!officeID) {
          console.error('OfficeID not found in localStorage');
          return;
        }

        const response = await axios.get(`/api/getPendingDocumentsByOfficeID/${officeID}`);

        if (response.data && response.data.length > 0) {
          this.documents = response.data;
        } else {
          console.warn('No documents found in the response.');
          this.errorMessage = 'No documents found.';
        }

        console.log('Updated Documents:', this.documents);
      } catch (error) {
        console.error('Error fetching documents:', error);
        this.errorMessage = 'Error fetching documents. Please try again.';
      }
    },

    async approveDocument() {
  try {
    // Check if the document is already in the desired status
    if (this.selectedDocument.Status === 'In Progress') {
      console.log('Document is already in progress. No need to approve.');
      return;
    }

    const response = await axios.put(`/api/approveDocument/${this.selectedDocument.DocumentID}`, {
      Status: 'In Progress',
    });

    if (response.status === 200) {
      console.log('Document approved:', this.selectedDocument);

      // Emit the custom event to notify the parent component
      this.$emit('documentApproved');
    } else {
      console.error('Failed to update document status:', response.data.error);

      // Handle the error in your application (e.g., display an error message)
    }
  } catch (error) {
    console.error('Error approving document:', error);

    // Handle the error in your application (e.g., display an error message)
  } finally {
    // Ensure the modal is closed
    this.closeConfirmationModal();

    // Refresh documents after approving
    this.fetchDocuments();
  }
},


    getStatusBadgeClass(status) {
      const badgeClasses = {
        'Pending': 'badge badge-danger',
        'In Progress': 'badge badge-info',
        'Completed': 'badge badge-success',
        'Deleted': 'badge badge-warning',
        'Sent Out of Office': 'badge badge-primary',
      };
      return badgeClasses[status] || 'badge badge-secondary';
    },
  },
};
</script>



<style scoped>
/* Your component-specific styles go here */

body {
  font-family: 'Varela Round', sans-serif !important;
}

.modal-confirm {		
  color: #ffffff !important;
  width: 400px !important;
}

.modal-confirm .modal-content {
  padding: 20px !important;
  border-radius: 5px !important;
  border: none !important;
  text-align: center !important;
  font-size: 14px !important;
}

.modal-confirm .modal-header {
  border-bottom: none !important;   
  position: relative !important;
}

.modal-confirm h4 {
  text-align: center !important;
  font-size: 26px !important;
  margin: 30px 0 -10px !important;
}

.modal-confirm .close {
  position: absolute !important;
  top: -5px !important;
  right: -2px !important;
}

.modal-confirm .modal-body {
  color: #ffffff !important;
}

.modal-confirm .modal-footer {
  border: none !important;
  text-align: center !important;		
  border-radius: 5px !important;
  font-size: 13px !important;
  padding: 10px 15px 25px !important;
}

.modal-confirm .modal-footer a {
  color: #999 !important;
}

.modal-confirm .icon-box {
  width: 80px !important;
  height: 80px !important;
  margin: 0 auto !important;
  border-radius: 50% !important;
  z-index: 9 !important;
  text-align: center !important;
  border: 3px solid #f15e5e !important;
}

.modal-confirm .icon-box i {
  color: #f15e5e !important;
  font-size: 46px !important;
  display: inline-block !important;
  margin-top: 13px !important;
}

.modal-confirm .btn, .modal-confirm .btn:active {
  color: #fff !important;
  border-radius: 4px !important;
  background: #60c7c1 !important;
  text-decoration: none !important;
  transition: all 0.4s !important;
  line-height: normal !important;
  min-width: 120px !important;
  border: none !important;
  min-height: 40px !important;
  border-radius: 3px !important;
  margin: 0 5px !important;
}

.modal-confirm .btn-secondary {
  background: #c1c1c1 !important;
}

.modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
  background: #a8a8a8 !important;
}

.modal-confirm .btn-danger {
  background: #f15e5e !important;
}

.modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
  background: #ee3535 !important;
}

.trigger-btn {
  display: inline-block !important;
  margin: 100px auto !important;
}

/* Additional component styles */
</style>
