<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 19/02/2018
 * Time: 00:39
 */

@session_start();
session_destroy();
unset($_SESSION);
header('Location:index.php');
exit;