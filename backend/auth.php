<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != '') {
    header("Location: login");
}

//show (basename($_SERVER['SCRIPT_FILENAME']));