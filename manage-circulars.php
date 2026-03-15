<?php
session_start();
include_once('./includes/config.php');

if (!isset($_SESSION['adminid']) || strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

$message = '';

if (isset($_GET['toggle']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $newStatus = (int)$_GET['toggle'];

    $stmt = mysqli_prepare($con, "UPDATE circulars SET is_active=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ii", $newStatus, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $message = "Circular status updated successfully.";
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$department = isset($_GET['department']) ? trim($_GET['department']) : '';
$from_date = isset($_GET['from_date']) ? trim($_GET['from_date']) : '';
$to_date = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';

$sql = "SELECT * FROM circulars WHERE 1=1";
$params = [];
$types = '';

if ($search !== '') {
    $sql .= " AND (circular_no LIKE ? OR title LIKE ? OR department LIKE ?)";
    $searchLike = "%$search%";
    $params[] = $searchLike;
    $params[] = $searchLike;
    $params[] = $searchLike;
    $types .= 'sss';
}

if ($department !== '') {
    $sql .= " AND department = ?";
    $params[] = $department;
    $types .= 's';
}

if ($from_date !== '') {
    $sql .= " AND publish_date >= ?";
    $params[] = $from_date;
    $types .= 's';
}

if ($to_date !== '') {
    $sql .= " AND publish_date <= ?";
    $params[] = $to_date;
    $types .= 's';
}

$sql .= " ORDER BY id DESC";

$stmt = mysqli_prepare($con, $sql);
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$deptResult = mysqli_query($con, "SELECT department_name FROM departments WHERE is_active=1 ORDER BY department_name ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Manage Circulars | MPSC Internal Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="./css/styles.css" rel="stylesheet" />
    <link href="./css/custom.css" rel="stylesheet" />
    <link href="./css/circular.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include_once('./includes/navbar.php'); ?>

    <div id="layoutSidenav">
        <?php include_once('./includes/sidebar.php'); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-3">
                    <div class="circular-ref-page">

                        <?php if (!empty($message)) { ?>
                            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
                        <?php } ?>

                        <div class="circular-ref-panel">
                            <div class="circular-ref-panel-body">

                                <div class="circular-ref-title-row">
                                    <h2 class="circular-ref-title">Bank Circulars Listing</h2>

                                    <form method="get" class="circular-ref-search">
                                        <input type="text" name="search" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>">
                                        <button type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>

                                <form method="get">
                                    <div class="circular-ref-filter-row">
                                        <select name="department" class="dept-select">
                                            <option value="">All Department</option>
                                            <?php while ($dept = mysqli_fetch_assoc($deptResult)) { ?>
                                                <option value="<?php echo htmlspecialchars($dept['department_name']); ?>" <?php echo ($department == $dept['department_name']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($dept['department_name']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                        <div class="circular-ref-date-box">
                                            <input type="date" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>

                                        <div class="circular-ref-date-box">
                                            <input type="date" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>">
                                            <i class="far fa-calendar-alt"></i>
                                        </div>

                                        <button type="submit" class="circular-ref-icon-btn circular-ref-search-btn">
                                            <i class="fas fa-search"></i>
                                        </button>

                                        <a href="manage-circulars.php" class="circular-ref-icon-btn circular-ref-reset-btn">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>

                                        <a href="add-circular.php" class="circular-ref-add-btn">
                                            <i class="fas fa-plus"></i> Add Circular
                                        </a>
                                    </div>
                                </form>

                                <div class="circular-ref-table-wrap">
                                    <div class="table-responsive">
                                        <table class="table-circular-ref">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No.</th>
                                                    <th>Outward No</th>
                                                    <th>Circular Date</th>
                                                    <th>Circulars Title</th>
                                                    <th>Department</th>
                                                    <th>Upload Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sr = 1;
                                                if ($result && mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $sr++; ?></td>
                                                            <td><?php echo htmlspecialchars($row['circular_no']); ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($row['publish_date'])); ?></td>
                                                            <td>
                                                                <div class="circular-ref-title-text">
                                                                    <?php echo nl2br(htmlspecialchars($row['title'])); ?>
                                                                </div>
                                                            </td>
                                                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
                                                            <td>
                                                                <div class="circular-ref-actions">
                                                                    <a href="edit-circular.php?id=<?php echo (int)$row['id']; ?>" class="circular-ref-edit">
                                                                        <i class="fas fa-pen me-1"></i>Edit

                                                                        <?php if ($row['is_active'] == 1) { ?>
                                                                            <a href="manage-circulars.php?id=<?php echo (int)$row['id']; ?>&toggle=0"
                                                                                class="circular-ref-delete"
                                                                                onclick="return confirm('Deactivate this circular?');">
                                                                                <i class="fas fa-trash-alt me-1"></i>Delete
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <a href="manage-circulars.php?id=<?php echo (int)$row['id']; ?>&toggle=1"
                                                                                class="circular-ref-edit"
                                                                                onclick="return confirm('Activate this circular?');">
                                                                                <i class="fas fa-check me-1"></i>Activate
                                                                            </a>
                                                                        <?php } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="7" class="circular-ref-empty">No circulars found.</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
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