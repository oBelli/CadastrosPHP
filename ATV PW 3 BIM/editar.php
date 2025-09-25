<?php
include('conecta.php');
session_start();

if (!isset($_SESSION['usuario'])) {
    header('location: index.html');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['campo0'];
    $nome = $_POST['campo1'];
    $login = $_POST['campo2'];
    $senha = $_POST['campo3'];
    $email = $_POST['campo4'];
    $telefone = $_POST['campo5'];

    $sql = "UPDATE tb_contato SET nome=:nome, login=:login, senha=:senha, email=:email, telefone=:telefone WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "sucesso";
    } else {
        echo "erro";
    }
    exit;
}
?>