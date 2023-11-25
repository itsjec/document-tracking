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
                    <th>Document ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Sender</th>
                    <th>Location</th>
                    <th>Received From</th>
                    <th>Date Received</th>
                    <th>Required Action</th>
                    <th>Status</th>
                    <th>Action</th>
                    <!-- Add more columns as needed -->
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop through your data and populate the table rows -->
                  <tr v-for="(document, index) in documentList" :key="index">
                    <td>{{ document.documentID }}</td>
                    <td>{{ document.title }}</td>
                    <td>{{ document.description }}</td>
                    <td>{{ document.type }}</td>
                    <td>{{ document.sender }}</td>
                    <td>{{ document.location }}</td>
                    <td>{{ document.receivedFrom }}</td>
                    <td>{{ document.dateReceived }}</td>
                    <td>{{ document.requiredAction }}</td>
                    <td>{{ document.status }}</td>
                    <td>{{ document.action }}</td>
                    <!-- Add more columns as needed -->
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
export default {
  data() {
    return {
      totalDocuments: 150,
      incomingDocuments: 50,
      outgoingDocuments: 70,
      pendingDocuments: 30,
      documentList: [
        // Your array of documents here
      ],
    };
  },
};
</script>

<style scoped>
.custom-card {
  background-color: #191c24 !important;
  color: #ffffff !important;
}
</style>
