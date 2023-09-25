<?php
try {
    $bd = new PDO("mysql:host=localhost;dbname=tiemokodb", "root", "");
} catch (Exception $e) {
    die($e->getMessage());
}
