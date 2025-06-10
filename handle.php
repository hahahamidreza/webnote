<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
session_start();
include 'inc/db.php';
global $conn;
if (isset($_POST['submit'])) {
//    echo "submitted";
    $type = $_POST['type'];
    if ($type == "register") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        if (empty($email) || empty($password) || empty($password_confirm)) {
            $error = 'please  fill out all fields';
            require_once "index.php";
            exit;
        }
        if ($password != $password_confirm) {
            $error = 'passwords do not match';
            require_once "index.php";
            exit;
        }
        //hashed password
        $hashed_password = md5($password);
        //check email
        $check = mysqli_query($conn, "SELECT * FROM users WHERE `email` = '$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = 'email already exists';
            require_once "index.php";
            exit;
        }
        //register user
        $insert = mysqli_query($conn, "INSERT INTO users(name, email, password) values ('$username', '$email', '$hashed_password')");
        if ($insert) {
            $success = 'registered successfully! you may now login';
            require_once "login.php";
            exit;
        } else {
            $error = 'something went wrong! please try again later';
        }
    } else if ($type == "login") {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        if (empty($email) || empty($password)) {
            $error = 'please fill out all fields';
            require_once "login.php";
            exit;
        }
        $hashed_password = md5($password);
        $check2 = mysqli_query($conn, "SELECT * FROM users WHERE `email` = '$email' AND `password` = '$hashed_password'");
        if (mysqli_num_rows($check2) > 0) {
            $user = mysqli_fetch_assoc($check2);
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $success = 'login successfully. taking you to the panel right now';
            header("location: panel.php");
            exit;
        } else {
            $error = "Wrong email or password";
            require_once("login.php");
            exit;
        }
    } else if ($type == "new_note" && isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $tittle = mysqli_real_escape_string($conn, $_POST["tittle"]);
        $content = mysqli_real_escape_string($conn, $_POST["content"]);
        $pin_unpin = isset($_POST['pin_unpin']) ? 1 : 0;
        $image_path = ''; // default empty
        if (isset($_FILES['uploads'])) {
            $temp_file = $_FILES['uploads']['tmp_name'];
            $upload_dir = "uploads";
            $new_name = 'file-' . time() . ".jpg";
            move_uploaded_file($temp_file, $upload_dir . '/' . $new_name);
            $image_path = "$new_name";
//            if (!is_dir($upload_dir)) {
//                mkdir($upload_dir, 0755, true);
//            }
        }
        if (empty($content)) {
            $error = 'please fill out content';
            require_once "panel.php";
            exit;
        }
        $add_note = mysqli_query($conn,
            "INSERT INTO `user_note`(`user_id`, `note_tittle`, `note_content`, `pin_unpin`, `img_path`) values ('$user_id','$tittle', '$content', '$pin_unpin','$image_path')");
        header("location:panel.php");
        exit;
    } else if ($type == "note_action" && isset($_SESSION['user_id'])) {
//        var_dump($_POST['note_id']);
//        exit;
        $user_id = $_SESSION['user_id'];
        $note_id = intval($_POST['note_id']);
        $action = $_POST["submit"];
        $check_note_user = mysqli_query
        ($conn, "SELECT * FROM `user_note` WHERE `note_id` = '$note_id' AND `user_id` = '$user_id'");
        if (!mysqli_num_rows($check_note_user)) {
            $error = "you cannot do this";
            exit;
        }
        if ($action == "delete") {
            $delete = mysqli_query($conn, "DELETE FROM `user_note` WHERE `note_id` = '$note_id' AND `user_id` = '$user_id'");
//            if ($delete) {
//                echo "Note deleted successfully";
//            } else {
//                echo "Delete failed: " . mysqli_error($conn);
//            }
//            exit;
            header("location:panel.php");
            exit;
//            exit;
        } else if ($action == "pin/unpin") {
            $ispin = mysqli_fetch_assoc($check_note_user);
            $pin_unpin = $ispin['pin_unpin'] == 1 ? 0 : 1;
            mysqli_query($conn, "UPDATE `user_note` SET `pin_unpin` = '$pin_unpin' WHERE `note_id` = '$note_id'");
            require_once "panel.php";
            exit;
        } else if ($action == "edit") {
            header('location:note_edit.php');
            exit();
        }
    } else {
        header("location:login.php");
        exit;
    }
} else {
    header("location:login.php");
}
if (isset($_GET['type']) && $_GET['type'] == "note_action" && isset($_GET['submit']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $note_id = intval($_GET['note_id']);
    $action = $_GET["submit"];

    $check_note_user = mysqli_query($conn, "SELECT * FROM `user_note` WHERE `note_id` = '$note_id' AND `user_id` = '$user_id'");
    if (mysqli_num_rows($check_note_user) == 0) {
        echo 'You cannot do this.';
        exit;
    }

    if ($action == "delete") {
        $delete = mysqli_query($conn, "DELETE FROM `user_note` WHERE `note_id` = '$note_id' AND `user_id` = '$user_id'");
        if ($delete) {
            header("Location: panel.php");
            exit;
        } else {
            echo "Delete failed: " . mysqli_error($conn);
            exit;
        }

    } elseif ($action == "pin") {
        $note = mysqli_fetch_assoc($check_note_user);
        $new_status = ($note['pin_unpin'] == 1) ? 0 : 1;
        $update = mysqli_query($conn, "UPDATE `user_note` SET `pin_unpin` = '$new_status' WHERE `note_id` = '$note_id'");
        header("Location: panel.php");
        exit;

    } elseif ($action == "edit") {
        $_SESSION['edit_note_id'] = $note_id;
        header("Location: note_edit.php?note_id=$note_id");
        exit;
    }
}

//note


