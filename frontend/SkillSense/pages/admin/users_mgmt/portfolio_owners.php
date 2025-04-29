<!-- C:\wamp64\www\Lumiguid_repo\frontend\SkillSense\pages\admin\users_mgmt\all_users.php -->

<style>
/* Table Row Hover */
#usersTable tbody tr:hover {
    background-color: #f5f5f5;
    cursor: pointer;
}
.btn {
    padding: 0.4rem 0.6rem;
    font-size: 0.875rem;
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

</style>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-card">
        <h4 class="fw-bold">Portfolio Owner</h4>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add-new-user">
                <i class="bi bi-plus"></i> Add New Owner
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
                <table id="usersTable" class="datatables-basic table">
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
                        <!-- Data will be injected by JS -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- Modal: View User Details -->
<div class="modal fade" id="rowDetailsModal" tabindex="-1" aria-labelledby="rowDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
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
        </div>
    </div>
</div>

<!-- Modal: Edit User -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Image</label>
                        <input type="file" class="dropify" id="editImage">
                    </div>
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail">
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <select class="form-select" id="editRole">
                            <option value="admin">Admin</option>
                            <option value="employer">Employer</option>
                            <option value="portfolio_owner">Portfolio Owner</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDate" class="form-label">Created At</label>
                        <input type="date" class="form-control" id="editDate">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas: Add New User -->
<div class="offcanvas offcanvas-end" id="add-new-user">
    <div class="offcanvas-header border-bottom">
        <h5>Add New User</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="form-add-new-user">
            <div class="mb-3">
                <label for="userImage" class="form-label">Image</label>
                <input type="file" class="dropify" id="userImage">
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label">Name</label>
                <input type="text" class="form-control" id="userName">
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="userEmail">
            </div>
            <div class="mb-3">
                <label for="userRole" class="form-label">Role</label>
                <select class="form-select" id="userRole">
                    <option value="admin">Admin</option>
                    <option value="employer">Employer</option>
                    <option value="portfolio_owner">Portfolio Owner</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="userDate" class="form-label">Date</label>
                <input type="date" class="form-control" id="userDate">
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
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
    const table = $('#usersTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        pageLength: 10
    });

    fetch('http://localhost:8000/api/users', { headers: { 'Accept': 'application/json' } })
    .then(res => res.json())
    .then(data => {
        data.forEach(user => {
            const imgSrc = user.profile_photo_url || 'https://via.placeholder.com/100';
            const badge = `<span class="badge bg-${getRoleColor(user.role)}">${formatRole(user.role)}</span>`;
            const createdAt = new Date(user.created_at).toLocaleDateString();
            const row = [
                user.id,
                `<img src="${imgSrc}" class="table-img" alt="User Image">`,
                user.name || '<i class="text-muted">No Name</i>',
                user.email,
                badge,
                createdAt,
                `<button class="btn btn-sm btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>`
            ];
            table.row.add(row).draw(false);
        });
    })
    .catch(err => console.error('Error fetching users:', err));

    function getRoleColor(role) {
        return { admin: 'danger', employer: 'primary', portfolio_owner: 'info' }[role] || 'secondary';
    }

    function formatRole(role) {
        return { admin: 'Admin', employer: 'Employer', portfolio_owner: 'Portfolio Owner' }[role] || role;
    }
});
</script>
