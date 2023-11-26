<template>
<div class="main-container">
    <div class="bottom-section">
      <div class="left-column">

        <InternalNavBar></InternalNavBar>
      </div>
      <div class="right-column">

      </div>
    </div>
  </div>
</template>

<script>
import AdminNavBar from '@/components/AdminNavBar.vue';
import InternalNavBar from '@/components/InternalNavBar.vue';


export default {
  components: {
    AdminNavBar,
    InternalNavBar,

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
  width: 260px; 
  padding: 20px;
}

.right-column {
  flex: 1;
  padding: 20px;
}

</style>
