<?php
session_start();
error_reporting(0);
include('../includes/dbconn.php');

if(strlen($_SESSION['alogin']) == 0){
    header('location:index.php');
    exit;
}

if (isset($_POST['export_csv'])) {

    // Query to fetch employee data
    $sql = "SELECT EmpId, FirstName, LastName, Department, Status, RegDate FROM tblemployees";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Set CSV filename
    $filename = "employees_" . date('Y-m-d') . ".csv";

    // Set headers to force download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    // Open PHP output stream
    $output = fopen('php://output', 'w');

    // Add CSV column headers
    fputcsv($output, array('S.N', 'Employee ID', 'Full Name', 'Department', 'Joined On', 'Status'));

    // Write the employee data to the CSV
    $cnt = 1;
    foreach ($results as $result) {
        $status = ($result->Status == 1) ? 'Active' : 'Inactive';
        fputcsv($output, array(
            $cnt, 
            $result->EmpId, 
            $result->FirstName . ' ' . $result->LastName, 
            $result->Department, 
            $result->RegDate, 
            $status
        ));
        $cnt++;
    }

    // Close the file after writing
    fclose($output);
    exit();
}
?>
