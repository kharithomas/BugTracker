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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Projects</h1>
          </div>
          <div class="row">
          <div class="col-md-12">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <a href="create_project.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create A New Project</a>
          </div>
          <div class="card shadow mb-4">
            <?php
                // Attempt select query execution
                $sql = "SELECT * FROM projects";
                if($result = $mysqli->query($sql)){
                    if($result->num_rows > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Name</th>";
                                    echo "<th>Description</th>";
                                    echo "<th>Actions</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $result->fetch_array()){
                                echo "<tr>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['description'] . "</td>";
                                    echo "<td>";
                                        echo "<a href='update_project.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'>
                                        <i class='fas fa-pencil-alt text-yellow px-2'></i>Edit</a>";
                                        echo "<a href='delete.php?id=". $row['id'] ."&desc=p' title='Delete Record' data-toggle='tooltip'><i class='fas fa-trash text-red px-2'></i>Remove</a>";
                                        
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                        // Free result set
                        $result->free();
                    } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                }

            // Close connection
            $mysqli->close();
            ?>
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