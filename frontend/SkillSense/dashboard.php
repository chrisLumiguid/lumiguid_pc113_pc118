<?php
// ─────────────────────────────────────────────────────────────────────────────
// 1) SESSION & SECURITY HARDENING
// ─────────────────────────────────────────────────────────────────────────────
// Prevent JavaScript access & enforce HTTPS-only cookies
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);      
ini_set('session.use_strict_mode', 1);



// Start (or resume) session
session_start();

// Regenerate on fresh login (do this after verifying credentials!)
// session_regenerate_id(true);

// ─────────────────────────────────────────────────────────────────────────────
// 2) REQUIRE AUTHENTICATION
// ─────────────────────────────────────────────────────────────────────────────
if (!isset($_SESSION['user_id'], $_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

// ─────────────────────────────────────────────────────────────────────────────
// 3) CAPTURE & SANITIZE REQUESTED PAGE
// ─────────────────────────────────────────────────────────────────────────────
$role = $_SESSION['role'];
$page = $_GET['page'] ?? 'dashboard';

// Allow only alphanumeric, underscore, and slash
$page = preg_replace('/[^a-zA-Z0-9_\/]/', '', $page);
$page = ltrim($page, '/');

// ─────────────────────────────────────────────────────────────────────────────
// 4) DEFINE ALLOWED PAGES PER ROLE
// ─────────────────────────────────────────────────────────────────────────────
$allowed_pages = [
    'admin' => [
        'dashboard'                      => 'pages/admin/dashboard.php',
        'logs'                           => 'pages/admin/logs.php',
        'overview'                       => 'pages/admin/overview.php',
        'users_mgmt/all_users'           => 'pages/admin/users_mgmt/all_users.php',
        'users_mgmt/employers'           => 'pages/admin/users_mgmt/employers.php',
        'users_mgmt/portfolio_owners'     => 'pages/admin/users_mgmt/portfolio_owners.php',
        'portfolio_mgmt/all_portfolios'  => 'pages/admin/portfolio_mgmt/all_portfolios.php',
        // 'portfolio_mgmt/pending'         => 'pages/admin/portfolio_mgmt/pending.php',
        'portfolio_mgmt/reports'         => 'pages/admin/portfolio_mgmt/reports.php',
        'project_mgmt/all_projects'         => 'pages/admin/project_mgmt/all_projects.php',
        'project_mgmt/upload_projects'         => 'pages/admin/project_mgmt/upload_projects.php',
        'testimonial_mgmt/all_testimonials' => 'pages/admin/testimonial_mgmt/all_testimonials.php',
        'testimonial_mgmt/pending' => 'pages/admin/testimonial_mgmt/pending.php',
    ],
    'portfolio_owner' => [
        'dashboard'      => 'pages/portfolio_owner/dashboard.php',
        'my_projects'    => 'pages/portfolio_owner/my_projects.php',
        'profile'        => 'pages/portfolio_owner/profile.php',
    ],
    'employer' => [
        'dashboard'      => 'pages/employer/dashboard.php',
        'search_talent'  => 'pages/employer/search_talent.php',
        'job_postings'   => 'pages/employer/job_postings.php',
    ],
];

// ─────────────────────────────────────────────────────────────────────────────
// 5) RESOLVE PAGE TO INCLUDE (OR 404)
// ─────────────────────────────────────────────────────────────────────────────
$default404 = __DIR__ . '/pages/404.php';
$page_to_include = $default404;

if (
    isset($allowed_pages[$role][$page])
    && file_exists(__DIR__ . '/' . $allowed_pages[$role][$page])
) {
    // Safely resolve path
    $target = realpath(__DIR__ . '/' . $allowed_pages[$role][$page]);
    $base = realpath(__DIR__);
    if ($target !== false && strpos($target, $base) === 0) {
        $page_to_include = $target;
    }
}

// ─────────────────────────────────────────────────────────────────────────────
// 6) SEND SECURITY HEADERS
// ─────────────────────────────────────────────────────────────────────────────
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
header('X-Content-Type-Options: nosniff');

// ─────────────────────────────────────────────────────────────────────────────
// 7) RENDER LAYOUT
// ─────────────────────────────────────────────────────────────────────────────
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title><?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?> Dashboard | SkillSense</title>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"/> -->
</head>
<body>

    <?php include __DIR__ . '/partials/header.php'; ?>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php
            // include the correct sidebar partial
            $sidebar = __DIR__ . "/partials/sidebar_{$role}.php";
            if (file_exists($sidebar)) {
                include $sidebar;
            } else {
                echo "<p>Sidebar not found for role.</p>";
            }
            ?>

        <div class="layout-page">
            <!-- Navbar -->
            <?php include __DIR__ . '/partials/nav.php'; ?>
            <!-- / Navbar -->

            
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <?php include $page_to_include; ?>
                </div>
            </div>
        </div>
        <div>
        </div>

  

  <!-- <footer> -->
    <?php include __DIR__ . '/partials/footer.php'; ?>
  <!-- </footer> -->

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
