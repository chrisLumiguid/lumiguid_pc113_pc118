// ============================
// EDIT EMPLOYEE
// ============================
// Open the edit modal and pre-fill fields when an employee's "Edit" button is clicked
$(document).on("click", ".btn-edit", function () {
	const employee = $(this).data("employee"); // Get employee data from the button's 'data-employee' attribute
	// Set the form fields to the selected employee's data
	$("#editEmployeeID").val(employee.id);
	$("#editEmployeeIDNumber").val(employee.employee_id_number);
	$("#editFirstName").val(employee.f_name);
	$("#editLastName").val(employee.l_name);
	$("#editEmail").val(employee.email);
	$("#editPhone").val(employee.phone);
	$("#editAddress").val(employee.address);
	$("#editEmployeeModal").modal("show"); // Show the edit employee modal
});

// Handle the form submission for updating employee data
$("#editEmployeeForm").on("submit", function (event) {
	event.preventDefault(); // Prevent the default form submission

	const employeeId = $("#editEmployeeID").val(); // Get employee ID from the hidden input field
	const updatedData = new FormData(this); // Create a FormData object with the updated form data

	// Send a POST request to update the employee data
	$.ajax({
		url: `http://localhost:8000/api/update/${employeeId}/employee`, // API endpoint to update employee
		method: "POST", // HTTP POST request to update
		data: updatedData, // Send updated data as FormData
		contentType: false, // Prevent jQuery from setting the content-type header
		processData: false, // Prevent jQuery from processing the data
		success: function (response) {
			alert(response.message); // Show success message
			$("#editEmployeeModal").modal("hide"); // Close the edit modal
			loadEmployees(); // Reload employee data
		},
		error: function (xhr) {
			let errorMsg = "Error updating employee.";
			if (xhr.responseJSON && xhr.responseJSON.errors) {
				errorMsg = Object.values(xhr.responseJSON.errors).join("\n");
			}
			alert(errorMsg); // Show error message
		},
	});
});
