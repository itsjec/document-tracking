<template>
    <div class="container mt-5">
      <!-- Document Details Table -->
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card custom-card">
            <div class="card-body">
              <h5 class="card-title">Incoming Details</h5>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Tracking Number</th>
                      <th>Location</th>
                      <th>Status</th>
                      <th>Office ID</th>
                      <th>Receiver Name</th>
                      <!-- Add more columns as needed -->
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Sample Document Information -->
                    <tr>
                      <td>DOC2023-001</td>
                      <td> Invoice for Office Supplies</td>
                      <td>This document is an invoice from our<br>regular office supplies vendor for the<br>recent order placed to restock our<br>inventory.</td>
                      <td>Financial</td>
                      <td> XYZ Office Supplies</td>
                    </tr>
                    <tr>
                      <td>DOC2023-002</td>
                      <td>Invoice for Office Supplies</td>
                      <td>This is a Purchase Order from our<br>supplier for the supply of office supplies<br>needed for the upcoming quarter.</td>
                      <td>Financial</td>
                      <td>ABC Office Supplies</td>
                    </tr>
                    <tr>
                      <td>INV2023001</td>
                      <td> Monthly Inventory Report</td>
                      <td>Report on the current status of inventory<br>for the month of January 2023.</td>
                      <td>Inventory</td>
                      <td>Warehouse Department</td>
                    </tr>
                    <tr>
                      <td>CSR2023001</td>
                      <td>Quarterly Customer and<br> Sales Report</td>
                      <td>Report summarizing customer feedback<br>and sales performance for the first quarter<br> of 2023.</td>
                      <td>Sales and Customer <br>Feedback</td>
                      <td>Sales and Marketing<br> Department</td>
                    </tr>
                    <tr>
                      <td>HRR2023001</td>
                      <td>Monthly HR Performance<br>Report</td>
                      <td>Report on key human resources metrics<br> and performance indicators for the month<br> of March 2023.</td>
                      <td>Human Resources</td>
                      <td>HR Department</td>
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
  