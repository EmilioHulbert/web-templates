<?php
session_start();
include('../includes/dbconn.php');

// Check if the user is logged in
if(strlen($_SESSION['emplogin']) == 0) {
    header('location:../index.php');
    exit();
}

// Get employee ID from session
$eid = $_SESSION['eid'];

// Fetch employee leave history from the database
$sql = "SELECT LeaveType, ToDate, FromDate, Description, PostingDate, AdminRemarkDate, AdminRemark, Status FROM tblleaves WHERE empid=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

// Check if data exists
if(count($results) > 0) {
    // Set headers for CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="leave_history.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Open output stream (php://output writes directly to the browser)
    $output = fopen('php://output', 'w');
    
    // Add column headers to the CSV file
    fputcsv($output, ['#', 'Leave Type', 'Conditions', 'From', 'To', 'Applied', 'Admin Remark', 'Status']);
    
    // Write data to CSV file
    $cnt = 1;
    foreach($results as $result) {
        // Format the status field to readable format
        if($result->Status == 1) {
            $status = 'Approved';
        } elseif($result->Status == 2) {
            $status = 'Not Approved';
        } else {
            $status = 'Pending';
        }

        // Write the row of data
        fputcsv($output, [
            $cnt++, 
            $result->LeaveType, 
            $result->Description, 
            $result->FromDate, 
            $result->ToDate, 
            $result->PostingDate, 
            $result->AdminRemark ? $result->AdminRemark . ' at ' . $result->AdminRemarkDate : 'Pending',
            $status
        ]);
    }
    
    // Close the output stream
    fclose($output);
    exit();
} else {
    echo "No leave history available for this employee.";
    exit();
}
?>
