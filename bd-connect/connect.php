<?php
$host = '127.0.0.1';
$dbname = 'coursbd';

$db = new PDO("mysql:host=$host;dbname=$dbname",'root','');

return $db;
