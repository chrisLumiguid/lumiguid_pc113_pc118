<?php
// Start output buffering to capture the page content
ob_start();
?>
<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="../assets/">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Users - SkillSync</title>

    <!-- DataTables CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Dropify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css">
    <link rel="stylesheet" href="../assets/css/demo.css">

    <!-- Custom Table Styling -->
    <style>
        /* Add hover effect for rows */
        #usersTable tbody tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }

        /* White background and padding for the entire section */
        .content-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Remove background from the table */
        .card-datatable {
            background-color: transparent;
            box-shadow: none;
        }

        /* Add spacing between elements */
        .content-card h4 {
            margin-bottom: 20px;
        }

        .content-card .d-flex {
            margin-bottom: 20px;
        }

        /* Modal image styling */
        .modal-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Sidebar -->
            <?php include 'layouts/sidebar.php'; ?>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include 'layouts/navbar.php'; ?>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="content-card">
                            <h4 class="fw-bold">Users</h4>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-new-user">
                                    <i class="bi bi-plus"></i> Add New User
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-box-arrow-up"></i> Export
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                        <li>
                                            <button class="dropdown-item" id="exportCopy">
                                                <i class="bi bi-clipboard"></i> Copy
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" id="exportCsv">
                                                <i class="bi bi-file-earmark-spreadsheet"></i> CSV
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" id="exportExcel">
                                                <i class="bi bi-file-earmark-excel"></i> Excel
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" id="exportPdf">
                                                <i class="bi bi-file-earmark-pdf"></i> PDF
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" id="exportPrint">
                                                <i class="bi bi-printer"></i> Print
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- DataTable with Buttons -->
                            <div class="card-datatable text-nowrap">
                                <table id="usersTable" class="datatables-basic table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><img src="../assets/img/user1.jpg" alt="User 1" class="table-img"></td>
                                            <td>John Doe</td>
                                            <td>john.doe@example.com</td>
                                            <td>Admin</td>
                                            <td>2025-03-23</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><img src="../assets/img/user2.jpg" alt="User 2" class="table-img"></td>
                                            <td>Jane Smith</td>
                                            <td>jane.smith@example.com</td>
                                            <td>User</td>
                                            <td>2025-03-22</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /DataTable with Buttons -->
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include 'layouts/footer.php'; ?>
                </div>
                <!-- / Content wrapper -->
            </div>
            <!-- / Layout container -->
        </div>
    </div>

    <!-- Modal for Row Details -->
    <div class="modal fade" id="rowDetailsModal" tabindex="-1" aria-labelledby="rowDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rowDetailsModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="User Image" class="modal-img">
                    <p><strong>ID:</strong> <span id="modalId"></span></p>
                    <p><strong>Name:</strong> <span id="modalName"></span></p>
                    <p><strong>Email:</strong> <span id="modalEmail"></span></p>
                    <p><strong>Role:</strong> <span id="modalRole"></span></p>
                    <p><strong>Created At:</strong> <span id="modalCreatedAt"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Image</label>
                            <input type="file" class="dropify" id="editImage" data-default-file="../assets/img/user1.jpg">
                        </div>
                        <div class="mb-3">
                            <label for="editId" class="form-label">ID</label>
                            <input type="text" class="form-control" id="editId" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" placeholder="Enter name">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <select class="form-select" id="editRole">
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editDate" class="form-label">Created At</label>
                            <input type="date" class="form-control" id="editDate">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Offcanvas for Add New User -->
    <div class="offcanvas offcanvas-end" id="add-new-user">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Add New User</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form id="form-add-new-user" onsubmit="return false">
                <div class="mb-3">
                    <label for="userImage" class="form-label">Image</label>
                    <input type="file" class="dropify" id="userImage">
                </div>
                <div class="mb-3">
                    <label for="userName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="userName" placeholder="Enter name">
                </div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="userEmail" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="userRole" class="form-label">Role</label>
                    <select class="form-select" id="userRole">
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="userDate" class="form-label">Date</label>
                    <input type="date" class="form-control" id="userDate">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </div>
    </div>

    <!-- DataTables JS (CDN) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <!-- Dropify JS -->
    <script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page JS -->
    <script>
        $(document).ready(function () {
            // Initialize Dropify
            $('.dropify').dropify();

            const table = $('#usersTable').DataTable({
                responsive: true,
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' + // Length and search
                     '<"row"<"col-sm-12"tr>>' + // Table
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>', // Info and pagination
                lengthMenu: [5, 10, 25, 50, 100],
                pageLength: 10
            });

            // Handle row click to show details modal
            $('#usersTable tbody').on('click', 'tr', function (e) {
                if (!$(e.target).hasClass('edit-btn')) { // Prevent conflict with Edit button
                    const rowData = table.row(this).data();
                    if (rowData) {
                        $('#modalImage').attr('src', $(this).find('img').attr('src'));
                        $('#modalId').text(rowData[0]);
                        $('#modalName').text(rowData[2]);
                        $('#modalEmail').text(rowData[3]);
                        $('#modalRole').text(rowData[4]);
                        $('#modalCreatedAt').text(rowData[5]);
                        $('#rowDetailsModal').modal('show');
                    }
                }
            });

            // Handle Edit button click
            $('#usersTable tbody').on('click', '.edit-btn', function () {
                const rowData = table.row($(this).closest('tr')).data();
                if (rowData) {
                    $('#editId').val(rowData[0]);
                    $('#editName').val(rowData[2]);
                    $('#editEmail').val(rowData[3]);
                    $('#editRole').val(rowData[4]);
                    $('#editDate').val(rowData[5]);
                }
            });

            // Save changes button
            $('#saveChanges').on('click', function () {
                alert('Changes saved successfully!');
                $('#editModal').modal('hide');
            });
        });
    </script>
</body>
</html>
<?php
// Capture the content and store it in a variable
$content = ob_get_clean();

// Include the master layout
include 'master.php';
?>