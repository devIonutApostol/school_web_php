<?php include("top.php") ?>

<div style="width: 300px; margin-top: 200px;">
    <form action="create_reader.php" method="post">
        <div class="form-outline mb-4">
            <input type="text" name="username" id="username" class="form-control" required minlength="5" />
            <label class="form-label" for="username">Username</label>
        </div>

        <div class="form-outline mb-4">
            <input name="password" type="password" id="password" class="form-control" required minlength="5" />
            <label class="form-label" for="password">Password</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
        <?php
        include("info-error.php") 
        ?>
    </form>
    <div>


<?php include("bottom.php") ?>