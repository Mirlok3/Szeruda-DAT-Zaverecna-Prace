<?php
require 'app/core/config.php';

$string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";";

try {
    $conn = new PDO($string, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->beginTransaction();

    $conn->exec("
        INSERT INTO users (username, email, password)
        VALUES ('admin', 'admin@admin.com', 'password')
    ");
    $conn->exec("
        INSERT INTO users (username, email, password)
        VALUES ('tom', 'tom@tom.com', 'password')
    ");
    $conn->exec("
        INSERT INTO users (username, email, password)
        VALUES ('nekdo', 'nekdo@nekdo.com', 'password')
    ");

    $conn->commit();
    echo "\nTable users seeded successfully";

    $conn->beginTransaction();

    $conn->exec("
        INSERT INTO posts (description, title, username)
        VALUES ('Lactea de flavum omnia, locus homo!', 'test', 'admin')
    ");
    $conn->exec("
        INSERT INTO posts (description, title, username)
        VALUES ('Est grandis canis, cesaris.', 'test2', 'tom')
    ");
    $conn->exec("
        INSERT INTO posts (description, title, username, image)
        VALUES ('Cum zelus velum, omnes absolutioes locus superbus, audax cannabises.', 'Img test', 'tom', 'uploads/test.jpg')
    ");

    $conn->commit();
    echo "\nTable posts seeded successfully";
} catch(PDOException $e) {
    echo $e->getMessage();
}
