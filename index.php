<?php

include("config.php");

function exibirTarefas() {
    global $conexao;
    $sql = "SELECT * FROM tarefas";
    $resultado = mysqli_query($conexao, $sql);
    while ($tarefa = mysqli_fetch_assoc($resultado)) {
        echo '<tr>';
        echo '<td>'.$tarefa['titulo'].'</td>';
        echo '<td>'.$tarefa['descricao'].'</td>';
        echo '<td>'.$tarefa['data_vencimento'].'</td>';
        if(empty($tarefa['data_conclusao'])){
        echo'<td><a href="?acao=concluir&id='.$tarefa['id'].'">Concluir</a></td>';
        }
        else{
        echo '<td>'.$tarefa['data_conclusao'].'</td>';
        }
        echo '<td><a href="?acao=editar&id='.$tarefa['id'].'">Editar</a></td>';
        echo '<td><a href="?acao=excluir&id='.$tarefa['id'].'">Excluir</a></td>';
        echo '</tr>';
    }
}

function criarTarefa($titulo, $descricao, $data_vencimento) {
    global $conexao;
    $sql = "INSERT INTO tarefas (titulo, descricao, data_vencimento) VALUES ('$titulo', '$descricao', '$data_vencimento')";
    mysqli_query($conexao, $sql);
}

function editarTarefa($id, $titulo, $descricao, $data_vencimento) {
    global $conexao;
    $sql = "UPDATE tarefas SET titulo='$titulo', descricao='$descricao', data_vencimento='$data_vencimento' WHERE id=$id";
    mysqli_query($conexao, $sql);
}

function excluirTarefa($id) {
    global $conexao;
    $sql = "DELETE FROM tarefas WHERE id=$id";
    mysqli_query($conexao, $sql);
}

if (isset($_POST['criar'])) {
    if (isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['data_vencimento']) &&
        !empty($_POST['titulo']) && !empty($_POST['descricao']) && !empty($_POST['data_vencimento'])) {
        $erro = '';
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $data_vencimento = $_POST['data_vencimento'];
        criarTarefa($titulo, $descricao, $data_vencimento);
    } else {
        $erro = '<p style="color:red">Por favor, preencha todos os campos obrigatórios!</p>';
    }
}

if (isset($_POST['editar'])) {
if (isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['data_vencimento']) &&
!empty($_POST['titulo']) && !empty($_POST['descricao']) && !empty($_POST['data_vencimento'])) {
    $erro_edicao = '';
    $id = $_GET['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_vencimento = $_POST['data_vencimento'];
    editarTarefa($id, $titulo, $descricao, $data_vencimento);
    header("location: index.php");
} else {
    $erro_edicao = '<p style="color:red">Por favor, preencha todos os campos obrigatórios!</p>';
}
}

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
$id = $_GET['id'];
excluirTarefa($id);
}

if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
$id = $_GET['id'];
$sql = "SELECT * FROM tarefas WHERE id=$id";
$resultado = mysqli_query($conexao, $sql);
$tarefa = mysqli_fetch_assoc($resultado);
}

if (isset($_GET['acao']) && $_GET['acao'] == 'concluir') {
$id = $_GET['id'];
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d');
global $conexao;
$sql = "UPDATE tarefas SET data_conclusao = '$data' WHERE id=$id";
mysqli_query($conexao, $sql);
header("location: index.php");
}

echo '<html>';
echo '<head>';
echo '<title>CRUD de Tarefas</title>';
echo '</head>';
echo '<body>';

echo '<h2>Nova Tarefa</h2>';
echo '<form method="POST" class="form">';
echo '<label>Título:</label><br>';
echo '<input type="text" name="titulo" value="" class="input"><br>';
echo '<label>Descrição:</label><br>';
echo '<textarea name="descricao" class="input"></textarea><br>';
echo '<label>Data de Vencimento:</label><br>';
echo '<input type="date" name="data_vencimento" value="" class="input"><br>';
echo $erro;
echo '<input type="submit" name="criar" value="Criar" class="button">';
echo '</form>';

echo '<h2>Tarefas</h2>';
echo '<table class="table">';
echo '<thead class="thead">';
echo '<tr>';
echo '<th>Título</th>';
echo '<th>Descrição</th>';
echo '<th>Data de Vencimento</th>';
echo '<th>Data de Conclusão</th>';
echo '<th>Editar</th>';
echo '<th>Excluir</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody class="tbody">';
exibirTarefas();
echo '</tbody>';
echo '</table>';

if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
echo '<h2>Editar Tarefa</h2>';
echo '<form method="POST">';
echo '<input type="hidden" name="id" value="'.$tarefa['id'].'">';
echo '<label>Título:</label><br>';
echo '<input type="text" name="titulo" value="'.$tarefa['titulo'].'"><br>';
echo '<label>Descrição:</label><br>';
echo '<textarea name="descricao">'.$tarefa['descricao'].'</textarea><br>';
echo '<label>Data de Vencimento:</label><br>';
echo '<input type="date" name="data_vencimento" value="'.$tarefa['data_vencimento'].'"><br>';
echo $erro_edicao;
echo '<input type="submit" name="editar" value="Salvar">';
echo '</form>';
}

echo '</body>';
echo '</html>';

mysqli_close($conexao);
?>

<style>
body, h1, h2, p, ul, li, table, th, td, form, input, textarea, button {
    margin: 0;
    padding: 0;
    border: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    color: #333;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h1, h2 {
    color: #333;
}

.form {
    margin-bottom: 20px;
}

.label {
    font-weight: bold;
}

.input, textarea {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
}

.button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    font-size: 16px;
    cursor: pointer;
}

.button:hover {
    background-color: #0056b3;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.thead {
    background-color: #007bff;
    color: #fff;
}

.th, .td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ccc;
}

.td a {
    text-decoration: none;
    color: #007bff;
}

.td a:hover {
    text-decoration: underline;
}

</style>