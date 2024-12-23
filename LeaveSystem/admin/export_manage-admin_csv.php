<?php
// Start the session and include necessary files
session_start();
error_reporting(0);
include('../includes/dbconn.php');

// Check if the user is logged in
if(strlen($_SESSION['alogin'])==0){
    header('location:index.php');  // Redirect to login if not logged in
} else {
    // Fetch all admin records from the database
    $sql = "SELECT * FROM admin";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    
    // If there are results, proceed to export them as CSV
    if($query->rowCount() > 0) {
        // Set headers for the CSV file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="admin_data.csv"');
        
        // Open the output stream (php://output sends data to the browser)
        $output = fopen('php://output', 'w');
        
        // Write the column headers to the CSV file
        fputcsv($output, ['ID', 'Full Name', 'Username', 'Email', 'Account Created On']);
        
        // Loop through the results and write each row to the CSV
        foreach($results as $row) {
            fputcsv($output, [
                $row->id, 
                $row->fullname, 
                $row->UserName, 
                $row->email, 
                $row->updationDate
            ]);
        }
        
        // Close the file pointer
        fclose($output);
        exit();  // Ensure no further output is sent
    } else {
        // If no data found, show an error message
        echo "No admin data found.";
    }
}
?>
