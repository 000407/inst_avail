<?php
session_start();
include '../init.php';

session_destroy();
header("location: {$app_path}/index.php");
