<?php
include_once "session_check.php";
include_once "header.php";
include_once "nav.php";
?>
<div class="row">
    <div class="col-12">
        <h1>New link</h1>
        <form action="save_link.php" method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input required class="form-control" type="text" placeholder="Title" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="real_link">Real link:</label>
                <input required class="form-control" type="text" placeholder="Real link" name="real_link" id="real_link">
            </div>
            <div class="form-group">
                <label for="instant_redirect">Instant redirect <i title="Make instant redirect or show user template before redirect" class="fa fa-question-circle"></i></label>
                <input checked type="checkbox" name="instant_redirect" id="instant_redirect">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
<?php include_once "footer.php"; ?>