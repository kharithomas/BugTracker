<?php
  // Initialize the session
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }

  include('./includes/header.php'); 
  include('./includes/navbar.php');
  include_once('./../connections/config.php');

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
            
            <!-- enter content here -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php 
    include('./includes/footer.php'); 
    include('./includes/scripts.php');
?>