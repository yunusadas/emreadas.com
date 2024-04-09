<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", "On");
if (!isset($_SESSION['kisi']['id'])) {
    header('Location: ../login/login.php?errorcode=2ACF');
    exit;
}
if (time() - $_SESSION['start_time'] > $_SESSION['expire_time']) {
    session_unset();
    session_destroy();
    header('Location: ../login/login.php?errorcode=2ACF');
}