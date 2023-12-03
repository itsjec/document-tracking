<template>
<div class="main-container">
    <div class="bottom-section">
      <div class="left-column">

        <AdminNavBar></AdminNavBar>
      </div>
      <div class="right-column">
        <Document></Document>
      </div>
    </div>
  </div>
</template>

<script>
import AdminNavBar from '@/components/AdminNavBar.vue';
import Document from '@/components/Document.vue';


export default {
  components: {
    AdminNavBar,
    Document,

  },
}
</script>

<style>

.main-container {
  display: flex;
  flex-direction: column;
}

.top-section {
  padding: 10px 20px 20px 20px; /* Adjust the top padding as needed */
  width: 80rem;
}

.bottom-section {
  display: flex;
}

.left-column {
  width: 250px;
  padding: 10px;
}

.right-column {
  flex: 1;
  padding: 10px;
}


</style>
