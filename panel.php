<?php
//require_once 'config.php';
require_once 'inc/db.php';
require_once 'config.php';

global $conn;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//var_dump($_SESSION);
//include 'handle.php';
include 'inc/db.php';

require_once("header.php"); ?>
    <div class="header px-3 align-items-center bg-warning position-relative top-0 col-12 d-flex justify-content-between">
        <h2 class="text-light">
            <a href="#"
               class="d-flex align-items-center justify-content-between text-uppercase text-dark text-decoration-none">
                webnote<i class="fa-regular fa-notebook"></i>
            </a>
        </h2>
        <p class="text-dark align-baseline text-center">wellcome, <?php
            echo (isset($_SESSION['name'])) ? $_SESSION['name'] : 'my friend';
            ?></p>
        <?php
        ?>
        <a href="logout.php" class="btn btn-dark text-decoration-none">
            <i class="fa-regular fa-right-from-bracket"></i>
        </a>
    </div>
    <div class="container d-flex position-relative flex-row gap-2 justify-content-center">
        <a class="position-fixed bottom-0 end-0 m-4 text-decoration-none
        btn btn-warning rounded-circle btn-lg w-auto h-auto z-3" href="view-note.php">
            <i class="fa-solid fa-plus"></i>
        </a>
        <div class=" w-100">
            <div class="mt-2 d-flex justify-content-between flex-row-reverse">
                <form method="" class="mb-3">
                    <label for="sort_by">Sort by:</label>
                    <select name="sort_by" id="sort_by" class="form-select w-auto d-inline-block">
                        <option value="recent">
                            Recent
                        </option>
                        <option value="oldest">
                        </option>
                        <option value="title_asc">
                            Title A-Z
                        </option>
                        <option value="title_desc">
                            Title Z-A
                        </option>
                    </select>
                </form>
                <h3>Your notes</h3>
            </div>
            <div class="d-flex mt-5 flex-wrap">
                <?php
                //            $query="SELECT * FROM `user_note` WHERE `user_id` = '$_SESSION[user_id]'";
                $check = mysqli_query($conn, "SELECT * FROM `user_note` WHERE `user_id` = '$_SESSION[user_id]'");
                if (mysqli_num_rows($check) > 0) {
                    while ($note = mysqli_fetch_assoc($check)) {
                        ?>
                        <div class="border col-3 rounded-3 rounded-start-0 position-relative p-3 m-1 bg-light">
                            <div class="position-absolute justify-content-center col-5 gap-1 bg-light bottom-100
                            start-0 border border-bottom-0 rounded-top-3 d-flex flex-row align-items-center">
                                <a href="handle.php?type=note_action&note_id=<?php echo $note['note_id']; ?>&submit=delete"
                                   class="p-2 btn text-decoration-none text-dark">
                                    <i class="fa-regular fa-trash"></i>
                                </a>
                                <a href="handle.php?type=note_action&note_id=<?php echo $note['note_id']; ?>&submit=pin"
                                   class="p-2 btn btn text-decoration-none text-dark">
                                    <?php if ($note['pin_unpin']) { ?>
                                        <i class="fa-solid fa-thumbtack text-warning"></i>
                                    <?php } else { ?>
                                        <i class="fa-regular fa-thumbtack text-dark"></i>
                                    <?php } ?>
                                </a>
                                <a href="view-note.php?type=note_action&note_id=<?php echo $note['note_id']; ?>&submit=edit"
                                   class="p-2 btn text-decoration-none text-dark">
                                    <i class="fa-regular fa-pen"></i>
                                </a>
                            </div>
                            <form class="d-flex position-absolute m-2    top-0 end-0 flex-row gap-1" action="handle.php"
                                  method="post">
                                <input type="hidden" value="note_action" name="type">
                                <input type="hidden" value="<?php echo $note['note_id'] ?>" name="note_id">
                                <button type="submit" name="submit" value="delete" class="btn">

                                </button>
                                <button type="submit" class="btn" name="submit" value="pin/unpin">

                                    <!--                                <i class="fa-regular fa-thumbtack"></i>-->
                                </button>
                                <button type="submit" class="btn" name="submit" value="edit">

                                </button>
                            </form>
                            <h5><?php echo $note['note_tittle'] ?></h5>
                            <p><?php echo $note['note_content'] ?></p>
                            <hr>
                            <img src="<?php echo base_url() . 'uploads/' . $note['img_path']; ?>" alt=""
                                 class="img-fluid rounded">

                        </div>
                        <?php
                    } ?>

                <?php } else {
                    echo '<p class="text-dark">No notes</p>';
                }
                ?>
            </div>
        </div>
    </div>
<?php require_once("footer.php");
