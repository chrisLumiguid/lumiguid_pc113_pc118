<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
     <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            font-size: 1rem;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover {
            background-color: #495057;
            border-radius: 5px;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }
        .table thead {
            background-color: #343a40;
            color: white;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <a href="#"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="#"><i class="bi bi-people"></i> Manage Users</a>
        <a href="#"><i class="bi bi-person-badge"></i> Manage Employees</a>
        <a href="#"><i class="bi bi-gear"></i> Settings</a>
        <a href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <div class="sidebar">
        <h3>Admin Panel</h3>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="manage_students.php"><i class="bi bi-people"></i> Manage Students</a>
        <a href="manage_employees.php"><i class="bi bi-person-badge"></i> Manage Employees</a>
        <a href="#"><i class="bi bi-gear"></i> Settings</a>
        <a href="#"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Admin Dashboard. All Rights Reserved.</p>
    </footer>
</body>
</html>
