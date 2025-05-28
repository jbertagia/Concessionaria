<?php
require_once __DIR__ . '/../model/Veiculo.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo "Token CSRF inválido.";
    exit;
}

}

if (!isset($_SESSION['usuario'])) {
    echo "Acesso negado.";
    exit;
}

// var_dump($_POST); // debug: dados recebidos do formulário
// var_dump($_FILES); // debug: dados do arquivo enviado

$imagemNome = null;
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $pastaDestino = __DIR__ . '/../public/imagens/';
    
    if (!is_dir($pastaDestino)) {
        mkdir($pastaDestino, 0777, true);
    }

    $imagemNome = basename($_FILES['imagem']['name']);
    $caminhoCompleto = $pastaDestino . $imagemNome;

    if (file_exists($caminhoCompleto)) {
        echo "Já existe um arquivo com esse nome. Por favor, renomeie a imagem antes de fazer o upload.";
        exit;
    }

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
        // upload ok
    } else {
        echo "Erro ao mover o arquivo enviado.";
        exit;
    }
}

$dados = [
    'usuario_id' => $_POST['usuario_id'],
    'tipo'       => $_POST['tipo'],
    'marca'      => $_POST['marca'],
    'modelo'     => $_POST['modelo'],
    'ano'        => $_POST['ano'],
    'cor'        => $_POST['cor'],
    'portas'     => $_POST['portas'],
    'preco'      => number_format(str_replace(',', '.', $_POST['preco']), 2, '.', ''),
    'cidade'     => $_POST['cidade'],
    'imagem'     => $imagemNome
];

// var_dump($dados); // debug: dados finais antes de enviar ao model

$resultado = Veiculo::cadastrar($dados);

if ($resultado) {
    echo "Veículo cadastrado com sucesso! <br><a href='index.php?pagina=meusVeiculos'>Ver meus veículos</a>";
} else {
    echo "Erro ao cadastrar veículo.";
}
?>
