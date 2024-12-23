<?php
    include 'config.php';
    /* Start the session */
    session_start();
    /* remove all session variables */
    session_unset(); 
    /* destroy the session */
    session_destroy();

$closesqlcon=new Database();
$closesqlcon ->__destruct();
 header("location:{$base_url}admin/index.php");
?>