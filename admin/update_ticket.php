<?php 

// Include config & class file
require_once "./../connections/config.php";
include("./classes/Create.php");
include("./classes/Models.php");

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

// Create an employee object for later use
$model_obj = new Models();


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
                                <h1 class="h3 mb-0 text-gray-800">Update A Ticket</h1>
                            </div>
                            <p class="py-3">Update a ticket using the form below.</p>
                        
                            <?php 
                            if(isset($_POST['new']) && $_POST['new'] == 1)
                            {
                                $id = $_REQUEST['id'];
                                $p_id =$_REQUEST['p_id'];
                                $name = $_REQUEST['name'];
                                $submitter = $_REQUEST['submitter'];
                                $status = $_REQUEST['status'];
                                $priority =$_REQUEST['priority'];
                                $type =$_REQUEST['type'];
                                $date_modified = date('Y-m-d H:i:s');

                                $update="UPDATE tickets SET p_id='".$p_id."', name='".$name."', submitter='".$submitter."', status='".$status."', priority='".$priority."', type='".$type."' WHERE id='".$id."'";

                                mysqli_query($mysqli, $update) or die(mysqli_error());

                            } else { ?>
                                <form action="" method="post" name="form">
                                    <input type="hidden" name="new" value="1" />
                                    <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
                                    <div class="form-group">
                                        <label>Ticket Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $row['name'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Project ID</label>
                                        <input type="number" name="p_id" class="form-control" value="<?php echo $row['p_id'];?>">
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
                                    <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                    <button type="button" class="btn btn-default" onclick="javascript:history.back()">Cancel</button>
                                </form>
                            <?php } ?>
                            
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