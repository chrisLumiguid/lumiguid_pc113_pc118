<!-- filepath: c:\wamp64\www\Lumiguid_repo\frontend\manage_employees.php -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Table Styling -->
    <style>
        /* Compact table styling */
        #employeesTable {
            font-size: 14px;
        }

        #employeesTable tbody tr:hover {
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .content-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #employeesTable thead th {
            background-color: #007bff;
            color: white;
            text-align: center;
        }

        #employeesTable tbody td {
            text-align: center;
            vertical-align: middle;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <div class="container-fluid">
            <div class="content-card">
                <h4 class="fw-bold text-center">Employee List</h4>

                <!-- Add New Employee Button -->
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                        <i class="bi bi-plus"></i> Add New Employee
                    </button>
                </div>

                <!-- DataTable -->
                <div class="card-datatable text-nowrap">
                    <table id="employeesTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be dynamically populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- View Employee Modal -->
    <div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewEmployeeModalLabel">Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="viewName"></span></p>
                    <p><strong>Age:</strong> <span id="viewAge"></span></p>
                    <p><strong>Email:</strong> <span id="viewEmail"></span></p>
                    <p><strong>Phone:</strong> <span id="viewPhone"></span></p>
                    <p><strong>Address:</strong> <span id="viewAddress"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm">
                        <div class="mb-3">
                            <label for="addName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="addName" required>
                        </div>
                        <div class="mb-3">
                            <label for="addAge" class="form-label">Age</label>
                            <input type="number" class="form-control" id="addAge" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="addPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="addPhone" required>
                        </div>
                        <div class="mb-3">
                            <label for="addAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="addAddress" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function () {
            const table = $('#employeesTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                }
            });

            // Fetch data from the employees API
            $.ajax({
                url: 'http://127.0.0.1:8000/api/employees',
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
                                <td>
                                    <button class="btn btn-sm btn-edit edit-btn" data-id="${employee.id}">Edit</button>
                                    <button class="btn btn-sm btn-delete delete-btn" data-id="${employee.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#employeesTable tbody').html(tableBody);
                    table.rows.add($(tableBody)).draw();
                },
                error: function (error) {
                    console.error('Error fetching employees:', error);
                }
            });

            // Row click event to view details
            $('#employeesTable tbody').on('click', 'tr', function () {
                const rowData = table.row(this).data();
                if (rowData) {
                    $('#viewName').text(rowData[1]);
                    $('#viewAge').text(rowData[2]);
                    $('#viewEmail').text(rowData[3]);
                    $('#viewPhone').text(rowData[4]);
                    $('#viewAddress').text(rowData[5]);
                    $('#viewEmployeeModal').modal('show');
                }
            });

            // Handle Add Employee Form Submission
            $('#addEmployeeForm').on('submit', function (e) {
                e.preventDefault();
                alert('Add Employee functionality not implemented yet.');
            });

            // Handle Edit Button Click
            $('#employeesTable tbody').on('click', '.edit-btn', function (e) {
                e.stopPropagation();
                alert('Edit functionality not implemented yet.');
            });

            // Handle Delete Button Click
            $('#employeesTable tbody').on('click', '.delete-btn', function (e) {
                e.stopPropagation();
                alert('Delete functionality not implemented yet.');
            });
        });
    </script>
</body>
</html>