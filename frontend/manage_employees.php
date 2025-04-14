<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account Settings | TinangLab</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <?php include 'stud_employee/header.php';?>
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
      flex-grow: 1;
      transition: margin-left 0.3s ease;
    }
    .sidebar.collapsed ~ nav ~ .content {
      margin-left: var(--sidebar-collapsed-width);
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
    .navbar {
      display: flex;
    }
    .swal2-container {
      z-index: 2000 !important;
    }
  </style>
</head>

<body>
  <?php include 'partials/sidebar.php'; ?> 
  <?php include 'partials/navbar.php'; ?>
  <div class="content">
    <div class="container-fluid">
      <div class="text-center my-4">
        <h1 class="display-4 text-dark">Manage Employees</h1>
        <p class="lead text-muted">View and manage employee records with ease.</p>
      </div>
      <div class="card shadow-lg p-4">
        <div class="d-flex justify-content-between mb-3">
          <h2>Employees List</h2>
          <button class="btn btn-custom" id="addEmployeeBtn" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
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
                <th>Address</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Employee Modal -->
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
              <label class="form-label">Employee ID Number</label>
              <input type="text" class="form-control" name="employee_id_number" required>
            </div>
            <div class="mb-3">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control" name="f_name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Last Name</label>
              <input type="text" class="form-control" name="l_name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Phone</label>
              <input type="text" class="form-control" name="phone" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Birth Date</label>
              <input type="date" class="form-control" name="birth_date" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" name="address" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Gender</label>
              <select class="form-control" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Guardian Name</label>
              <input type="text" class="form-control" name="guardian_name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Age</label>
              <input type="number" class="form-control" name="age" required>
            </div>
            <button type="submit" class="btn btn-custom">Add Employee</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editEmployeeForm">
          <input type="hidden" name="id" id="editEmployeeID">
          <div class="mb-3">
            <label class="form-label">Employee ID Number</label>
            <input type="text" class="form-control" name="employee_id_number" id="editEmployeeIDNumber" required>
          </div>
          <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="f_name" id="editFirstName" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="l_name" id="editLastName" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="editEmail" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="editPhone" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Birth Date</label>
            <input type="date" class="form-control" name="birth_date" id="editBirthDate" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="editAddress" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Gender</label>
            <select class="form-control" name="gender" id="editGender" required>
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Guardian Name</label>
            <input type="text" class="form-control" name="guardian_name" id="editGuardianName" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" class="form-control" name="age" id="editAge" required>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="assets/js/employees/add_employee.js"></script>
  <script src="assets/js/employees/store_employee.js"></script>
  <script src="assets/js/employees/delete_employee.js"></script>
  <script src="assets/js/employees/edit_employee.js"></script>
  <script src="assets/js/employees/load_employee.js"></script>
</body>

</html>
