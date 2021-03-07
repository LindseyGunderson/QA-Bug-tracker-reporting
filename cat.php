<?php

    // Add user-defined functions
    require_once('functions.php');
    
    // Add a new row to the database
    require_once('app/connect.php');

    
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

            
            <!-- Display Active Bugs with bootstrap -->
            <h2 class="mt-5 mb-5"><?php echo $title ?></h2>
            <div class="row mb-6">

            <?php      while($row = $result->fetch_assoc()) : ?>

                <div class="col-md-8 ">
                    <div class="card mb-5 ">
                        <div class="card-body border-success">

                            <!-- Resolve button connected to the ID once clicked -->
                            <?php if($_GET['cat_id'] == 0) : echo '<a name="resolve" class="float-right btn btn-info  " href="app/complete.php?id='. h($row['bug_id']).'" >Resolve</a>';
                                    
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

                    <!-- include footer -->
    <?php include('./partials/footer.php'); ?>