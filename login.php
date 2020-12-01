<?php
include_once "header.php";
?>
<div class="row">
    <div class="col-12 offset-md-4 col-md-4">
        <h2>Login</h2>
        <form action="do_login.php" method="POST">
            <div class="form-group">
                <label for="email">Email: </label>
                <input required id="email" name="email" type="email" placeholder="your@email.com" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input required id="password" name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <?php if (isset($_GET["incorrect"])) { ?>
                <div class="alert alert-warning">
                    Password or email do not match
                </div>
            <?php } ?>
            <?php if (isset($_GET["login"])) { ?>
                <div class="alert alert-warning">
                    Please login
                </div>
            <?php } ?>
            <div class="form-group">
                <button class="btn btn-success">Login</button>
            </div>
        </form>
    </div>
</div>
<?php
include_once "footer.php";
