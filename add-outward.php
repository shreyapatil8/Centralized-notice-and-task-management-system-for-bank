<?php
session_start();
include_once('./includes/auth-admin.php');
include_once('./includes/config.php');

if (!isset($_SESSION['adminid']) || strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

$error = '';

if (isset($_POST['submit'])) {
    $outward_no   = trim($_POST['outward_no']);
    $outward_date = trim($_POST['outward_date']);
    $outward_to   = trim($_POST['outward_to']);
    $details      = trim($_POST['details']);

    if (empty($outward_no) || empty($outward_date) || empty($outward_to) || empty($details)) {
        $error = "Please fill all required fields.";
    } else {
        $entry_by = "admin";

        $stmt = mysqli_prepare($con, "INSERT INTO outwards (outward_no, outward_date, outward_title, entry_by) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $outward_no, $outward_date, $outward_to, $entry_by);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: manage-outward.php");
            exit();
        } else {
            $error = "Something went wrong while saving outward entry.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Add Outward | MPSC Internal Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/custom.css" rel="stylesheet" />
    <link href="./css/inward.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<?php include_once('./includes/navbar.php'); ?>

<div id="layoutSidenav">
    <?php include_once('./includes/sidebar.php'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-3">
                <div class="inward-page">

                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php } ?>

                    <div class="inward-panel">
                        <div class="inward-panel-body">

                            <div class="inward-top-row">
                                <h2 class="inward-title">Add</h2>
                            </div>

                            <form method="post">
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <label class="inward-form-label"><span class="req">*</span>Outward No</label>
                                        <input type="text" name="outward_no" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="inward-form-label"><span class="req">*</span>Outward Date</label>
                                        <input type="datetime-local" name="outward_date" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="inward-form-label"><span class="req">*</span>Outward To</label>
                                        <input type="text" name="outward_to" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label class="inward-form-label"><span class="req">*</span>Details</label>
                                        <textarea name="details" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>

                                <button type="submit" name="submit" class="inward-save-btn">
                                    <i class="fas fa-check"></i> Save
                                </button>
                            </form>

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