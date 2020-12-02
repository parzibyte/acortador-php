<?php

use Parzibyte\UserController;

include_once "session_check.php";
include_once "vendor/autoload.php";
include_once "header.php";
include_once "nav.php";
$users = UserController::getAll();
?>
<div class="row">
    <div class="col-12">
        <h2>Users</h2>
        <a href="add_user.php" class="btn btn-success mb-2">
            <i class="fa fa-plus"></i>&nbsp;Add user
        </a>
    </div>
    <div class="col-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Change password</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?php echo $user->email ?></td>
                            <td>
                                <a href="change_password.php?id=<?php echo $user->id ?>" class="btn btn-warning">
                                    <i class="fa fa-key"></i>
                                </a>
                            </td>
                            <td>
                                <a href="delete_user.php?id=<?php echo $user->id ?>" class="btn btn-danger confirm-action">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="js/sweetalert2.min.js"></script>
<script>
    const $anchors = document.querySelectorAll(".confirm-action");
    $anchors.forEach($anchor => {
        $anchor.addEventListener("click", async (event) => {
            event.preventDefault();
            const url = event.srcElement.href;
            const result = await Swal.fire({
                title: 'Delete',
                text: "Are you sure you want to delete this user?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#e51c23',
                cancelButtonColor: '#4A42F3',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes, delete it'
            });
            if (result.value) {
                window.location.href = url;
            }
        });
    });
</script>
<?php
include_once "footer.php";
?>