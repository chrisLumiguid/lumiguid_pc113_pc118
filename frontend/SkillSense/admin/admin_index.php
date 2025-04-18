<?php
// pinaka-homepagee  index.php
?>
<!-- admin_index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard | SkillSense</title>
</head>
<body>
  <?php include('admin_partials/header.php')?>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php include('admin_partials/nav.php'); ?>
      <?php include('admin_partials/sidebar.php'); ?>
      <!-- Main Content -->
      <div class="layout-page">
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <?php
              $page = $_GET['page'] ?? 'dashboard';

              switch ($page) {
                case 'all_users':
                  include 'users/all_users.php';
                  break;

                // Add more pages as needed
                default:
                  echo "<h4>Welcome to SkillSense Admin Dashboard</h4>";
              }
            ?>
          </div>
        </div>
      </div>
      <?php include('admin_partials/footer.php'); ?>
    </div>
  </div>


</body>
</html>
