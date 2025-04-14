<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <?php include 'stud_employee/header.php'; ?>

    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .sidebar.collapsed ~ nav ~ .content {
            margin-left: var(--sidebar-collapsed-width);
        }
        .dataTables_wrapper {
            margin-top: 20px;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-edit {
            background-color: #f7b924;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

         .swal2-container {
            z-index: 2000 !important; 
        }
    </style>
</head>
<body>
    <?php include('partials/sidebar.php'); ?>
    <?php include('partials/navbar.php'); ?>

    <div class="content">
        <div class="container-fluid">
            <div class="text-center my-4">
                <h1 class="display-4 text-dark">Manage Students</h1>
                <p class="lead text-muted">View and manage student records with ease.</p>
            </div>
            <div class="card shadow-lg p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Students List</h2>
                    <button class="btn btn-custom" id="addStudentBtn" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                        <i class="bi bi-plus-circle"></i> Add New Student
                    </button>
                </div>
                <table id="studentsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Year Level</th>
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

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                        <div class="mb-3"><label class="form-label">Student ID</label><input type="text" class="form-control" name="student_id_number" required></div>
                        <div class="mb-3"><label class="form-label">First Name</label><input type="text" class="form-control" name="f_name" required></div>
                        <div class="mb-3"><label class="form-label">Last Name</label><input type="text" class="form-control" name="l_name" required></div>
                        <div class="mb-3"><label class="form-label">Year Level</label><input type="number" class="form-control" name="year_level" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" required></div>
                        <div class="mb-3"><label class="form-label">Phone</label><input type="text" class="form-control" name="phone" required></div>
                        <div class="mb-3"><label class="form-label">Birth Date</label><input type="date" class="form-control" name="birth_date" required></div>
                        <div class="mb-3"><label class="form-label">Address</label><input type="text" class="form-control" name="address" required></div>
                        <div class="mb-3"><label class="form-label">Gender</label>
                            <select class="form-control" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="form-label">Guardian Name</label><input type="text" class="form-control" name="guardian_name" required></div>
                        <div class="mb-3"><label class="form-label">Age</label><input type="number" class="form-control" name="age" required></div>
                        <button type="submit" class="btn btn-custom">Add Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editStudentForm">
                        <input type="hidden" name="id" id="editStudentID">
                        <div class="mb-3"><label class="form-label">Student ID</label><input type="text" class="form-control" id="editStudentIDNumber" name="student_id_number" disabled></div>
                        <div class="mb-3"><label class="form-label">First Name</label><input type="text" class="form-control" name="f_name" id="editFirstName" required></div>
                        <div class="mb-3"><label class="form-label">Last Name</label><input type="text" class="form-control" name="l_name" id="editLastName" required></div>
                        <div class="mb-3"><label class="form-label">Year Level</label><input type="number" class="form-control" name="year_level" id="editYearLevel" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" id="editEmail" required></div>
                        <div class="mb-3"><label class="form-label">Phone</label><input type="text" class="form-control" name="phone" id="editPhone" required></div>
                        <div class="mb-3"><label class="form-label">Birth Date</label><input type="date" class="form-control" name="birth_date" id="editBirthDate" required></div>
                        <div class="mb-3"><label class="form-label">Address</label><input type="text" class="form-control" name="address" id="editAddress" required></div>
                        <div class="mb-3"><label class="form-label">Gender</label>
                            <select class="form-control" name="gender" id="editGender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3"><label class="form-label">Guardian Name</label><input type="text" class="form-control" name="guardian_name" id="editGuardianName" required></div>
                        <div class="mb-3"><label class="form-label">Age</label><input type="number" class="form-control" name="age" id="editAge" required></div>
                        <button type="submit" class="btn btn-custom">Update Student</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom JavaScript -->
    <script src="assets/js/students/add_student.js"></script>
    <script src="assets/js/students/store_student.js"></script>
    <script src="assets/js/students/delete_student.js"></script>
    <script src="assets/js/students/edit_student.js"></script>
    <script src="assets/js/students/load_student.js"></script>
</body>
</html>
