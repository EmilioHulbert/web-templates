<?php
session_start();
error_reporting(0);
include('../includes/dbconn.php');

// Check if the user is logged in and authorized
if(strlen($_SESSION['alogin']) == 0){   
    header('location:index.php');
    exit();
}

// Check if the form was submitted
if (isset($_POST['export_csv'])) {
    
    // Prepare the SQL query to fetch employee leave data
    $sql = "SELECT tblleaves.id as lid, tblemployees.EmpId, tblemployees.FirstName, tblemployees.LastName, tblleaves.LeaveType, tblleaves.PostingDate, tblleaves.Status FROM tblleaves JOIN tblemployees ON tblleaves.empid = tblemployees.id";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    // Define the file name and open it for writing
    $filename = "employee_leaves_" . date('Y-m-d') . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    $output = fopen('php://output', 'w');
    
    // Add the headers to the CSV file
    fputcsv($output, array('S.N', 'Employee ID', 'Full Name', 'Leave Type', 'Applied On', 'Status'));
    
    // Loop through the fetched data and write each row to the CSV file
    $cnt = 1;
    foreach ($results as $result) {
        $status = '';
        if ($result->Status == 1) {
            $status = 'Approved';
        } elseif ($result->Status == 2) {
            $status = 'Declined';
        } else {
            $status = 'Pending';
        }
        
        // Write row data to CSV
        fputcsv($output, array(
            $cnt,
            $result->EmpId,
            $result->FirstName . ' ' . $result->LastName,
            $result->LeaveType,
            $result->PostingDate,
            $status
        ));
        
        $cnt++;
    }
    
    // Close the file
    fclose($output);
    exit();
}
?>
