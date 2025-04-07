// ============================
// ADD EMPLOYEE
// ============================
// Open modal for adding new employee when "Add New Employee" button is clicked
$("#addEmployeeBtn").on("click", function () {
	$("#addEmployeeModal").modal("show"); // Show the add employee modal
});

// Handle form submission for adding a new employee
$("#addEmployeeForm").on("submit", function (event) {
	event.preventDefault(); 

	const formData = new FormData(this); 
	console.log([...formData.entries()]); 

	// Send a POST request to create a new employee
	$.ajax({
		url: "http://localhost:8000/api/create/employee",
		method: "POST", 
		data: formData, 
		contentType: false, 
		processData: false, 
		success: function (response) {
			alert(response.message); 
			$("#addEmployeeModal").modal("hide"); 
			loadEmployees(); 
		},
		error: function (xhr) {
			let errorMsg = "Error adding employee.";
			if (xhr.responseJSON && xhr.responseJSON.errors) {
				errorMsg = Object.values(xhr.responseJSON.errors).join("\n");
			}
			alert(errorMsg);
		},
	});
});
