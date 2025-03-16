<?php
include "../autoload/loader.php";
session_start();

if (!isset($_SESSION['phone_no'])) {
    echo "Session expired. Please start again.";
    exit;
}

$ctr = new AuthController();
$ctr->finalizeSignUp();
