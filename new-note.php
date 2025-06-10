<?php require_once 'header.php';

?>
<div class="header px-3 align-items-center bg-warning
position-relative top-0 col-12 d-flex justify-content-between">
    <h3>edit your note</h3>
    <a href="panel.php" class="btn btn-dark text-decoration-none">
        get back to panel</a>
</div>
<div class="container">
    <div class="w-100">
        <form action="handle.php" enctype="multipart/form-data" class="d-flex flex-column gap-2" method="post">
            <label for="tittle">heading</label>
            <input type="text" id="tittle" name="tittle">
            <label for="content">content</label>
            <textarea id="content" name="content"></textarea>
            <label for="uploads">any image?</label>
            <input type="file" id="uploads" name="uploads" >
            <?php if (isset($error)): ?>
                <div class="position-absolute top-0 alert alert-secondary" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <label for="pin_unpin">pin it</label>
            <input type="checkbox" value="" id="pin/unpin" name="pin_unpin">
            <input type="hidden" name="type" value="new_note">
            <input class="btn btn-warning" type="submit" name="submit" value="save">
        </form>

    </div>
</div>
<?php require_once 'footer.php'; ?>
