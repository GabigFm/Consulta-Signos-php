<?php
include('layouts/header.php');

// Carrega o arquivo XML
$signos = @simplexml_load_file(__DIR__ . '/signos.xml');

// Verifica se o XML foi carregado corretamente
if ($signos === false || !isset($signos->signo)) {
    echo "<div class='container py-4'>";
    echo "<p class='alert alert-warning'>Não foi possível carregar os signos disponíveis.</p>";
    echo "<a href='index.php' class='btn btn-secondary'>Voltar</a>";
    echo "</div>";
    exit;
}

// Recebe a data enviada pelo formulário
$data_nascimento = $_POST['data_nascimento'] ?? '';

// Valida a data
$data = DateTime::createFromFormat('!Y-m-d', $data_nascimento);

if (
    !$data ||
    $data->format('Y-m-d') !== $data_nascimento ||
    !isset($_POST['data_nascimento'])
) {
    echo "<div class='container py-4'>";
    echo "<p class='alert alert-danger'>Data inválida. Volte e tente novamente.</p>";
    echo "<a href='index.php' class='btn btn-secondary'>Voltar</a>";
    echo "</div>";
    exit;
}

$data_usuario = (int)$data->format('md');

$signo_encontrado = null;

foreach ($signos->signo as $signo) {

    $inicio = DateTime::createFromFormat(
        '!d/m',
        (string)$signo->dataInicio
    );

    $fim = DateTime::createFromFormat(
        '!d/m',
        (string)$signo->dataFim
    );

    if (!$inicio || !$fim) {
        continue;
    }

    $inicio_numero = (int)$inicio->format('md');
    $fim_numero = (int)$fim->format('md');

    if ($inicio_numero <= $fim_numero) {

        $encontrado = (
            $data_usuario >= $inicio_numero &&
            $data_usuario <= $fim_numero
        );

    } else {

        $encontrado = (
            $data_usuario >= $inicio_numero ||
            $data_usuario <= $fim_numero
        );
    }

    if ($encontrado) {
        $signo_encontrado = $signo;
        break;
    }
}

echo "<div class='container py-5'>";

if ($signo_encontrado) {

    $nomeSigno = trim((string)$signo_encontrado->signoNome);

    $simbolo = '';

    switch ($nomeSigno) {

        case 'Áries':
            $simbolo = '♈';
            break;

        case 'Touro':
            $simbolo = '♉';
            break;

        case 'Gêmeos':
            $simbolo = '♊';
            break;

        case 'Câncer':
            $simbolo = '♋';
            break;

        case 'Leão':
            $simbolo = '♌';
            break;

        case 'Virgem':
            $simbolo = '♍';
            break;

        case 'Libra':
            $simbolo = '♎';
            break;

        case 'Escorpião':
            $simbolo = '♏';
            break;

        case 'Sagitário':
            $simbolo = '♐';
            break;

        case 'Capricórnio':
            $simbolo = '♑';
            break;

        case 'Aquário':
            $simbolo = '♒';
            break;

        case 'Peixes':
            $simbolo = '♓';
            break;
    }

    echo "<div class='card shadow-sm'>";
    echo "<div class='card-body text-center'>";

    echo "<div class='simbolo-signo'>";
    echo $simbolo;
    echo "</div>";

    echo "<h1 class='card-title mb-3'>";
    echo htmlspecialchars($nomeSigno);
    echo "</h1>";

    echo "<p class='card-text'>";
    echo htmlspecialchars((string)$signo_encontrado->descricao);
    echo "</p>";

    echo "</div>";
    echo "</div>";

} else {

    echo "<p class='alert alert-warning'>";
    echo "Não foi possível encontrar seu signo.";
    echo "</p>";
}

echo "<a href='index.php' class='btn btn-secondary mt-3'>";
echo "Voltar";
echo "</a>";

echo "</div>";
?>