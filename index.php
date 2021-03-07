<?php

    // Add user-defined functions
    require_once('functions.php');
    
    // Add a new row to the database
    require_once('app/connect.php');

    
    // Include the headter
    include('./partials/header.php'); 

?>


<!-- Navigation -->
<?php require_once('partials/nav.php'); ?>
<!-- End Navigation -->




  <!-- Sign Up Form -->
  <!-- <div class="container"> 
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
    </div> -->
 <!-- End of Sign Up Form -->


    <!-- Page Content -->
    <div class="container"> 
            <h1 class="mt-5 mb-5">Bug Report</h1>

            <!-- Create New Notes -->
            <h2 class="mt-5 mb-5">Add New Bug</h2>

            <div class="row">
                <div class="col-md-6">
                    <form id="bugForm" action="app/insert.php" method="POST">
                        <div class="form-group">

                        <!-- Form Category -->
                            <label for="cat">Severity</label>
                            <select class="form-control" name="bugSeverity" id="bugSeverity">
                                <option value="1">Low</option>
                                <option value="2">Moderate</option>
                                <option value="3">High</option>
                            </select>
                        </div>

                            <!-- Form note title -->
                            <div class="form-group">
                                <label for="bugTitle">Bug Title</label>
                                <input type="text" class="form-control" id="bugTitle" name="bugTitle">
                            </div>
                                
                                <!-- Form note description -->
                                <div class="form-group">
                                    <label for="description">Bug Description</label>
                                    <textarea class="form-control" name="bugDescription" id="bugDescription"></textarea>
                                </div>
                                
                                <div class="row">

                                    <!-- Form due date -->
                                    <div class="form-group col-md-6">
                                        <label for="date">Date</label>
                                        <input class="form-control" type="date" id="bugDate" name="bugDate">
                                    </div>

                                    <div class="form-group col-md-6">

                                    <!-- Form status -->
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
                $sql = 'SELECT * FROM bug_reports';

                // prepare the statement
                $stmt = $mysqli->prepare($sql);

                $stmt->execute();
        
                $result = $stmt->get_result();


             ?>

            <!-- Display Active Bugs with bootstrap -->
            <h2 class="mt-5 mb-5">Open Bugs</h2>
            <div class="row mb-6">

            <?php      while($row = $result->fetch_assoc()) : ?>

                <div class="col-md-6 ">
                    <div class="card mb-5 ">
                        <div class="card-body border-success">

                            <!-- Archive button connected to the ID once clicked -->
                            <?php echo '<a class="float-right btn btn-info  " href="app/complete.php?id='. h($row['bug_id']).'">Resolve</a>'; ?>

                            <!-- Display the category for active notes -->
                            <!-- <h3 class="card-header"><?php echo h($row['bug_severity']) ?></h3> -->

                            <!-- Display the title for the active notes -->
                            <h3 class="card-header "><?php echo h($row['bug_title']) ?> </h3>

                            <!-- Display the date for the active notes -->
                            <p class="card-title "><strong>Date: </strong><?php echo  h($row['bug_created_date']) ?></p>

                            <!-- Display the note text for the active notes -->
                            <!-- <p class="text-dark"><?php echo h($row['bug_note']) ?></p> -->
                            <?php echo '<a class="float-right" href="view.php?id='. h($row['bug_id']).'"> 0 Comment</a>'; ?>
                        </div>
                    </div>
                </div>      
                <?php endwhile; /// ends DB results loop ?>

            </div>
            <!-- End active notes -->


                    <!-- include footer -->
    <?php include('./partials/footer.php'); ?>