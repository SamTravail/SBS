<?php

$_SESSION['login'] = false;
session_destroy();

echo "<script>window.location.replace('https://localhost/sbs/index.php')</script>";
