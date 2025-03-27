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

    <style>
        .content {
        margin-top: 550px;
    }
        .dataTables_wrapper { margin-top: 20px; }
        .card { margin-top: 20px; }
    </style>
</head>
<body>
    <?php include 'sidebar.php' ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-start my-3">
            </div>
            <div class="text-center my-4">
                <h1>Manage Employees</h1>
                <p>View and manage employee records.</p>
            </div>
            <div class="card shadow p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Employees List</h2>
                    <button class="btn btn-success" id="addEmployeeBtn">
                        <i class="bi bi-plus-circle"></i> Add New Employee
                    </button>
                </div>
                <table id="employeesTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Email</th>
                            <th>Phone</th>
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

    <!-- Modal for Adding Employee -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm">
                        <div class="mb-3">
                            <label class="form-label">Employee ID</label>
                            <input type="text" class="form-control" id="employeeID" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Birth Date</label>
                            <input type="date" class="form-control" id="birthDate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-control" id="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guardian Name</label>
                            <input type="text" class="form-control" id="guardianName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
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
            const table = $('#employeesTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10
            });

            function loadEmployees() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/employees',
                    method: 'GET',
                    success: function (response) {
                        table.clear();
                        response.forEach((employee, index) => {
                            table.row.add([
                                index + 1,
                                employee.employee_id_number,
                                employee.f_name + ' ' + employee.l_name,
                                employee.birth_date || 'N/A',
                                employee.email || 'N/A',
                                employee.phone || 'N/A',
                                `<button class="btn btn-warning btn-sm">Edit</button>
                                 <button class="btn btn-danger btn-sm">Delete</button>`
                            ]).draw();
                        });
                    },
                    error: function (error) {
                        console.error('Error loading employees:', error);
                    }
                });
            }

            loadEmployees();

            $('#addEmployeeBtn').on('click', function () {
                $('#addEmployeeModal').modal('show');
            });

            $('#addEmployeeForm').on('submit', function (e) {
                e.preventDefault();

                const newEmployee = {
                    type: 'employee',
                    employee_id_number: $('#employeeID').val(),
                    f_name: $('#firstName').val(),
                    l_name: $('#lastName').val(),
                    birth_date: $('#birthDate').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    address: $('#address').val(),
                    gender: $('#gender').val(),
                    guardian_name: $('#guardianName').val()
                };

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/create',
                    method: 'POST',
                    contentType: 'application/json', 
                    data: JSON.stringify(newEmployee), 
                    success: function () {
                        alert('Employee added successfully!');
                        $('#addEmployeeModal').modal('hide');
                        $('#addEmployeeForm')[0].reset();
                        loadEmployees();
                    },
                    error: function (error) {
                        console.error('Error adding employee:', error);
                        if (error.status === 0) {
                            alert('Failed to connect to the server. Please ensure the backend is running.');
                        } else {
                            alert('Failed to add employee. Check the console for details.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>