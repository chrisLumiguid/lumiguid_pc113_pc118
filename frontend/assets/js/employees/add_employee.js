document.addEventListener("DOMContentLoaded", function () {
	const addEmployeeModalEl = document.getElementById("addEmployeeModal");
	const addEmployeeForm = document.getElementById("addEmployeeForm");
	const addEmployeeBtn = document.getElementById("addEmployeeBtn");

	const addEmployeeModalInstance = new bootstrap.Modal(addEmployeeModalEl);

	addEmployeeBtn.addEventListener("click", function () {
		addEmployeeModalInstance.show();
	});

	addEmployeeForm.addEventListener("submit", function (event) {
		event.preventDefault();

		const formData = new FormData(addEmployeeForm);

		fetch("http://localhost:8000/api/create/employee", {
			method: "POST",
			headers: {
				Accept: "application/json",
				// Laravel Sanctum: No CSRF required unless you're using web guard
			},
			body: formData,
		})
			.then(async (response) => {
				const data = await response.json();

				if (!response.ok) {
					// Validation errors from Laravel
					const message =
						data.message ||
						Object.values(data.errors || {})
							.flat()
							.join("\n") ||
						"Something went wrong.";
					throw new Error(message);
				}

				// Hide modal, then show alert AFTER it's fully hidden
				addEmployeeModalInstance.hide();

				// Wait for modal animation to finish before showing SweetAlert
				addEmployeeModalEl.addEventListener("hidden.bs.modal", function handleHidden() {
					Swal.fire({
						icon: "success",
						title: "Employee Added",
						text: data.message,
						timer: 2000,
						showConfirmButton: false,
						customClass: {
							popup: "zindex-swal",
						},
					});
					addEmployeeForm.reset();
					loadEmployees();
					// Clean up event listener
					addEmployeeModalEl.removeEventListener("hidden.bs.modal", handleHidden);
				});
			})
			.catch((error) => {
				console.error("Error:", error.message);
				Swal.fire({
					icon: "error",
					title: "Failed to Add Employee",
					text: error.message,
					customClass: {
						popup: "zindex-swal",
					},
				});
			});
	});
});
