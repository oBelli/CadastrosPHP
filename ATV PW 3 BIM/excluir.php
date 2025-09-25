<?php
include 'conecta.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header('location: index.html');
    exit;
}

$id = $_POST['id'];

$sql = "DELETE FROM tb_contato WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo "sucesso";
} else {
    echo "erro";
}
?>