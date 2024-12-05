<?php

require_once('../autoload/loader.php');
if (isset($_SESSION['admin_username']) && !empty($_SESSION['admin_username'])) {
    // User is logged in as admin, redirect to admin dashboard
    new Redirect('dashboard');
} else {
    new Redirect('login');
}