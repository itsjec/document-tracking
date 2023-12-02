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
                    <!-- Sample Document Information -->
                    <tr>
                      <td>DOC2023-001</td>
                      <td> Invoice for Office Supplies</td>
                      <td>This document is an invoice from our<br>regular office supplies vendor for the<br>recent order placed to restock our<br>inventory.</td>
                      <td>Financial</td>
                      <td> XYZ Office Supplies</td>
                      <td> Finance Department</td>
                      <td>XYZ Office Supplies</td>
                      <td> February 10, 2023</td>
                      <td>Verify the items and quantities on the invoice.<br> Confirm the total amount due and schedule the<br>payment before the due date.</td>
                      <td>Pending</td>
                      <td>Forwarded to the Finance<br>Department for review and<br>processing.</td>
                    </tr>
                    <tr>
                      <td>DOC2023-002</td>
                      <td>Invoice for Office Supplies</td>
                      <td>This is a Purchase Order from our<br>supplier for the supply of office supplies<br>needed for the upcoming quarter.</td>
                      <td>Financial</td>
                      <td>ABC Office Supplies</td>
                      <td>Finance Department</td>
                      <td>ABC Office Supplies</td>
                      <td>January 15, 2023</td>
                      <td>Check the significance of the order and<br>ensure that it aligns with our requirements.<br>Confirm the amount and verify the arrival<br> time for the arrangement of the receipt.</td>
                      <td>Pending</td>
                      <td>The order has been sent to<br> the Finance Department<br> for confirmation and action.</td>
                    </tr>
                    <tr>
                      <td>INV2023001</td>
                      <td> Monthly Inventory Report</td>
                      <td>Report on the current status of inventory<br>for the month of January 2023.</td>
                      <td>Inventory</td>
                      <td>Warehouse Department</td>
                      <td>Main Warehouse</td>
                      <td>Warehouse Team</td>
                      <td>January 31, 2023</td>
                      <td>Review current inventory levels, identify low <br>stock items, and coordinate with procurement<br> for replenishment.</td>
                      <td>Pending</td>
                      <td>Under Review - Identified low<br> stock items; initiated commu-<br>nication with procurement for<br>replenishment.</td>
                    </tr>
                    <tr>
                      <td>CSR2023001</td>
                      <td>Quarterly Customer and<br> Sales Report</td>
                      <td>Report summarizing customer feedback<br>and sales performance for the first quarter<br> of 2023.</td>
                      <td>Sales and Customer <br>Feedback</td>
                      <td>Sales and Marketing<br> Department</td>
                      <td>Head Office</td>
                      <td>Sales Team</td>
                      <td>April 15, 2023</td>
                      <td>Analyze customer feedback, identify areas<br> for improvement, and develop strategies to<br>boost sales in underperforming segments.</td>
                      <td>In Progress</td>
                      <td>Currently analyzing customer<br>feedback data identified key<br>areas for improvement. Sales<br> team has been briefed, and<br>strategies are being<br> developed for implementation<br>in the next quarter.</td>
                    </tr>
                    <tr>
                      <td>HRR2023001</td>
                      <td>Monthly HR Performance<br>Report</td>
                      <td>Report on key human resources metrics<br> and performance indicators for the month<br> of March 2023.</td>
                      <td>Human Resources</td>
                      <td>HR Department</td>
                      <td>Corporate Office</td>
                      <td>HR Team</td>
                      <td>April 5, 2023</td>
                      <td> Review employee performance metrics,<br> identify areas for improvement, and<br> schedule performance discussions with<br> underperforming employees.</td>
                      <td>In Review</td>
                      <td>Currently reviewing employee<br>performance metrics;<br> identified areas for improvement<br>in the sales department.<br>Scheduled performance discu<br>ssions with relevant managers<br>and employees.</td>
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
  