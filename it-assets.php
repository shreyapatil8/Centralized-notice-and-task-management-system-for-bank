<?php
session_start();
include_once('./includes/auth-admin.php');
include_once('./includes/config.php');

if (!isset($_SESSION['adminid']) || strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>IT Assets | MPSC Internal Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/custom.css" rel="stylesheet" />
    <link href="./css/it-assets.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<?php include_once('./includes/navbar.php'); ?>

<div id="layoutSidenav">
    <?php include_once('./includes/sidebar.php'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-3">
                <div class="it-assets-page">
                    <div class="it-assets-panel">

                        <h1 class="it-assets-title">IT ASSETS</h1>

                        <div class="it-assets-grid">

                            <div class="asset-card">
                                <div class="asset-card-top">
                                    <div class="asset-card-icon"><i class="fas fa-box"></i></div>
                                </div>
                                <div class="asset-card-middle">CPU</div>
                                <div class="asset-card-bottom">37</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top">
                                    <div class="asset-card-icon"><i class="fas fa-desktop"></i></div>
                                </div>
                                <div class="asset-card-middle">Monitor</div>
                                <div class="asset-card-bottom">46</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top teal">
                                    <div class="asset-card-icon dark"><i class="fas fa-keyboard"></i></div>
                                </div>
                                <div class="asset-card-middle">Keyboard</div>
                                <div class="asset-card-bottom teal">130</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top teal">
                                    <div class="asset-card-icon dark"><i class="fas fa-mouse-pointer"></i></div>
                                </div>
                                <div class="asset-card-middle">Mouse</div>
                                <div class="asset-card-bottom teal">129</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top">
                                    <div class="asset-card-icon"><i class="fas fa-tv"></i></div>
                                </div>
                                <div class="asset-card-middle multiline">Aio<br>Desktop</div>
                                <div class="asset-card-bottom">91</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top">
                                    <div class="asset-card-icon"><i class="fas fa-video"></i></div>
                                </div>
                                <div class="asset-card-middle">Projector</div>
                                <div class="asset-card-bottom">5</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top">
                                    <div class="asset-card-icon"><i class="fas fa-print"></i></div>
                                </div>
                                <div class="asset-card-middle">Printer</div>
                                <div class="asset-card-bottom">73</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top">
                                    <div class="asset-card-icon"><i class="far fa-map"></i></div>
                                </div>
                                <div class="asset-card-middle">Scanner</div>
                                <div class="asset-card-bottom">7</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top teal">
                                    <div class="asset-card-icon dark"><i class="fas fa-laptop"></i></div>
                                </div>
                                <div class="asset-card-middle">Laptop</div>
                                <div class="asset-card-bottom teal">51</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top teal">
                                    <div class="asset-card-icon dark"><i class="fas fa-minus"></i></div>
                                </div>
                                <div class="asset-card-middle">CCTV DVR</div>
                                <div class="asset-card-bottom teal">3</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top">
                                    <div class="asset-card-icon"><i class="fas fa-camera"></i></div>
                                </div>
                                <div class="asset-card-middle multiline">CCTV<br>Camera</div>
                                <div class="asset-card-bottom">16</div>
                            </div>

                            <div class="asset-card">
                                <div class="asset-card-top">
                                    <div class="asset-card-icon"><i class="fas fa-wifi"></i></div>
                                </div>
                                <div class="asset-card-middle multiline">N/W<br>Devices</div>
                                <div class="asset-card-bottom">30</div>
                            </div>

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