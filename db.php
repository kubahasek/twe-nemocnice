<?php

$conn = new PDO('mysql:host=mysqlstudenti.litv.sssvt.cz;dbname=3a1_hasekjakub_db2', 'hasekjakub', '123456', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
$conn->query('SET NAMES utf8');
