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

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="text-center mb-4">Welcome to the Admin Dashboard</h1>
            <p class="text-center">Manage users, view reports, and configure settings.</p>

            <!-- Students List Section -->
            <div class="mt-4">
                <h2>Students List</h2>
                <table id="studentsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Year Level</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be dynamically populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Admin Dashboard. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch data from the students API
            $.ajax({
                url: 'http://127.0.0.1:8000/api/students', // Replace with your API endpoint
                method: 'GET',
                success: function (data) {
                    let tableBody = '';
                    data.students.forEach((student, index) => {
                        tableBody += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${student.f_name} ${student.l_name}</td>
                                <td>${student.year_level || 'N/A'}</td>
                                <td>${student.email || 'N/A'}</td>
                                <td>${student.phone || 'N/A'}</td>
                                <td>${student.address || 'N/A'}</td>
                            </tr>
                        `;
                    });
                    $('#studentsTable tbody').html(tableBody);
                    $('#studentsTable').DataTable({
                        responsive: true,
                        paging: true,
                        searching: true,
                        ordering: true,
                        lengthMenu: [5, 10, 25, 50],
                        dom: 'Bfrtip',
                        language: {
                            search: "Search:",
                            lengthMenu: "Show _MENU_ entries",
                            info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        }
                    });
                },
                error: function (error) {
                    console.error('Error fetching students:', error);
                }
            });
        });
    </script>
</body>
</html>