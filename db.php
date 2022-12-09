<?php
function get_pdo() {
    $dsn = "mysql:host=localhost; dbname=member; charset=utf8";
    $username = "testtest";
    $password = "testtest";
    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
    }
    return $pdo;
}
?>