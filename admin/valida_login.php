<?php

session_start();

require('conexao.php');

$ds_email = $_POST['ds_email'] ?? '';
$ds_senha = $_POST['ds_senha'] ?? '';

$sql = "SELECT cd_usuario, ds_senha FROM Usuarios WHERE ds_email = :ds_email LIMIT 1";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(":ds_email", $ds_email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($ds_senha, $dados['ds_senha'])) {
        $_SESSION['usuario_id'] = $dados['cd_usuario'];
        $_SESSION['usuario_email'] = $ds_email;
        header('Location: home.php');
        exit();
    } else {
        $_SESSION['erro_login'] = "Senha incorreta!";
        header("Location: index.php");
        exit();
    }

} else {
    $_SESSION['erro_login'] = "Usuário não encontrado!";
    header('Location: index.php');
    exit();
}