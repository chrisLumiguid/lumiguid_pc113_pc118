<nav
  class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
      <i class="icon-base bx bx-menu icon-md"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center me-auto">
      <div class="nav-item d-flex align-items-center">
        <span class="w-px-22 h-px-22"><i class="icon-base bx bx-search icon-md"></i></span>
        <input
          type="text"
          class="form-control border-0 shadow-none ps-1 ps-sm-2 d-md-block d-none"
          placeholder="Search..."
          aria-label="Search..." />
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-md-auto">
      <!-- GitHub Button -->
      <li class="nav-item lh-1 me-4">
        <a class="github-button" href="#" data-icon="octicon-star" data-size="large" data-show-count="true"
          aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
      </li>

      <!-- User Dropdown -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img id="navbar-avatar" src="https://ui-avatars.com/api/?name=Loading..." class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img id="user-avatar" src="https://ui-avatars.com/api/?name=Loading..." class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <h6 class="mb-0" id="user-name">Loading...</h6>
                  <small class="text-body-secondary" id="user-role">Loading...</small>
                </div>
              </div>
            </a>
          </li>
          <li><div class="dropdown-divider my-1"></div></li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="icon-base bx bx-user icon-md me-3"></i><span>My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
            </a>
          </li>
          <li><div class="dropdown-divider my-1"></div></li>
          <li>
            <a class="dropdown-item" href="javascript:void(0);" onclick="logout()">
              <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>

<script>
function logout() {
  const token = localStorage.getItem('auth_token');
  if (!token) {
    localStorage.clear();
    window.location.href = 'login.php';
    return;
  }

  fetch('http://127.0.0.1:8000/api/logout', {
    method: 'POST',
    headers: {
      'Authorization': 'Bearer ' + token,
      'Content-Type': 'application/json'
    }
  })
  .finally(() => {
    localStorage.clear();
    window.location.href = 'login.php';
  });
}

function formatRole(role) {
  return role.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase());
}

function getInitials(name) {
  if (!name) return "NA";
  const parts = name.trim().split(" ");
  return parts.length >= 2
    ? parts[0][0].toUpperCase() + parts[parts.length - 1][0].toUpperCase()
    : parts[0][0].toUpperCase();
}

document.addEventListener("DOMContentLoaded", function () {
  const userData = localStorage.getItem("user");

  if (!userData) {
    window.location.href = 'login.php';
    return;
  }

  try {
    const user = JSON.parse(userData);
    const initials = getInitials(user.name);

    const avatar = user.profile_image
      ? user.profile_image
      : `https://ui-avatars.com/api/?name=${initials}&color=7F9CF5&background=EBF4FF`;

    document.getElementById("navbar-avatar").src = avatar;
    document.getElementById("user-avatar").src = avatar;
    document.getElementById("user-name").textContent = user.name;
    document.getElementById("user-role").textContent = formatRole(user.role);
  } catch (err) {
    console.error("Failed to load user from localStorage", err);
    localStorage.clear();
    window.location.href = 'login.php';
  }
});
</script>
