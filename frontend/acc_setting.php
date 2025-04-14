<!DOCTYPE html>
<html
  lang="en"
  class="layout-menu-fixed layout-compact"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account Settings | TinangLab</title>

  <?php include 'stud_employee/header.php'; ?>

  <style>
    .content-wrapper {
      margin-left: var(--sidebar-width);
      padding: 50px;
      flex-grow: 1;
      transition: margin-left 0.3s ease;
    }

    .sidebar.collapsed ~ nav ~ .content-wrapper {
      margin-left: var(--sidebar-collapsed-width);
    }

    .account-settings-wrapper {
      max-width: 900px;
      margin: 0 auto;
      transition: all 0.3s ease;
    }

    .layout-menu-collapsed .account-settings-wrapper {
      margin-left: auto !important;
      margin-right: auto !important;
    }

    @media (max-width: 991.98px) {
      .account-settings-wrapper {
        padding-left: 1rem;
        padding-right: 1rem;
      }
    }
  </style>
</head>

<body>
  <?php include 'partials/sidebar.php'; ?>
  <?php include 'partials/navbar.php'; ?>

  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-md-12 account-settings-wrapper">
          <div class="nav-align-top">
            <ul class="nav nav-pills flex-column flex-md-row mb-6 gap-md-0 gap-2">
              <li class="nav-item">
                <a class="nav-link active" href="#"><i class="bx bx-user me-2"></i> Account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="bx bx-bell me-2"></i> Notifications</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="bx bx-link-alt me-2"></i> Connections</a>
              </li>
            </ul>
          </div>

          <div class="card mb-6">
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4 pb-4 border-bottom">
                <img src="../assets/img/avatars/1.png" alt="user-avatar" class="w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" id="upload" name="profile_picture" class="account-file-input" hidden accept="image/png, image/jpeg" />
                  </label>
                  <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" id="resetImage">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button>
                  <div>Allowed JPG, GIF, PNG. Max size of 800K</div>
                </div>
              </div>
            </div>

            <div class="card-body pt-4">
              <form id="formAccountSettings" method="POST" enctype="multipart/form-data">
                <div class="row g-4">
                  <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input class="form-control" type="text" id="firstName" name="firstName" value="John" />
                  </div>
                  <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input class="form-control" type="text" id="lastName" name="lastName" value="Doe" />
                  </div>
                  <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="email" id="email" name="email" value="john.doe@example.com" />
                  </div>
                  <div class="col-md-6">
                    <label for="organization" class="form-label">Organization</label>
                    <input class="form-control" type="text" id="organization" name="organization" value="TinangLab" />
                  </div>
                  <div class="col-md-6">
                    <label for="fileUpload" class="form-label">Upload Resume or File</label>
                    <input type="file" id="fileUpload" name="resume" class="dropify"
                      data-allowed-file-extensions="jpg png jpeg pdf docx"
                      data-max-file-size="2M"
                      data-height="120" />
                  </div>
                </div>

                <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-3">Save Changes</button>
                  <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                </div>
              </form>
            </div>
          </div>

          <div class="card mt-4">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
              <div class="alert alert-warning">
                <h5 class="alert-heading mb-1">Are you sure?</h5>
                <p class="mb-0">Once you delete your account, it cannot be undone.</p>
              </div>
              <form id="formAccountDeactivation" onsubmit="return false">
                <div class="form-check my-3 ms-1">
                  <input class="form-check-input" type="checkbox" id="accountActivation" />
                  <label class="form-check-label" for="accountActivation">I confirm deactivation</label>
                </div>
                <button type="submit" class="btn btn-danger">Deactivate Account</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="content-backdrop fade"></div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function () {
      // Initialize Dropify
      $('.dropify').dropify();

      // SweetAlert for file selection
      $('#fileUpload').on('change', function () {
        const file = this.files[0];
        if (file) {
          Swal.fire({
            icon: 'success',
            title: 'File Selected!',
            text: `You selected "${file.name}"`,
            timer: 1800,
            showConfirmButton: false
          });
        }
      });

      // Reset avatar
      $('#resetImage').on('click', function () {
        $('#upload').val('');
        $('#uploadedAvatar').attr('src', '../assets/img/avatars/1.png');
      });
    });

    // Handle form submit
    $('#formAccountSettings').on('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      const profilePic = $('#upload')[0].files[0];
      if (profilePic) {
        formData.append('profile_picture', profilePic);
      }

      $.ajax({
        url: 'http://localhost:8000/api/update-profile',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        },
        success: function (response) {
          Swal.fire({
            icon: 'success',
            title: 'Profile Updated!',
            text: response.message
          });

          if (response.user?.profile_picture) {
            $('#uploadedAvatar').attr('src', '/storage/' + response.user.profile_picture);
          }
        },
        error: function (xhr) {
          const err = xhr.responseJSON?.message || 'Something went wrong';
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: err
          });
        }
      });
    });
  </script>
</body>
</html>
