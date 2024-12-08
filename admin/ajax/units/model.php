<?php
include_once "../../../autoload/loader.php";

$ctr = new UnitsController();

$id = $_POST['id'];
$name = strtoupper(trim($_POST['name']));

// Update manufacturer in the database
$ctr->updateModel($id, $name); // Call your update method here
// No response needed
