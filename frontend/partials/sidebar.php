
<?php include 'partials/head.php'; ?>

<div class="sidebar" id="sidebar">
  <div class="logo-details">TinangLab</div>
  <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
  <ul class="nav-links">
    <li>
      <a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">
        <i class='bx bx-grid-alt'></i>
        <span class="links_name">Dashboard</span></a></li>
    <li>
      <a href="manage_employees.php" class="<?= ($currentPage == 'manage_employees.php') ? 'active' : '' ?>">
        <i class='bx bx-id-card'></i>
        <span class="links_name">Employees</span></a></li>
    <li>
      <a href="manage_students.php" class="<?= ($currentPage == 'manage_students.php') ? 'active' : '' ?>">
        <i class='bx bx-pencil'></i>
        <span class="links_name">Student</span></a></li>
    <li>
      <a href="acc_setting.php" class="<?= ($currentPage == 'acc_setting.php') ? 'active' : '' ?>">
        <i class='bx bx-user'></i>
        <span class="links_name">Profile</span></a></li>
    <li class="log_out">
      <a href="#">
        <i class='bx bx-log-out'></i>
        <span class="links_name">Log out</span></a></li>
  </ul>
</div>
