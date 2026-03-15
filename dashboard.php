<?php
session_start();
include_once('./includes/config.php');

if (!isset($_SESSION['adminid']) || strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

/* Dashboard counts */
$newsCount = 0;
$circularCount = 0;
$noticeCount = 0;
$employeeCount = 0;

$newsResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM news WHERE is_active=1");
if ($newsResult) {
    $newsData = mysqli_fetch_assoc($newsResult);
    $newsCount = (int)$newsData['total'];
}

$circularResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM circulars WHERE is_active=1");
if ($circularResult) {
    $circularData = mysqli_fetch_assoc($circularResult);
    $circularCount = (int)$circularData['total'];
}

$noticeResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM notices WHERE is_active=1");
if ($noticeResult) {
    $noticeData = mysqli_fetch_assoc($noticeResult);
    $noticeCount = (int)$noticeData['total'];
}

$employeeResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM employees WHERE status='Active'");
if ($employeeResult) {
    $employeeData = mysqli_fetch_assoc($employeeResult);
    $employeeCount = (int)$employeeData['total'];
}

/* Recent data */
$recentNews = mysqli_query($con, "SELECT id, title, publish_date FROM news WHERE is_active=1 ORDER BY id DESC LIMIT 5");
$recentCirculars = mysqli_query($con, "SELECT id, title, circular_no, publish_date FROM circulars WHERE is_active=1 ORDER BY id DESC LIMIT 5");
$recentNotices = mysqli_query($con, "SELECT id, title, priority, publish_date FROM notices WHERE is_active=1 ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard | SDCC Internal Portal</title>
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/custom.css" rel="stylesheet" />
    <link href="./css/dashboard.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include_once('includes/navbar.php'); ?>

    <div id="layoutSidenav">
        <?php include_once('includes/sidebar.php'); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="container-fluid">
                        <div class="page-title-row">
                            <h1>Dashboard</h1>
                            <div class="page-subtitle">Bank portal administration panel</div>
                        </div>

                        <div class="summary-strip">QR Code Process Summary</div>
                        <div class="summary-wrapper">
                            <div class="row">
                                <div class="col-lg col-md-6 col-sm-6">
                                    <div class="stat-box">
                                        <div class="stat-head bg-redish">Total Entry</div>
                                        <div class="stat-body"><?php echo $newsCount + $circularCount + $noticeCount + $employeeCount; ?></div>
                                    </div>
                                </div>

                                <div class="col-lg col-md-6 col-sm-6">
                                    <div class="stat-box">
                                        <div class="stat-head bg-blueish">Pending</div>
                                        <div class="stat-body"><?php echo $circularCount; ?></div>
                                    </div>
                                </div>

                                <div class="col-lg col-md-6 col-sm-6">
                                    <div class="stat-box">
                                        <div class="stat-head bg-greenish">Approved</div>
                                        <div class="stat-body"><?php echo $newsCount; ?></div>
                                    </div>
                                </div>

                                <div class="col-lg col-md-6 col-sm-6">
                                    <div class="stat-box">
                                        <div class="stat-head bg-orangeish">Rejected</div>
                                        <div class="stat-body"><?php echo $noticeCount; ?></div>
                                    </div>
                                </div>

                                <div class="col-lg col-md-6 col-sm-6">
                                    <div class="stat-box">
                                        <div class="stat-head bg-lightgreenish">QR Generated</div>
                                        <div class="stat-body"><?php echo $employeeCount; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="quick-box">
                            <div class="quick-box-header">
                                <span><i class="fas fa-bookmark me-2"></i>Quick Shortcuts</span>
                                <span><i class="fas fa-plus"></i> Add</span>
                            </div>
                            <div class="quick-box-body">
                                <a href=" https://share.google/v0sGI322DcU2pWU9D" target="_blank" class="shortcut-btn">
                                    <i class="fas fa-globe"></i>
                                    View Portal
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <?php include_once('./includes/footer.php'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./js/scripts.js"></script>
</body>

</html>