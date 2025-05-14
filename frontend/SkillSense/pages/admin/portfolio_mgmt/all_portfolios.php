<style>
/* Table Row Hover */
#portfoliosTable tbody tr:hover {
    background-color: #f5f5f5;
    cursor: pointer;
}

/* White Background Card */
.content-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Button Styling */
.btn {
    padding: 0.4rem 0.6rem;
    font-size: 0.875rem;
}

/* Transparent Card Table */
.card-datatable {
    background-color: transparent;
    box-shadow: none;
}

/* Modal Image */
.modal-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
    margin: 0 auto 20px;
}

/* Responsive Table */
@media (max-width: 576px) {
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

/* SweetAlert2 Higher Z-Index */
.swal2-container {
    z-index: 5000 !important;
}
</style>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-card">
        <h4 class="fw-bold">Portfolios</h4>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-new-portfolio">
                <i class="bi bi-plus"></i> Add New Portfolio
            </button>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" id="exportDropdown" data-bs-toggle="dropdown">
                    <i class="bi bi-box-arrow-up"></i> Export
                </button>
                <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                    <li><button class="dropdown-item" id="exportCopy">Copy</button></li>
                    <li><button class="dropdown-item" id="exportCsv">CSV</button></li>
                    <li><button class="dropdown-item" id="exportExcel">Excel</button></li>
                    <li><button class="dropdown-item" id="exportPdf">PDF</button></li>
                    <li><button class="dropdown-item" id="exportPrint">Print</button></li>
                </ul>
            </div>
        </div>

        <!-- DataTable -->
        <div class="card-datatable">
            <div class="table-responsive">
                <table class="table table-striped" id="portfoliosTable">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Tags</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic content -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas: Add New Portfolio -->
<div class="offcanvas offcanvas-end" id="add-new-portfolio">
    <div class="offcanvas-header">
        <h5>Add New Portfolio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="form-add-new-portfolio" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Cover Image</label>
                <input type="file" class="form-control" name="cover_image">
            </div>
            <div class="mb-3">
                <label class="form-label">Gallery Images (Multiple)</label>
                <input type="file" class="form-control" name="gallery_images[]" multiple>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" class="form-control" name="category" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tags</label>
                <input type="text" class="form-control" name="tags" placeholder="Comma separated">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status" required>
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>

<!-- Modal: Edit Portfolio -->
<div class="modal fade" id="editPortfolioModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="form-edit-portfolio">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Portfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editPortfolioId">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" id="editPortfolioTitle" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="editPortfolioDescription" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" id="editPortfolioCategory" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="editPortfolioStatus" required>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const bearerToken = localStorage.getItem('token');
let table;

// Load portfolios into DataTable
function loadPortfolios() {
    fetch('http://localhost:8000/api/admin/portfolios', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${bearerToken}`
        }
    })
    .then(response => response.json())
    .then(data => {
        table.clear().draw();
        if (Array.isArray(data)) {
            data.forEach(portfolio => {
                table.row.add([
                    portfolio.title || '',
                    portfolio.category || '',
                    portfolio.status || '',
                    portfolio.tags || '',
                    portfolio.created_at || '',
                    `
                    <button class="btn btn-sm btn-warning edit-btn" 
                        data-id="${portfolio.id}" 
                        data-title="${portfolio.title}" 
                        data-description="${portfolio.description}" 
                        data-category="${portfolio.category}" 
                        data-status="${portfolio.status}">
                        Edit
                    </button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="${portfolio.id}">Delete</button>
                    `
                ]).draw(false);
            });
        } else {
            Swal.fire('Error', 'Unexpected data format received.', 'error');
        }
    })
    .catch(error => {
        console.error(error);
        Swal.fire('Error', 'Failed to load portfolios.', 'error');
    });
}

// Add new portfolio
$('#form-add-new-portfolio').on('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('http://localhost:8000/api/admin/portfolios', {
        method: 'POST',
        headers: { 
            'Accept': 'application/json',
            'Authorization': `Bearer ${bearerToken}` 
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        Swal.fire('Success', 'Portfolio created successfully.', 'success');
        $('#add-new-portfolio').offcanvas('hide');
        loadPortfolios();
    })
    .catch(error => {
        console.error(error);
        Swal.fire('Error', 'Failed to add portfolio.', 'error');
    });
});

// Open Edit Modal
$(document).on('click', '.edit-btn', function() {
    $('#editPortfolioId').val($(this).data('id'));
    $('#editPortfolioTitle').val($(this).data('title'));
    $('#editPortfolioDescription').val($(this).data('description'));
    $('#editPortfolioCategory').val($(this).data('category'));
    $('#editPortfolioStatus').val($(this).data('status'));
    $('#editPortfolioModal').modal('show');
});

// Save Edited Portfolio
$('#form-edit-portfolio').on('submit', function(e) {
    e.preventDefault();
    const id = $('#editPortfolioId').val();
    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('title', $('#editPortfolioTitle').val());
    formData.append('description', $('#editPortfolioDescription').val());
    formData.append('category', $('#editPortfolioCategory').val());
    formData.append('status', $('#editPortfolioStatus').val());

    fetch(`http://localhost:8000/api/admin/portfolios/${id}`, {
        method: 'POST',
        headers: { 'Authorization': `Bearer ${bearerToken}` },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        Swal.fire('Success', 'Portfolio updated.', 'success');
        $('#editPortfolioModal').modal('hide');
        loadPortfolios();
    })
    .catch(error => {
        console.error(error);
        Swal.fire('Error', 'Failed to update portfolio.', 'error');
    });
});

// Delete Portfolio
$(document).on('click', '.delete-btn', function() {
    const id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: 'This will permanently delete the portfolio.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then(result => {
        if (result.isConfirmed) {
            fetch(`http://localhost:8000/api/admin/portfolios/${id}`, {
                method: 'DELETE',
                headers: { 'Authorization': `Bearer ${bearerToken}` }
            })
            .then(res => res.json())
            .then(data => {
                Swal.fire('Deleted!', 'Portfolio has been deleted.', 'success');
                loadPortfolios();
            })
            .catch(error => {
                console.error(error);
                Swal.fire('Error', 'Failed to delete portfolio.', 'error');
            });
        }
    });
});

// Initialize
$(document).ready(function() {
    table = $('#portfoliosTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'csvHtml5', 'excelHtml5', 'pdfHtml5', 'print']
    });

    // Export buttons
    $('#exportCopy').click(() => table.button('.buttons-copy').trigger());
    $('#exportCsv').click(() => table.button('.buttons-csv').trigger());
    $('#exportExcel').click(() => table.button('.buttons-excel').trigger());
    $('#exportPdf').click(() => table.button('.buttons-pdf').trigger());
    $('#exportPrint').click(() => table.button('.buttons-print').trigger());

    loadPortfolios();
});
</script>
