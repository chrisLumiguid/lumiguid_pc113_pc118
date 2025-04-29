<style>
/* Table Row Hover */
#projectsTable tbody tr:hover {
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
.content-card h4 {
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

/* Responsive Table */
@media (max-width: 576px) {
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}
</style>

<!-- All Projects Table -->
<div class="content-wrapper">
    <div class="content-card">
        <h4 class="fw-bold">All Projects</h4>

        <!-- Table for Displaying Projects -->
        <div class="card-datatable">
            <div class="table-responsive">
                <table class="table" id="projectsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Portfolio Owner</th> 
                            <th>Title</th>
                            <th>Client</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Date Completed</th>
                            <th>Project URL</th>
                            <th>Description</th>
                            <th>Cover Image</th>
                            <th>Tags</th>
                            <th>Video URL</th>
                            <th>Created At</th>
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


<!-- Required JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {
    // Initialize DataTable for Projects
    const table = $('#projectsTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        pageLength: 10
    });

    // Fetch projects from API and populate the table
    fetch('http://localhost:8000/api/projects', { headers: { 'Accept': 'application/json' } })
    .then(res => res.json())
    .then(data => {
        data.forEach(project => {
            const statusBadge = `<span class="badge bg-${project.status === 'published' ? 'success' : project.status === 'draft' ? 'warning' : 'secondary'}">${project.status}</span>`;
            const dateCompleted = project.date_completed ? new Date(project.date_completed).toLocaleDateString() : 'N/A';
            const tags = project.tags ? project.tags.join(', ') : 'N/A';
            const coverImage = project.cover_image ? `<img src="${project.cover_image}" alt="Cover Image" class="img-thumbnail" style="max-width: 100px;">` : 'No Image';
            const videoUrl = project.video_url ? `<a href="${project.video_url}" target="_blank">Watch Video</a>` : 'N/A';

            // Assuming project.portfolio_owner has the owner's name
            const portfolioOwnerName = project.portfolio_owner ? project.portfolio_owner.name : 'N/A';

            const row = [
                project.id,
                portfolioOwnerName, // Portfolio Owner Name Column
                project.title,
                project.client_name || 'N/A',
                project.category || 'N/A',
                statusBadge,
                dateCompleted,
                project.project_url ? `<a href="${project.project_url}" target="_blank">View Project</a>` : 'N/A',
                project.description ? project.description.substring(0, 50) + '...' : 'No Description', // Shorten Description
                coverImage,
                tags,
                videoUrl,
                new Date(project.created_at).toLocaleDateString() // Created At
            ];
            table.row.add(row).draw(false);
        });
    })
    .catch(err => console.error('Error fetching projects:', err));
});

</script>
