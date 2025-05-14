<!-- C:\wamp64\www\Lumiguid_repo\frontend\SkillSense\pages\admin\users_mgmt\all_users.php -->

<?php
// Only start session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is authenticated
if (!isset($_SESSION['user_id'], $_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

// Optional: Role-based access
if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}
?>


<div class="content-wrapper">
  <!-- Content -->
  <div class="card">
    <h5 class="card-header">All Users</h5>
    <div class="table-responsive text-nowrap">
      <table class="table" id="usersTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Email Verified</th>
            <th>Role</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <!-- Data will be inserted here dynamically -->
        </tbody>
      </table>
    </div>
  </div>
</div>



<script src="/SkillSense/assets/js/userSession.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    loadUserHeader(); // ✅ Show name, role, and avatar in nav

    const token = localStorage.getItem('auth_token');
    if (!token) {
      console.error("Auth token not found.");
      return;
    }

    fetch('http://127.0.0.1:8000/api/admin/users', {
      headers: {
        'method': 'GET',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`
      }
    })
    .then(res => {
      if (!res.ok) throw new Error("Failed to fetch users");
      return res.json();
    })
    .then(data => {
      const users = data.users || data;
      const tbody = document.querySelector("#usersTable tbody");
      tbody.innerHTML = '';

      users.forEach(user => {
        const roleBadge = getRoleBadge(user.role);
        const verified = user.email_verified_at
          ? `<span class="badge bg-success">Verified</span>`
          : `<span class="badge bg-secondary">Not Verified</span>`;

        const row = `<tr>
          <td>${user.id}</td>
          <td>${user.name ?? '<i class="text-muted">No Name</i>'}</td>
          <td>${user.email}</td>
          <td>${verified}</td>
          <td>${roleBadge}</td>
          <td>${new Date(user.created_at).toLocaleString()}</td>
        </tr>`;

        tbody.innerHTML += row;
      });
    })
    .catch(err => {
      console.error('Error loading users:', err);
      alert('Failed to load user data.');
    });

    function getRoleBadge(role) {
      const badgeMap = {
        admin: 'danger',
        employer: 'primary',
        portfolio_owner: 'info',
        guest: 'secondary'
      };
      const labelMap = {
        admin: 'Admin',
        employer: 'Employer',
        portfolio_owner: 'Portfolio Owner',
        guest: 'Guest'
      };
      return `<span class="badge bg-${badgeMap[role] ?? 'secondary'}">${labelMap[role] ?? role}</span>`;
    }
  });
</script>
