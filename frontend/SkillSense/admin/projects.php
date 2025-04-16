<!-- filepath: c:\wamp64\www\SkillSync\Frontend\admin\projects.php -->
<?php
// Start output buffering to capture the page content
ob_start();
?>
<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="../assets/">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Projects - SkillSync</title>

    <!-- DataTables CSS -->
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

    <style>
        #projectsTable tbody tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include 'layouts/sidebar.php'; ?>
            <div class="layout-page">
                <?php include 'layouts/navbar.php'; ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="content-card">
                            <h4 class="fw-bold">Projects</h4>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-new-project">
                                    <i class="bi bi-plus"></i> Add New Project
                                </button>
                            </div>
                            <div class="card-datatable text-nowrap">
                                <table id="projectsTable" class="datatables-basic table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <!-- Data will be dynamically loaded via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php include 'layouts/footer.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Offcanvas for Add New Project -->
    <div class="offcanvas offcanvas-end" id="add-new-project">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Add New Project</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form id="form-add-new-project" onsubmit="return false">
                <div class="mb-3">
                    <label for="projectImage" class="form-label">Image</label>
                    <input type="file" class="dropify" id="projectImage">
                </div>
                <div class="mb-3">
                    <label for="projectTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="projectTitle" placeholder="Enter title">
                </div>
                <div class="mb-3">
                    <label for="projectDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="projectDescription" rows="3" placeholder="Enter description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </div>
    </div>

    <!-- DataTables JS -->
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

    <script>
        $(document).ready(function () {
            // Initialize Dropify
            $('.dropify').dropify();

            const table = $('#projectsTable').DataTable({
                ajax: '/api/projects', // Replace with your API endpoint
                columns: [
                    { data: 'id' },
                    {
                        data: 'image',
                        render: function (data) {
                            return `<img src="${data}" alt="Project Image" class="table-img" style="width: 50px; height: 50px;">`;
                        }
                    },
                    { data: 'title' },
                    { data: 'description' },
                    { data: 'created_at' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `
                                <button class="btn btn-sm btn-primary edit-btn" data-id="${row.id}">Edit</button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">Delete</button>
                            `;
                        }
                    }
                ],
                responsive: true,
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                     '<"row"<"col-sm-12"tr>>' +
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                lengthMenu: [5, 10, 25, 50, 100],
                pageLength: 10
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