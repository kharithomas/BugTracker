<?php 

// Include config file
require_once "./../connections/config.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$id = $_REQUEST['id'];

$query = "SELECT * from tickets where id='".$id."'"; 
$result = mysqli_query($mysqli, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

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
                            <h1 class="h3 mb-0 text-gray-800">Details for Ticket #<?php echo $row['id'];?></h1>
                        </div>
                        <p class="py-2">
                            <a href="tickets.php">Back to List</a>
                            <a href="update_ticket.php?id=<?php echo $row['id'];?>">Edit Ticket</a>
                        </p>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card shadow p-3">
                            <div class="row">
                                <div class="col-12 py-2">
                                    <h5 class="section-title">Ticket Title</h5>
                                    <p><?php echo $row['name']; ?></p>
                                </div>
                                <hr>
                                <div class="col-md-6 py-2">
                                    <h5 class="section-title">Assigned Developer</h5>
                                    <p><?php echo $row['developer']; ?></p>
                                </div>
                                <div class="col-md-6 py-2">
                                    <h5 class="section-title">Submitter</h5>
                                    <p><?php echo $row['submitter']; ?></p>
                                </div>
                                <hr>
                                <div class="col-md-6 py-2">
                                    <h5 class="section-title">Project</h5>
                                    <p><?php echo $row['p_name']; ?></p>
                                </div>
                                <div class="col-md-6 py-2">
                                    <h5 class="section-title">Ticket Priority</h5>
                                    <p><?php echo $row['priority']; ?></p>
                                </div>
                                <hr>
                                <div class="col-md-6 py-2">
                                    <h5 class="section-title">Ticket Status</h5>
                                    <p><?php echo $row['status']; ?></p>
                                </div>
                                <div class="col-md-6 py-2">
                                    <h5 class="section-title">Ticket Type</h5>
                                    <p><?php echo $row['type']; ?></p>
                                </div>
                                <hr>
                                <div class="col-md-6 py-2">
                                    <h5 class="section-title">Created</h5>
                                    <p><?php echo $row['date_created']; ?></p>
                                </div>
                                <div class="col-md-6 py-2">
                                    <h5 class="section-title">Updated</h5>
                                    <p><?php echo $row['date_modified']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                    <th>Commenter</th>
                                    <th>Message</th>
                                    <th>Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sel_query="Select * from ticketComment";
                                    $result = mysqli_query($mysqli, $sel_query);
                                    while($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                        <td><?php echo $row["author"]; ?></td>
                                        <td><?php echo $row["message"]; ?></td>
                                        <td><?php echo $row["date_created"]; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <h1>Column 3</h1>
                    </div>
                    <div class="col-12 col-md-6">
                        <h1>Column 4</h1>
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