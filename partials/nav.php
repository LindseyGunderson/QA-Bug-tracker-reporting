<!-- Nav bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand h1 mb-0" href="<?php echo SITE_URL; ?>">Bug Tracker</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


            <!-- // If the user_id is set, the user is logged in and show the logout button. 
        // Else, show the login form -->
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="<?php echo SITE_URL . 'app/logout.php'; ?>" class="btn btn-primary" >Logout</a>

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