<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

        <div class="sidebar-profile">
            <div class="profile-circle">
                <i class="far fa-user"></i>
            </div>
            <div class="sidebar-profile-info">
                <div class="name"><?php echo htmlspecialchars($_SESSION['login']); ?></div>
                <div class="status">● Online</div>
            </div>
        </div>

        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Main Navigation</div>

                <a class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link <?php echo in_array($current_page, ['manage-circulars.php', 'add-circular.php', 'edit-circular.php']) ? 'active' : ''; ?>" href="manage-circulars.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
                    Upload Circular List
                </a>

                <a class="nav-link <?php echo in_array($current_page, ['manage-news.php', 'add-news.php', 'edit-news.php']) ? 'active' : ''; ?>" href="manage-news.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-newspaper"></i></div>
                    News
                </a>

                <a class="nav-link" href="web-main.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                    View Portal
                </a>

                <a class="nav-link <?php echo ($current_page == 'inward.php') ? 'active' : ''; ?>" href="manage-inward.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                    Inward
                </a>

                <a class="nav-link <?php echo in_array($current_page, ['manage-outward.php', 'add-outward.php', 'edit-outward.php']) ? 'active' : ''; ?>" href="manage-outward.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                    Outward
                </a>

                <a class="nav-link <?php echo in_array($current_page, ['it-assets.php']) ? 'active' : ''; ?>" href="it-assets.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-desktop"></i></div>
                    IT Assets
                </a>

                <a class="nav-link <?php echo in_array($current_page, ['manage-portal-blocks.php', 'edit-portal-block.php']) ? 'active' : ''; ?>" href="manage-portal-blocks.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div>
                    Portal Downloads
                </a>

                <a class="nav-link <?php echo in_array($current_page, ['manage-policies.php', 'add-policy-file.php', 'edit-policy.php']) ? 'active' : ''; ?>" href="manage-policies.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-pdf"></i></div>
                    Policies
                </a>
            </div>
    </nav>
</div>