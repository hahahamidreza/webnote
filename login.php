<?php require_once "header.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'inc/db.php';
?>
<div class="container col-3">
    <form action="handle.php"
          class="d-flex mt-3 gap-2 rounded flex-column p-3 border border-dark bg-secondary text-light"
          method="POST"
    >
        <h3 class="text-center text-uppercase">Let's take some notes!</h3>
        Email:
        <input type="email" name="email" required autocomplete="off">
        Password:
        <input type="password" name="password" required autocomplete="off">
        <input type="hidden" value="login" name="type">
        <button class="btn btn-success" name="submit" type="submit">Login</button>
        <div>
            <span>already have an account!</span>
            <a href="index.php" class="text-decoration-underline text-light"> sign up here</a>
        </div>
    </form>
</div>
<?php require_once "footer.php"; ?>
