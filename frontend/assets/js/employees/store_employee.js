document.getElementById("addEmployeeForm").addEventListener("submit", function (e) {
	e.preventDefault();

	const form = e.target;
	const formData = new FormData();

	// Get input values
	formData.append("employee_id_number", document.getElementById("addEmployeeID").value);
	formData.append("f_name", document.getElementById("addFirstName").value);
	formData.append("l_name", document.getElementById("addLastName").value);
	formData.append("email", document.getElementById("addEmail").value);
	formData.append("phone", document.getElementById("addPhone").value);
	formData.append("address", document.getElementById("addAddress").value);

	// Get file inputs
	const profilePicInput = document.getElementById("addProfilePic");
	const fileInput = document.getElementById("addFile");

	if (profilePicInput.files.length > 0) {
		formData.append("profile_picture", profilePicInput.files[0]);
	}

	if (fileInput.files.length > 0) {
		formData.append("file", fileInput.files[0]);
	}

	fetch("http://localhost:8000/api/employees", {
		method: "POST",
		body: formData,
		headers: {
			// No need to set Content-Type for FormData — the browser does it
			Accept: "application/json",
		},
	})
		.then((response) => {
			if (!response.ok) {
				return response.json().then((data) => {
					throw new Error(data.message || "Failed to add employee.");
				});
			}
			return response.json();
		})
		.then((data) => {
			Swal.fire({
				icon: "success",
				title: "Success",
				text: "Employee added successfully!",
			});

			// Reset the form
			form.reset();
			$("#addEmployeeModal").modal("hide");

			// Reload table
			loadEmployees();
		})
		.catch((error) => {
			Swal.fire({
				icon: "error",
				title: "Error",
				text: error.message || "An error occurred while adding the employee.",
			});
		});
});
