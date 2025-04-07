// ============================
// LOAD EMPLOYEES
// ============================
const table = $("#employeesTable").DataTable({ responsive: true, pageLength: 10 });

// Function to load employee data from the server and display it in the DataTable
function loadEmployees() {
	$.ajax({
		url: "http://localhost:8000/api/employees", // API endpoint to fetch employee data
		method: "GET", // HTTP GET request to retrieve data
		success: function (response) {
			table.clear(); // Clear the table before adding new data
			response.data.forEach((employee, index) => {
				const profilePic = employee.profile_picture ? `<img src="${employee.profile_picture}" alt="Profile Pic" width="50">` : "N/A";
				const file = employee.file ? `<a href="${employee.file}" target="_blank">Download</a>` : "N/A";
				const row = table.row
					.add([
						index + 1, // Row number
						employee.employee_id_number, // Employee ID
						profilePic, // Profile picture
						`${employee.f_name} ${employee.l_name}`, // Full name
						employee.email || "N/A", // Email, or 'N/A' if not available
						employee.phone || "N/A", // Phone, or 'N/A' if not available
						employee.address || "N/A", // Address, or 'N/A' if not available
						file, // Employee file link
						`<button class="btn btn-edit me-2" data-employee='${JSON.stringify(employee)}'><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-delete" data-id="${employee.id}"><i class="bi bi-trash"></i></button>`,
					])
					.draw()
					.node();
				$(row).attr("data-employee", JSON.stringify(employee)); // Attach employee data to the row
			});
		},
		error: function () {
			alert("Error loading employees."); // Error handling if data fetch fails
		},
	});
}

loadEmployees(); // Initially load employee data
