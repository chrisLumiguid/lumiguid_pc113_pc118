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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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

        .modal-header,
        .modal-footer {
            background-color: #f7f9fc;
        }

        .form-label {
            font-weight: bold;
        }

        .modal-body input,
        .modal-body select {
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

        .navbar{
            display:flex;
            
        }

    </style>
</head>

<body>
    <!-- <div class="main"> -->
        <!-- <div class="navbar"> -->
            <!-- </div> -->
            <!-- <div class="sidebar"> -->
                <?php include 'sidebar.php'; ?> 
            <!-- </div> -->
        <!-- </div> -->
        <div class="content">
            <?php include 'navbar.php'; ?>
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
                                    <th>Profile Picture</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>File</th>
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
                        <form id="addEmployeeForm" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Employee ID</label>
                                <input type="text" class="form-control" id="addEmployeeID" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" class="dropify" name="profile_picture" id="addProfilePic" data-max-file-size="2M" required>
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
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id="addAddress" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">File</label>
                                <input type="file"  id="addFile" name="addFile">
                            </div>
                            <button type="submit" class="btn btn-custom">Add Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Editing Employee -->
        <div class="modal fade" id="editEmployeeModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editEmployeeForm" enctype="multipart/form-data">
                            <input type="hidden" id="editEmployeeID">
                            <div class="mb-3">
                                <label class="form-label">Employee ID</label>
                                <input type="text" class="form-control" id="editEmployeeIDNumber" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" class="dropify" id="editProfilePic" data-max-file-size="2M">
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
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id="editAddress" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">File</label>
                                <input type="file"  id="addFile" name="addFile">
                            </div>
                            <button type="submit" class="btn btn-custom">Update Employee</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="js/employees/add_employee.js"></script>
    <script src="js/employees/delete_employee.js"></script>
    <script src="js/employees/edit_employee.js"></script>
    <script src="js/employees/load_employee.js"></script>
    <script>
    let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if(sidebar.classList.contains("active")){
        sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
      }else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    </script>
</body>
</html>


