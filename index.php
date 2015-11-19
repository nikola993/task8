<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

require_once 'db/mysql.php';
require 'select.php';
require 'delete.php';
require 'insert.php';
require 'update.php';

$db = new Db_Mysql(array(
    'dbname' => 'shift_planning_test',
    'username' => 'root',
    'password' => NULL,
    'host' => 'localhost'
));
$db->connect();
echo '<br>';
$db->ping();
echo '<br>';
$result = $db->query(SELECT::$query);
$db->fetch($result, $resultType=null);
echo '<br>';
$db->affectedRows();
echo '<br>';
$db->insertId();
echo '<br>';
$unescapedString = "ASDASDAS";
$db->escape($unescapedString);
echo '<br>';
$db->close();