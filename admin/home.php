<?php 
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h2>Página Inicial</h2>
    <p>Usuário: <?= $_SESSION['usuario_email'] ?></p>
    
    <button>
        <a href="logout.php">Sair</a>
    </button>
</body>
</html>