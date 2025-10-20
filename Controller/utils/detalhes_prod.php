<?php
include '../../model/DB/conexao.php';
$id_produto = $_GET['id_produto'] ?? null;

$sql = "SELECT p.*, c.cat_nome, s.subcat_nome
        FROM produto p
        LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
        LEFT JOIN subcategoria s ON p.id_subcategoria = s.id_subcategoria
        WHERE p.id_produto = ?";

$query = $con->prepare($sql);
$query->bind_param("i", $id_produto);
$query->execute();
$result = $query->get_result();
$produto = $result->fetch_assoc();

if (!$produto) {
    die("Produto não encontrado!");
}

$valor_formatado = number_format($produto['valor'], 2, ',', '.');
$peso_formatado = $produto['peso'] ? number_format($produto['peso'], 2, ',', '.') . ' kg' : 'Não informado';
?>