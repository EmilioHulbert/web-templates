<?php
// Start session
session_start();

// Check if user is logged in
if(strlen($_SESSION['alogin'])==0){   
    header('location:index.php');
    exit;
}

// Include database connection
include('../includes/dbconn.php');

// Set status for approved leaves
$status = 1;

// Query to fetch approved leave records
$sql = "SELECT tblleaves.id as lid, tblemployees.FirstName, tblemployees.LastName, tblemployees.EmpId, tblemployees.id, tblleaves.LeaveType, tblleaves.PostingDate, tblleaves.Status
        FROM tblleaves
        JOIN tblemployees ON tblleaves.empid = tblemployees.id
        WHERE tblleaves.Status = :status
        ORDER BY lid DESC";

// Prepare and execute the query
$query = $dbh->prepare($sql);
$query->bindParam(':status', $status, PDO::PARAM_INT);
$query->execute();

// Fetch the results
$results = $query->fetchAll(PDO::FETCH_OBJ);

// Check if there are results
if($query->rowCount() > 0){
    // Set the filename for the CSV
    $filename = "approved_leaves_" . date('Y-m-d') . ".csv";
    
    // Set the headers to force download the file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Open output stream to write the CSV data
    $output = fopen('php://output', 'w');
    
    // Add column headers to CSV
    fputcsv($output, ['S.N', 'Employee ID', 'Full Name', 'Leave Type', 'Applied On', 'Status']);
    
    // Write data to CSV
    $cnt = 1;
    foreach($results as $result) {
        // Prepare the data for each row
        $status_text = '';
        if ($result->Status == 1) {
            $status_text = 'Approved';
        } elseif ($result->Status == 2) {
            $status_text = 'Declined';
        } elseif ($result->Status == 0) {
            $status_text = 'Pending';
        }
        
        // Write the row to CSV
        fputcsv($output, [
            $cnt,
            $result->EmpId,
            $result->FirstName . ' ' . $result->LastName,
            $result->LeaveType,
            $result->PostingDate,
            $status_text
        ]);
        
        // Increment serial number
        $cnt++;
    }
    
    // Close the output stream
    fclose($output);
    exit;
} else {
    // If no data, show an error message
    $_SESSION['error'] = "No approved leave records found.";
    header('location:approved-history.php');
    exit;
}
?>
