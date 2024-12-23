<?php
// Start session
session_start();

// Include database connection
include('../includes/dbconn.php');

// Check if user is logged in
if(strlen($_SESSION['alogin'])==0){   
    header('location:index.php');
    exit;
}

// Check if the export button is pressed
if(isset($_POST['export_csv'])) {
    $status = 2; // Declined leaves

    // Query to fetch declined leave records
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

    // Check if data is found
    if(count($results) > 0) {
        // Set filename for the CSV file
        $filename = "declined_leaves_" . date('Y-m-d') . ".csv";

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Open output stream for the CSV file
        $output = fopen('php://output', 'w');

        // Add column headers to the CSV
        fputcsv($output, ['S.N', 'Employee ID', 'Full Name', 'Leave Type', 'Applied On', 'Status']);

        // Write data to the CSV
        $cnt = 1;
        foreach ($results as $result) {
            // Set status text
            $status_text = '';
            if ($result->Status == 1) {
                $status_text = 'Approved';
            } elseif ($result->Status == 2) {
                $status_text = 'Declined';
            } elseif ($result->Status == 0) {
                $status_text = 'Pending';
            }

            // Write row to CSV
            fputcsv($output, [
                $cnt,
                $result->EmpId,
                $result->FirstName . ' ' . $result->LastName,
                $result->LeaveType,
                $result->PostingDate,
                $status_text
            ]);

            // Increment counter for serial number
            $cnt++;
        }

        // Close the output stream
        fclose($output);
        exit;
    } else {
        // If no data, show an error message
        $_SESSION['error'] = "No declined leave records found.";
        header('location:declined-history.php');
        exit;
    }
}
?>
