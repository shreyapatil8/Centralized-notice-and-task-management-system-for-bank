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

                <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="https://share.google/v0sGI322DcU2pWU9D" target="_blank">
                    <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                    View Portal
                </a>

                <a class="nav-link <?php echo ($current_page == 'inward.php') ? 'active' : ''; ?>" href="manage-inward.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div>
                    Inword
                </a>

                <a class="nav-link <?php echo ($current_page == 'outward.php') ? 'active' : ''; ?>" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                    Outward
                </a>

                <a class="nav-link <?php echo ($current_page == 'bdp-dashboard.php') ? 'active' : ''; ?>" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                    BDP Dashboard
                </a>

                <a class="nav-link <?php echo ($current_page == 'fund-management.php') ? 'active' : ''; ?>" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-usd"></i></div>
                    Fund Management
                </a>

                <a class="nav-link <?php echo ($current_page == 'system-audit-dashboard.php') ? 'active' : ''; ?>" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-check"></i></div>
                    System Audit Dashboard
                </a>

                <a class="nav-link <?php echo ($current_page == 'reports.php') ? 'active' : ''; ?>" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                    Reports
                </a>

                <a class="nav-link <?php echo ($current_page == 'it-bdp-report.php') ? 'active' : ''; ?>" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-laptop-code"></i></div>
                    IT BDP Report
                </a>
            </div>
        </div>
    </nav>
</div>