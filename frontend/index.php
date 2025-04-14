<!DOCTYPE html>
<html lang="en">
<?php include 'partials/head.php'; ?>
<body>

  <?php include 'partials/sidebar.php'; ?>
  <?php include 'partials/navbar.php'; ?>

  <div class="main-content">
    <h2>Welcome to the Dashboard!</h2>
    <p>All content adjusts properly when the sidebar toggles.</p>
  </div>

  <!-- <script src="../assets/js/sidebar.js"></script> -->
<script>
const toggleBtn = document.getElementById("toggleSidebar");
const sidebar = document.getElementById("sidebar");

toggleBtn.onclick = () => {
	sidebar.classList.toggle("collapsed");
};
</script>
</body>
</html>
