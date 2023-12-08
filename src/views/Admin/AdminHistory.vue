<template>
<div class="main-container">
    <div class="bottom-section">
      <div class="left-column">

        <AdminNavBar></AdminNavBar>
      </div>
      <div class="right-column">
        <AdminHistory></AdminHistory>
      </div>
    </div>
  </div>
</template>

<script>
import AdminNavBar from '@/components/AdminNavBar.vue';
import AdminDashboard from '@/components/AdminDashboard.vue';
import AdminHistory from '@/components/AdminHistory.vue';


export default {
  components: {
    AdminNavBar,
    AdminDashboard,
    AdminHistory
},
}
</script>

<style>

.main-container {
  display: flex;
  flex-direction: column;
}

.top-section {
  padding: 20px;
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
