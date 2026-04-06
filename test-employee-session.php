<?php
session_start();
echo "<pre>";
echo "userid: ";
var_dump($_SESSION['userid'] ?? null);
echo "login: ";
var_dump($_SESSION['login'] ?? null);
echo "role: ";
var_dump($_SESSION['role'] ?? null);
echo "branch_name: ";
var_dump($_SESSION['branch_name'] ?? null);
echo "</pre>";
?>