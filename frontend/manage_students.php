<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <title>Manage Students</title>
</head>
<body>
     <?php include 'sidebar.php'; ?>
    <div class="content">
        <div class="container-fluid">
            <!-- Back to Dashboard Button -->
            <div class="d-flex justify-content-start my-3">
                <a href="dashboard.php" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i> Back to Dashboard
                </a>
            </div>

            <h1 class="text-center mb-4">Manage Students</h1>
            <p class="text-center">View and manage student records.</p>

            <!-- Students List Section -->
            <div class="mt-4">
                <h2>Students List</h2>
                <table id="studentsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Year Level</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be dynamically populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Viewing Student Details -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">Student Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="studentName"></span></p>
                    <p><strong>Year Level:</strong> <span id="studentYearLevel"></span></p>
                    <p><strong>Email:</strong> <span id="studentEmail"></span></p>
                    <p><strong>Phone:</strong> <span id="studentPhone"></span></p>
                    <p><strong>Address:</strong> <span id="studentAddress"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch data from the students API
            $.ajax({
                url: 'http://127.0.0.1:8000/api/students', // Replace with your API endpoint
                method: 'GET',
                success: function (data) {
                    let tableBody = '';
                    data.students.forEach((student, index) => {
                        tableBody += `
                            <tr data-student='${JSON.stringify(student)}'>
                                <td>${index + 1}</td>
                                <td>${student.f_name} ${student.l_name}</td>
                                <td>${student.year_level || 'N/A'}</td>
                                <td>${student.email || 'N/A'}</td>
                                <td>${student.phone || 'N/A'}</td>
                                <td>${student.address || 'N/A'}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-btn">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#studentsTable tbody').html(tableBody);
                    $('#studentsTable').DataTable({
                        responsive: true,
                        paging: true,
                        searching: true,
                        ordering: true,
                        lengthMenu: [5, 10, 25, 50],
                        language: {
                            search: "Search:",
                            lengthMenu: "Show _MENU_ entries",
                            info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        }
                    });

                    // Row click event to view details
                    $('#studentsTable tbody').on('click', 'tr', function () {
                        const student = $(this).data('student');
                        if (student) {
                            $('#studentName').text(`${student.f_name} ${student.l_name}`);
                            $('#studentYearLevel').text(student.year_level || 'N/A');
                            $('#studentEmail').text(student.email || 'N/A');
                            $('#studentPhone').text(student.phone || 'N/A');
                            $('#studentAddress').text(student.address || 'N/A');
                            $('#studentModal').modal('show');
                        }
                    });

                    // Edit button click event
                    $('#studentsTable tbody').on('click', '.edit-btn', function (e) {
                        e.stopPropagation(); // Prevent triggering the row click event
                        alert('Edit functionality not implemented yet.');
                    });

                    // Delete button click event
                    $('#studentsTable tbody').on('click', '.delete-btn', function (e) {
                        e.stopPropagation(); // Prevent triggering the row click event
                        alert('Delete functionality not implemented yet.');
                    });
                },
                error: function (error) {
                    console.error('Error fetching students:', error);
                }
            });
        });
    </script>
</body>
</html>