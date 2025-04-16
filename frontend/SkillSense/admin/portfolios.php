
<?php include "admin_partials/header.php"; ?>
<?php include "admin_partials/sidebar.php"; ?>
<?php include "admin_partials/navbar.php"; ?>
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
                            <h4 class="fw-bold">Portfolios</h4>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-new-portfolio">
                                    <i class="bi bi-plus"></i> Add New Portfolio
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
                                <table id="portfoliosTable" class="datatables-basic table table-responsive">
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
                                        <tr>
                                            <td>1</td>
                                            <td><img src="../assets/img/portfolio1.jpg" alt="Portfolio 1" class="table-img"></td>
                                            <td>Portfolio 1</td>
                                            <td>Portfolio description 1</td>
                                            <td>2025-03-23</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><img src="../assets/img/portfolio2.jpg" alt="Portfolio 2" class="table-img"></td>
                                            <td>Portfolio 2</td>
                                            <td>Portfolio description 2</td>
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
                    <h5 class="modal-title" id="rowDetailsModalLabel">Portfolio Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Portfolio Image" class="modal-img">
                    <p><strong>ID:</strong> <span id="modalId"></span></p>
                    <p><strong>Title:</strong> <span id="modalTitle"></span></p>
                    <p><strong>Description:</strong> <span id="modalDescription"></span></p>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Portfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Image</label>
                            <input type="file" class="dropify" id="editImage" data-default-file="../assets/img/portfolio1.jpg">
                        </div>
                        <div class="mb-3">
                            <label for="editId" class="form-label">ID</label>
                            <input type="text" class="form-control" id="editId" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editTitle" placeholder="Enter title">
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" rows="3" placeholder="Enter description"></textarea>
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

    <!-- Offcanvas for Add New Portfolio -->
    <div class="offcanvas offcanvas-end" id="add-new-portfolio">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Add New Portfolio</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form id="form-add-new-portfolio" onsubmit="return false">
                <div class="mb-3">
                    <label for="portfolioImage" class="form-label">Image</label>
                    <input type="file" class="dropify" id="portfolioImage">
                </div>
                <div class="mb-3">
                    <label for="portfolioTitle" class="form-label">Title</label>
                    <input type="text" class="form-control" id="portfolioTitle" placeholder="Enter title">
                </div>
                <div class="mb-3">
                    <label for="portfolioDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="portfolioDescription" rows="3" placeholder="Enter description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="portfolioDate" class="form-label">Date</label>
                    <input type="date" class="form-control" id="portfolioDate">
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

            const table = $('#portfoliosTable').DataTable({
                responsive: true,
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' + // Length and search
                     '<"row"<"col-sm-12"tr>>' + // Table
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>', // Info and pagination
                lengthMenu: [5, 10, 25, 50, 100],
                pageLength: 10
            });

            // Handle row click to show details modal
            $('#portfoliosTable tbody').on('click', 'tr', function (e) {
                if (!$(e.target).hasClass('edit-btn')) { // Prevent conflict with Edit button
                    const rowData = table.row(this).data();
                    if (rowData) {
                        $('#modalImage').attr('src', $(this).find('img').attr('src'));
                        $('#modalId').text(rowData[0]);
                        $('#modalTitle').text(rowData[1]);
                        $('#modalDescription').text(rowData[2]);
                        $('#modalCreatedAt').text(rowData[3]);
                        $('#rowDetailsModal').modal('show');
                    }
                }
            });

            // Handle Edit button click
            $('#portfoliosTable tbody').on('click', '.edit-btn', function () {
                const rowData = table.row($(this).closest('tr')).data();
                if (rowData) {
                    $('#editId').val(rowData[0]);
                    $('#editImage').attr('data-default-file', $(this).closest('tr').find('img').attr('src'));
                    $('#editTitle').val(rowData[1]);
                    $('#editDescription').val(rowData[2]);
                    $('#editDate').val(rowData[3]);
                    $('.dropify').dropify(); // Reinitialize Dropify
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