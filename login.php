<?php include("top.php") ?>

<div style="width: 300px; margin-top: 200px;">
    <form action="auth.php" method="post">
        <div class="form-outline mb-4">
            <input type="text" name="username" id="username" class="form-control" required minlength="5" />
            <label class="form-label" for="username">Username</label>
        </div>

        <div class="form-outline mb-4">
            <input type="password" name="password" id="password" class="form-control" required minlength="5" />
            <label class="form-label" for="password">Password</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>

        <?php
        include("info-error.php");
            ?>

        <div class="text-center">
            <p>Not a member? <a href="register.php">Register</a></p>
        </div>
    </form>
<div>


<?php include("bottom.php") ?>