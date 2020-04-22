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
            <h1 class="h3 mb-0 text-gray-800">My Tickets</h1>
          </div>
          <div class="row">
          <div class="col-md-12">
          <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Create A New Ticket</a>
          </div> -->
            <?php
                // Attempt select query execution
                $sql = "SELECT t.id id, t.name t_title, p.name p_name, e.name dev, t.priority t_priority, t.status t_status, t.type t_type, t.date_created t_date_created FROM tickets t, projects p, employees e WHERE t.p_id = p.id AND p.id = e.id";
                if($result = $mysqli->query($sql)){
                    if($result->num_rows > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Title</th>";
                                    echo "<th>Project Name</th>";
                                    echo "<th>Developer Assigned</th>";
                                    echo "<th>Ticket Priority</th>";
                                    echo "<th>Ticket Status</th>";
                                    echo "<th>Ticket Type</th>";
                                    echo "<th>Created</th>";
                                    echo "<th>Actions</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = $result->fetch_array()){
                                echo "<tr>";
                                    echo "<td>" . $row['t_title'] . "</td>";
                                    echo "<td>" . $row['p_name'] . "</td>";
                                    echo "<td>" . $row['dev'] . "</td>";
                                    echo "<td>" . $row['t_priority'] . "</td>";
                                    echo "<td>" . $row['t_status'] . "</td>";
                                    echo "<td>" . $row['t_type'] . "</td>";
                                    echo "<td>" . $row['t_date_created'] . "</td>";
                                    echo "<td>";
                                        echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'>
                                        <i class='fas fa-pencil-alt text-yellow px-2'></i>Edit</a>";
                                        
                                        echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='fas fa-trash text-red px-2'></i>Details</a>";
                                        
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
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<?php 
    include('./includes/footer.php'); 
    include('./includes/scripts.php');
?>