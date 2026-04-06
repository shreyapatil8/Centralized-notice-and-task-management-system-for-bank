<?php
session_start();
include_once('./includes/auth-admin.php');
if (!isset($_SESSION['adminid']) || strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Outward | MPSC Internal Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/custom.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
<?php include_once('./includes/navbar.php'); ?>
<div id="layoutSidenav">
    <?php include_once('./includes/sidebar.php'); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 pt-4">
                <div class="alert alert-info">Edit Outward page will be built next.</div>
            </div>
        </main>
        <?php include_once('./includes/footer.php'); ?>
    </div>
</div>
</body>
</html>