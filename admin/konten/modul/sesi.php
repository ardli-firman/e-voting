<?php
session_start();
if (@$_GET['aksi'] == 'logout') {
    logout();
    header('Location: ../index.php');
}

function logout()
{
    unset($_SESSION);
    session_destroy();
    $_SESSION = [];
}

function isLogin()
{
    if (!isset($_SESSION['data']['adm']) || $_SESSION['data']['adm']['level'] != 'admin') {
        session_destroy();
        header('Location: ../index.php');
    }
}
