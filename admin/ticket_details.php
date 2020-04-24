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

// Check whether the user submitted a comment
if(isset($_POST['submit_comment'])) {
    $commenter = (int)'2'; // change this to be dynamic
    $msg = $_POST['notes'];
    $date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO ticket_comment (t_id, commenter, message, date_created) VALUES (?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $id, $commenter, $msg, $date);
    $stmt->execute(); 

}

if(isset($_POST['insert'])){
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $uploader = (int)'1';
    $notes = 'This is a test upload';

    $query = "INSERT INTO ticket_attachment(t_id, file, uploader, notes) VALUES ($id, $file,$uploader, $notes)";

    if(mysqli_query($mysqli, $query)) {
        echo '<script>alert("Image inserted into database")</script>';
    }
}

// Initialize message variable
$msg = "";
// Check whether the user uploaded an attachment
if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];
    // Get text
    $image_text = mysqli_real_escape_string($mysqli, $_POST['image_text']);

    // image file directory
    $target = "img/".basename($image);
    
    $uploader = 1;
    $tid = (int)$id;

    $sql = "INSERT INTO ticket_attachment (t_id, image, uploader, image_text) VALUES ( '$tid', '$image', '$uploader', '$image_text')";
    // execute query
    mysqli_query($mysqli, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo '<script>alert("Image uploaded successfully");</script>';
    }else{
        echo '<script>alert("Failed to upload image");</script>';
    }
}

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
                            <span><a href="tickets.php">Back to List</a></span>
                            <span class="px-2"><a href="update_ticket.php?id=<?php echo $row['id'];?>">Edit Ticket</a></span>
                        </p>
                    </div>
                    <div class="col-12 col-md-6">
                    <!-- General ticket details -->
                        <div class="card shadow p-3 mb-4">
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
                    <!-- Ticket comments -->
                        <form action="" method="post" class="pb-2">
                            <input type="text" name="notes">
                            <input type='submit' value='Add comment' name='submit_comment'>
                        </form>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Ticket Comments</h6>
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
                                    $sel_query="Select e.name commenter, tc.message msg, tc.date_created dc from ticket_comment tc, employees e where tc.t_id = $id && tc.commenter = e.id";
                                    $result = mysqli_query($mysqli, $sel_query);
                                    while($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                        <td><?php echo $row["commenter"]; ?></td>
                                        <td><?php echo $row["msg"]; ?></td>
                                        <td><?php echo $row["dc"]; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Ticket history -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Ticket History</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                    <th>Submitter</th>
                                    <th>Date Changed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sel_query="Select submitter, updated from ticket_history where t_id = $id";
                                    $result = mysqli_query($mysqli, $sel_query);
                                    while($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                        <td><?php echo $row["property"]; ?></td>
                                        <td><?php echo $row["old_value"]; ?></td>
                                        <td><?php echo $row["new_value"]; ?></td>
                                        <td><?php echo $row["date_modified"]; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Ticket attachments -->
                        <div class="my-3">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
                                <div>
                                    <input type="file" name="image">
                                </div>
                                <div>
                                    <textarea 
                                        id="text" 
                                        cols="25" 
                                        rows="1" 
                                        name="image_text" 
                                        placeholder="Enter notes..."></textarea>
                                </div>
                                <div>
                                    <button type="submit" name="upload">Upload</button>
                                </div>
                            </form>
                        </div>
                        <div class="card shadow my-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Ticket Attachments</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                    <th>File</th>
                                    <th>Uploader</th>
                                    <th>Notes</th>
                                    <th>Created</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sel_query="Select ta.image image, e.name uploader, ta.image_text text, ta.date_created dc from ticket_attachment ta, employees e where t_id = $id && ta.uploader = e.id";
                                    $result = mysqli_query($mysqli, $sel_query);
                                    while($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                        <td><?php echo $row["image"]; ?></td>
                                        <td><?php echo $row["uploader"]; ?></td>
                                        <td><?php echo $row["text"]; ?></td>
                                        <td><?php echo $row["dc"]; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
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