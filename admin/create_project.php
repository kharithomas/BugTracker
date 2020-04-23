<?php 

// Include config & class file
require_once "./../connections/config.php";
include("./classes/Create.php");

$ins_obj = new Create();

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['description'])) {
    
    $table_name = "projects";
    $name = $_POST['name'];
    $desc = $_POST['description'];

    $data = array(
        "name" => $name,
        "description" => $desc
    );

    $sql = $ins_obj->insert_data($table_name, $data);
    $result = mysqli_query($mysqli, $sql);

    if($result){
        // Records created successfully. Redirect to landing page
        header("location: projects.php");
        exit();
    } else{
        echo "Something went wrong. Please try again later.";
    }
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
                                <h1 class="h3 mb-0 text-gray-800">Create A Project</h1>
                            </div>
                            <p class="py-3">Create a new project by adding to this form.</p>
                            
                            <form action="create_project.php" method="post">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="description" class="form-control">
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