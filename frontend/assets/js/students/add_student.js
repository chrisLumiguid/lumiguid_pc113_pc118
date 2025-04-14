document.addEventListener("DOMContentLoaded", function () {
	const addStudentModalEl = document.getElementById("addStudentModal");
	const addStudentForm = document.getElementById("addStudentForm");
	const addStudentBtn = document.getElementById("addStudentBtn");

	const addStudentModalInstance = new bootstrap.Modal(addStudentModalEl);

	// Show modal on Add button click
	addStudentBtn.addEventListener("click", function () {
		addStudentModalInstance.show();
	});

	addStudentForm.addEventListener("submit", function (event) {
		event.preventDefault();

		const formData = new FormData(addStudentForm);

		fetch("http://127.0.0.1:8000/api/create/student", {
			method: "POST",
			headers: {
				Accept: "application/json",
			},
			body: formData,
		})
			.then(async (response) => {
				const data = await response.json();

				if (!response.ok) {
					const message =
						data.message ||
						Object.values(data.errors || {})
							.flat()
							.join("\n") ||
						"Something went wrong.";
					throw new Error(message);
				}

				// Hide modal first
				addStudentModalInstance.hide();

				// Then wait for it to be fully hidden before showing SweetAlert
				addStudentModalEl.addEventListener("hidden.bs.modal", function handleHidden() {
					Swal.fire({
						icon: "success",
						title: "Student Added",
						text: data.message || "Student successfully added!",
						timer: 2000,
						showConfirmButton: false,
						customClass: {
							popup: "zindex-swal",
						},
					});

					addStudentForm.reset();

					if (typeof loadStudents === "function") loadStudents();

					// Clean up the listener
					addStudentModalEl.removeEventListener("hidden.bs.modal", handleHidden);
				});
			})
			.catch((error) => {
				console.error("Error:", error.message);
				Swal.fire({
					icon: "error",
					title: "Failed to Add Student",
					text: error.message,
					customClass: {
						popup: "zindex-swal",
					},
				});
			});
	});
});
