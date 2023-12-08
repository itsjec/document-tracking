<template>

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo" href="../admin">
        <div class="logo-container">
          <img :src="require('@/assets/images/logocalapan.png')" alt="Your Logo">
        </div>
      </a>
      <a class="sidebar-brand brand-logo-mini" href="../admin">
      </a>
    </div>
        <ul class="nav">
          <li class="nav-item menu-items">
            <a class="nav-link" href="./admin">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
            <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="./adminpending" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">Pending</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="./adminongoing">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
              <span class="menu-title">Ongoing</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="./adminsent">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
              <span class="menu-title">Sent</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="./adminhistory">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title">History</span>
            </a>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="./">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
              <span class="menu-title">Log Out</span>
            </a>
          </li>
        </ul>
      </nav>
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Track Document">
                </form>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Log out</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">Advanced settings</p>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
</template>

<script>
</script>

<style>
.sidebar-brand-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-container {
  text-align: center;
}

.logo {
  max-width: 100%; /* Set the maximum width to 100% of the container */
  max-height: 100px; /* Set the maximum height to a specific value, adjust as needed */
}

</style>