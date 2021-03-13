<?php

    // Add user-defined functions
    require_once('functions.php');
    
    // Add a new row to the database
    require_once('app/connect.php');

        // Start the PHP session
        if(session_status() == 1) {
            session_start();
        }
    
    
    // Include the headter
    include('./partials/header.php'); 


    if($_GET['cat_id'] !== 0){

        $title = "Open Bugs";
    
    } 
    
    if($_GET['cat_id']){

        $title = "Resolved Bugs";
    }

?>



    <!-- Navigation -->
    <?php require_once('partials/nav.php'); ?>
    <!-- End Navigation -->


<!-- Show the sign up form, if the user is not logged in -->
<?php   if(!isset($_SESSION['user_id'])):  ?>
    <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert mt-5 alert-warning">
                        <?php  

                            // custom function to print messages to screen
                            lg_msgs($_GET['cat_id']);

                        ?>
                    </div>
                </div>
            </div>
        </div>


  <!-- Sign Up Form -->
  <div class="container"> 
            <div class="row justify-content-center">
                <div class="col-6">        
                    <div class="card mb-5 mt-5">
                        <div class="card-body"> 
                            <h3 class="mb-5">Sign Up</h3>                
                            <form action="./app/signup.php" method="POST">
                                <div class="form-group">
                                    <label for="signupEmail">Email address</label>
                                    <input type="text" class="form-control" id="signupEmail" name="signupEmail" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="signupPassword">Password</label>
                                    <input type="password" class="form-control" id="signupPassword" name="signupPassword" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="signupPassword">Re-type Password</label>
                                    <input type="password" class="form-control" id="signupPasswordConfirm" name="signupPasswordConfirm" placeholder="Password">
                                </div>                                
                                <input name="signupSubmit" type="submit" class="btn btn-primary" value="Sign Up">
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </div>

<!-- if the user is logged in, show their todo list items -->
 <?php else: ?>
        </div>

    <div class="container"> 


                <!-- SELECT all active Bugs for the logged in user -->
                <?php
                $sql = 'SELECT * FROM bug_reports
                            WHERE bug_status = ?
                            ORDER BY bug_created_date DESC';

                // prepare the statement
                $stmt = $mysqli->prepare($sql);

                 //Bind parameters to be updated into database
                 $stmt->bind_param('i', $_GET['cat_id']);

                $stmt->execute();
        
                $result = $stmt->get_result();



             ?>

            
            <!-- Display Open Bugs with bootstrap -->
            <h2 class="mt-5 mb-5"><?php echo $title ?></h2>
            <div class="row mb-6">

            <?php      while($row = $result->fetch_assoc()) : ?>

                <div class="col-md-8 ">
                    <div class="card mb-5 ">
                        <div class="card-body border-success">

                            <!-- Resolve button connected to the ID once clicked -->
                            <?php if($_GET['cat_id'] == 0) : echo '<a name="resolve" class="float-right btn btn-info  " href="app/complete.php?id='. h($row['bug_id']).'" >Resolve</a>';
                                    
                                    // We show the Re-Open button
                                    else:
                                    
                                    echo '<a name="reopen" class="float-right btn btn-danger" href="app/complete.php?status=reopen&id='. h($row['bug_id']).'" >Re-Open</a>';
                                    endif;
                            ?>

                             <!-- Display the issue number of the bug -->
                             <p class="text-dark" style="font-weight: bold;">Issue # <?php echo  h($row['bug_id']) ?>
                            <span class="badge <?php echo lg_severityBG(h($row['bug_severity'])); ?>"  style="padding: 0.5rem; margin-left: 0.5rem; font-size: 0.8rem;"><?php echo lg_severityResult(h($row['bug_severity'])); ?></span></p>

                            <!-- Display the title for the open bug -->
                            <h3 class="card-header "><?php echo h($row['bug_title']) ?> </h3>
                            

                            <!-- Display the date for the bug date -->
                            <p class="card-title" style="padding-top: 1rem;"><strong>Date: </strong><?php echo  h($row['bug_created_date']) ?>

                            <!-- Display the number of comments attached to the open bug -->
                            <?php echo '<a class="float-right" href="view.php?id='. h($row['bug_id']).'" style="padding-top:0"> Add Comments</a></p>'; ?>

                        </div>
                    </div>
                </div>      
                <?php endwhile; /// ends DB results loop ?>

            </div>
            <!-- End active notes -->
    </div>

    <?php endif; ?>     
    <!-- include footer -->

                    <!-- include footer -->
    <?php include('./partials/footer.php'); ?>