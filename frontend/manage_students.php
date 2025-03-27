<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        .content { 
            padding: 20px; 
            margin-top: 950px;
        }
        .dataTables_wrapper { margin-top: 20px; }
        .card { margin-top: 20px; }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-start my-3">
            </div>
            <div class="text-center my-4">
                <h1>Manage Students</h1>
                <p>View and manage student records.</p>
            </div>
            <div class="card shadow p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Students List</h2>
                    <button class="btn btn-success" id="addStudentBtn">
                        <i class="bi bi-plus-circle"></i> Add New Student
                    </button>
                </div>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            const table = $('#studentsTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10
            });

            function loadStudents() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/students', // Replace with your API endpoint
                    method: 'GET',
                    success: function (response) {
                        table.clear();
                        response.forEach((student, index) => {
                            table.row.add([
                                index + 1,
                                student.f_name + ' ' + student.l_name,
                                student.year_level || 'N/A',
                                student.email || 'N/A',
                                student.phone || 'N/A',
                                student.address || 'N/A',
                                `<button class="btn btn-warning btn-sm edit-btn">Edit</button>
                                 <button class="btn btn-danger btn-sm delete-btn">Delete</button>`
                            ]).draw();
                        });
                    },
                    error: function (error) {
                        console.error('Error fetching students:', error);
                    }
                });
            }

            loadStudents();

            // Add Student Button
            $('#addStudentBtn').on('click', function () {
                alert('Add Student functionality not implemented yet.');
            });

            // Row click event to view details
            $('#studentsTable tbody').on('click', 'tr', function () {
                const student = table.row(this).data();
                if (student) {
                    $('#studentName').text(student[1]);
                    $('#studentYearLevel').text(student[2]);
                    $('#studentEmail').text(student[3]);
                    $('#studentPhone').text(student[4]);
                    $('#studentAddress').text(student[5]);
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
        });
    </script>
</body>
</html>