<?php
require_once 'inc/db.php';
require_once 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
global $conn;
global $note;

$is_edit = false;
$title = '';
$content = '';
$create_date = '';
$note_id = null;

if (isset($_GET['note_id']) && isset($_SESSION['user_id'])) {
    $note_id = intval($_GET['note_id']);
    $user_id = $_SESSION['user_id'];

    $result = mysqli_query($conn, "SELECT * FROM `user_note` WHERE `note_id` = '$note_id' AND `user_id` = '$user_id'");
    if (mysqli_num_rows($result) > 0) {
        $note = mysqli_fetch_assoc($result);
        $title = $note['note_tittle'];
        $content = $note['note_content'];
        $create_date = date("Y-m-d H:i", strtotime($note['create_date']));
        $is_edit = true;
    }
}
require_once 'config.php';
require_once 'header.php';?>
<div class="container my-5">
    <div class="card shadow-lg rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-warning mb-0"><?php echo $is_edit ? 'Your Note' : 'Create New Note'; ?></h2>
            <a href="panel.php" class="btn btn-outline-warning">Back</a>
        </div>

        <form method="post" action="handle.php" enctype="multipart/form-data">
            <input type="hidden" name="type" value="new_note">
            <?php if ($is_edit): ?>
                <input type="hidden" name="note_id" value="<?php echo $note_id; ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label for="title" class="form-label fw-bold">Title</label>
                <input type="text" class="border-0 form-control form-control-lg" id="title" name="tittle"
                       value="<?php if(isset($note)){echo htmlspecialchars($note['note_tittle']);} ?>"
                       placeholder="Enter title here..." required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label fw-bold">Content</label>
                <textarea class="form-control border-0" name="content" id="content" rows="8"
                          placeholder="Write your note here..." required><?php if(isset($note)){echo htmlspecialchars($note['note_content']);} ?></textarea>
            </div>

            <?php if (!empty($note['img_path'])): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Attached Image</label><br>
                    <img src="<?php echo base_url() . 'uploads/' . $note['img_path']; ?>" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="uploads" class="form-label fw-bold">Upload Image (Optional)</label>
                <input type="file" class="form-control" name="uploads" id="uploads">
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="pin_unpin" id="pin_unpin"
                    <?php echo (!empty($note['pin_unpin'])) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="pin_unpin">
                    Pin this note
                </label>
            </div>

            <?php if ($is_edit && $note['create_date']): ?>
                <p class="text-muted small">Created on: <?php echo date("F j, Y, g:i a", strtotime($note['create_date'])); ?></p>
            <?php endif; ?>

            <button type="submit" name="submit" value="save" class="btn btn-warning px-4">Save Note</button>
        </form>
    </div>
</div>
<?php require_once 'footer.php';?>
