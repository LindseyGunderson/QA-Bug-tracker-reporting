<?php
    // Add user-defined functions
    require_once('functions.php');

    //include connection to DB from separate file
    require_once('app/connect.php');

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

<div class="container"> 
        <h2 class="mt-5 mb-5">Bug Issue # </h2>
        <div class="row mb-6">

        <?php      while($row = $result->fetch_assoc()) : ?>

            <div class="col-md-10">
                <div class="card">
                    <div class="card-body border-success">

                        <!-- Archive button connected to the ID once clicked -->
                        <?php echo '<a class="float-right btn btn-info  " href="app/complete.php?id='. h($row['bug_id']).'">Resolve</a>'; ?>

                        <!-- Display the category for active notes -->
                        <!-- <h3 class="card-header"><?php echo h($row['bug_severity']) ?></h3> -->

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

        <h5 class="mt-5 mb-5">Post Comment</h5>

        <?php      
            if (mysqli_num_rows($comments) !== 0) {

                while($row = $comments->fetch_assoc()) : ?>

                <div class="comment card-body">
                    <div class="card-body">
                        <div>
                        <h6><i class="fa fa-comment" style="font-size:32px;color:#cad7e3"></i><span class="card-title text-muted" style="padding-left: 1rem;"><?php echo h($row['comment_date_created'])?></span></h6>
                        <p class="card-text">
                            
                            <?php echo h($row['comment_msg'])?>
                        </p>
                        </div>
                    </div>

                    </div>


                    <?php  
                endwhile; /// ends DB results loop
            } ?>

            <div class="row">
                <div class="col-md-4">
                    <form id="commentForm" action="app/insert.php" method="POST">
                                
                                <!-- Form note description -->
                                <div class="form-group">
                                    <input type="hidden" name="currentDate" value="<?php echo $today?>" readonly="readonly">
                                    <input type="hidden" name="id" value="<?php echo h($row['bug_id']) ?>">
                                    <textarea class="form-control" name="commentMsg" id="commentMsg" placeholder="Enter your comment..."></textarea>
                                </div>
                                
                                <div class="row">
                                    <button type="submit" class="btn btn-primary">Add New Comment</button>
                                </div>
                            <!-- Submit button -->
                            
                    </form>
                    </div>
            </div>
