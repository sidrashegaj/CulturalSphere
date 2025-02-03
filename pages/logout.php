<?php
session_start();
session_unset(); //unset all session variables
session_destroy(); //destroy the session

//redirect to main index page
header("Location: ../index.php");
exit();
?>
