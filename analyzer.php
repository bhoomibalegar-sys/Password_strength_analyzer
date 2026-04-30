<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST['password'])) {
    echo "No password received";
    exit();
}

$password = $_POST['password'];
$score = 0;

if(strlen($password) >= 8) $score++;
if(preg_match('/[A-Z]/', $password)) $score++;
if(preg_match('/[a-z]/', $password)) $score++;
if(preg_match('/[0-9]/', $password)) $score++;
if(preg_match('/[!@#$%^&*]/', $password)) $score++;

if($score <= 2) {
    echo "<b style='color:red;'>Weak</b>";
} elseif($score <= 4) {
    echo "<b style='color:orange;'>Moderate</b>";
} else {
    echo "<b style='color:green;'>Strong</b>";
}
?>
