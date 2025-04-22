// ============================
// Load Employees into Table
// ============================
function loadEmployees() {
	fetch("http://localhost:8000/api/employees")
		.then((response) => response.json())
		.then((data) => {
			const tbody = $("#employeesTable tbody");
			tbody.empty(); // Clear old rows

			data.forEach((employee) => {
				const row = $(`
					<tr>
						<td>${employee.employee_id_number}</td>
						<td>${employee.f_name}</td>
						<td>${employee.l_name}</td>
						<td>${employee.email}</td>
						<td>${employee.phone}</td>
						<td>
							<button class="btn btn-sm btn-primary btn-edit">Edit</button>
						</td>
					</tr>
				`);

				// Attach employee object directly using jQuery's .data()
				row.find(".btn-edit").data("employee", employee);

				tbody.append(row);
			});
		})
		.catch((error) => {
			console.error("Failed to load employees:", error);
		});
}

// ============================
// Edit Employee - Show Modal
// ============================
$(document).on("click", ".btn-edit", function () {
	const employee = $(this).data("employee");

	$("#editEmployeeID").val(employee.id);
	$("#editEmployeeIDNumber").val(employee.employee_id_number);
	$("#editFirstName").val(employee.f_name);
	$("#editLastName").val(employee.l_name);
	$("#editEmail").val(employee.email);
	$("#editPhone").val(employee.phone);
	$("#editAddress").val(employee.address);
	$("#editBirthDate").val(employee.birth_date);
	$("#editGender").val(employee.gender);
	$("#editGuardianName").val(employee.guardian_name);
	$("#editAge").val(employee.age);

	const editModal = new bootstrap.Modal(document.getElementById("editEmployeeModal"));
	editModal.show();
});

// ============================
// Submit Edited Employee
// ============================
document.getElementById("editEmployeeForm").addEventListener("submit", function (event) {
	event.preventDefault();

	const employeeId = document.getElementById("editEmployeeID").value;
	const form = document.getElementById("editEmployeeForm");
	const formData = new FormData(form);

	fetch(
		`http://localhost:8000/api/employee/${employeeId}`,
		{
			method: "POST", 
			headers: {
				Accept: "application/json",
				"X-HTTP-Method-Override": "PUT", 
			},
			body: formData,
		}
	)
		.then(async (response) => {
			const contentType = response.headers.get("content-type");
			if (!contentType || !contentType.includes("application/json")) {
				const text = await response.text();
				throw new Error("Server error: " + text.slice(0, 100));
			}

			const data = await response.json();
			if (!response.ok) {
				if (data.errors) {
					throw new Error(Object.values(data.errors).join("\n"));
				} else {
					throw new Error(data.message || "Error updating employee.");
				}
			}

			Swal.fire({
				icon: "success",
				title: "Success",
				text: data.message,
				timer: 2000,
				showConfirmButton: false,
			});

			const modal = bootstrap.Modal.getInstance(document.getElementById("editEmployeeModal"));
			modal.hide();

			loadEmployees(); // Reload with updated data
		})
		.catch((error) => {
			console.error("Update Error:", error);
			Swal.fire({
				icon: "error",
				title: "Oops...",
				text: error.message,
			});
		});
});

// Load employees initially
loadEmployees();
