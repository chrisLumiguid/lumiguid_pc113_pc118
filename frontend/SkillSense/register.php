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

                <a href="homepage.php">
                  <span><- Back</span>
                </a>
              
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
  document.addEventListener('DOMContentLoaded', function () {
    const roleOptions = document.querySelectorAll('.role-option');
    const roleInput = document.getElementById('role');

    roleOptions.forEach(option => {
      option.addEventListener('click', function () {
        // Remove 'selected' class from all
        roleOptions.forEach(opt => opt.classList.remove('selected'));

        // Add 'selected' to clicked one
        this.classList.add('selected');

        // Set the hidden input value
        const selectedRole = this.getAttribute('data-role');
        roleInput.value = selectedRole;

        // Redirect based on role selection
        if (selectedRole === 'portfolio_owner') {
          window.location.href = 'complete_profile.php';
        } else if (selectedRole === 'employer') {
          window.location.href = 'complete_profile_employer.php';
        }
      });
    });
  });
</script>
</body>
</html>