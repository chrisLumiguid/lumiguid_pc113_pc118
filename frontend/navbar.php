<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horizontal Nav Alignment</title>

  <!-- Boxicons (for icons) -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    nav {
      display: flex;
      align-items: center;
      justify-content: space-between; /* spread items horizontally */
      background-color: #f0f0f0;
      padding: 10px 20px;
    }

    .sidebar-button,
    .search-box,
    .profile-details {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .search-box input {
      padding: 5px 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .profile-details img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      object-fit: cover;
    }

    .dashboard,
    .admin_name {
      font-weight: bold;
    }
  </style>
</head>
<body>

  <nav>
    <div class="sidebar-button">
      <i class='bx bx-menu sidebarBtn'></i>
      <span class="dashboard">Dashboard</span>
    </div>
    <div class="profile-details">
      <img src="https://via.placeholder.com/30" alt="Profile">
      <span class="admin_name">Tina Pai</span>
      <i class='bx bx-chevron-down'></i>
    </div>
  </nav>

</body>
</html>
