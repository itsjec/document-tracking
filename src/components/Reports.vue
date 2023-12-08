<template>
    <div class="container mt-5">
      <!-- Document Details Table -->
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card custom-card">
            <div class="card-body">
              <h5 class="card-title">Outgoing Report</h5>
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
                      <th>Date Confirmed</th>
                      <th>Subject</th>
                      <th>Confirmation Details</th>
                      <!-- Add more columns as needed -->
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Sample Document Information -->
                    <tr>
                      <td>DOC2023-001</td>
                      <td>Confirmation of <br>Invoice Receipt</td>
                      <td>This document serves as confirmation<br>of the receipt of the Invoice for Office<br> Supplies (Document ID: DOC2023-001)<br> from XYZ Office Supplies. The Finance<br>Department has initiated the necessary<br>actions.</td>
                      <td>Confirmation</td>
                      <td>MIS</td>
                      <td>Finance <br>Department</td>
                      <td>February 15, 2023</td>
                      <td> Confirmation of Invoice Receipt<br> (Document ID: DOC2023-001)</td>
                      <td>Confirmation Number: CONF2023-001<br> Date of Confirmation: February 15, 2023</td>
                    </tr>
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
  