<?php
session_start();

if (isset($_SESSION["examinee_id"])) {
    session_unset();
    session_destroy();
    header("location:../login.php");
    die();
}
