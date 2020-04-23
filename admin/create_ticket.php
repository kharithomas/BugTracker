<?php

  // Initialize the session
  session_start();

  // Include config file
  require_once "./../connections/config.php";
  require_once "./classes/Models.php";
  $model_obj = new Models();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  // Create an employee object for later use
  $model_obj = new Models();

  if(isset($_POST['submit'])) {

    $p_id = $_POST['p_id'];
    $name = $_POST['name'];
    $submitter = $_POST['submitter'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $type = $_POST['type'];

    $sql = "INSERT INTO `tickets`(`p_id`, `name`, `submitter`, `status`, `priority`, `type`) VALUES (?, ?, ?, ?, ?, ?)";

    if($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("isisss", $param_pid, $param_name, $param_submitter, $param_status, $param_priority, $param_type);
            
        // Set parameters
        $param_pid = (int)$p_id;
        $param_name = $name;
        $param_submitter = (int)$submitter;
        $param_status = $status;
        $param_priority = $priority;
        $param_type = $type;
        
        $result = $stmt->execute();
        // Attempt to execute the prepared statement
        if($result){
            // Records created successfully. Redirect to landing page
            header("location: tickets.php");
            exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }

     // Close statement
     $stmt->close();
    }
    
    // Close connection
    $mysqli->close();

    include('./includes/header.php'); 
    include('./includes/navbar.php');
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Insert Topbar -->
        <?php 
            include('./includes/topbar.php');
        ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header">
                                <h1 class="h3 mb-0 text-gray-800">Create A Ticket</h1>
                            </div>
                            <p class="py-3">Create a new ticket by adding to this form.</p>
                            <form action="create_ticket.php" method="post">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Project ID</label>
                                    <input type="number" name="p_id" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Submitter</label>
                                    <select class="form-control" name="submitter">
                                        <option>-Choose a Submitter-</option>
                                        <?php $model_obj->showEmployees();?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" >
                                        <option>-Choose a Status-</option>
                                        <?php $model_obj->showStatus();?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Priority</label>
                                    <select class="form-control" name="priority" >
                                        <?php $model_obj->showPriority();?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" name="type" >
                                        <?php $model_obj->showType();?>
                                    </select>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php 
include('./includes/footer.php'); 
include('./includes/scripts.php');
?>
