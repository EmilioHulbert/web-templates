<?php
session_start();
error_reporting(0);
include('../includes/dbconn.php');

// Ensure the user is logged in as admin
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
} else {
    // If the export button is pressed
    if(isset($_POST['export_csv'])) {
        
        // Prepare the SQL query to get all departments
        $sql = "SELECT * from tbldepartments";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC); // Fetch results as an associative array

        // Check if there are results
        if(count($results) > 0) {
            // Open a file in write mode to store CSV data
            $filename = "departments.csv";
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            
            // Create file pointer connected to output stream
            $output = fopen('php://output', 'w');
            
            // Add column headers to CSV
            fputcsv($output, array('ID', 'Department Name', 'Short Name', 'Department Code', 'Creation Date'));

            // Add each department as a row in the CSV
            foreach($results as $row) {
                fputcsv($output, $row);
            }
            
            // Close the file pointer
            fclose($output);
            exit; // End script to prevent further output
        } else {
            echo "No departments available to export.";
        }
    }
}
?>
