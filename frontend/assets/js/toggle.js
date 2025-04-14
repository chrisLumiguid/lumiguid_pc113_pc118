document.addEventListener("DOMContentLoaded", () => {
	const toggleBtn = document.getElementById("toggleSidebar");
	const sidebar = document.getElementById("sidebar");

	toggleBtn.onclick = () => {
		sidebar.classList.toggle("collapsed");
	};
});
