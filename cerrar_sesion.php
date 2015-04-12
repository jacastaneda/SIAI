<?php
session_start();
unset($_SESSION['siai']);
header( 'Location: index.php' );
?>