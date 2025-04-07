// ============================
// DELETE EMPLOYEE
// ============================
// Handle employee deletion when the "Delete" button is clicked
$(document).on("click", ".btn-delete", function () {
	const employeeId = $(this).data("id"); // Get employee ID from the button's 'data-id' attribute
	if (confirm("Are you sure you want to delete this Employee?")) {
		// If the user confirms deletion, send a DELETE request to the server
		$.ajax({
			url: `http://localhost:8000/api/delete/${employeeId}/employee`, // API endpoint to delete employee
			method: "DELETE", // HTTP DELETE request to remove employee
			success: function () {
				alert("Employee deleted successfully."); // Show success message
				loadEmployees(); // Reload employee data
			},
			error: function () {
				alert("Error deleting employee."); // Show error message if deletion fails
			},
		});
	}
});
