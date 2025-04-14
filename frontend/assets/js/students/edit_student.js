// ======================
// EDIT STUDENT FUNCTIONALITY
// ======================
$(document).on("click", ".btn-edit", function () {
	const student = $(this).data("student");

	$("#editStudentID").val(student.id);
	$("#editStudentIDNumber").val(student.student_id_number);
	$("#editFirstName").val(student.f_name);
	$("#editLastName").val(student.l_name);
	$("#editYearLevel").val(student.year_level);
	$("#editEmail").val(student.email);
	$("#editPhone").val(student.phone);

	$("#editStudentModal").modal("show");
});

$("#editStudentForm").on("submit", function (event) {
	event.preventDefault();

	const studentId = $("#editStudentID").val();
	const updatedData = {
		f_name: $("#editFirstName").val(),
		l_name: $("#editLastName").val(),
		year_level: $("#editYearLevel").val(),
		email: $("#editEmail").val(),
		phone: $("#editPhone").val(),
	};

	fetch(`http://127.0.0.1:8000/api/update/${studentId}/student`, {
		method: "PUT",
		headers: {
			"Content-Type": "application/json",
			Accept: "application/json",
		},
		body: JSON.stringify(updatedData),
	})
		.then(async (response) => {
			const data = await response.json();

			if (!response.ok) {
				const errorMessage =
					data.message ||
					Object.values(data.errors || {})
						.flat()
						.join("\n") ||
					"Something went wrong.";
				throw new Error(errorMessage);
			}

			$("#editStudentModal").modal("hide");
			Swal.fire({
				icon: "success",
				title: "Student Updated",
				text: data.message || "Student record updated successfully!",
				timer: 2000,
				showConfirmButton: false,
			});
			loadStudents();
		})
		.catch((error) => {
			Swal.fire({
				icon: "error",
				title: "Update Failed",
				text: error.message,
			});
		});
});
