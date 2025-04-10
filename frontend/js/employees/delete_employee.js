// ============================
// DELETE EMPLOYEE
// ============================
// Handle employee deletion when the "Delete" button is clicked
$(document).on("click", ".btn-delete", function () {
	const employeeId = $(this).data("id"); 
	if (confirm("Are you sure you want to delete this Employee?")) {

		$.ajax({
			url: `http://localhost:8000/api/delete/${employeeId}/employee`,
			method: "DELETE", 
			success: function () {
				alert("Employee deleted successfully."); 
				loadEmployees(); 
			},
			error: function () {
				alert("Error deleting employee."); 
			},
		});
	}
});
