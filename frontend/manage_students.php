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
    <!-- Sidebar CSS -->
    <link rel="stylesheet" href="sidebar.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            /* background-color: #f9f9f9; */
        }
        .dataTables_wrapper {
            margin-top: 20px;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-edit {
            background-color: #f7b924;
            color: white;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <?php include('sidebar.php'); ?>
   
    <div class="content">
        <?php include('navbar.php') ?>
        <div class="container-fluid">
            <div class="text-center my-4">
                <h1 class="display-4 text-dark">Manage Students</h1>
                <p class="lead text-muted">View and manage student records with ease.</p>
            </div>
            <div class="card shadow-lg p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h2>Students List</h2>
                    <button class="btn btn-custom" id="addStudentBtn">
                        <i class="bi bi-plus-circle"></i> Add New Student
                    </button>
                </div>
                <table id="studentsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Profile Picture</th>
                            <th>Name</th>
                            <th>Year Level</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Student -->
    <div class="modal fade" id="addStudentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addStudentForm">
                        <div class="mb-3">
                            <label class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="addStudentID" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" id="addFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="addLastName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Year Level</label>
                            <input type="number" class="form-control" id="addYearLevel" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" id="addPhone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Birth Date</label>
                            <input type="date" class="form-control" id="addBirthDate" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" id="addAddress" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-control" id="addGender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guardian Name</label>
                            <input type="text" class="form-control" id="addGuardianName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" id="addAge" required>
                        </div>
                    <button type="submit" class="btn btn-custom">Add Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Updating Student -->
    <div class="modal fade" id="editStudentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editStudentForm">
                        <input type="hidden" id="editStudentID">
                        <div class="mb-3">
                            <label class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="editStudentIDNumber" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editLastName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Year Level</label>
                            <input type="number" class="form-control" id="editYearLevel" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" id="editPhone" required>
                        </div>
                        <button type="submit" class="btn btn-custom">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/students/add_student.js"></script>
    <script src="js/students/delete_student.js"></script>
    <script src="js/students/edit_student.js"></script>
    <script src="js/students/load_student.js"></script>
    <script>
        $(document).ready(function () {
            const table = $('#studentsTable').DataTable({ responsive: true, pageLength: 10 });

            function loadStudents() {
                $.ajax({
                    url: 'http://localhost:8000/api/students',
                    method: 'GET',
                    success: function (response) {
                        table.clear();
                        response.data.forEach((student, index) => {
                            const row = table.row.add([ 
                                index + 1,
                                student.student_id_number,
                                student.f_name + ' ' + student.l_name,
                                student.year_level || 'N/A',
                                student.email || 'N/A',
                                student.phone || 'N/A',
                                `<button class="btn btn-edit me-2" data-student='${JSON.stringify(student)}'><i class="bi bi-pencil-square"></i></button>
                                 <button class="btn btn-delete" data-id="${student.id}"><i class="bi bi-trash"></i></button>`
                            ]).draw().node();
                            $(row).attr('data-student', JSON.stringify(student));
                        });
                    },
                    error: function () { alert("Error loading students."); }
                });
            }

            loadStudents();

            // Add Student Button
            $('#addStudentBtn').on('click', function () {
                $('#addStudentModal').modal('show');
            });

            // Edit Student Button (to show the edit modal)
            $(document).on('click', '.btn-edit', function () {
                const student = $(this).data('student');
                $('#editStudentID').val(student.id);
                $('#editStudentIDNumber').val(student.student_id_number);
                $('#editFirstName').val(student.f_name);
                $('#editLastName').val(student.l_name);
                $('#editYearLevel').val(student.year_level);
                $('#editEmail').val(student.email);
                $('#editPhone').val(student.phone);
                $('#editStudentModal').modal('show');
            });

            // Update Student Form Submission
            $('#editStudentForm').on('submit', function (event) {
                event.preventDefault();

                const studentId = $('#editStudentID').val();
                const updatedData = {
                    f_name: $('#editFirstName').val(),
                    l_name: $('#editLastName').val(),
                    year_level: $('#editYearLevel').val(),
                    email: $('#editEmail').val(),
                    phone: $('#editPhone').val()
                };

                $.ajax({
                    url: `http://127.0.0.1:8000/api/update/${studentId}/student`,
                    method: 'PUT',
                    contentType: "application/json",
                    data: JSON.stringify(updatedData),
                    success: function (response) {
                        alert(response.message);
                        $('#editStudentModal').modal('hide');
                        loadStudents();
                    },
                    error: function (xhr) {
                        let errorMsg = "Error updating student.";
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMsg = xhr.responseJSON.error;
                        }
                        alert(errorMsg);
                    }
                });
            });

            // Delete Student
            $(document).on('click', '.btn-delete', function () {
                const studentId = $(this).data('id');
                if (confirm("Are you sure you want to delete this student?")) {
                    $.ajax({
                        url: `http://localhost:8000/api/delete/${studentId}/student`,
                        method: 'DELETE',
                        success: function () {
                            alert("Student deleted successfully.");
                            loadStudents();
                        },
                        error: function () {
                            alert("Error deleting student.");
                        }
                    });
                }
            });

// Handle form submission for adding a new student
$('#addStudentForm').on('submit', function (event) {
    event.preventDefault(); // Prevent default form submission

    // Collect form data
    const newStudent = {
        student_id_number: $('#addStudentID').val(),
        f_name: $('#addFirstName').val(),
        l_name: $('#addLastName').val(),
        year_level: $('#addYearLevel').val(),
        email: $('#addEmail').val(),
        phone: $('#addPhone').val(),
        birth_date: $('#addBirthDate').val(),
        address: $('#addAddress').val(),
        gender: $('#addGender').val(),
        guardian_name: $('#addGuardianName').val(),
        age: $('#addAge').val()
    };

    // AJAX request to create a student
    $.ajax({
        url: 'http://127.0.0.1:8000/api/create/student',  // Update with your API endpoint
        method: 'POST',
        contentType: 'application/json',  // Ensures correct data format
        data: JSON.stringify(newStudent), // Convert object to JSON
        success: function (response) {
            alert(response.message); // Show success message
            $('#addStudentModal').modal('hide'); // Hide modal
            $('#addStudentForm')[0].reset(); // Reset form fields
            loadStudents(); // Refresh table data
        },
        error: function (xhr) {
            let errorMsg = "Error adding student.";
            if (xhr.responseJSON && xhr.responseJSON.error) {
                errorMsg = xhr.responseJSON.error;
            }
            alert(errorMsg);
        }
    });
});

        });


      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if(sidebar.classList.contains("active")){
        sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
      }else
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
        




    </script>
</body>
</html>
