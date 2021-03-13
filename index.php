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

?>


<!-- Navigation -->
<?php require_once('partials/nav.php'); ?>
<!-- End Navigation -->


<?php 
    // Print an error message to the user if the login is unsuccessful
    if(isset($_GET['msg'])): ?>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert <?php if($_GET['msg'] == 'signupSuccess' || $_GET['msg'] == 'loginSuccess')
                    { 
                        echo 'alert-success'; 

                    } else 
                    
                    { 
                        echo 'alert-warning'; 

                    } ?> mt-5">
                        <?php  

                            // custom function to print messages to screen
                            lg_msgs($_GET['msg']);

                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>





<!-- Show the sign up form, if the user is not logged in -->
 <?php   if(!isset($_SESSION['user_id'])):  ?>


  <!-- Sign Up Form -->
  <div class="container"> 
            <div class="row justify-content-center">
                <div class="col-6">        
                    <div class="card mb-5 mt-5">
                        <div class="card-body"> 
                            <h3 class="mb-5">Sign Up</h3>                
                            <form id="signupForm" action="./app/signup.php" method="POST">
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

<!-- if the user is logged in, show the bug list -->
        <?php else: ?>

    <!-- Page Content -->
    <div class="container"> 
            <h1 class="mt-5 mb-5">Bug Report</h1>

            <!-- Create Bugs -->
            <h2 class="mt-5 mb-5">Add New Bug</h2>

            <div class="row">
                <div class="col-md-6">
                    <form id="bugForm" action="app/insert.php" method="POST">
                        <div class="form-group">

                        <!-- Form Severity -->
                            <label for="cat">Severity</label>
                            <select class="form-control" name="bugSeverity" id="bugSeverity">
                                <option value="1">Low</option>
                                <option value="2">Moderate</option>
                                <option value="3">High</option>
                            </select>
                        </div>

                            <!-- Form Bug Title -->
                            <div class="form-group">
                                <label for="bugTitle">Bug Title</label>
                                <input type="text" class="form-control" id="bugTitle" name="bugTitle">
                            </div>
                                
                                <!-- Form Bug Description -->
                                <div class="form-group">
                                    <label for="description">Bug Description</label>
                                    <textarea class="form-control" name="bugDescription" id="bugDescription"></textarea>
                                </div>
                                
                                <div class="row">

                                    <!-- Form Bug Date Created -->
                                    <div class="form-group col-md-6">
                                        <label for="date">Date</label>
                                        <input class="form-control" type="date" id="bugDate" name="bugDate">
                                    </div>

                                    <div class="form-group col-md-6">

                                    <!-- Form Bug Status -->
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control">
                                                <option value="0">Active</option>
                                                <option value="1">Resolved</option>
                                        </select>
                                    </div>
                                </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary" name="newBug">Add New Bug</button>
                    </form>
                    </div>
                </div>
         <!-- End of form contents -->


            <!-- SELECT all active Bugs for the logged in user -->
            <?php
                $sql = 'SELECT * FROM bug_reports
                            WHERE bug_status = 0
                            ORDER BY bug_created_date DESC
                            LIMIT 4';

                // prepare the statement
                $stmt = $mysqli->prepare($sql);

                $stmt->execute();
        
                $result = $stmt->get_result();

             ?>


            
            <!-- Display Recent Bugs -->
            <h2 class="mt-5 mb-5">Recently Added Issues</h2>
            <div class="row mb-6">

            <?php      while($row = $result->fetch_assoc()) : ?>


                <div class="col-md-6 ">
                    <div class="card mb-5 ">
                        <div class="card-body border-success">

                            <!-- Resolve button connected to the ID once clicked -->
                            <?php echo '<a class="float-right btn btn-info  " href="app/complete.php?id='. h($row['bug_id']).'">Resolve</a>'; ?>

                            <!-- Display the issue number of the bug -->
                            <p class="text-dark" style="font-weight: bold;">Issue # <?php echo  h($row['bug_id']) ?>
                            <span class="badge <?php echo lg_severityBG(h($row['bug_severity'])); ?>"  style="padding: 0.5rem; margin-left: 0.5rem; font-size: 0.8rem;"><?php echo lg_severityResult(h($row['bug_severity'])); ?></span></p>

                            <!-- Display the title for the open bug -->
                            <h3 class="card-header "><?php echo h($row['bug_title']) ?> </h3>
                            
                            <!-- Display the date for the bug date -->
                            <p class="card-title" style="padding-top: 1rem; "><strong>Date: </strong><?php echo  h($row['bug_created_date']) ?>

                            <!-- Display the number of comments attached to the open bug -->
                            <?php echo '<a class="float-right" href="view.php?id='. h($row['bug_id']).'"> Add Comments</a></p>'; ?>

                        </div>
                    </div>
                </div>      
                <?php endwhile; /// ends DB results loop ?>

            </div>
            <!-- End recent bugs -->
    <?php endif; ?>   

                    <!-- include footer -->
    <?php include('./partials/footer.php'); ?>