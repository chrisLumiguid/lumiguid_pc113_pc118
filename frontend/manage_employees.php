<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <title>Manage Employees</title>
</head>
<body>
    <div class="content">
        <div class="container-fluid">
            <!-- Back to Dashboard Button -->
            <div class="d-flex justify-content-start my-3">
                <a href="dashboard.php" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <h1 class="text-center mb-4">Manage Employees</h1>
            <p class="text-center">View and manage employee records.</p>

            <!-- Students List Section -->
            <div class="mt-4">
                <h2>Employee List</h2>
                <table id="employeesTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
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
            $.ajax({
                url: 'http://127.0.0.1:8000/api/employees', // Replace with your API endpoint
                method: 'GET',
                success: function (data) {
                    let tableBody = '';
                    data.employees.forEach((employee, index) => {
                        tableBody += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${employee.f_name} ${employee.l_name}</td>
                                <td>${employee.age || 'N/A'}</td>
                                <td>${employee.email || 'N/A'}</td>
                                <td>${employee.phone || 'N/A'}</td>
                                <td>${employee.address || 'N/A'}</td>
                            </tr>
                        `;
                    });
                    $('#employeesTable tbody').html(tableBody);
                    $('#employeesTable').DataTable({
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
                    console.error('Error fetching employees:', error);
                }
            });
        });
    </script>
</body>
</html>