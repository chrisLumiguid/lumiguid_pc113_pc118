$(document).ready(function () {
	$("#addEmployeeForm").on("submit", function (e) {
		e.preventDefault();

		let formData = new FormData(this);

		$.ajax({
			url: "http://127.0.0.1:8000/api/create/employee", // make sure the URL is correct
			method: "POST",
			data: formData,
			processData: false,
			contentType: false,
			success: function (response) {
				$("#addEmployeeModal").modal("hide");

				Swal.fire({
					icon: "success",
					title: "Success!",
					text: "Employee added successfully!",
					showConfirmButton: false,
					timer: 2000,
				});

				$("#addEmployeeForm")[0].reset();
				// optionally reload the table
				loadEmployees(); // <-- if you're using a function like this
			},
			error: function (xhr) {
				console.log(xhr.responseText);
				Swal.fire({
					icon: "error",
					title: "Oops...",
					text: "Something went wrong!",
				});
			},
		});
	});
});
