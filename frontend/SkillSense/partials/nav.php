<?php
if (!isset($user)) {
    $user = [
        'name' => 'Guest',
        'profile_image' => null
    ];
}

$avatarUrl = $user['profile_image']
    ? $user['profile_image']
    : 'https://ui-avatars.com/api/?name=' . urlencode($user['name']) . '&color=7F9CF5&background=EBF4FF';
?>
<!-- partials/navbar.php -->
 
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
    <!-- Place this tag where you want the button to render. -->
    <li class="nav-item lh-1 me-4">
        <a
        class="github-button"
        href="#"
        data-icon="octicon-star"
        data-size="large"
        data-show-count="true"
        aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
        >Star</a
        >
    </li>

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a
        class="nav-link dropdown-toggle hide-arrow p-0"
        href="javascript:void(0);"
        data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            <img src="<?= $avatarUrl ?>" alt="<?= $user['name'] ?>" class="w-px-40 h-auto rounded-circle" />
        </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="#">
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                    <!-- Avatar Image -->
                    <img id="user-avatar" src="<?= $avatarUrl ?>" alt="<?= $user['name'] ?>" class="w-px-40 h-auto rounded-circle" />
                </div>
                </div>
                <div class="flex-grow-1">
                <h6 class="mb-0" id="user-name">John Doe</h6>
                <small class="text-body-secondary">Admin</small>
                </div>
            </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider my-1"></div>
        </li>
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
        <li>
            <div class="dropdown-divider my-1"></div>
        </li>
        <li>
            <a class="dropdown-item" href="javascript:void(0);" id="logout-btn">
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
document.getElementById('logout-btn')?.addEventListener('click', async function () {
    try {
        const token = localStorage.getItem('auth_token'); 

        const response = await fetch('http://localhost:8000/api/logout', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        if (response.ok) {
            localStorage.removeItem('auth_token');
            // Optionally clear user data and redirect
            window.location.href = 'login.php';
        } else {
            const err = await response.json();
            alert('Logout failed: ' + (err.message || 'Unknown error'));
        }
    } catch (e) {
        console.error('Logout error:', e);
        alert('Logout error. Please try again.');
    }
});
</script>
