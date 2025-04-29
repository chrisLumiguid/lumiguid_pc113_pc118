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
.btn {
    padding: 0.4rem 0.6rem;
    font-size: 0.875rem;
}

/* Transparent Background Table */
.card-datatable {
    background-color: transparent;
    box-shadow: none;
}

/* Margin adjustments */
.content-card h4,
.content-card .d-flex {
    margin-bottom: 20px;
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

@media (max-width: 576px) {
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}
</style>

<!-- Content Wrapper -->
<div class="content-wrapper">
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
                    <li><button class="dropdown-item" id="exportCopy"><i class="bi bi-clipboard"></i> Copy</button></li>
                    <li><button class="dropdown-item" id="exportCsv"><i class="bi bi-file-earmark-spreadsheet"></i> CSV</button></li>
                    <li><button class="dropdown-item" id="exportExcel"><i class="bi bi-file-earmark-excel"></i> Excel</button></li>
                    <li><button class="dropdown-item" id="exportPdf"><i class="bi bi-file-earmark-pdf"></i> PDF</button></li>
                    <li><button class="dropdown-item" id="exportPrint"><i class="bi bi-printer"></i> Print</button></li>
                </ul>
            </div>
        </div>

        <!-- DataTable -->
        <div class="card-datatable">
            <div class="table-responsive">
                <table class="table" id="portfoliosTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Tags</th>
                            <th>Gallery Images</th>
                            <th>Cover Image</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be dynamically populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas: Add New Portfolio -->
<div class="offcanvas offcanvas-end" id="add-new-portfolio">
    <div class="offcanvas-header border-bottom">
        <h5>Add New Portfolio</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="form-add-new-portfolio">
            <div class="mb-3">
                <label for="portfolioTitle" class="form-label">Portfolio Title</label>
                <input type="text" class="form-control" id="portfolioTitle">
            </div>
            <div class="mb-3">
                <label for="portfolioDescription" class="form-label">Portfolio Description</label>
                <textarea class="form-control" id="portfolioDescription" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="portfolioCoverImage" class="form-label">Cover Image</label>
                <input type="file" class="form-control" id="portfolioCoverImage">
            </div>
            <div class="mb-3">
                <label for="portfolioGallery" class="form-label">Gallery Images (Multiple)</label>
                <input type="file" class="form-control" id="portfolioGallery" multiple>
            </div>
            <div class="mb-3">
                <label for="portfolioCategory" class="form-label">Category</label>
                <input type="text" class="form-control" id="portfolioCategory">
            </div>
            <div class="mb-3">
                <label for="portfolioTags" class="form-label">Tags</label>
                <input type="text" class="form-control" id="portfolioTags" placeholder="Comma separated">
            </div>
            <div class="mb-3">
                <label for="portfolioStatus" class="form-label">Status</label>
                <select class="form-select" id="portfolioStatus">
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
<div class="modal fade" id="editPortfolioModal" tabindex="-1" aria-labelledby="editPortfolioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Portfolio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPortfolioForm">
                    <div class="mb-3">
                        <label for="editPortfolioTitle" class="form-label">Portfolio Title</label>
                        <input type="text" class="form-control" id="editPortfolioTitle">
                    </div>
                    <div class="mb-3">
                        <label for="editPortfolioDescription" class="form-label">Portfolio Description</label>
                        <textarea class="form-control" id="editPortfolioDescription" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editPortfolioCoverImage" class="form-label">Cover Image</label>
                        <input type="file" class="form-control" id="editPortfolioCoverImage">
                    </div>
                    <div class="mb-3">
                        <label for="editPortfolioCategory" class="form-label">Category</label>
                        <input type="text" class="form-control" id="editPortfolioCategory">
                    </div>
                    <div class="mb-3">
                        <label for="editPortfolioStatus" class="form-label">Status</label>
                        <select class="form-select" id="editPortfolioStatus">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Required JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {
    $('.dropify').dropify();

    // Initialize DataTable for the Portfolio table
    const table = $('#portfoliosTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        pageLength: 10
    });

    // Fetch portfolios from API and populate the table
    fetch('http://localhost:8000/api/admin/portfolios', { headers: { 'Accept': 'application/json' } })
    .then(res => res.json())
    .then(data => {
        data.forEach(portfolio => {
            const statusBadge = `<span class="badge bg-${portfolio.status === 'published' ? 'success' : portfolio.status === 'draft' ? 'warning' : 'secondary'}">${portfolio.status}</span>`;
            const createdAt = new Date(portfolio.created_at).toLocaleDateString();
            const ownerName = portfolio.owner ? portfolio.owner.name : 'No Owner'; // Assuming 'owner' is an object with 'name' property
            const tags = portfolio.tags ? portfolio.tags.join(', ') : 'No Tags';
            const galleryImages = portfolio.gallery_images ? portfolio.gallery_images.length : 0; // Display number of gallery images
            const coverImage = portfolio.cover_image ? `<img src="${portfolio.cover_image}" alt="Cover Image" class="img-thumbnail" style="max-width: 100px;">` : 'No Image';
            const description = portfolio.description || 'No Description';

            table.row.add([
                portfolio.id,
                portfolio.title,
                ownerName,
                portfolio.category,
                statusBadge,
                createdAt,
                tags,
                galleryImages,
                coverImage,
                description,
                `<button class="btn btn-sm btn-primary edit-portfolio" data-id="${portfolio.id}"><i class="bi bi-pencil"></i> Edit</button>`
            ]).draw();
        });

        // Edit portfolio functionality
        $(document).on('click', '.edit-portfolio', function () {
            const portfolioId = $(this).data('id');
            // Fetch portfolio details from API for editing
            fetch(`http://localhost:8000/api/portfolios/${portfolioId}`)
            .then(res => res.json())
            .then(portfolio => {
                $('#editPortfolioTitle').val(portfolio.title);
                $('#editPortfolioDescription').val(portfolio.description);
                $('#editPortfolioCategory').val(portfolio.category);
                $('#editPortfolioStatus').val(portfolio.status);
                $('#editPortfolioModal').modal('show');
            });
        });
    });
});
</script>
