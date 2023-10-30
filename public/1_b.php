<?php
// Inicia a sessão para armazenar os elementos
session_start();

// Verifica se a variável de sessão não está definida, caso não esteja define como array vazio
if (!isset($_SESSION['elementos_1b'])) {

    $_SESSION['elementos_1b'] = array();

}

// Se o botão ADICIONAR foi acionado, executa a ação de novo elemento
if (isset($_POST['adicionar'])) {

    $novoElemento = $_POST['novoElemento'];
    $_SESSION['elementos_1b'][] = $novoElemento; // Adiciona o novo elemento ao final do array 'elementos_1b'
    echo "Elemento $novoElemento registrado com sucesso.\n";

}

// Se o botão ORDENAR foi acionado, realiza a ordenação dos elementos
if (isset($_POST['ordenar'])) {

    $ordem = $_POST['ordem'];

    if ($ordem === 'crescente') {

        ordenarCrescente($_SESSION['elementos_1b']);
        echo "Elementos ordenados de forma crescente.\n";

    } elseif ($ordem === 'decrescente') {

        ordenarDecrescente($_SESSION['elementos_1b']);
        echo "Elementos ordenados de forma decrescente.\n";

    }
}

// Função para ordenar os elementos em ordem crescente
function ordenarCrescente(&$elementos)
{
    $troca = true;
    $numElementos = count($elementos);

    while ($troca) {

        $troca = false;

        for ($i = 0; $i < $numElementos - 1; $i++) {

            if ($elementos[$i] > $elementos[$i + 1]) {

                $temp = $elementos[$i];
                $elementos[$i] = $elementos[$i + 1];
                $elementos[$i + 1] = $temp;
                $troca = true;

            }
        }

        $numElementos--;

    }
}

// Função para ordenar os elementos em ordem decrescente
function ordenarDecrescente(&$elementos)
{
    $troca = true;
    $numElementos = count($elementos);

    while ($troca) {

        $troca = false;

        for ($i = 0; $i < $numElementos - 1; $i++) {

            if ($elementos[$i] < $elementos[$i + 1]) {

                $temp = $elementos[$i];
                $elementos[$i] = $elementos[$i + 1];
                $elementos[$i + 1] = $temp;
                $troca = true;

            }
        }

        $numElementos--;

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ordenação de Elementos</title>
</head>
<body>
    <h2>Ordenação de Elementos</h2>

    <form method="post" action="1_b.php">
        <input type="number" name="novoElemento" placeholder="Digite o elemento a ser registrado">
        <button type="submit" name="adicionar">Adicionar Elemento</button>
    </form>

    <form method="post" action="1_b.php">
        <input type="radio" id="crescente" name="ordem" value="crescente" checked>
        <label for="crescente">Crescente</label>
        <input type="radio" id="decrescente" name="ordem" value="decrescente">
        <label for="decrescente">Decrescente</label>
        <button type="submit" name="ordenar">Ordenar</button>
    </form>

    <?php
    if (!empty($_SESSION['elementos_1b'])) {
        echo "<h3>Elementos Registrados:</h3>";
        echo "<ul>";
        foreach ($_SESSION['elementos_1b'] as $elemento) {
            echo "<li>$elemento</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nenhum elemento registrado.</p>";
    }
    ?>
</body>
</html>
