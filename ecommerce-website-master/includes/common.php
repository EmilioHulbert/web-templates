<?php
$con=mysqli_connect("localhost","admin","melody254","ecommerce");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
