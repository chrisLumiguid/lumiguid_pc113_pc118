// ============================
// ADD EMPLOYEE
// ============================
// Open modal for adding new employee when "Add New Employee" button is clicked
$("#addEmployeeBtn").on("click", function () {
	$("#addEmployeeModal").modal("show"); // Show the add employee modal
});

// Handle form submission for adding a new employee
$("#addEmployeeForm").on("submit", function (event) {
	event.preventDefault(); // Prevent the default form submission

	const formData = new FormData(this); // Create FormData object from the form data
	console.log([...formData.entries()]); // Debugging: Log the form data to check if 'profile_picture' is included

	// Send a POST request to create a new employee
	$.ajax({
		url: "http://localhost:8000/api/create/employee", // API endpoint to add new employee
		method: "POST", // HTTP POST request to add data
		data: formData, // Send form data as FormData
		contentType: false, // Prevent jQuery from setting content-type
		processData: false, // Prevent jQuery from processing data
		success: function (response) {
			alert(response.message); // Show success message
			$("#addEmployeeModal").modal("hide"); // Close the add employee modal
			loadEmployees(); // Reload employee data
		},
		error: function (xhr) {
			let errorMsg = "Error adding employee.";
			if (xhr.responseJSON && xhr.responseJSON.errors) {
				errorMsg = Object.values(xhr.responseJSON.errors).join("\n");
			}
			alert(errorMsg); // Show error message
		},
	});
});
