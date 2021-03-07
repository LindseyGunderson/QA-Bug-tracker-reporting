<!-- Nav bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand h1 mb-0" href="<?php echo SITE_URL; ?>" style="padding-right: 1.5rem;">Bug Tracker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <!-- Link to main page of app -->
                
                <li class="nav-item active">
                   <?php echo '<li><a class="nav-link" href="' . SITE_URL . 'cat.php?cat_id=0">Open Bugs</a></li>'; ?>
                </li>
                <li>
                <li>
                   <?php echo '<li><a class="nav-link" href="' . SITE_URL . 'cat.php?cat_id=1">Resolved Bugs</a></li>'; ?>
                </li>
                <li>
   
    </div>  

            <!-- // If the user_id is set, the user is logged in and show the logout button. 
        // Else, show the login form -->
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="<?php echo SITE_URL . 'app/logout.php?logout=1'; ?>" class="btn btn-primary" >Logout</a>

           <?php else: ?>

            <form action="./app/login.php" method="POST" class="form-inline ml-auto">
                <div class="form-group">
                    <label for="loginEmail" class="mr-3 ml-3">Email address</label>
                    <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="loginPassword" class="mr-3 ml-3">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Password">
                </div>
                <input name="loginSubmit" type="submit" class="btn btn-primary ml-3" value="Login">
            </form>    
           <?php endif; ?>
    </div>
</nav>