<?php

session_start();
//session_unregister($username);
session_destroy();
//$_SESSION['login']=0;
//echo $_SESSION['login'];
 header("Location: index.php");
?>