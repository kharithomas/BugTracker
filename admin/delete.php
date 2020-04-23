<!-- General delete class for projects, tickets, and associated files -->
<?php

// Initialize the session
session_start();

// Include config file
require_once "./../connections/config.php";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Deletes an item from any table given table_name, id, and return page
function delete($id, $table_name, $return, $mysqli) {
    $query = "DELETE FROM $table_name WHERE id=$id";
    $result = mysqli_query($mysqli, $query) or die (mysqli_error());
    header("Location: ".$return); 
}

if(isset($_REQUEST['id']) && ($_REQUEST['desc'] == 'p')) {
    $id = $_REQUEST['id'];
    $table_name = 'projects';
    $return = 'projects.php';
    delete($id, $table_name, $return, $mysqli);
} else if(isset($_REQUEST['id']) && ($_REQUEST['desc'] == 't')) {
    $id = $_REQUEST['id'];
    $table_name = 'tickets';
    $return = 'tickets.php';
    delete($id, $table_name, $return, $mysqli);
} else {
    echo "Something went wrong. Please try again later.";
}

?>