<template>
            <div class="page-header">
              <h3 class="page-title"> Pending Documents </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Admin</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Pending Documents</li>
                </ol>
              </nav>
            </div>
 <!-- Document Details Table -->
<div class="row mt-4">
  <div class="col-md-12">
    <div class="card custom-card">
      <div class="card-body">
        <h5 class="card-title">Pending Documents</h5>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Tracking Number</th>
                <th>Title</th>
                <th>Author</th>
                <th>Location</th>
                <th>Status</th>
                <th>OfficeID</th>
                <th>Action Needed</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="document in documentList" :key="document.document_id">
                <td>{{ document.tracking_number }}</td>
                <td>{{ document.title }}</td>
                <td>{{ document.author }}</td>
                <td>{{ document.location }}</td>
                <td>
                  <span :class="getStatusBadgeClass(document.status)">
                    {{ document.status }}
                  </span>
                </td>
                <td>{{ document.office_id }}</td>
                <td>{{ document.action_needed }}</td>
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
</template>

<script>
export default {
  data() {
    return {
      documentList: [], // Your document data will go here
    };
  },
  methods: {
    getStatusBadgeClass(status) {
      // Your existing logic for getting the status badge class
    },
    viewDocument(document) {
      // Your logic for handling the view button click
      console.log('View button clicked for document:', document);
    },
  },
  created() {
    // Fetch document data when the component is created
    this.getDocumentList();
  },
  methods: {
    async getDocumentList() {
      // Your logic for fetching the document list
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
