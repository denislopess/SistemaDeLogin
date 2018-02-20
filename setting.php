<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 18/02/2018
 * Time: 20:55
 */



$conn = new PDO('mysql:host=localhost;dbname=sistema_login','root','');
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);