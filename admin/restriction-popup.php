<!-- Popup Modal HTML -->

<style>
/* The Warning Modal (background) */
.warning_modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Warning Modal Content */
.warning_modal_content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

</style>


<div id="popupRestriction" class="warning_modal">

  <!-- Modal content -->
  <div class="warning_modal_content">
    <!-- <span class="close">&times;</span> -->
    <h1 style="color:red">Warning Leaving Windows</h1>
    <h3>Please wait for the countdown to continue the test.</h3>
    <h3 id="countdown_warning"></h3>
  </div>

</div>

<script src="../assets/js/Restriction.js"></script>