<!doctype html>
<html lang="en" class="layout-wide customizer-hide" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page | SkillSync</title>
    <meta name="description" content="Login to your SkillSync account" />

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
              <!-- Brand -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <!-- SVG Logo -->
                  </span>
                  <span class="app-brand-text demo text-heading fw-bold">SkillSync</span>
                </a>
              </div>

              <h4 class="mb-1">Welcome to SkillSync! 👋</h4>
              <p class="mb-4">Sign in to continue</p>

              <!-- Login Form -->
              <form id="formAuthentication" class="mb-4" novalidate>
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

<script>
  document.getElementById('formAuthentication').addEventListener('submit', async function (e) {
  e.preventDefault();

  const username = document.getElementById('username').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();

  const errorBox = document.createElement('div');
  errorBox.className = 'alert alert-danger mt-3';
  errorBox.style.display = 'none';
  document.querySelector('.card-body').prepend(errorBox);

  try {
    // Register user via Bearer Token Authentication
    const response = await fetch(`${apiBase}/api/register`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`, // Sending the Bearer Token
      },
      body: JSON.stringify({
        username,
        email,
        password,
        password_confirmation: password
      }),
    });

    const result = await response.json();

    if (!response.ok) {
      let messages = '';
      if (result.errors) {
        Object.values(result.errors).forEach(err => {
          messages += `<div>${err.join('<br>')}</div>`;
        });
      } else {
        messages = `<div>${result.message || 'Registration failed'}</div>`;
      }

      errorBox.innerHTML = messages;
      errorBox.style.display = 'block';
    } else {
      alert('🎉 Registration successful!');
      window.location.href = 'index.php';
    }
  } catch (error) {
    console.error('Fetch error:', error);
    errorBox.innerHTML = 'Something went wrong. Please try again.';
    errorBox.style.display = 'block';
  }
});

</script>
  </body>
</html>
