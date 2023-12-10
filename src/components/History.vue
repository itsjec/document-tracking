<template>
  <div class="container mt-5">
    <!-- Document Details Table -->
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card custom-card">
          <div class="card-body">
            <h5 class="card-title">History Documents</h5>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Document ID</th>
                    <th>Step ID</th>
                    <th>Date Started</th>
                    <th>Date Completed</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    
                  </tr>
                  <tr v-for="(document, index) in documentList" :key="index">
                    <td>{{ document.documentID }}</td>
                    <td>{{ document.stepid }}</td>
                    <td>{{ document.datestarted }}</td>
                    <td>{{ document.datecompleted }}</td>
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
