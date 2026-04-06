<?php
include_once('./includes/auth-portal.php');
date_default_timezone_set('Asia/Kolkata');
include_once('./includes/config.php');

$itPolicyRow = mysqli_fetch_assoc(mysqli_query(
    $con,
    "SELECT file_name FROM portal_policies WHERE policy_key='it_policy'"
));

$cyberPolicyRow = mysqli_fetch_assoc(mysqli_query(
    $con,
    "SELECT file_name FROM portal_policies WHERE policy_key='cyber_security'"
));
$portalBlocksQuery = mysqli_query($con, "SELECT * FROM portal_blocks WHERE is_active=1 ORDER BY display_order ASC, id ASC");
mysqli_set_charset($con, "utf8mb4");

function time_elapsed_string($datetime)
{
    date_default_timezone_set('Asia/Kolkata');

    $timestamp = strtotime($datetime);
    $current = time();
    $diff = $current - $timestamp;

    if ($diff < 60) {
        return 'just now';
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } else {
        return date('M d, Y', $timestamp);
    }
}


$circularQuery = mysqli_query($con, "SELECT id, title, file_name FROM circulars WHERE is_active=1 ORDER BY id DESC LIMIT 10");
$newsQuery = mysqli_query($con, "SELECT * FROM news WHERE is_active=1 ORDER BY id DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="mr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MPSC Bank Portal</title>
    <link href="./css/portal.css" rel="stylesheet" />
</head>

<body>
    <div class="portal-page">

        <div class="portal-top-banner">
            <div class="portal-logo-box">
                <img src="./assets/logo.jpeg" alt="Bank Logo">
            </div>

            <div class="portal-title-box">
                <h1 class="bank-title">
                    मामासाहेब पवार सत्यविजय सहकारी बँक<br>
                    लि., कुंडल
                </h1>
            </div>
        </div>

        <div class="portal-menu-bar">
            <a href="dashboard.php" class="active">होम</a>
            <div class="portal-dropdown">
                <a href="javascript:void(0);">धोरण</a>
                <div class="portal-dropdown-menu">
                    <?php if (!empty($itPolicyRow['file_name'])) { ?>
                        <a href="./uploads/policies/<?php echo rawurlencode($itPolicyRow['file_name']); ?>">आयटी धोरण</a>
                    <?php } else { ?>
                        <a href="javascript:void(0);" class="disabled-link">आयटी धोरण</a>
                    <?php } ?>

                    <?php if (!empty($cyberPolicyRow['file_name'])) { ?>
                        <a href="./uploads/policies/<?php echo rawurlencode($cyberPolicyRow['file_name']); ?>">सायबर सिक्युरिटी धोरण</a>
                    <?php } else { ?>
                        <a href="javascript:void(0);" class="disabled-link">सायबर सिक्युरिटी धोरण</a>
                    <?php } ?>
                </div>
            </div>

            <div class="portal-navbar">
                <div class="menu-left">
                    <a href="#" target="_blank">वेबसाईट</a>
                    <a href="https://webmail.rediffmailpro.com/action/login/sanglidccb.bank.in" target="_blank">ई-मेल</a>
                    <a href="<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ? 'dashboard.php' : 'entry-forms.php'; ?>">
                        एंट्री फॉर्म / रिपोर्ट
                    </a>
                    <a href="#">संपर्क</a>
                </div>

                <div class="menu-right">
                    <a href="logout.php" class="logout-btn">⏻ लॉग आउट</a>
                </div>
            </div>
        </div>

        <div class="portal-main">
            <div class="portal-home-grid">

                <!-- LEFT COLUMN -->
                <div class="portal-left-stack">

                    <div class="portal-card">
                        <div class="portal-card-header">
                            <span>नवीन परिपत्रक</span>
                            <span class="live-dot"></span>
                        </div>

                        <div class="portal-card-body">
                            <ul class="circular-link-list">
                                <?php if ($circularQuery && mysqli_num_rows($circularQuery) > 0) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($circularQuery)) { ?>
                                        <li>
                                            <a href="./uploads/circulars/<?php echo rawurlencode($row['file_name']); ?>" target="_blank">
                                                <?php echo htmlspecialchars($row['title']); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php } else { ?>
                                    <li>No circulars available.</li>
                                <?php } ?>
                            </ul>
                        </div>

                        <div class="portal-see-all">
                            <a href="portal-circulars.php?dept=all&year=all">सर्व पहा..</a>
                        </div>
                    </div>

                    <?php if ($portalBlocksQuery && mysqli_num_rows($portalBlocksQuery) > 0) { ?>
                        <?php while ($block = mysqli_fetch_assoc($portalBlocksQuery)) { ?>
                            <div class="portal-side-link-card <?php echo htmlspecialchars($block['color_class']); ?>">
                                <div class="portal-side-link-title">
                                    <?php echo htmlspecialchars($block['block_title']); ?>
                                </div>

                                <?php if (!empty($block['file_name'])) { ?>
                                    <a href="./uploads/portal-blocks/<?php echo rawurlencode($block['file_name']); ?>" download class="portal-click-link">
                                        क्लिक करा..
                                    </a>
                                <?php } else { ?>
                                    <a href="javascript:void(0);" class="portal-click-link">
                                        क्लिक करा..
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>

                <!-- CENTER COLUMN -->
                <div class="portal-news-column">
                    <?php if ($newsQuery && mysqli_num_rows($newsQuery) > 0) { ?>
                        <?php while ($news = mysqli_fetch_assoc($newsQuery)) { ?>
                            <div class="portal-news-card">

                                <div class="portal-news-head">
                                    <img src="./assets/logo.jpeg" alt="Logo" class="portal-news-mini-logo">

                                    <div class="portal-news-head-text">
                                        <div class="portal-news-title">News</div>
                                        <div class="portal-news-time">
                                            <?php echo htmlspecialchars(time_elapsed_string($news['created_at'])); ?>
                                            <span class="portal-news-globe">🌍</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="portal-news-summary">
                                    <?php echo nl2br(htmlspecialchars($news['summary'])); ?>
                                </div>

                                <div class="portal-news-image-wrap">
                                    <img src="./uploads/news/<?php echo htmlspecialchars($news['image_name']); ?>" class="portal-news-image" alt="News">
                                </div>

                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="portal-placeholder"></div>
                    <?php } ?>
                </div>

                <!-- RIGHT COLUMN -->
                <div class="portal-placeholder"></div>

            </div>
        </div>

        <div class="portal-footer">
            <div>कॉपीराइट २०२६ © मामासाहेब पवार सत्यविजय सहकारी बँक लि., कुंडल. सर्व हक्क राखीव.</div>
            <div>Design and Developed By: Shreya Patil</div>
        </div>
    </div>
</body>

</html>