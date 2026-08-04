<?php
require('conexao.php');

$nm_usuario = "Pedro Livi";
$ds_email = "pedro.livi@email.com"; 
$ds_senha = password_hash("123456", PASSWORD_ARGON2I);
$dt_nascimento = "2005-03-17";
$fg_sexo = "M"; 
$fg_status = "A";

$sql = "INSERT INTO Usuarios (
    nm_usuario, 
    ds_email, 
    ds_senha, 
    dt_nascimento, 
    fg_sexo, 
    fg_status) 
    VALUES (
    :nm_usuario, 
    :ds_email, 
    :ds_senha, 
    :dt_nascimento, 
    :fg_sexo, 
    :fg_status)";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(":nm_usuario", $nm_usuario);

$stmt->bindParam(":ds_email", $ds_email);

$stmt->bindParam(":ds_senha", $ds_senha);

$stmt->bindParam(":dt_nascimento", $dt_nascimento);

$stmt->bindParam(":fg_sexo", $fg_sexo);

$stmt->bindParam(":fg_status", $fg_status);

if ($stmt->execute()) {
    echo "Usuário criado com sucesso!";
} else {
    "Erro ao criar o Usuário";
}