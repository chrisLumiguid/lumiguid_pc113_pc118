<?php session_start(); ?>
<!doctype html>
<html lang="en" class="layout-wide customizer-hide" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page | SkillSync</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/vendor/fonts/iconify-icons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />

  <!-- Scripts -->
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>
</head>

<body>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card px-sm-6 px-0">
          <div class="card-body">
            <div class="app-brand justify-content-center">
              <a href="#" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-heading fw-bold">SkillSync</span>
              </a>
            </div>

            <h4 class="mb-1">Welcome to SkillSync! 👋</h4>
            <p class="mb-4">Sign in to continue</p>

            <form id="formAuthentication" method="POST" action="" class="mb-4" novalidate>
              <div id="error" class="text-danger text-center mb-3"></div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required />
              </div>

              <div class="mb-3 form-password-toggle">
                <label for="password" class="form-label">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                  <span class="input-group-text cursor-pointer" onclick="togglePassword()">
                    <i class="iconify" data-icon="bx:bx-hide"></i>
                  </span>
                </div>
              </div>

              <div class="mb-3 d-flex justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me">Remember Me</label>
                </div>
                <a href="auth-forgot-password-basic.html">Forgot Password?</a>
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-primary d-grid w-100" id="loginBtn">Login</button>
              </div>
            </form>

            <p class="text-center">
              <span>New here?</span>
              <a href="register.php">Create an account</a>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    const apiBase = 'http://localhost:8000';

    document.getElementById('formAuthentication').addEventListener('submit', async function (e) {
      e.preventDefault();

      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();

      try {
        const response = await fetch(`${apiBase}/api/login`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ email, password })
        });

        const result = await response.json();

        if (response.ok) {
          // ✅ Clear old data
          localStorage.clear();

          // ✅ Save token, role, and full user object
          localStorage.setItem('auth_token', result.token);
          localStorage.setItem('role', result.user.role);
          localStorage.setItem('user', JSON.stringify(result.user));

          // ✅ Set PHP session
          const sessionResponse = await fetch('set_session.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
              user_id: result.user.id,
              role: result.user.role
            })
          });

          const sessionResult = await sessionResponse.json();

          if (sessionResult.status === 'success') {
            // ✅ Redirect based on role
            let page = 'dashboard';
            switch (result.user.role) {
              case 'admin': page = 'dashboard'; break;
              case 'portfolio_owner': page = 'dashboard'; break;
              case 'employer': page = 'dashboard'; break;
              default: page = 'dashboard';
            }
            window.location.href = `dashboard.php?page=${page}`;
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Session Error',
              text: 'Could not set session. Please try again.'
            });
          }

        } else {
          Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: result.message || 'Invalid email or password.'
          });
        }

      } catch (error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong. Please try again later.'
        });
      }
    });

    function togglePassword() {
      const passwordField = document.getElementById("password");
      const icon = event.currentTarget.querySelector("i");

      if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.setAttribute("data-icon", "bx:bx-show");
      } else {
        passwordField.type = "password";
        icon.setAttribute("data-icon", "bx:bx-hide");
      }
    }
  </script>
</body>
</html>
