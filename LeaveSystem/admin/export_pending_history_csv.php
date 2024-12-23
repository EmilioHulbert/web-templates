<?php
session_start();
error_reporting(0);
include('../includes/dbconn.php');
if(strlen($_SESSION['alogin'])==0){   
    header('location:index.php');
} else {

// Export CSV logic
if(isset($_POST['export_csv'])) {
    $status = 0;  // pending status
    // Query to fetch pending leaves
    $sql = "SELECT tblleaves.id as lid, tblemployees.EmpId, tblemployees.FirstName, tblemployees.LastName, tblleaves.LeaveType, tblleaves.PostingDate, tblleaves.Status FROM tblleaves JOIN tblemployees ON tblleaves.empid = tblemployees.id WHERE tblleaves.Status = :status ORDER BY lid DESC";
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    // Define the CSV file name
    $filename = "pending_leave_requests_" . date('Y-m-d_H-i-s') . ".csv";

    // Open the output stream
    $output = fopen('php://output', 'w');

    // Send the header to download the file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Add the CSV column headers
    fputcsv($output, ['Employee ID', 'Full Name', 'Leave Type', 'Applied On', 'Current Status']);

    // Loop through results and add to the CSV
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $statusText = '';
            switch ($result->Status) {
                case 1:
                    $statusText = 'Approved';
                    break;
                case 2:
                    $statusText = 'Declined';
                    break;
                case 0:
                    $statusText = 'Pending';
                    break;
            }

            fputcsv($output, [
                $result->EmpId,
                $result->FirstName . ' ' . $result->LastName,
                $result->LeaveType,
                $result->PostingDate,
                $statusText
            ]);
        }
    }

    // Close the output stream
    fclose($output);
    exit();  // Stop the rest of the page from rendering
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- (existing head content) -->
</head>

<body>
    <!-- (existing body content) -->
    <div class="col-md-12 mb-3 text-right">
        <form action="export_pending_history_csv.php" method="post">
            <button type="submit" name="export_csv" class="btn btn-success">Export to CSV</button>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Table for displaying pending leave requests -->
            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered progress-table text-center">
                        <thead class="text-uppercase">
                            <tr>
                                <td>S.N</td>
                                <td>Employee ID</td>
                                <td width="120">Full Name</td>
                                <td>Leave Type</td>
                                <td>Applied On</td>
                                <td>Current Status</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $status = 0;
                            $sql = "SELECT tblleaves.id as lid, tblemployees.FirstName, tblemployees.LastName, tblemployees.EmpId, tblemployees.id, tblleaves.LeaveType, tblleaves.PostingDate, tblleaves.Status FROM tblleaves JOIN tblemployees ON tblleaves.empid = tblemployees.id WHERE tblleaves.Status = :status ORDER BY lid DESC";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':status', $status, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>  
                                    <tr>
                                        <td><b><?php echo htmlentities($cnt); ?></b></td>
                                        <td><?php echo htmlentities($result->EmpId); ?></td>
                                        <td><a href="update-employee.php?empid=<?php echo htmlentities($result->id); ?>" target="_blank"><?php echo htmlentities($result->FirstName . " " . $result->LastName); ?></a></td>
                                        <td><?php echo htmlentities($result->LeaveType); ?></td>
                                        <td><?php echo htmlentities($result->PostingDate); ?></td>
                                        <td><?php 
                                            $status = $result->Status;
                                            if ($status == 1) {
                                                echo '<span style="color: green">Approved <i class="fa fa-thumbs-o-up"></i></span>';
                                            } elseif ($status == 2) {
                                                echo '<span style="color: red">Declined <i class="fa fa-thumbs-o-down"></i></span>';
                                            } elseif ($status == 0) {
                                                echo '<span style="color: blue">Pending <i class="fa fa-spinner"></i></span>';
                                            }
                                        ?></td>
                                        <td><a href="employeeLeave-details.php?leaveid=<?php echo htmlentities($result->lid); ?>" class="btn btn-secondary btn-sm">View Details</a></td>
                                    </tr>
                                    <?php $cnt++; 
                                } 
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- (existing footer content) -->
</body>

</html>

<?php } ?>
