<template>
  <div>

    <div class="top-bar">
        <!-- Logo -->
        <div class="logo">
          <img :src="require('@/assets/images/logocalapan.png')" alt="Your Logo">
        </div>

        <div class="middle-section">
          <h1>City Hall Document Tracking</h1>
        </div>

        <form class="navbar-form form-inline">
          <div class="input-group search-box">								
            <input type="text" id="search" class="form-control" placeholder="Track Document...">
            <div class="input-group-append">
              <span class="input-group-text">
                <i class="material-icons">&#xE8B6;</i>
              </span>
            </div>
          </div>
        </form>
      </div>
    <!-- Contact Us Form -->
    <div class="row mt-4">
      <div class="col-md-8 mx-auto">
        <!-- Your existing Contact Us form goes here -->
        <div class="contact-form">
          <h1>Register your document !</h1>
          <p class="hint-text">We'd love to assist you. Please complete the details below.</p>
          <form action="/examples/actions/confirmation.php" method="post">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputFirstName">Your Full Name</label>
                  <input type="text" class="form-control" id="inputFirstName" placeholder="From" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputLastName">Document Title</label>
                  <input type="text" class="form-control" id="inputLastName" placeholder="Document Title" required>
                </div>
              </div>
            </div>            
            <div class="form-group">
              <label for="selectPurpose">Receiving Office</label>
              <select class="form-control" id="selectPurpose" required>
                <option value="" disabled selected>Select Office</option>
                <option value="purpose1">Office 1</option>
                <option value="purpose2">Office 2</option>
                <!-- Add more options as needed -->
              </select>
            </div>
            <div class="form-group">
              <label for="inputMessage">Purpose</label>
              <textarea class="form-control" id="inputMessage" placeholder="Purpose" rows="5" required></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Contact Form Styling */
.contact-form {
  padding: 50px;
  margin: 30px 0;
  background-color: #
}

.contact-form h1 {
  text-transform: uppercase;
  margin: 0 0 15px;
}

.contact-form .form-control,
.contact-form .btn  {
  min-height: 38px;
  border-radius: 2px;
}

.contact-form .btn-primary {
  min-width: 150px;
  background: #299be4;
  border: none;
}

.contact-form .btn-primary:hover {
  background: #1c8cd7; 
}

.contact-form label {
  opacity: 0.9;
}

.contact-form textarea {
  resize: vertical;
}

.hint-text {
  font-size: 15px;
  padding-bottom: 15px;
  opacity: 0.8;
}

.top-bar {
  background-color: #f8f9fa;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo img {
  max-height: 35px;
}

.search-bar {
  flex: 1;
  margin-left: 20px;
}

.middle-section h1{
  color:#7324a4;
  font-size:20px;
}
</style>
