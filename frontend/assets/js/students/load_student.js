// ======================
// LOAD STUDENTS FUNCTIONALITY
// ======================
window.loadStudents = function () {
	const table = $("#studentsTable").DataTable();

	fetch("http://localhost:8000/api/students", {
		method: "GET",
	})
		.then((response) => {
			if (!response.ok) {
				throw new Error("Failed to fetch student data.");
			}
			return response.json();
		})
		.then((data) => {
			table.clear();
			data.data.forEach((student, index) => {
				const row = table.row
					.add([
						index + 1,
						student.student_id_number,
						student.f_name + " " + student.l_name,
						student.year_level || "N/A",
						student.email || "N/A",
						student.phone || "N/A",
						`<button class="btn btn-edit me-2" data-student='${JSON.stringify(student)}'><i class="bi bi-pencil-square"></i></button>
                 <button class="btn btn-delete" data-id="${student.id}"><i class="bi bi-trash"></i></button>`,
					])
					.draw()
					.node();
				$(row).attr("data-student", JSON.stringify(student));
			});
		})
		.catch((error) => {
			Swal.fire({
				icon: "error",
				title: "Load Failed",
				text: error.message || "Error loading student records.",
			});
		});
};

$(document).ready(function () {
	$("#studentsTable").DataTable({
		responsive: true,
		pageLength: 10,
	});
	loadStudents(); // Load on page ready
});
