<?php
/**
 * Approve/Reject Transfer — Admin-only handler
 * Approve: Updates it_assets branch_name + marks transfer as Approved
 * Reject: Marks transfer as Rejected (no changes to it_assets)
 */

include_once('./includes/auth-admin.php');
include_once('./includes/config.php');
mysqli_set_charset($con, "utf8mb4");

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('location:it-asset-approval.php');
    exit();
}

// Get action type
$action = isset($_POST['action']) ? trim($_POST['action']) : '';
$transferId = isset($_POST['transfer_id']) ? (int) $_POST['transfer_id'] : 0;
$returnBranch = isset($_POST['branch']) ? trim($_POST['branch']) : '';

if ($transferId <= 0 || !in_array($action, ['approve', 'reject'])) {
    header('location:it-asset-approval.php?msg=invalid&branch=' . urlencode($returnBranch));
    exit();
}

// ─── APPROVE ───
if ($action === 'approve') {
    $assetId = isset($_POST['asset_id']) ? (int) $_POST['asset_id'] : 0;

    if ($assetId <= 0) {
        header('location:it-asset-approval.php?msg=invalid&branch=' . urlencode($returnBranch));
        exit();
    }

    // Fetch transfer record to get to_branch
    $fetchStmt = mysqli_prepare($con,
        "SELECT id, asset_id, to_branch FROM it_asset_transfers WHERE id = ? AND transfer_status = 'Pending'"
    );
    mysqli_stmt_bind_param($fetchStmt, "i", $transferId);
    mysqli_stmt_execute($fetchStmt);
    $fetchResult = mysqli_stmt_get_result($fetchStmt);
    $transfer = mysqli_fetch_assoc($fetchResult);
    mysqli_stmt_close($fetchStmt);

    if (!$transfer) {
        header('location:it-asset-approval.php?msg=invalid&branch=' . urlencode($returnBranch));
        exit();
    }

    // Begin transaction
    mysqli_begin_transaction($con);

    try {
        // 1. Update it_assets — change branch_name to to_branch
        $updateAsset = mysqli_prepare($con,
            "UPDATE it_assets SET branch_name = ? WHERE id = ?"
        );
        mysqli_stmt_bind_param($updateAsset, "si", $transfer['to_branch'], $transfer['asset_id']);
        mysqli_stmt_execute($updateAsset);
        mysqli_stmt_close($updateAsset);

        // 2. Update it_asset_transfers — mark as Approved + record approval timestamp
        $updateTransfer = mysqli_prepare($con,
            "UPDATE it_asset_transfers SET transfer_status = 'Approved', approved_at = NOW() WHERE id = ?"
        );
        mysqli_stmt_bind_param($updateTransfer, "i", $transferId);
        mysqli_stmt_execute($updateTransfer);
        mysqli_stmt_close($updateTransfer);

        mysqli_commit($con);
        header('location:it-asset-approval.php?msg=approved&branch=' . urlencode($returnBranch));

    } catch (Exception $e) {
        mysqli_rollback($con);
        header('location:it-asset-approval.php?msg=error&branch=' . urlencode($returnBranch));
    }
}

// ─── REJECT ───
if ($action === 'reject') {
    // Verify the transfer exists and is pending
    $checkStmt = mysqli_prepare($con,
        "SELECT id FROM it_asset_transfers WHERE id = ? AND transfer_status = 'Pending'"
    );
    mysqli_stmt_bind_param($checkStmt, "i", $transferId);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);
    mysqli_stmt_close($checkStmt);

    if (mysqli_num_rows($checkResult) === 0) {
        header('location:it-asset-approval.php?msg=invalid&branch=' . urlencode($returnBranch));
        exit();
    }

    // Update transfer status to Rejected
    $rejectStmt = mysqli_prepare($con,
        "UPDATE it_asset_transfers SET transfer_status = 'Rejected' WHERE id = ?"
    );
    mysqli_stmt_bind_param($rejectStmt, "i", $transferId);
    mysqli_stmt_execute($rejectStmt);
    mysqli_stmt_close($rejectStmt);

    header('location:it-asset-approval.php?msg=rejected&branch=' . urlencode($returnBranch));
}

exit();
?>
