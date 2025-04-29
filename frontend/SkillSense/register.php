<!doctype html>
<html lang="en" class="layout-wide customizer-hide" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Register | SkillSync</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/vendor/fonts/iconify-icons.css" />
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/js/config.js"></script>

    <!-- Custom Style for Role Selection -->
    <style>
      .role-select {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-bottom: 2rem;
      }

      .role-option {
        border: 2px solid #d3d3d3;
        border-radius: 8px;
        padding: 1rem;
        width: 140px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .role-option i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #696cff;
      }

      .role-option.selected {
        border-color: #696cff;
        background-color: #f5f5ff;
      }
    </style>
  </head>

  <body>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card px-sm-6 px-0">
            <div class="card-body">
              <div class="app-brand justify-content-center mb-6">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <span class="text-primary">
                      <!-- Optional logo SVG -->
                    </span>
                  </span>
                  <span class="app-brand-text demo text-heading fw-bold">SkillSync</span>
                </a>
              </div>

              <h4 class="mb-1">Adventure starts here 🚀</h4>
              <p class="mb-6">Make your app management easy and fun!</p>

              <form id="formAuthentication" class="mb-6" method="POST">
                <!-- Role selection box -->
                <div class="mb-4">
                  <label class="form-label d-block text-center">Select Account Type</label>
                  <div class="role-select">
                    <div class="role-option" data-role="employer">
                      <i class="iconify" data-icon="mdi:briefcase-outline"></i>
                      <div>Employer</div>
                    </div>
                    <div class="role-option" data-role="portfolio_owner">
                      <i class="iconify" data-icon="mdi:account-box-outline"></i>
                      <div>Portfolio Owner</div>
                    </div>
                  </div>
                  <input type="hidden" name="role" id="role" required>
                </div>

                <div class="mb-4">
                  <label for="name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" autofocus required />
                </div>

                <div class="mb-4">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
                </div>

                <div class="form-password-toggle mb-4">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" name="password" placeholder="••••••••••••" aria-describedby="password" required />
                    <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                  </div>
                </div>

                <div class="form-password-toggle mb-4">
                  <label class="form-label" for="password_confirmation">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="••••••••••••" aria-describedby="password_confirmation" required />
                    <span class="input-group-text cursor-pointer"><i class="icon-base bx bx-hide"></i></span>
                  </div>
                </div>

                <div class="my-4">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div>
                </div>

                <button class="btn btn-primary d-grid w-100">Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="login.php">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Core JS -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/js/main.js"></script>

<script>
    const apiBase = 'http://localhost:8000'; // Your API base URL

    // Role selection logic
    const roleOptions = document.querySelectorAll('.role-option');
    const roleInput = document.getElementById('role');

    roleOptions.forEach(option => {
      option.addEventListener('click', () => {
        roleOptions.forEach(o => o.classList.remove('selected'));
        option.classList.add('selected');
        roleInput.value = option.getAttribute('data-role');
      });
    });

    document.getElementById('formAuthentication').addEventListener('submit', async function (e) {
      e.preventDefault();

      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      const password_confirmation = document.getElementById('password_confirmation').value.trim();
      const role = document.getElementById('role').value.trim();

      try {
        const response = await fetch(`${apiBase}/api/register`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name, email, password, password_confirmation, role })
        });

        const result = await response.json();
        if (!response.ok) {
          alert('Registration failed');
        } else {
          localStorage.setItem('auth_token', result.token); // Store token
          localStorage.setItem('role', result.user.role); // Store role

          if (result.user.role === 'employer') {
            window.location.href = 'employer_dashboard.php';
          } else if (result.user.role === 'portfolio_owner') {
            window.location.href = 'portfolio_owner_dashboard.php';
          }
        }
      } catch (error) {
        console.error(error);
        alert('Something went wrong. Please try again.');
      }
    });
  </script>
  </body>
</html>
