// ============================
// DELETE EMPLOYEE
// ============================
// Handle employee deletion when the "Delete" button is clicked
document.addEventListener("click", function (event) {
	if (event.target.classList.contains("btn-delete")) {
		const employeeId = event.target.getAttribute("data-id");

		Swal.fire({
			title: "Are you sure?",
			text: "You won’t be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",
			confirmButtonText: "Yes, delete it!",
		}).then((result) => {
			if (result.isConfirmed) {
				fetch(`http://localhost:8000/api/delete/${employeeId}/employee`, {
					method: "DELETE",
				})
					.then((response) => {
						if (!response.ok) {
							throw new Error("Error deleting employee.");
						}
						return response.json();
					})
					.then(() => {
						Swal.fire("Deleted!", "Employee has been deleted.", "success");
						loadEmployees();
					})
					.catch(() => {
						Swal.fire("Error!", "There was a problem deleting the employee.", "error");
					});
			}
		});
	}
});
