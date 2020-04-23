<?php 

// Include config & class file
require_once "./../connections/config.php";
include("./classes/Create.php");

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$id = $_REQUEST['id'];

$query = "SELECT * from projects where id='".$id."'"; 
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
                                <h1 class="h3 mb-0 text-gray-800">Update A Project</h1>
                            </div>
                            <p class="py-3">Update a project using the form below.</p>
                        
                            <?php 
                            if(isset($_POST['new']) && $_POST['new'] == 1)
                            {
                                $id = $_REQUEST['id'];
                                $name =$_REQUEST['name'];
                                $description =$_REQUEST['description'];

                                $update="UPDATE projects SET name='".$name."', description='".$description."' WHERE id='".$id."'";

                                mysqli_query($mysqli, $update) or die(mysqli_error());

                            } else { ?>
                                <form action="" method="post" name="form">
                                    <input type="hidden" name="new" value="1" />
                                    <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
                                    <div class="form-group">
                                        <label>Project Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $row['name'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" name="description" class="form-control" value="<?php echo $row['description'];?>">
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