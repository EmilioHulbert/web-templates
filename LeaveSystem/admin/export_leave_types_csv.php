<?php
session_start();
error_reporting(0);
include('../includes/dbconn.php');

// Check if the user is logged in
if(strlen($_SESSION['alogin'])==0){   
    header('location:index.php');
} else {
    // If the export button is pressed
    if(isset($_POST['export_csv'])) {
        
        // SQL query to fetch leave types
        $sql = "SELECT * from tblleavetype";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC); // Fetch results as an associative array

        // Check if there are any results
        if(count($results) > 0) {
            // Set the filename and content type headers
            $filename = "leave_types.csv";
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            
            // Open the output stream for writing
            $output = fopen('php://output', 'w');
            
            // Add column headers to the CSV file
            fputcsv($output, array('ID', 'Leave Type', 'Description', 'Creation Date'));

            // Loop through each result and write it to the CSV file
            foreach($results as $row) {
                fputcsv($output, $row);
            }
            
            // Close the output stream
            fclose($output);
            exit; // Prevent further script execution
        } else {
            echo "No leave types available to export.";
        }
    }
}
?>
