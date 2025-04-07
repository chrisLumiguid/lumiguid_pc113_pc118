// ============================
// EDIT EMPLOYEE
// ============================
// Open the edit modal and pre-fill fields when an employee's "Edit" button is clicked
$(document).on("click", ".btn-edit", function () {
	const employee = $(this).data("employee");   
	
	$("#editEmployeeID").val(employee.id);
	$("#editEmployeeIDNumber").val(employee.employee_id_number);
	$("#editFirstName").val(employee.f_name);
	$("#editLastName").val(employee.l_name);
	$("#editEmail").val(employee.email);
	$("#editPhone").val(employee.phone);
	$("#editAddress").val(employee.address);
	$("#editEmployeeModal").modal("show"); 


$("#editEmployeeForm").on("submit", function (event) {
	event.preventDefault(); 

	const employeeId = $("#editEmployeeID").val(); 
	const updatedData = new FormData(this);

	// Send a POST request to update the employee data
	$.ajax({
		url: `http://localhost:8000/api/update/${employeeId}/employee`, 
		method: "POST", 
		data: updatedData, 
		contentType: false, 
		processData: false, 
		success: function (response) {
			alert(response.message);
			$("#editEmployeeModal").modal("hide");
			loadEmployees();
		},
		error: function (xhr) {
			let errorMsg = "Error updating employee.";
			if (xhr.responseJSON && xhr.responseJSON.errors) {
				errorMsg = Object.values(xhr.responseJSON.errors).join("\n");
			}
			alert(errorMsg);
		},
	});
});
