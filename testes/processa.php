<?php
header('Content-Type: application/json; charset=utf-8');

// Acessa os dados diretamente de $_POST usando os atributos 'name' dos inputs
$usuarioId = filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT);
$mensagem  = trim($_POST['mensagem'] ?? '');

// Validação simples
if (!$usuarioId || empty($mensagem)) {
    echo json_encode([
        'status' => 'erro',
        'resposta' => 'Dados inválidos ou incompletos.'
    ]);
    exit;
}

// Processamento (ex: salvar no banco de dados)
$respostaTexto = "Mensagem do usuário #{$usuarioId} cadastrada: \"{$mensagem}\"";

echo json_encode([
    'status' => 'sucesso',
    'resposta' => $respostaTexto
]);