<?php
    // Add user-defined functions
    require_once('functions.php');

    //include connection to DB from separate file
    require_once('app/connect.php');


    // Start the PHP session
    if(session_status() == 1) {

        session_start();

    }

        // Include the headter
        include('./partials/header.php'); 

        // Navigation -->
        require_once('partials/nav.php');
        //  End Navigation -->

        $today = date("Y-m-d");  

    // Check if the ID param in the URL exists
    if (!isset($_GET['id'])) {

        exit('No ID specified!');
    }

        //Select the bug issue based on the ID
        $sql = "SELECT * FROM bug_reports
                   WHERE bug_id = ?";

        $stmt = $mysqli->prepare($sql);
    
        //Bind parameters to be updated into database
        $stmt->bind_param('i', $_GET['id']);
    
        //Execute the query and update entry in database
        $stmt->execute();

        $result = $stmt->get_result();

    
        ?>

    <?php         
    
    // select statement to query both the bug details and comments associated 
            $sql = "SELECT * FROM bug_reports
                    JOIN bug_comments
                    ON bug_reports.bug_id = bug_comments.comment_bug_id
                    WHERE bug_id 
                        AND comment_bug_id = ?";

                    $stmt = $mysqli->prepare($sql);
                        
                    //Bind parameters to be updated into database
                    $stmt->bind_param('i', $_GET['id']);

                    //Execute the query and update entry in database
                    $stmt->execute();

                    $comments = $stmt->get_result();



    ?>


    
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

<!-- Print the bug details to the screen -->
<div class="container"> 
        <h2 class="mt-5 mb-5">Bug Issue # <?php echo $_GET['id'] ?></h2>
        <div class="row mb-6">

        <?php      while($row = $result->fetch_assoc()) : ?>

            <div class="col-md-10">
                <div class="card">
                    <div class="card-body border-success">

                        <!-- Resolve button connected to the ID once clcked -->
                        <?php echo '<a class="float-right btn btn-info  " href="app/complete.php?id='. h($row['bug_id']).'">Resolve</a>'; ?>

                        <!-- Display the category for active notes -->
                        <span class="badge <?php echo lg_severityBG(h($row['bug_severity'])); ?>"  style="padding: 0.5rem; margin-left: 0.5rem; font-size: 0.8rem;"><?php echo lg_severityResult(h($row['bug_severity'])); ?></span></p>

                        <!-- Display the title for the active notes -->
                        <div class="card-header"><h3 ><?php echo h($row['bug_title']) ?> </h3></div>

                        <!-- Display the date for the active notes -->
                        <p class="card-title "><strong>Date: </strong><?php echo  h($row['bug_created_date']) ?></p>

                        <!-- Display the note text for the active notes -->
                        <p class="text-dark"><?php echo h($row['bug_note']) ?></p>
                    </div>
                </div>
            </div>      
            <?php endwhile; /// ends DB results loop ?>
    </div>


    <?php      

            // check if there are comments
            if (mysqli_num_rows($comments) !== 0) {

                while($row = $comments->fetch_assoc()) : ?>

                <!-- display the comments if there are comments -->
                <div class="comment card-body">
                    <div class="card-body">
                        <div>
                        <h6><i class="fa fa-comment" style="font-size:32px;color:#cad7e3"></i><span class="card-title text-muted" style="padding-left: 1rem;"><?php echo h($row['comment_date_created'])?></span></h6>
                        <p class="accordion-body" style="font-weight:bold;">
                            
                            <?php echo h($row['comment_msg'])?>
                        </p>
                        </div>
                    </div>

                    </div>


                    <?php  
                endwhile; /// ends DB results loop for comments
            } ?>


            <!-- else there will be no comments to show -->



        <!-- Form for posting comments -->
        <h5 class="mt-5 mb-5">Post Comment</h5>

            <div class="row">
                <div class="col-md-4">
                    <form id="commentForm" action="app/insert.php" method="POST">
                                
                                <!-- Comment note description -->
                                <div class="form-group">
                                    <input type="hidden" name="currentDate" value="<?php echo $today?>" readonly="readonly">
                                    <input type="hidden" name="id" value="<?php echo h($_GET['id']) ?>">
                                    <textarea class="form-control" name="commentMsg" id="commentMsg" placeholder="Enter your comment..."></textarea>
                                </div>
                                
                                <div class="row">
                                    <button type="submit" class="btn btn-primary">Add New Comment</button>
                                </div>
                            
                    </form>
                    </div>
            </div>
    <?php endif; ?>   
            <!-- End of Comment form -->
