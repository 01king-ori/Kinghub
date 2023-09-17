<?php
require 'config.php';


if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST["delete"])) {
    $id = $_SESSION["id"];

    // Delete the user profile
    $query = "DELETE FROM tb_user WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    // Log out the user and destroy the session
    session_unset();
    session_destroy();

    header("Location: Login.php");
}
