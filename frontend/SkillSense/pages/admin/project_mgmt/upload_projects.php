<style>
/* Table Row Hover */
#projectsTable tbody tr:hover {
    background-color: #f5f5f5;
    cursor: pointer;
}
.content-card .d-flex {
    margin-bottom: 30px; /* Adjust this value to your liking */
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

/* Buttons Styling */
.btn {
    padding: 0.4rem 0.6rem;
    font-size: 0.875rem;
}

/* Responsive Table */
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
        <h4 class="fw-bold">Upload Projects</h4>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#upload-project">
                <i class="bi bi-upload"></i> Upload New Project
            </button>
        </div>

        <!-- DataTable -->
        <div class="card-datatable">
            <div class="table-responsive">
                <table id="projectsTable" class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Client</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Date Completed</th>
                            <th>Project URL</th>
                            <th>Description</th>
                            <th>Cover Image</th>
                            <th>Gallery Images</th>
                            <th>Video URL</th>
                            <th>Created At</th>
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

<!-- Offcanvas: Upload New Project -->
<div class="offcanvas offcanvas-end" id="upload-project">
    <div class="offcanvas-header border-bottom">
        <h5>Upload New Project</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="form-upload-project">
            <div class="mb-3">
                <label for="portfolioOwner" class="form-label">Portfolio Owner</label>
                <select class="form-select" id="portfolioOwner">
                    <!-- Fetch portfolio owners from the database -->
                </select>
            </div>
            <div class="mb-3">
                <label for="portfolio" class="form-label">Portfolio</label>
                <select class="form-select" id="portfolio">
                    <!-- Fetch portfolios for selected owner -->
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Project Title</label>
                <input type="text" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="coverImage" class="form-label">Cover Image</label>
                <input type="file" class="form-control" id="coverImage">
            </div>
            <div class="mb-3">
                <label for="galleryImages" class="form-label">Gallery Images</label>
                <input type="file" class="form-control" id="galleryImages" multiple>
            </div>
            <div class="mb-3">
                <label for="videoUrl" class="form-label">Video URL</label>
                <input type="text" class="form-control" id="videoUrl">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category">
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" class="form-control" id="tags">
            </div>
            <div class="mb-3">
                <label for="dateCompleted" class="form-label">Date Completed</label>
                <input type="date" class="form-control" id="dateCompleted">
            </div>
            <div class="mb-3">
                <label for="clientName" class="form-label">Client Name</label>
                <input type="text" class="form-control" id="clientName">
            </div>
            <div class="mb-3">
                <label for="projectUrl" class="form-label">Project URL</label>
                <input type="text" class="form-control" id="projectUrl">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit Project</button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {
    const table = $('#projectsTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        pageLength: 10
    });

    // Fetch projects from API and populate the table
    fetch('http://localhost:8000/api/admin/projects', { headers: {
         'Accept': 'application/json',
         
        
        } })
    .then(res => res.json())
    .then(data => {
        data.forEach(project => {
            const statusBadge = `<span class="badge bg-${project.status === 'published' ? 'success' : project.status === 'draft' ? 'warning' : 'secondary'}">${project.status}</span>`;
            const dateCompleted = project.date_completed ? new Date(project.date_completed).toLocaleDateString() : 'N/A';
            const tags = project.tags ? project.tags.join(', ') : 'N/A';
            const coverImage = project.cover_image ? `<img src="${project.cover_image}" alt="Cover Image" class="img-thumbnail" style="max-width: 100px;">` : 'No Image';
            const galleryImages = project.gallery_images ? project.gallery_images.map(img => `<img src="${img}" alt="Gallery Image" class="img-thumbnail" style="max-width: 100px;">`).join('') : 'No Images';
            const videoUrl = project.video_url ? `<a href="${project.video_url}" target="_blank">Watch Video</a>` : 'N/A';
            const row = [
                project.id,
                project.title,
                project.client_name || 'N/A',
                project.category || 'N/A',
                statusBadge,
                dateCompleted,
                project.project_url ? `<a href="${project.project_url}" target="_blank">View Project</a>` : 'N/A',
                project.description ? project.description.substring(0, 50) + '...' : 'No Description',
                coverImage,
                galleryImages,
                videoUrl,
                new Date(project.created_at).toLocaleDateString() // Created At
            ];
            table.row.add(row).draw(false);
        });
    })
    .catch(err => console.error('Error fetching projects:', err));

    // Add project form submission logic
    $('#form-upload-project').on('submit', function (e) {
        e.preventDefault();
        const projectData = {
            portfolio_owner_id: $('#portfolioOwner').val(),
            portfolio_id: $('#portfolio').val(),
            title: $('#title').val(),
            description: $('#description').val(),
            cover_image: $('#coverImage')[0].files[0],
            gallery_images: $('#galleryImages')[0].files,
            video_url: $('#videoUrl').val(),
            category: $('#category').val(),
            tags: $('#tags').val().split(','),
            date_completed: $('#dateCompleted').val(),
            client_name: $('#clientName').val(),
            project_url: $('#projectUrl').val(),
            status: $('#status').val(),
        };

        // Logic for sending the data to API or backend
        console.log('Project Data:', projectData);
    });
});
</script>
