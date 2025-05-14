function logout() {
	const token = localStorage.getItem("auth_token");
	if (!token) {
		localStorage.clear();
		window.location.href = "login.php";
		return;
	}

	fetch("http://127.0.0.1:8000/api/logout", {
		method: "POST",
		headers: {
			Authorization: "Bearer " + token,
			"Content-Type": "application/json",
		},
	}).finally(() => {
		localStorage.clear();
		window.location.href = "login.php";
	});
}

function formatRole(role) {
	return role.replace(/_/g, " ").replace(/\b\w/g, (c) => c.toUpperCase());
}

function getInitials(name) {
	if (!name) return "NA";
	const parts = name.trim().split(" ");
	return parts.length >= 2 ? parts[0][0].toUpperCase() + parts[parts.length - 1][0].toUpperCase() : parts[0][0].toUpperCase();
}

function loadUserHeader() {
	const userData = localStorage.getItem("user");
	if (!userData) {
		window.location.href = "login.php";
		return;
	}

	try {
		const user = JSON.parse(userData);
		const initials = getInitials(user.name);
		const avatar = user.profile_image ? user.profile_image : `https://ui-avatars.com/api/?name=${initials}&color=7F9CF5&background=EBF4FF`;

		const avatarEl = document.getElementById("navbar-avatar");
		const userAvatarEl = document.getElementById("user-avatar");
		const nameEl = document.getElementById("user-name");
		const roleEl = document.getElementById("user-role");

		if (avatarEl) avatarEl.src = avatar;
		if (userAvatarEl) userAvatarEl.src = avatar;
		if (nameEl) nameEl.textContent = user.name;
		if (roleEl) roleEl.textContent = formatRole(user.role);
	} catch (err) {
		console.error("Failed to parse user info:", err);
		localStorage.clear();
		window.location.href = "login.php";
	}
}
