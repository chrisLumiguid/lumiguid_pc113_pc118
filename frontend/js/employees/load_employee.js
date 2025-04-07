// ============================
// LOAD EMPLOYEES
// ============================
const table = $("#employeesTable").DataTable({ responsive: true, pageLength: 10 });

// Function to load employee data from the server and display it in the DataTable
function loadEmployees() {
	$.ajax({
		url: "http://localhost:8000/api/employees", 
		method: "GET", 
		success: function (response) {
			table.clear(); 
			response.data.forEach((employee, index) => {
				const profilePic = employee.profile_picture ? `<img src="${employee.profile_picture}" alt="Profile Pic" width="50">` : "N/A";
				const file = employee.file ? `<a href="${employee.file}" target="_blank">Download</a>` : "N/A";
				const row = table.row
					.add([
						index + 1, 
						employee.employee_id_number, 
						profilePic, 
						`${employee.f_name} ${employee.l_name}`, 
						employee.email || "N/A", 
						employee.phone || "N/A", 
						employee.address || "N/A", 
						file, 
						`<button class="btn btn-edit me-2" data-employee='${JSON.stringify(employee)}'><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-delete" data-id="${employee.id}"><i class="bi bi-trash"></i></button>`,
					])
					.draw()
					.node();
				$(row).attr("data-employee", JSON.stringify(employee)); 
			});
		},
		error: function () {
			alert("Error loading employees."); 
		},
	});
}

loadEmployees(); 
