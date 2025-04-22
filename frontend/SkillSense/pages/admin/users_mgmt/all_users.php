
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
          </tbody>
        </table>
      </div>
    </div>

</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    fetch('http://localhost:8000/api/users', {
      headers: {
        'Accept': 'application/json'
      }
    })
    .then(res => res.json())
    .then(data => {
      const tbody = document.querySelector("#usersTable tbody");
      tbody.innerHTML = ''; // clear existing
      data.forEach(user => {
        const roleBadge = getRoleBadge(user.role);
        const verified = user.email_verified_at ? 
          `<span class="badge bg-success">Verified</span>` : 
          `<span class="badge bg-secondary">Not Verified</span>`;
        
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
