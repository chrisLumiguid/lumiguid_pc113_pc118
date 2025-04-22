<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];
$page = preg_replace('/[^a-zA-Z0-9_\/]/', '', $_GET['page'] ?? 'dashboard'); // allow nested paths like users_mgmt/all_users


$allowed_pages = [
    'admin' => [
        'dashboard' => 'pages/admin/dashboard.php',
        'logs' => 'pages/admin/logs.php',
        'overview' => 'pages/admin/overview.php',
        'users_mgmt/all_users' => 'pages/admin/users_mgmt/all_users.php',
        'users_mgmt/employers' => 'pages/admin/users_mgmt/employers.php',
        'users_mgmt/portfolio_owner' => 'pages/admin/users_mgmt/portfolio_owner.php',
        'portfolio_mgmt/all_portfolios' => 'pages/admin/portfolio_mgmt/all_portfolios.php',
        'portfolio_mgmt/pending' => 'pages/admin/portfolio_mgmt/pending.php',
        'portfolio_mgmt/reports' => 'pages/admin/portfolio_mgmt/reports.php',
    ],
    'portfolio_owner' => [
        'dashboard' => 'pages/portfolio_owner/dashboard.php',
        'my_projects' => 'pages/portfolio_owner/my_projects.php',
        'profile' => 'pages/portfolio_owner/profile.php'
    ],
    'employer' => [
        'dashboard' => 'pages/employer/dashboard.php',
        'search_talent' => 'pages/employer/search_talent.php',
        'job_postings' => 'pages/employer/job_postings.php'
    ]
];

// Check access and load page
$page_to_include = $allowed_pages[$role][$page] ?? 'pages/404.php';

if (!file_exists($page_to_include)) {
    $page_to_include = 'pages/404.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <header>
        <?php include 'partials/header.php'; ?>
    </header>

    <aside>
        <?php include "partials/{$role}/sidebar.php"; ?>
    </aside>

    <main>
        <?php include $page_to_include; ?>
    </main>

    <footer>
        <?php include 'partials/footer.php'; ?>
    </footer>
</body>
</html>
