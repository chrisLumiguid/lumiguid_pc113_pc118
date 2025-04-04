<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- Sidebar CSS -->
    <link rel="stylesheet" href="sidebar.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
            flex-grow: 1;
        }
        .dataTables_wrapper {
            margin-top: 20px;
        }
        .table th {
            background-color: #0056b3;
            color: white;
            text-align: center;
            font-weight: bold;
        }
        .table tbody tr {
            transition: background-color 0.3s ease;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: bold;
        }
        .btn-edit {
            background-color: #f7b924;
            color: white;
            border-radius: 25px;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border-radius: 25px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .modal-header, .modal-footer {
            background-color: #f7f9fc;
        }
        .form-label {
            font-weight: bold;
        }
        .modal-body input, .modal-body select {
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
        }
        .modal-body button {
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .modal-body button:hover {
            background-color: #0056b3;
        }
        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <!-- Include Sidebar -->
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <div class="container-fluid">
            <div class="text-center my-4">
                <h1 class="display-4 text-dark">Manage Employees</h1>
                <p class="lead text-muted">View and manage employee records with ease.</p>
            </div>
            <div class="card shadow-lg p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Employees List</h2>
                    <button class="btn btn-custom" id="addEmployeeBtn">
                        <i class="bi bi-plus-circle"></i> Add New Employee
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="employeesTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Employee -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm">
                        <div class="mb-3">
                            <label class="form-label">Employee ID</label>
                            <input type="text" class="form-control" id="addEmployeeID" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" id="addFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="addLastName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" id="addPhone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Birth Date</label>
                            <input type="date" class="form-control" id="addBirthDate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" id="addAddress" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-control" id="addGender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guardian Name</label>
                            <input type="text" class="form-control" id="addGuardianName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" id="addAge" required>
                        </div>
                        <button type="submit" class="btn btn-custom">Add Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Updating Employee -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm">
                        <input type="hidden" id="editEmployeeID">
                        <div class="mb-3">
                            <label class="form-label">Employee ID</label>
                            <input type="text" class="form-control" id="editEmployeeIDNumber" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editLastName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" id="editPhone" required>
                        </div>
                        <button type="submit" class="btn btn-custom">Update Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            const table = $('#employeesTable').DataTable({ responsive: true, pageLength: 10 });

            function loadEmployees() {
                $.ajax({
                    url: 'http://localhost:8000/api/employees',
                    method: 'GET',
                    success: function (response) {
                        table.clear();
                        response.data.forEach((employee, index) => {
                            const row = table.row.add([ 
                                index + 1,
                                employee.employee_id_number,
                                employee.f_name + ' ' + employee.l_name,
                                employee.email || 'N/A',
                                employee.phone || 'N/A',
                                `<button class="btn btn-edit me-2" data-employee='${JSON.stringify(employee)}'><i class="bi bi-pencil-square"></i></button>
                                 <button class="btn btn-delete" data-id="${employee.id}"><i class="bi bi-trash"></i></button>` 
                            ]).draw().node();
                            $(row).attr('data-employee', JSON.stringify(employee));
                        });
                    },
                    error: function () { alert("Error loading employees."); }
                });
            }

            loadEmployees();

            // Add Employee Button
            $('#addEmployeeBtn').on('click', function () {
                $('#addEmployeeModal').modal('show');
            });

            // Edit Employee Button (to show the edit modal)
            $(document).on('click', '.btn-edit', function () {
                const employee = $(this).data('employee');
                $('#editEmployeeID').val(employee.id);
                $('#editEmployeeIDNumber').val(employee.employee_id_number);
                $('#editFirstName').val(employee.f_name);
                $('#editLastName').val(employee.l_name);
                $('#editEmail').val(employee.email);
                $('#editPhone').val(employee.phone);
                $('#editEmployeeModal').modal('show');
            });

            // Update Employee Form Submission
            $('#editEmployeeForm').on('submit', function (event) {
                event.preventDefault();

                const employeeId = $('#editEmployeeID').val();
                const updatedData = {
                    f_name: $('#editFirstName').val(),
                    l_name: $('#editLastName').val(),
                    email: $('#editEmail').val(),
                    phone: $('#editPhone').val()
                };

                $.ajax({
                    url: `http://localhost:8000/api/update/${employeeId}/employee`,
                    method: 'PUT',
                    contentType: "application/json",
                    data: JSON.stringify(updatedData),
                    success: function (response) {
                        alert(response.message);
                        $('#editEmployeeModal').modal('hide');
                        loadEmployees();
                    },
                    error: function (xhr) {
                        let errorMsg = "Error updating employee.";
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMsg = xhr.responseJSON.error;
                        }
                        alert(errorMsg);
                    }
                });
            });

            // Delete Employee
            $(document).on('click', '.btn-delete', function () {
                const employeeId = $(this).data('id');
                if (confirm("Are you sure you want to delete this Employee?")) {
                    $.ajax({
                        url: `http://localhost:8000/api/delete/${employeeId}/employee`,
                        method: 'DELETE',
                        success: function () {
                            alert("Employee deleted successfully.");
                            loadEmployees();
                        },
                        error: function () {
                            alert("Error deleting employee.");
                        }
                    });
                }
            });

            // Handle form submission for adding a new employee
            $('#addEmployeeForm').on('submit', function (event) {
                event.preventDefault();

                const newEmployee = {
                    employee_id_number: $('#addEmployeeID').val(),
                    f_name: $('#addFirstName').val(),
                    l_name: $('#addLastName').val(),
                    email: $('#addEmail').val(),
                    phone: $('#addPhone').val(),
                    birth_date: $('#addBirthDate').val(),
                    address: $('#addAddress').val(),
                    gender: $('#addGender').val(),
                    guardian_name: $('#addGuardianName').val(),
                    age: $('#addAge').val()
                };

                $.ajax({
                    url: 'http://localhost:8000/api/create/employee',
                    method: 'POST',
                    contentType: "application/json",
                    data: JSON.stringify(newEmployee),
                    success: function (response) {
                        alert(response.message);
                        $('#addEmployeeModal').modal('hide');
                        loadEmployees();
                    },
                    error: function () {
                        alert("Error adding employee.");
                    }
                });
            });
        });
    </script>
</body>
</html>
