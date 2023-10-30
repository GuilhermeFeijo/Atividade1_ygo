<?php
// Inicia a sessão para armazenar os Elemento 
session_start();

// Verifica se a variável de sessão não está definida, caso não esteja define como array vazio
if (!isset($_SESSION['elementos'])) {

    $_SESSION['elementos'] = array();

}


// Se o botão REGISTRAR for acionado, executa a ação de novo Elemento
if (isset($_POST['registrar'])) {

    $novoElemento = $_POST['novoElemento'];

    // Verifica se o novo elemento é maior ou igual a zero antes de adicionar ao array
    if ($novoElemento >= 0) {

        $_SESSION['elementos'][] = $novoElemento; // Adiciona o novo elemento ao final do array 'Elemento'
        echo "Elemento $novoElemento registrado com sucesso.\n";

    } else {
        echo "Não é possível registrar elementos negativos.\n";
    }

} 


// Se o botão EXCLUIR for acionado, executa a ação de excluir um elemento
elseif (isset($_POST['excluir'])) {

    $elementoExcluir = $_POST['elementoExcluir'];
    $elementos = $_SESSION['elementos']; 
    $newElementos = array();  
    $elementoExcluido = false; 

    // Percorre os elementos na sessão
    foreach ($elementos as $elemento) {

        // Verifica se o elemento é diferente do elemento a ser excluído ou se o elemento já foi excluído
        if ($elemento != $elementoExcluir) {

            $newElementos[] = $elemento;  // Adiciona o elemento ao novo array se não for o elemento a ser excluído

        } else {

            $elementoExcluido = true;

        }

    }

    $_SESSION['elementos'] = $newElementos;  // Atualiza a sessão com os elementos restantes

    if($elementoExcluido == true){
        echo "Elemento $elementoExcluir excluído.\n";
    }else{
        echo "Elemento Não localizado";
    }
    
}

// Verifica se o botão 'listarElementos' foi acionado
if (isset($_POST['listarElementos'])) {
    $elementos = $_SESSION['elementos'];  // Recupera os elementos da sessão

    // Variável para contar os elementos
    $numElementos = 0;
    foreach ($elementos as $elemento) {
        $numElementos++; // Incrementa o contador para cada elemento encontrado
    }

    // Verifica se não há elementos registrados
    if ($numElementos === 0) {
        echo "Nenhum elemento registrado.";
    } else {
        echo "<h3>Elementos Registrados:</h3>";
        echo "<ul>";

        // Exibe os elementos individualmente
        $contador = 0;
        while ($contador < $numElementos) {
            echo "<li>$elementos[$contador]</li>";
            $contador++;
        }
        
        echo "</ul>";
    }
}

// Verifica se o botão 'listarInverso' foi acionado
if (isset($_POST['listarInverso'])) {
    $elementos = $_SESSION['elementos'];  // Recupera os elementos da sessão

    // Verifica se não há elementos registrados
    if (empty($elementos)) {
        echo "<h3>Elementos Registrados (em ordem inversa à ordem de inserção):</h3>";
        echo "Nenhum elemento registrado.";
    } else {
        echo "<h3>Elementos Registrados (em ordem inversa à ordem de inserção):</h3>";
        echo "<ul>";

        $numElementos = 0;
        foreach ($elementos as $elemento) {
            $numElementos++; // Conta o número de elementos
        }

        $contador = $numElementos - 1;
        while ($contador >= 0) {
            echo "<li>$elementos[$contador]</li>"; // Exibe os elementos na ordem inversa
            $contador--;
        }

        echo "</ul>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Controle de Elementos</title>
</head>
<body>
    <h2>Controle de Elementos</h2>

    <form method="post" action="1_a.php">
        <input type="number" name="novoElemento" placeholder="Digite o elemento a ser registrado">
        <button type="submit" name="registrar">Registrar Elemento</button>
    </form>
    <br>
    <form method="post" action="1_a.php">
        <input type="number" name="elementoExcluir" placeholder="Digite o elemento a ser excluído">
        <button type="submit" name="excluir">Excluir Elemento</button>
    </form>

    <form method="post" action="1_a.php">
        <button type="submit" name="listarElementos">Listar Elementos</button>
    </form>

    <form method="post" action="1_a.php">
        <button type="submit" name="listarInverso">Listar elementos inverso à ordem de inserção</button>
    </form>
</body>
</html>
