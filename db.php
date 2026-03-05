<?php
$conn = new mysqli("localhost", "root", "", "bettersmart");

if ($conn->connect_error) {
    die("Erro: " . $conn->connect_error);
}
?>