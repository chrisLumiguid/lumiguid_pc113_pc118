<!-- complete_profile.php -->
<!doctype html>
<html lang="en" class="layout-wide customizer-hide" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Complete Your Profile | SkillSync</title>

  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css" />
  <link rel="stylesheet" href="../assets/vendor/css/core.css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />

  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>

  <style>
    .step { visibility: hidden;  width: 100%;  position: absolute; opacity: 0; transform: translateX(100px); transition: all 0.5s ease; }
    .step.active { display: block;  visibility: visible;  position: relative; opacity: 1; transform: translateX(0); }
    .progress { height: 8px; background-color: #e0e0e0; }
    .progress-bar { background-color: #696cff; transition: width 0.4s ease; }
    
  </style>
</head>

<body>
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <div class="card p-4">
        <div class="card-body">
          <h4 class="mb-2 text-center">Complete Your Portfolio Owner Profile 🎯</h4>
          <p class="mb-4 text-center">Follow the steps below</p>

          <!-- Progress Bar -->
          <div class="progress-container mb-4">
            <div class="progress">
              <div class="progress-bar" id="progressBar" style="width: 17%;"></div>
            </div>
            <small class="d-block text-end mt-1" id="progressText">Step 1 of 6</small>
          </div>

          <div id="errorContainer" class="alert alert-danger d-none"></div>

          <form id="wizardForm" enctype="multipart/form-data">

            <!-- Step 1 -->
            <div class="step active" id="step-1">
              <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
              </div>
              <button type="button" class="btn btn-primary w-100 btn-next" id="nextBtnStep1">Next</button>
            </div>

            <!-- Step 2 -->
            <div class="step" id="step-2">
              <div class="mb-3">
                <label class="form-label">Professional Headline</label>
                <input type="text" class="form-control" id="headline" name="headline" required>
              </div>
              <div class="mb-3">
                <label class="form-label">About Me</label>
                <textarea class="form-control" id="about" name="about" rows="3" required></textarea>
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-prev" id="prevBtnStep2">Back</button>
                <button type="button" class="btn btn-primary btn-next" id="nextStep2">Next</button>
              </div>
            </div>

            <!-- Step 3 -->
            <div class="step" id="step-3">
              <div class="mb-3">
                <label class="form-label">Skills (comma separated)</label>
                <input type="text" class="form-control" id="skills" name="skills" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Current Company</label>
                <input type="text" class="form-control" id="currentCompany" name="current_company">
              </div>
              <div class="mb-3">
                <label class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position">
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-prev" id="prevBtnStep3">Back</button>
                <button type="button" class="btn btn-primary btn-next" id="nextBtnStep3">Next</button>
              </div>
            </div>

            <!-- Step 4 -->
            <div class="step" id="step-4">
              <div class="mb-3">
                <label class="form-label">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture" class="dropify" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="5M" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Resume (PDF Only)</label>
                <input type="file" id="resume" name="resume" class="dropify" data-allowed-file-extensions="pdf" data-max-file-size="5M" required>
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-prev" id="prevBtnStep4">Back</button>
                <button type="button" class="btn btn-primary btn-next" id="nextBtnStep4">Next</button>
              </div>
            </div>

            <!-- Step 5 -->
            <div class="step" id="step-5">
              <div class="mb-3">
                <label class="form-label">Experience Summary</label>
                <textarea class="form-control" id="experienceSummary" name="experience_summary"></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Education Summary</label>
                <textarea class="form-control" id="educationSummary" name="education_summary"></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Portfolio Overview</label>
                <textarea class="form-control" id="portfolioOverview" name="portfolio_overview"></textarea>
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-prev" id="prevBtnStep5">Back</button>
                <button type="button" class="btn btn-primary btn-next" id="nextBtnStep5">Next</button>
              </div>
            </div>

            <!-- Step 6 -->
            <div class="step" id="step-6">
              <div class="mb-3">
                <label class="form-label">LinkedIn</label>
                <input type="url" class="form-control" id="linkedin" name="linkedin">
              </div>
              <div class="mb-3">
                <label class="form-label">GitHub</label>
                <input type="url" class="form-control" id="github" name="github">
              </div>
              <div class="mb-3">
                <label class="form-label">Personal Website</label>
                <input type="url" class="form-control" id="personalWebsite" name="personal_website">
              </div>
              <div class="mb-3">
                <label class="form-label">Profile Banner</label>
                <input type="file" id="banner" name="banner" class="dropify" data-allowed-file-extensions="jpg png jpeg" data-max-file-size="5M" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location">
              </div>
              <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone">
              </div>
              <div class="mb-3">
                <label class="form-label">Contact Email</label>
                <input type="email" class="form-control" id="contactEmail" name="contact_email">
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-prev" id="prevBtnStep6">Back</button>
                <button type="submit" class="btn btn-success" id="submitBtn">Submit Profile</button>
              </div>
            </div>

          </form>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
<script src="../assets/vendor/js/menu.js"></script>
<script src="../assets/js/main.js"></script>



<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('wizardForm');
  const steps = document.querySelectorAll('.step');
  const progressBar = document.getElementById('progressBar');
  const apiBase = window.location.origin.includes('localhost') ? 'http://localhost:8000' : window.location.origin;
  let totalSteps = steps.length;
  let currentStep = 1;
  let token = null;
  let processing = false;
  const maxFileSize = 100 * 1024 * 1024; // 100MB

  showStep(currentStep);

  document.querySelectorAll('.btn-next').forEach(button => {
    button.addEventListener('click', nextStep);
  });
  document.querySelectorAll('.btn-prev').forEach(button => {
    button.addEventListener('click', prevStep);
  });

  $('.dropify').dropify({
    messages: {
      'default': 'Drag and drop a file here or click',
      'replace': 'Drag and drop or click to replace',
      'remove': 'Remove',
      'error': 'Oops, something wrong happened.'
    },
    error: {
      'fileSize': 'The file size is too big (100MB max).',
      'fileExtension': 'This file format is not allowed.'
    } 
  });

  form.addEventListener('submit', submitForm);

  form.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function () {
      if (this.files.length > 0) {
        const file = this.files[0];
        if (file.size > maxFileSize) {
          showError('The selected file exceeds the maximum size of 100MB.');
          this.value = '';
        }
      }
    });
  });

  form.querySelectorAll('input, textarea').forEach(input => {
    input.addEventListener('input', function () {
      if (this.checkValidity()) {
        this.classList.add('is-valid');
        this.classList.remove('is-invalid');
      } else {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
      }
    });
  });

  function showStep(step) {
    steps.forEach((s, index) => {
      s.classList.toggle('active', index === step - 1);
    });

    if (progressBar) {
      const progress = (step / totalSteps) * 100;
      progressBar.style.width = `${progress}%`;
      document.getElementById('progressText').innerText = `Step ${step} of ${totalSteps}`;
    }
  }

  function nextStep() {
    if (!validateCurrentStep()) return;

    if (currentStep === 1) {
      const nameInput = document.getElementById('name');
      const emailInput = document.getElementById('email');
      const passwordInput = document.getElementById('password');
      const passwordConfirmationInput = document.getElementById('password_confirmation');

      const name = nameInput?.value.trim();
      const email = emailInput?.value.trim();
      const password = passwordInput?.value;
      const password_confirmation = passwordConfirmationInput?.value;

      if (!name || !email || !password || !password_confirmation) {
        showError('Please fill in all required fields.');
        return;
      }

      if (password !== password_confirmation) {
        showError('Passwords do not match.');
        return;
      }

      processing = true;
      document.getElementById('nextBtnStep1').disabled = true;

      // Show the loading spinner first
      Swal.fire({
        title: 'Processing...',
        text: 'Please wait while we register your account.',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      fetch(`${apiBase}/api/register`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          name,
          email,
          password,
          password_confirmation,
          role: 'portfolio_owner'
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          token = data.token || null;
          clearError();

          // Close the loading spinner and show success alert
          Swal.close(); // Close loading spinner
          showSuccess('Registration Successful!', 'Proceed to complete your profile.', 'Continue')
            .then(() => {
              currentStep++;
              showStep(currentStep);
            });
        } else {
          showError(data.message || 'Registration failed.');
        }
      })
      .catch(error => {
        console.error(error);
        showError('An error occurred during registration.');
      })
      .finally(() => {
        processing = false;
        document.getElementById('nextBtnStep1').disabled = false;
      });
    } else {
      currentStep++;
      showStep(currentStep);
    }
  }
  

  function prevStep() {
    if (currentStep > 1) {
      currentStep--;
      showStep(currentStep);
    }
  }

  function submitForm(event) {
    event.preventDefault();
    if (processing) return;
    if (!validateCurrentStep()) return;

    processing = true;
    document.getElementById('submitBtn').disabled = true;

    const formData = new FormData(form);

    fetch(`${apiBase}/api/portfolio_owner/complete-profile`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showSuccess('Profile Completed!', 'Your portfolio profile is now complete.', 'Go to Dashboard')
        .then(() => {
          window.location.href = '/dashboard.php';
        });
      } else {
        showError(data.message || 'Profile completion failed.');
      }
    })
    .catch(error => {
      console.error(error);
      showError('An unexpected error occurred.');
    })
    .finally(() => {
      processing = false;
      document.getElementById('submitBtn').disabled = false;
    });
  }

  function validateCurrentStep() {
    const currentStepElement = document.getElementById(`step-${currentStep}`);
    const inputs = currentStepElement.querySelectorAll('input, textarea');

    let isValid = true;
    inputs.forEach(input => {
      if (!input.checkValidity()) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        isValid = false;
      } else {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
      }
    });

    if (!isValid) {
      showError('Please fill in all required fields correctly.');
    }
    return isValid;
  }

  function showError(message) {
    const errorContainer = document.getElementById('errorContainer');
    errorContainer.textContent = message;
    errorContainer.classList.remove('d-none');
  }

  function showSuccess(title, text, confirmButtonText) {
    clearError();
    return Swal.fire({
      title,
      text,
      icon: 'success',
      confirmButtonText: confirmButtonText || 'OK'
    });
  }

  function clearError() {
    const errorContainer = document.getElementById('errorContainer');
    if (errorContainer) {
      errorContainer.classList.add('d-none');
      errorContainer.textContent = '';
    }
  }

}); // End of DOMContentLoaded
</script>
</body>
</html>
