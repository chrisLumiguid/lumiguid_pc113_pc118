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

/* Badge for Report Status */
.badge {
    font-size: 0.9rem;
    padding: 0.4rem 0.6rem;
    border-radius: 0.25rem;
}

/* Buttons Styling */
.btn {
    padding: 0.4rem 0.6rem;
    font-size: 0.875rem;
}
</style>

<!-- Portfolio Reports Table -->
<div class="content-wrapper">
    <div class="content-card">
        <h4 class="fw-bold">Portfolio Reports</h4>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-new-report">
                <i class="bi bi-plus"></i> Add New Report
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
                <table class="table" id="reportsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Portfolio Title</th>
                            <th>Freelancer</th>
                            <th>Report Title</th>
                            <th>Status</th>
                            <th>Date Created</th>
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

<!-- Offcanvas: Add New Report -->
<div class="offcanvas offcanvas-end" id="add-new-report">
    <div class="offcanvas-header border-bottom">
        <h5>Add New Report</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="form-add-new-report">
            <div class="mb-3">
                <label for="reportTitle" class="form-label">Report Title</label>
                <input type="text" class="form-control" id="reportTitle">
            </div>
            <div class="mb-3">
                <label for="reportDescription" class="form-label">Report Description</label>
                <textarea class="form-control" id="reportDescription" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="portfolioId" class="form-label">Associated Portfolio</label>
                <select class="form-select" id="portfolioId">
                    <!-- Dynamically populated with portfolios -->
                </select>
            </div>
            <div class="mb-3">
                <label for="reportStatus" class="form-label">Status</label>
                <select class="form-select" id="reportStatus">
                    <option value="draft">Draft</option>
                    <option value="submitted">Submitted</option>
                    <option value="reviewed">Reviewed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>

<!-- Modal: Edit Report -->
<div class="modal fade" id="editReportModal" tabindex="-1" aria-labelledby="editReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editReportForm">
                    <div class="mb-3">
                        <label for="editReportTitle" class="form-label">Report Title</label>
                        <input type="text" class="form-control" id="editReportTitle">
                    </div>
                    <div class="mb-3">
                        <label for="editReportDescription" class="form-label">Report Description</label>
                        <textarea class="form-control" id="editReportDescription" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editReportStatus" class="form-label">Status</label>
                        <select class="form-select" id="editReportStatus">
                            <option value="draft">Draft</option>
                            <option value="submitted">Submitted</option>
                            <option value="reviewed">Reviewed</option>
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
    // Initialize DataTable for Reports
    const table = $('#reportsTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        pageLength: 10
    });

    // Fetch portfolios and reports from API and populate the table
    fetch('http://localhost:8000/api/reports', { headers: { 'Accept': 'application/json' } })
    .then(res => res.json())
    .then(data => {
        data.forEach(report => {
            const statusBadge = `<span class="badge bg-${report.status === 'submitted' ? 'primary' : report.status === 'draft' ? 'warning' : 'success'}">${report.status}</span>`;
            const createdAt = new Date(report.created_at).toLocaleDateString();
            const row = [
                report.id,
                report.portfolio.title,
                report.portfolio.owner.name, // Assuming portfolio has a nested owner object with 'name'
                report.title,
                statusBadge,
                createdAt,
                `<button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editReportModal" data-id="${report.id}">Edit</button>`
            ];
            table.row.add(row).draw(false);
        });
    })
    .catch(err => console.error('Error fetching reports:', err));

    // Handling the Edit Report Modal
    $('#reportsTable').on('click', '.edit-btn', function() {
        const reportId = $(this).data('id');
        console.log('Editing Report ID:', reportId);
        // Fetch the report details and populate the modal for editing
    });
});
</script>
