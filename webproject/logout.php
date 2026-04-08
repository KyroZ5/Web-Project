<?php
session_start();
?>

<?php

if(isset($_SESSION["email"])){
    session_unset(); 
    
    session_destroy(); 
    
    echo "<script>alert('You have been logged out')</script>";
    echo "<script> window.location.href='index.php'; </script>"; //redirect to login page
}

?>