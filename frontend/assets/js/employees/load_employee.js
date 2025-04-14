// Initialize DataTable
const table = $("#employeesTable").DataTable({
	responsive: true,
	pageLength: 10,
	columns: [{ data: "#" }, { data: "employee_id" }, { data: "name" }, { data: "email" }, { data: "phone" }, { data: "address" }, { data: "actions" }],
});

function loadEmployees() {
	fetch("http://localhost:8000/api/employees")
		.then((response) => {
			if (!response.ok) {
				throw new Error("Failed to fetch employee data.");
			}
			return response.json();
		})
		.then((data) => {
			table.clear(); // Clear any existing data

			console.log("API Response:", data); // Debugging

			data.data.forEach((employee, index) => {
				const firstName = employee.f_name && employee.f_name.trim() !== "" ? employee.f_name : "N/A";
				const lastName = employee.l_name && employee.l_name.trim() !== "" ? employee.l_name : "N/A";

				const actions = `
                    <button class="btn btn-edit me-2" data-employee='${JSON.stringify({ ...employee, f_name: firstName, l_name: lastName })}'>
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-delete" data-id="${employee.id}">
                        <i class="bi bi-trash"></i>
                    </button>
                `;

				const rowData = {
					"#": index + 1,
					employee_id: employee.employee_id_number || "N/A",
					name: `${firstName} ${lastName}`,
					email: employee.email || "N/A",
					phone: employee.phone || "N/A",
					address: employee.address || "N/A",
					actions: actions,
				};

				table.row.add(rowData).draw();
			});
		})
		.catch((error) => {
			Swal.fire({
				icon: "error",
				title: "Failed to Load",
				text: error.message || "There was an error loading the employees.",
			});
		});
}

// Call loadEmployees on page load
document.addEventListener("DOMContentLoaded", loadEmployees);
