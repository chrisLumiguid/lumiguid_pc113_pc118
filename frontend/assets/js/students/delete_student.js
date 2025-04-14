// ======================
// DELETE STUDENT FUNCTIONALITY
// ======================
$(document).on("click", ".btn-delete", function () {
	const studentId = $(this).data("id");

	Swal.fire({
		title: "Are you sure?",
		text: "This student record will be permanently deleted.",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#d33",
		cancelButtonColor: "#6c757d",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.isConfirmed) {
			fetch(`http://localhost:8000/api/delete/${studentId}/student`, {
				method: "DELETE",
			})
				.then((response) => {
					if (response.ok) {
						Swal.fire({
							icon: "success",
							title: "Deleted!",
							text: "Student has been deleted.",
							timer: 2000,
							showConfirmButton: false,
						});
						loadStudents();
					} else {
						throw new Error("Error deleting student.");
					}
				})
				.catch((error) => {
					Swal.fire({
						icon: "error",
						title: "Error",
						text: error.message,
					});
				});
		}
	});
});
