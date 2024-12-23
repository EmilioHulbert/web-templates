<?php
session_start();
include('../includes/dbconn.php');

// Check if the user is logged in
if(strlen($_SESSION['alogin']) == 0){
    header('location:index.php');
    exit;
}

// Handle CSV export when the form is submitted
if(isset($_POST['export_csv'])) {

    // Query to fetch the leave data
    $sql = "SELECT tblemployees.EmpId, tblemployees.FirstName, tblemployees.LastName, tblleaves.LeaveType, tblleaves.PostingDate, tblleaves.Status 
            FROM tblleaves 
            JOIN tblemployees ON tblleaves.empid = tblemployees.id
            ORDER BY tblleaves.id DESC";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are results
    if (count($results) > 0) {
        // Open PHP output stream as a file to write CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="leave_history.csv"');
        $output = fopen('php://output', 'w');
        
        // Add the header row to the CSV
        fputcsv($output, ['Employee ID', 'Full Name', 'Leave Type', 'Applied On', 'Status']);
        
        // Write the data rows to the CSV
        foreach ($results as $row) {
            $fullName = $row['FirstName'] . ' ' . $row['LastName'];
            $status = '';
            switch ($row['Status']) {
                case 1:
                    $status = 'Approved';
                    break;
                case 2:
                    $status = 'Declined';
                    break;
                case 0:
                    $status = 'Pending';
                    break;
            }
            // Write each row to CSV
            fputcsv($output, [$row['EmpId'], $fullName, $row['LeaveType'], $row['PostingDate'], $status]);
        }

        // Close the output stream
        fclose($output);
        exit;
    } else {
        echo "No data found to export.";
        exit;
    }
}
?>
