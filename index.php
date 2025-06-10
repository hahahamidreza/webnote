<?php
////print_r($_REQUEST);
////exit;
//$request = $_REQUEST['q'] ?? '';
////echo $request;
////exit();
//$requests = explode("/", $request);
//$first = $requests[0];
//$routes = [
//    'login' => 'templates/login.php',
//    'panel' => 'templates/panel.php',
//    'register' => 'templates/register.php',
//    'notes' => 'templates/new-notes.php',
//    'edit-notes' => 'templates/edit_notes.php',
//];
//require_once 'header.php';
//if (isset($routes[$first]) && !empty($first)) {
//    require_once $routes[$first];
//} else {
//    require_once 'templates/404.php';
//}
//require_once ("templates/login.php");
require_once("header.php");
session_abort(); ?>
<div class="container position-relative col-3">
    <?php if (isset($success)): ?>
        <div class="position-absolute top-0 alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="position-absolute top-0 alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <form action="handle.php"
          class="d-flex mt-3 gap-2 rounded flex-column p-3 border border-dark bg-secondary text-light"
          method="POST"
    >
        <h3 class="text-center text-uppercase">join us!</h3>
        Username:
        <input type="text" name="username">
        Email:
        <input type="email" name="email" required autocomplete="off">
        Password:
        <input type="password" name="password" required autocomplete="off">
        Password confirmation:
        <input type="password" name="password_confirm" required autocomplete="off">
        <br>
        <input type="hidden" value="register" name="type">
        <button class="btn btn-success" name="submit" type="submit">Register</button>
        <div>
            <span>already have an account!</span>
            <a href="login.php" class="text-decoration-underline text-light"> login here</a>
        </div>
    </form>
</div>
<?php require_once("footer.php"); ?>
