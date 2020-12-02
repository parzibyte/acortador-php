<?php
include_once "session_check.php";
include_once "header.php";
include_once "nav.php";
?>
<div class="row">
    <div class="col-12">
        <h1>New user</h1>
        <form action="save_user.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input required class="form-control" type="email" placeholder="Email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input required class="form-control" type="password" placeholder="Password" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm password:</label>
                <input required class="form-control" type="password" placeholder="Confirm password" name="confirm_password" id="confirm_password">
            </div>
            <?php if (isset($_GET["new_password_do_not_match"])) { ?>
                <div class="alert alert-warning">
                    Password and confirm password do not match
                </div>
            <?php } ?>

            <?php if (isset($_GET["existing_email"])) { ?>
                <div class="alert alert-warning">
                    Email already exists
                </div>
            <?php } ?>
            <div class="form-group">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
<?php include_once "footer.php"; ?>